<?php

namespace CWP\CWP\Tests\PageTypes;

use CWP\CWP\PageTypes\EventHolder;
use SilverStripe\Dev\FunctionalTest;

class DatedUpdateHolderControllerTest extends FunctionalTest
{
    protected static $fixture_file = 'EventHolderTest.yml';

    protected static $use_draft_site = true;

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
}
