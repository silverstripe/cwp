<?php

namespace CWP\CWP\PageTypes;

use DateTime;
use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTP;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\Connect\DatabaseException;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\Taxonomy\TaxonomyTerm;

class DatedUpdateHolder extends Page
{
    /**
     * Meant as an abstract base class.
     *
     * {@inheritDoc}
     */
    private static $hide_ancestor = DatedUpdateHolder::class;

    private static $update_name = 'Updates';

    private static $update_class = DatedUpdatePage::class;

    private static $singular_name = 'Dated Update Holder';

    private static $plural_name = 'Dated Update Holders';

    private static $table_name = 'DatedUpdateHolder';

    /**
     * Find all distinct tags (TaxonomyTerms) associated with the DatedUpdatePages under this holder.
     */
    public function UpdateTags()
    {
        $siteTree = DataObject::getSchema()->tableName(SiteTree::class);
        $taxonomy = DataObject::getSchema()->tableName(TaxonomyTerm::class);

        $tags = TaxonomyTerm::get()
            ->innerJoin('BasePage_Terms', sprintf('"%s"."ID"="BasePage_Terms"."TaxonomyTermID"', $taxonomy))
            ->innerJoin(
                $siteTree,
                sprintf(
                    '"%s"."ID" = "BasePage_Terms"."BasePageID" AND "%s"."ParentID" = \'%d\'',
                    $siteTree,
                    $siteTree,
                    $this->ID
                )
            )
            ->sort('Name');

        return $tags;
    }

    /**
     * Wrapper to find all updates belonging to this holder, based on some filters.
     */
    public function Updates($tagID = null, $dateFrom = null, $dateTo = null, $year = null, $monthNumber = null)
    {
        $className = Config::inst()->get($this->ClassName, 'update_class');
        return static::AllUpdates($className, $this->ID, $tagID, $dateFrom, $dateTo, $year, $monthNumber);
    }

    /**
     * Find all site's updates, based on some filters.
     * Omitting parameters will prevent relevant filters from being applied. The filters are ANDed together.
     *
     * @param string $className The name of the class to fetch.
     * @param int|null $parentID The ID of the holder to extract the updates from.
     * @param int|null $tagID The ID of the tag to filter the updates by.
     * @param string|null $dateFrom The beginning of a date filter range.
     * @param string|null $dateTo The end of the date filter range. If empty, only one day will be searched for.
     * @param int|null $year Numeric value of the year to show.
     * @param int|null $monthNumber Numeric value of the month to show.
     *
     * @returns DataList | PaginatedList
     */
    public static function AllUpdates(
        $className = DatedUpdatePage::class,
        $parentID = null,
        $tagID = null,
        $dateFrom = null,
        $dateTo = null,
        $year = null,
        $monthNumber = null
    ) {

        $items = $className::get();
        $dbTableName = DataObject::getSchema()->tableForField($className, 'Date');
        if (!$dbTableName) {
            $dbTableName = DatedUpdatePage::class;
        }

        // Filter by parent holder.
        if (isset($parentID)) {
            $items = $items->filter(['ParentID'=>$parentID]);
        }

        // Filter down to a single tag.
        if (isset($tagID)) {
            $taxonomy = DataObject::getSchema()->tableName(TaxonomyTerm::class);
            $tableName = DataObject::getSchema()->tableName($className);

            $items = $items->innerJoin(
                'BasePage_Terms',
                sprintf('"%s"."ID" = "BasePage_Terms"."BasePageID"', $tableName)
            )->innerJoin(
                $taxonomy,
                sprintf(
                    '"BasePage_Terms"."TaxonomyTermID" = "%s"."ID" AND "TaxonomyTerm"."ID" = \'%d\'',
                    $taxonomy,
                    $tagID
                )
            );
        }

        // Filter by date
        if (isset($dateFrom)) {
            if (!isset($dateTo)) {
                $dateTo = $dateFrom;
            }

            $items = $items->where([
                sprintf('"%s"."Date" >= \'%s\'', $dbTableName, Convert::raw2sql("$dateFrom 00:00:00")),
                sprintf('"%s"."Date" <= \'%s\'', $dbTableName, Convert::raw2sql("$dateTo 23:59:59"))
            ]);
        }

        // Filter down to single month.
        if (isset($year) && isset($monthNumber)) {
            $year = (int)$year;
            $monthNumber = (int)$monthNumber;

            $beginDate = sprintf("%04d-%02d-01 00:00:00", $year, $monthNumber);
            $endDate = date('Y-m-d H:i:s', strtotime("{$beginDate} +1 month"));

            $items = $items->where(array(
                sprintf('"%s"."Date" >= \'%s\'', $dbTableName, Convert::raw2sql($beginDate)),
                sprintf('"%s"."Date" < \'%s\'', $dbTableName, Convert::raw2sql($endDate))
            ));
        }

        try {
            // Try running query inside try/catch block to handle any invalid date format
            $items->dataQuery()->execute();
        } catch (DatabaseException $e) {
            self::handleInvalidDateFormat($e);
            // Ensure invalid SQL does not get run again
            $items = $className::get()->limit(0);
        }

        // Unpaginated DataList.
        return $items;
    }

    /**
     * Produce an ArrayList of available months out of the updates contained in the DataList.
     *
     * Here is an example of the returned structure:
     * ArrayList:
     *   ArrayData:
     *     YearName => 2013
     *     Months => ArrayList:
     *       MonthName => Jan
     *       MonthNumber => 1
     *       MonthLink => (page URL)year=2012&month=1
     *       Active => true
     *   ArrayData:
     *     YearName => 2012
     *     Months => ArrayList:
     *     ...
     *
     * @param DataList $updates DataList DataList to extract months from.
     * @param string $link Link used as abase to construct the MonthLink.
     * @param int $currentYear Currently selected year, for computing the link active state.
     * @param int $currentMonthNumber Currently selected month, for computing the link active state.
     *
     * @returns ArrayList
     */
    public static function ExtractMonths(
        DataList $updates,
        $link = null,
        $currentYear = null,
        $currentMonthNumber = null
    ) {
        // Set the link to current URL in the same way the HTTP::setGetVar does it.
        if (!isset($link)) {
            $link = Director::makeRelative($_SERVER['REQUEST_URI']);
        }

        $dates = [];
        try {
            $dates = $updates->dataQuery()
                ->groupby('YEAR("Date")')
                ->groupby('MONTH("Date")')
                ->query()
                ->setSelect([
                    'Year' => 'YEAR("Date")',
                    'Month' => 'MONTH("Date")',
                ])
                ->addWhere('"Date" IS NOT NULL')
                ->setOrderBy([
                    'YEAR("Date")' => 'DESC',
                    'MONTH("Date")' => 'DESC',
                ])
                ->execute();
        } catch (DatabaseException $e) {
            self::handleInvalidDateFormat($e);
        }

        $years = [];
        foreach ($dates as $date) {
            $monthNumber = $date['Month'];
            $year = $date['Year'];
            $dateObj = new DateTime(implode('-', [$year, $monthNumber, 1]));
            $monthName = $dateObj->Format('M');

            // Set up the relevant year array, if not yet available.
            if (!isset($years[$year])) {
                $years[$year] = ['YearName'=>$year, 'Months' => []];
            }

            // Check if the currently processed month is the one that is selected via GET params.
            $active = false;
            if (isset($year) && isset($monthNumber)) {
                $active = (((int)$currentYear)==$year && ((int)$currentMonthNumber)==$monthNumber);
            }

            // Build the link - keep the tag and date filter, but reset the pagination.
            if ($active) {
                // Allow clicking to deselect the month.
                $link = HTTP::setGetVar('month', null, $link, '&');
                $link = HTTP::setGetVar('year', null, $link, '&');
            } else {
                $link = HTTP::setGetVar('month', $monthNumber, $link, '&');
                $link = HTTP::setGetVar('year', $year, $link, '&');
            }
            $link = HTTP::setGetVar('start', null, $link, '&');

            $years[$year]['Months'][$monthNumber] = array(
                'MonthName'=>$monthName,
                'MonthNumber'=>$monthNumber,
                'MonthLink'=>$link,
                'Active'=>$active
            );
        }

        // ArrayList will not recursively walk through the supplied array, so manually build nested ArrayLists.
        foreach ($years as &$year) {
            $year['Months'] = new ArrayList($year['Months']);
        }

        // Reverse the list so the most recent years appear first.
        return new ArrayList($years);
    }

    public function getDefaultRSSLink()
    {
        return $this->Link('rss');
    }

    public function getDefaultAtomLink()
    {
        return $this->Link('atom');
    }

    public function getSubscriptionTitle()
    {
        return $this->Title;
    }

    private static function handleInvalidDateFormat(DatabaseException $e): void
    {
        $controller = Controller::curr();
        if ($controller instanceof DatedUpdateHolderController &&
            strpos($e->getMessage(), 'Incorrect DATETIME value') !== false
        ) {
            $controller->getRequest()->getSession()->set(DatedUpdateHolderController::TEMP_FORM_MESSAGE, _t(
                DatedUpdateHolderController::class . '.InvalidDateFormat',
                'Dates must be in "y-MM-dd" format.'
            ));
        } else {
            throw $e;
        }
    }
}
