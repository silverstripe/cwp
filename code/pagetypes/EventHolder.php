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

	/**
	 * Find all underlying events, based on some filters.
	 * Omitting parameters will prevent relevant filters from being applied.
	 *
	 * @returns DataList | PaginatedList
	 */
	public function Events($tagID = null, $dateFrom = null, $dateTo = null, $year = null, $monthNumber = null) {
		// For starters, get all events belonging under current holder.
		$items = EventPage::get()->filter(array('ParentID'=>$this->ID))->sort('Date', 'DESC');

		// Filter down to a single tag.
		if (isset($tagID)) {
			$items = $items->innerJoin(
					'BasePage_Terms',
					'"EventPage"."ID"="BasePage_Terms"."BasePageID"'
				)->innerJoin(
					'TaxonomyTerm',
					"\"BasePage_Terms\".\"TaxonomyTermID\"=\"TaxonomyTerm\".\"ID\" AND \"TaxonomyTerm\".\"ID\"='$tagID'"
				);
		}

		// Filter by date
		if (isset($dateFrom)) {

			if (isset($dateTo)) {
				// Date range
				$dateTo = "$dateTo 23:59:59";
				$dateFrom = "$dateFrom 00:00:00";
			}
			else {
				// Single date, set the dateTo based on the dateFrom.
				$dateTo = "$dateFrom 23:59:59";
				$dateFrom = "$dateFrom 00:00:00";
			}

			$items = $items->where("(\"EventPage\".\"Date\">='$dateFrom' AND \"EventPage\".\"Date\"<='$dateTo')");
		}

		// Filter down to single month.
		if (isset($year) && isset($monthNumber)) {
			$year = (int)$year;
			$monthNumber = (int)$monthNumber;

			$beginDate = "$year-$monthNumber-01 00:00:00";
			$endDate = date('Y-m-d H:i:s', strtotime("$year-$monthNumber-1 00:00:00 +1 month"));

			$items = $items->where("(\"EventPage\".\"Date\">='$beginDate' AND \"EventPage\".\"Date\"<'$endDate')");
		}

		// Unpaginated DataList.
		return $items;
	}

	/**
	 * Produce an ArrayList of available months out of the events contained in the DataList.
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
	 * @param $items DataList DataList to extract months from.
	 * @param $link Link used as abase to construct the MonthLink.
	 * @param $currentYear Currently selected year, for computing the link active state.
	 * @param $currentMonthNumber Currently selected month, for computing the link active state.
	 *
	 * @returns ArrayList
	 */
	public static function ExtractMonths(DataList $items, $link, $currentYear, $currentMonthNumber) {
		$years = array();
		foreach ($items as $item) {
			$year = $item->obj('Date')->Format('Y');
			$monthNumber = $item->obj('Date')->Format('n');
			$monthName = $item->obj('Date')->Format('M');

			// Set up the relevant year array, if not yet available.
			if (!isset($years[$year])) {
				$years[$year] = array('YearName'=>$year, 'Months'=>array());
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

		return new ArrayList($years);
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}

	public function getSubscriptionTitle() {
		return SiteConfig::current_site_config()->Title . ' events';
	}

}

/**
 * The parameters apply in the following preference order:
 *  - Highest priority: Tag & date (or date range)
 *  - Month (and Year)
 *  - Pagination
 *
 * So, when the user click on a tag link, the pagination, and month will be reset, but not the date filter. Also,
 * changing the date will not affect the tag, but will reset the month and pagination.
 *
 * When the user clicks on a month, pagination will be reset, but tags retained. Pagination retains all other
 * parameters.
 */
class EventHolder_Controller extends Page_Controller {

	public static $allowed_actions = array(
		'rss',
		'DateRangeForm'
	);

	public function init() {
		parent::init();

		// Include the DateRangeForm JS manually. We use custom form and $DateRangeForm is never invoked directly.
		Requirements::javascript('framework/javascript/DateField.js');
		Requirements::css('framework/thirdparty/jquery-ui-themes/smoothness/jquery-ui.css');

		RSSFeed::linkToFeed($this->Link() . 'rss', $this->getSubscriptionTitle());
	}

	/**
	 * Parse URL parameters.
	 */
	public function parseParams() {
		$tag = $this->request->getVar('tag');
		$from = $this->request->getVar('from');
		$to = $this->request->getVar('to');
		$year = $this->request->getVar('year');
		$month = $this->request->getVar('month');

		if ($tag=='') $tag = null;
		if ($from=='') $from = null;
		if ($to=='') $to = null;
		if ($year=='') $year = null;
		if ($month=='') $month = null;

		if (isset($tag)) $tag = (int)$tag;
		if (isset($from)) {
			$from = urldecode($from);
			$parser = new SS_Datetime;
			$parser->setValue($from);
			$from = $parser->Format('Y-m-d');
		}
		if (isset($to)) {
			$to = urldecode($to);
			$parser = new SS_Datetime;
			$parser->setValue($to);
			$to = $parser->Format('Y-m-d');
		}
		if (isset($year)) $year = (int)$year;
		if (isset($month)) $month = (int)$month;

		return array(
			'tag' => $tag,
			'from' => $from,
			'to' => $to,
			'year' => $year,
			'month' => $month
		);
	}

	/**
	 * Build the link - keep the date range, reset the rest.
	 */
	public function AllTagsLink() {
		$params = $this->parseParams();

		$link = HTTP::setGetVar('tag', null, null, '&');
		$link = HTTP::setGetVar('month', null, $link, '&');
		$link = HTTP::setGetVar('year', null, $link, '&');
		$link = HTTP::setGetVar('start', null, $link, '&');

		return $link;
	}

	/**
	 * List tags and attach links.
	 */
	public function EventTagsWithLinks() {
		$tags = $this->EventTags();

		$processed = new ArrayList();

		foreach ($tags as $tag) {
			// Build the link - keep the tag, and date range, but reset month, year and pagination.
			$link = HTTP::setGetVar('tag', $tag->ID, null, '&');
			$link = HTTP::setGetVar('month', null, $link, '&');
			$link = HTTP::setGetVar('year', null, $link, '&');
			$link = HTTP::setGetVar('start', null, $link, '&');

			$tag->Link = $link;
			$processed->push($tag);
		}

		return $processed;
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
	 * Extract the available months based on the current query.
	 * Only tag is respected. Pagination and months are ignored.
	 */
	public function AvailableMonths() {
		$params = $this->parseParams();

		return EventHolder::ExtractMonths(
			$this->Events($params['tag'], $params['from'], $params['to']),
			Director::makeRelative($_SERVER['REQUEST_URI']),
			$params['year'],
			$params['month']
		);
	}

	/**
	 * Get the events based on the current query.
	 */
	public function FilteredEvents($pageSize = 20) {
		$params = $this->parseParams();

		$items = $this->Events(
			$params['tag'],
			$params['from'],
			$params['to'],
			$params['year'],
			$params['month']
		);

		// Apply pagination
		$list = new PaginatedList($items, $this->request);
		$list->setPageLength($pageSize);
		return $list;
	}
	
	public function DateRangeForm() {
		$params = $this->parseParams();

		$fields = new FieldList(
			$dateFrom = new DateField('from'),
			$dateTo = new DateField('to'),
			new HiddenField('tag')
		);
		$dateFrom->setConfig('showcalendar', true);
		$dateTo->setConfig('showcalendar', true);

		$actions = new FieldList(
			FormAction::create("doDateFilter")->setTitle("Filter")->addExtraClass('btn btn-primary'),
			FormAction::create("doDateReset")->setTitle("Clear")->addExtraClass('btn')
		);

		$form = new Form($this, 'DateRangeForm', $fields, $actions);
		$form->loadDataFrom($this->request->getVars());
		$form->setFormMethod('get');

		return $form;
	}

	public function doDateFilter() {
		$params = $this->parseParams();

		// Build the link - keep the tag, but reset month, year and pagination.
		$link = HTTP::setGetVar('from', $params['from'], $this->AbsoluteLink(), '&');
		$link = HTTP::setGetVar('to', $params['to'], $link, '&');
		if (isset($params['tag'])) $link = HTTP::setGetVar('tag', $params['tag'], $link, '&');

		$this->redirect($link);
	}

	public function doDateReset() {
		$params = $this->parseParams();

		// Reset the link - only include the tag.
		$link = $this->AbsoluteLink();
		if (isset($params['tag'])) $link = HTTP::setGetVar('tag', $params['tag'], $link, '&');

		$this->redirect($link);
	}

	public function rss() {
		$rss = new RSSFeed($this->Children()->limit(20), $this->Link(), $this->getSubscriptionTitle());
		return $rss->outputToBrowser();
	}
}

