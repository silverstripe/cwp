<?php

class EventHolderTest extends SapphireTest {
	static $fixture_file = 'cwp/tests/EventHolderTest.yml';

	function testEventTags() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		$tags = $holder->EventTags();
		$this->assertNotNull($tags->find('Name', 'Future'), 'Finds present terms.');
		$this->assertNull($tags->find('Name', 'Event types', 'Does not find top level taxonomy.'));
		$this->assertNull($tags->find('Name', 'Carrot'), 'Does not find terms that are not applied.');
	}

	function testEventsWithTagFilter() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		//Get the "Future" tag.
		$tag = $this->objFromFixture('TaxonomyTerm', 'TaxonomyTerm1');

		$items = $holder->Events($tag->ID);
		
		$this->assertNotNull($items->find('URLSegment', 'future-event-1'), 'Finds the tagged page.');
		$this->assertNull($items->find('URLSegment', 'past-event-1'), 'Does not find pages that are not tagged.');
	}

	function testEventsWithMonthFilter() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		$items = $holder->Events(null, null, null, 2013, 7);
		
		$this->assertNotNull($items->find('URLSegment', 'future-event-1'), 'Finds the event in 2013-07.');
		$this->assertNull($items->find('URLSegment', 'past-event-1'), 'Does not find events at other dates.');
	}

	function testEventsWithDateRangeFilter() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		$items = $holder->Events(null, '2013-01-19', null);
		$this->assertNotNull($items->find('URLSegment', 'past-event-2'), 'Finds the event at the date');
		$this->assertNull($items->find('URLSegment', 'future-event-1'), 'Does not find the event at another date');

		$items = $holder->Events(null, '2013-01-01', '2013-01-19');
		$this->assertNotNull($items->find('URLSegment', 'past-event-2'), 'Finds events in the date range');
		$this->assertNull($items->find('URLSegment', 'future-event-1'), 'Does not find event out of range');
	}

	function testExtractMonths() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		$months = EventHolder::ExtractMonths(
			$holder->Events(),
			'http://mybase.org/?tag=12&start=10&from=2010-10-10&to=2010-10-11', // Used for link generation
			2013, // Currently selected
			1 // Currently selected
		);

		// Check which years are generated.
		$this->assertNotNull($months->find('YearName', 2013), 'Generates existing year');
		$this->assertNull($months->find('YearName', 1990), 'Does not generate non-present year');

		$year = $months->find('YearName', 2013);

		// Check which months come up in 2013
		$this->assertNotNull($year['Months']->find('MonthNumber', 7), 'Generates existing month');
		$this->assertNull($year['Months']->find('MonthNumber', 12), 'Does not generate non-present month');

		$month = $year['Months']->find('MonthNumber', 7);
		$this->assertEquals(
			$month['MonthLink'],
			'http://mybase.org/?tag=12&from=2010-10-10&to=2010-10-11&month=7&year=2013',
			'Selection link is built properly - start is removed, and tag, from and to retained.'
		);

		// Check if these months are marked properly.
		$month = $year['Months']->find('MonthNumber', 1);
		$this->assertEquals($month['Active'], true, 'Correctly marks active link');
	}
}
