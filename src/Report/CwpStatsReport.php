<?php

namespace CWP\CWP\Report;

use SilverStripe\Assets\File;
use SilverStripe\Assets\Folder;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldExportButton;
use SilverStripe\Forms\GridField\GridFieldPrintButton;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Reports\Report;
use SilverStripe\Subsites\Model\Subsite;
use SilverStripe\Versioned\Versioned;

/**
 * Summary report on the page and file counts managed by this CMS.
 */
class CwpStatsReport extends Report
{
    public function title()
    {
        return _t(__CLASS__ . '.Title', 'Summary statistics');
    }

    public function description()
    {
        return _t(
            __CLASS__ . '.Description',
            'This report provides various statistics for this site. The "total live page count" is the number that ' .
                'can be compared against the instance size specifications.'
        );
    }

    public function columns()
    {
        return [
            'Name' => _t(__CLASS__ . '.Name', 'Name'),
            'Count' => _t(__CLASS__ . '.Count', 'Count'),
        ];
    }

    /**
     * Manually create source records for the report. Agreggates cannot be provided as a column of a DataQuery result.
     *
     * {@inheritDoc}
     */
    public function sourceRecords($params = [], $sort = null, $limit = null)
    {
        $records = [];

        // Get the query to apply across all variants: looks at all subsites, translations, live stage only.
        $crossVariant = (function ($dataQuery) {
            $params = [
                'Subsite.filter' => false,
                'Versioned.mode' => 'stage',
                'Versioned.stage' => Versioned::LIVE,
            ];

            return $dataQuery->setDataQueryParam($params);
        });

        // Total.
        $records[] = [
            'Name' => _t(
                __CLASS__ . '.TotalPageCount',
                'Total live page count, across all translations and subsites'
            ),
            'Count' => $crossVariant(SiteTree::get())->count(),
        ];

        if (class_exists(Subsite::class)) {
            // Main site.
            $records[] = [
                'Name' => _t(__CLASS__ . '.PagesForMainSite', '- in the main site'),
                'Count' => $crossVariant(SiteTree::get())
                    ->filter(['SubsiteID' => 0])
                    ->count(),
            ];

            // Per subsite.
            $subsites = Subsite::get();
            foreach ($subsites as $subsite) {
                $records[] = [
                    'Name' => _t(
                        __CLASS__ . '.PagesForSubsite',
                        "- in the subsite '{SubsiteTitle}'",
                        ['SubsiteTitle' => $subsite->Title]
                    ),
                    'Count' => $crossVariant(SiteTree::get())
                        ->filter(['SubsiteID' => $subsite->ID])
                        ->count(),
                ];
            }
        }

        // Files.
        $records[] = [
            'Name' => _t(__CLASS__ . '.FileCount', 'File count'),
            'Count' => File::get()
                ->setDataQueryParam('Subsite.filter', false)
                ->filter(['ClassName:not' => Folder::class])
                ->count(),
        ];

        return ArrayList::create($records);
    }

    /**
     * @return GridField
     */
    public function getReportField()
    {
        /** @var GridField $gridField */
        $gridField = parent::getReportField();

        /** @var GridFieldConfig $gridConfig */
        $gridConfig = $gridField->getConfig();
        $gridConfig->removeComponentsByType(GridFieldPrintButton::class);
        $gridConfig->removeComponentsByType(GridFieldExportButton::class);
        $gridConfig->removeComponentsByType(GridFieldSortableHeader::class);

        return $gridField;
    }
}
