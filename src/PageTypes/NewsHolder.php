<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\ORM\DataList;
use SilverStripe\ORM\PaginatedList;

class NewsHolder extends DatedUpdateHolder
{
    private static $description = 'Container page for News Pages, provides news filtering and pagination';

    private static $allowed_children = [
        NewsPage::class,
    ];

    private static $default_child = NewsPage::class;

    private static $update_name = 'News';

    private static $update_class = NewsPage::class;

    private static $icon_class = 'font-icon-news';

    private static $singular_name = 'News Holder';

    private static $plural_name = 'News Holders';

    private static $table_name = 'NewsHolder';

    /**
     * Find all site's news items, based on some filters.
     * Omitting parameters will prevent relevant filters from being applied. The filters are ANDed together.
     *
     * @param string $className The name of the class to fetch.
     * @param int $parentID The ID of the holder to extract the news items from.
     * @param int $tagID The ID of the tag to filter the news items by.
     * @param string $dateFrom The beginning of a date filter range.
     * @param string $dateTo The end of the date filter range. If empty, only one day will be searched for.
     * @param int $year Numeric value of the year to show.
     * @param int $monthNumber Numeric value of the month to show.
     *
     * @returns DataList|PaginatedList
     */
    public static function AllUpdates(
        $className = NewsPage::class,
        $parentID = null,
        $tagID = null,
        $dateFrom = null,
        $dateTo = null,
        $year = null,
        $monthNumber = null
    ) {
        return parent::AllUpdates($className, $parentID, $tagID, $dateFrom, $dateTo, $year, $monthNumber)
            ->Sort('Date', 'DESC');
    }
}
