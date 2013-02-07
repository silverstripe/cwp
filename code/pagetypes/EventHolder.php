<?php

class EventHolder extends Page {

	static $allowed_children = array('EventPage');

	static $default_child = 'EventPage';

	static $icon = 'cwp/images/icons/sitetree_images/event_holder.png';

	public $pageIcon =  'images/icons/sitetree_images/event_holder.png';

	public function Children() {
		return parent::Children()->exclude('ClassName', 'EventPage');
	}

	/**
	 * Find all distinct tags (TaxonomyTerms) associated with the EventPages under this holder.
	 */
	public function EventTags() {
		$tags = TaxonomyTerm::get()
			->innerJoin('BasePage_Terms', '"TaxonomyTerm"."ID"="BasePage_Terms"."TaxonomyTermID"')
			->innerJoin('EventPage', '"BasePage_Terms"."BasePageID"="EventPage"."ID"')
			->innerJoin('SiteTree', "\"SiteTree\".\"ID\"=\"EventPage\".\"ID\" AND \"SiteTree\".\"ParentID\"='$this->ID'")
			->sort('Name');

		return $tags;
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}
}

/**
 * # About GET parameter priority #
 *
 * The GET parameters used in this page type apply in the current preference order:
 *  - Tag (highest priority)
 *  - Month & Year
 *  - Pagination page
 *
 * So, when the user click on a tag link, the pagination, and month will be reset. When the user selects a month,
 * pagination will be reset, but tags retained.
 */
class EventHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();

		RSSFeed::linkToFeed($this->Link() . 'rss', SiteConfig::current_site_config()->Title . ' news');
	}


	/**
	 * Get the TaxonomyTerm related to the current tag GET parameter.
	 */
	public function CurrentTag() {
		$tagID = $this->request->getVar('tag');
		if (isset($tagID)) {
			return TaxonomyTerm::get_by_id('TaxonomyTerm', (int)$tagID);
		}
	}

	/**
	 * Produce an array of available months out of the events from the currently selected tag.
	 *
	 * Here is an example of the returned structure:
	 * ArrayList:
	 *   ArrayData:
	 *     YearName => 2013
	 *     Months => ArrayList:
	 *       MonthName => Jan
	 *       MonthNumber => 1
	 *       MonthLink => (page URL)year=2012&month=1&start=0
	 *       Active => true
	 *   ArrayData:
	 *     YearName => 2012
	 *     Months => ArrayList:
	 *     ...
	 */
	public function CurrentMonths() {
		$items = $this->EventsWithTag();

		$currentYear = $this->request->getVar('year');
		$currentMonthNumber = $this->request->getVar('month');

		$years = array();
		foreach ($items as $item) {
			$year = $item->obj('Date')->Format('Y');
			$monthNumber = $item->obj('Date')->Format('n');
			$monthName = $item->obj('Date')->Format('M');

			// Set up the relevant year array, if not yet available.
			if (!isset($years[$year])) {
				$years[$year] = array('YearName'=>$year, 'Months'=>array());
			}

			// Build the link (retains the current GET params).
			$link = HTTP::setGetVar('year', $year, null, '&');
			$link = HTTP::setGetVar('month', $monthNumber, $link, '&');
			$link = HTTP::setGetVar('start', 0, $link, '&');

			// Check if the currently processed month is the one that is selected via GET params.
			$active = false;
			if (isset($year) && isset($monthNumber)) {
				$active = (((int)$currentYear)==$year && ((int)$currentMonthNumber)==$monthNumber);
			}

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

		return new ArrayList($years);
	}

	/**
	 * Query for Events, apply tag filter.
	 */
	public function EventsWithTag() {
		$tag = $this->CurrentTag();

		$items = EventPage::get()->sort('Date', 'DESC');

		// Filter down to a single tag.
		if ($tag) {
			$items = $items->innerJoin(
					'BasePage_Terms',
					'"EventPage"."ID"="BasePage_Terms"."BasePageID"'
				)->innerJoin(
					'TaxonomyTerm',
					"\"BasePage_Terms\".\"TaxonomyTermID\"=\"TaxonomyTerm\".\"ID\" AND \"TaxonomyTerm\".\"ID\"='$tag->ID'"
				);
		}

		return $items;
	}

	/**
	 * Apply the month filter to the tag-prefiltered events.
	 * Apply pagination on top of that.
	 */
	public function EventsWithMonth($pageSize = 20) {
		$items = $this->EventsWithTag();

		$year = $this->request->getVar('year');
		$monthNumber = $this->request->getVar('month');

		// Filter down to single month, if requested.
		if (isset($year) && isset($monthNumber)) {
			$year = (int)$year;
			$monthNumber = (int)$monthNumber;

			$beginDate = "$year-$monthNumber-01 00:00:00";
			$endDate = date('Y-m-d H:i:s', strtotime("$year-$monthNumber-1 00:00:00 +1 month"));

			$items = $items->where("(\"EventPage\".\"Date\">='$beginDate' AND \"EventPage\".\"Date\"<'$endDate')");
		}

		$list = new PaginatedList($items, $this->request);
		$list->setPageLength($pageSize);
		return $list;
	}

	public function rss() {
		$rss = new RSSFeed(
			$this->Children()->limit(20),
			$this->Link,
			SiteConfig::current_site_config()->Title . ' events'
		);
		return $rss->outputToBrowser();
	}
}

