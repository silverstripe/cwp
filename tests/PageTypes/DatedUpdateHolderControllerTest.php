<?php

namespace CWP\CWP\Tests\PageTypes;

use CWP\CWP\PageTypes\EventHolder;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\View\SSViewer;

class DatedUpdateHolderControllerTest extends FunctionalTest
{
    protected static $fixture_file = 'EventHolderTest.yml';

    protected static $use_draft_site = true;

    protected function setUp()
    {
        parent::setUp();

        // Note: this test requires the starter theme to be installed
        Config::modify()->set(SSViewer::class, 'themes', ['starter', '$default']);
        Config::modify()->set(SSViewer::class, 'theme', 'starter');
    }

    public function testSettingDateFiltersInReverseOrderShowsMessage()
    {
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');

        $result = $this->get($holder->Link() . '?from=2018-01-10&to=2018-01-01');

        $this->assertContains('Filter has been applied with the dates reversed', $result->getBody());
    }

    public function testSettingFromButNotToDateShowsMessage()
    {
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');

        $result = $this->get($holder->Link() . '?from=2018-01-10');

        $this->assertContains('Filtered by a single date', $result->getBody());
    }

    public function testInvalidDateFormat()
    {
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');
        $result = $this->get($holder->Link() . '?from=christmas&to=2018-01-10');
        $this->assertContains(htmlentities('Dates must be in "y-MM-dd" format.'), $result->getBody());
    }
}
