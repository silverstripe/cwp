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

		$items = $holder->Events(null, 2013, 7);
		
		$this->assertNotNull($items->find('URLSegment', 'future-event-1'), 'Finds the event in 2013-07.');
		$this->assertNull($items->find('URLSegment', 'past-event-1'), 'Does not find events at other dates.');
	}

	function testExtractMonths() {
		$holder = $this->objFromFixture('EventHolder', 'EventHolder1');

		$months = EventHolder::ExtractMonths(
			$holder->Events(),
			'http://mybase.org/?tag=12', // Used for link generation
			2013, // Currently selected
			7 // Currently selected
		);

		$this->assertNotNull($months->find('YearName', 2013), 'Generates existing year');
		$this->assertNull($months->find('YearName', 1990), 'Does not generate non-present year');

		$year = $months->find('YearName', 2013);

		$this->assertNotNull($year['Months']->find('MonthNumber', 7), 'Generates existing month');
		$this->assertNull($year['Months']->find('MonthNumber', 12), 'Does not generate non-present month');

		$month = $year['Months']->find('MonthNumber', 7);
		$this->assertEquals(
			$month['MonthLink'],
			'http://mybase.org/?tag=12&year=2013&month=7&start=0',
			'Link is built properly'
		);
		$this->assertEquals($month['Active'], true, 'Correctly marks active link');
	}
}
