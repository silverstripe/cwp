<?php

namespace CWP\CWP\Tests\Report;

use CWP\CWP\Report\CwpStatsReport;
use Page;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\Subsites\Model\Subsite;

class CwpStatsReportTest extends SapphireTest
{
    protected static $fixture_file = 'CwpStatsReportTest.yml';

    protected function setUp(): void
    {
        Config::modify()->set(SiteTree::class, 'create_default_pages', false);

        parent::setUp();
    }

    public function testCount()
    {
        // Publish all pages apart from page3.
        $this->objFromFixture(Page::class, 'page1')->publishRecursive();
        $this->objFromFixture(Page::class, 'page2')->publishRecursive();
        $this->objFromFixture(Page::class, 'page3')->publishRecursive();

        // Add page5s to a subsite, if the module is installed.
        $page5s = $this->objFromFixture(Page::class, 'page5s');
        if (class_exists(Subsite::class)) {
            $subsite = Subsite::create();
            $subsite->Title = 'subsite';
            $subsite->write();

            $page5s->SubsiteID = $subsite->ID;
            $page5s->write();
        }
        $page5s->publishRecursive();

        $report = CwpStatsReport::create();
        $records = $report->sourceRecords([])->toArray();
        $i = 0;
        $this->assertEquals(4, $records[$i++]['Count'], 'Four pages in total, across locales, subsites, live only.');
        if (class_exists(Subsite::class)) {
            $this->assertEquals(3, $records[$i++]['Count'], 'Three pages in the main site, if subsites installed.');
            $this->assertEquals(1, $records[$i++]['Count'], 'One page in the subsite, if subsites installed');
        }
        $this->assertEquals(1, $records[$i++]['Count'], 'One file in total.');
    }
}
