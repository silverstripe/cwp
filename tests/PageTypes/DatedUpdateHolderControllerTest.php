<?php

namespace CWP\CWP\Tests\PageTypes;

use CWP\CWP\PageTypes\EventHolder;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\SessionManager\Models\LoginSession;
use SilverStripe\View\SSViewer;
use SilverStripe\ORM\DB;

class DatedUpdateHolderControllerTest extends FunctionalTest
{
    protected static $fixture_file = 'EventHolderTest.yml';

    protected static $use_draft_site = true;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable IP anonymization to avoid TypeError when session-manager passes a null IP
        // (from a CLI test request) to IpUtils::anonymize() in PHP 8.3+ / newer symfony versions
        Config::modify()->set(LoginSession::class, 'anonymize_ip', false);

        // Note: this test requires the starter theme to be installed
        Config::modify()->set(SSViewer::class, 'themes', ['starter', '$default']);
    }

    public function testSettingDateFiltersInReverseOrderShowsMessage()
    {
        if (!$this->isRunningMySQL()) {
            $this->markTestSkipped('Not running MySQL');
        }
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');

        $this->logInWithPermission('VIEW_DRAFT_CONTENT');
        $result = $this->get($holder->Link() . '?stage=Stage' . '&from=2018-01-10&to=2018-01-01');

        $this->assertStringContainsString('Filter has been applied with the dates reversed', $result->getBody());
    }

    public function testSettingFromButNotToDateShowsMessage()
    {
        if (!$this->isRunningMySQL()) {
            $this->markTestSkipped('Not running MySQL');
        }
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');

        $this->logInWithPermission('VIEW_DRAFT_CONTENT');
        $result = $this->get($holder->Link() . '?stage=Stage' . '&from=2018-01-10');

        $this->assertStringContainsString('Filtered by a single date', $result->getBody());
    }

    public function testInvalidDateFormat()
    {
        if (!$this->isRunningMySQL()) {
            $this->markTestSkipped('Not running MySQL');
        }
        /** @var EventHolder $holder */
        $holder = $this->objFromFixture(EventHolder::class, 'EventHolder1');

        $this->logInWithPermission('VIEW_DRAFT_CONTENT');
        $result = $this->get($holder->Link() . '?stage=Stage' . '&from=christmas&to=2018-01-10');
        $this->assertStringContainsString(htmlentities('Dates must be in "y-MM-dd" format.'), $result->getBody());
    }

    /**
     * CWP was only designed to run on MySQL, will fail on PGSQL in CI due to DatedUpdateHolder::ExtractMonths()
     * using date functions that don't work in PGSQL
     */
    private function isRunningMySQL()
    {
        return strpos(strtolower(get_class(DB::get_connector())), 'mysql') !== false;
    }
}
