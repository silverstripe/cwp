<?php

class DatedUpdateHolder extends Page {

	// Meant as an abstract base class.
	private static $hide_ancestor = 'DatedUpdateHolder';

	private static $update_name = 'Updates';

	private static $update_class = 'DatedUpdatePage';

	private static $singular_name = 'Dated Update Holder';

	private static $plural_name = 'Dated Update Holders';

	/**
	 * Find all distinct tags (TaxonomyTerms) associated with the DatedUpdatePages under this holder.
	 */
	public function UpdateTags() {
		$tags = TaxonomyTerm::get()
			->innerJoin('BasePage_Terms', '"TaxonomyTerm"."ID"="BasePage_Terms"."TaxonomyTermID"')
			->innerJoin(
				'SiteTree',
				sprintf('"SiteTree"."ID" = "BasePage_Terms"."BasePageID" AND "SiteTree"."ParentID" = \'%d\'', $this->ID)
			)
			->sort('Name');

		return $tags;
	}

	/**
	 * Wrapper to find all updates belonging to this holder, based on some filters.
	 */
	public function Updates($tagID = null, $dateFrom = null, $dateTo = null, $year = null, $monthNumber = null) {
		$className = Config::inst()->get($this->ClassName, 'update_class');
		return static::AllUpdates($className, $this->ID, $tagID, $dateFrom, $dateTo, $year, $monthNumber);
	}

	/**
	 * Find all site's updates, based on some filters.
	 * Omitting parameters will prevent relevant filters from being applied. The filters are ANDed together.
	 *
	 * @param string $className The name of the class to fetch.
	 * @param int|null $parentID The ID of the holder to extract the updates from.
	 * @param int|null $tagID The ID of the tag to filter the updates by.
	 * @param string|null $dateFrom The beginning of a date filter range.
	 * @param string|null $dateTo The end of the date filter range. If empty, only one day will be searched for.
	 * @param int|null $year Numeric value of the year to show.
	 * @param int|null $monthNumber Numeric value of the month to show.
	 *
	 * @returns DataList | PaginatedList
	 */
	public static function AllUpdates($className = 'DatedUpdatePage', $parentID = null, $tagID = null, $dateFrom = null,
			$dateTo = null, $year = null, $monthNumber = null) {

		$items = $className::get();
		$dbTableName = ClassInfo::table_for_object_field($className, 'Date');

		// Filter by parent holder.
		if (isset($parentID)) {
			$items = $items->filter(array('ParentID'=>$parentID));
		}

		// Filter down to a single tag.
		if (isset($tagID)) {
			$items = $items->innerJoin(
				'BasePage_Terms',
				sprintf('"%s"."ID" = "BasePage_Terms"."BasePageID"', $className)
			)->innerJoin(
				'TaxonomyTerm',
				sprintf('"BasePage_Terms"."TaxonomyTermID" = "TaxonomyTerm"."ID" AND "TaxonomyTerm"."ID" = \'%d\'', $tagID)
			);
		}

		// Filter by date
		if (isset($dateFrom)) {

			if (!isset($dateTo)) {
				$dateTo = $dateFrom;
			}

			$items = $items->where(array(
				sprintf('"%s"."Date" >= \'%s\'', $dbTableName, Convert::raw2sql("$dateFrom 00:00:00")),
				sprintf('"%s"."Date" <= \'%s\'', $dbTableName, Convert::raw2sql("$dateTo 23:59:59"))
			));
		}

		// Filter down to single month.
		if (isset($year) && isset($monthNumber)) {
			$year = (int)$year;
			$monthNumber = (int)$monthNumber;

			$beginDate = sprintf("%04d-%02d-01 00:00:00", $year, $monthNumber);
			$endDate = date('Y-m-d H:i:s', strtotime("{$beginDate} +1 month"));

			$items = $items->where(array(
				sprintf('"%s"."Date" >= \'%s\'', $dbTableName, Convert::raw2sql($beginDate)),
				sprintf('"%s"."Date" < \'%s\'', $dbTableName, Convert::raw2sql($endDate))
			));
		}

		// Unpaginated DataList.
		return $items;
	}

	/**
	 * Produce an ArrayList of available months out of the updates contained in the DataList.
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
	 * @param $updates DataList DataList to extract months from.
	 * @param $link Link used as abase to construct the MonthLink.
	 * @param $currentYear Currently selected year, for computing the link active state.
	 * @param $currentMonthNumber Currently selected month, for computing the link active state.
	 *
	 * @returns ArrayList
	 */
	public static function ExtractMonths(DataList $updates, $link = null, $currentYear = null, $currentMonthNumber = null) {
		// Set the link to current URL in the same way the HTTP::setGetVar does it.
		if (!isset($link)) {
			$link = Director::makeRelative($_SERVER['REQUEST_URI']);
		}

		$dates = $updates->dataQuery()
			->groupby('YEAR("Date")')
			->groupby('MONTH("Date")')
			->sort('Date', 'DESC')
			->query()
			->setSelect(array(
				'Year' => 'YEAR("Date")',
				'Month' => 'MONTH("Date")',
			))
			->addWhere('"Date" IS NOT NULL')
			->execute();

		$years = array();
		foreach ($dates as $date) {
			$monthNumber = $date['Month'];
			$year = $date['Year'];
			$dateObj = new Datetime(implode('-', array($year, $monthNumber, 1)));
			$monthName = $dateObj->Format('M');

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

		// Reverse the list so the most recent years appear first.
		return new ArrayList($years);
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}

	public function getDefaultAtomLink() {
		return $this->Link('atom');
	}

	public function getSubscriptionTitle() {
		return $this->Title;
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
class DatedUpdateHolder_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'rss',
		'atom',
		'DateRangeForm'
	);


	private static $casting = array(
		'MetaTitle' => 'Text',
		'FilterDescription' => 'Text'
	);

	/**
	 * Get the meta title for the current action
	 *
	 * @return string
	 */
	public function getMetaTitle() {
		$title = $this->data()->getTitle();
		$filter = $this->FilterDescription();
		if($filter) {
			$title = "{$title} - {$filter}";
		}

		$this->extend('updateMetaTitle', $title);
		return $title;
	}

	/**
	 * Returns a description of the current filter
	 *
	 * @return string
	 */
	public function FilterDescription() {
		$params = $this->parseParams();

		$filters = array();
		if ($params['tag']) {
			$term = TaxonomyTerm::get_by_id('TaxonomyTerm', $params['tag']);
			if ($term) {
				$filters[] = _t('DatedUpdateHolder.FILTER_WITHIN', 'within') . ' "' . $term->Name . '"';
			}
		}

		if ($params['from'] || $params['to']) {
			if ($params['from']) {
				$from = strtotime($params['from']);
				if ($params['to']) {
					$to = strtotime($params['to']);
					$filters[] = _t('DatedUpdateHolder.FILTER_BETWEEN', 'between') . ' '
						. date('j/m/Y', $from) . ' and ' . date('j/m/Y', $to);
				} else {
					$filters[] = _t('DatedUpdateHolder.FILTER_ON', 'on') . ' ' . date('j/m/Y', $from);
				}
			} else {
				$to = strtotime($params['to']);
				$filters[] = _t('DatedUpdateHolder.FILTER_ON', 'on') . ' ' . date('j/m/Y', $to);
			}
		}

		if ($params['year'] && $params['month']) {
			$timestamp = mktime(1, 1, 1, $params['month'], 1, $params['year']);
			$filters[] = _t('DatedUpdateHolder.FILTER_IN', 'in') . ' ' . date('F', $timestamp) . ' ' . $params['year'];
		}

		if ($filters) {
			return $this->getUpdateName() . ' ' . implode(' ', $filters);
		}
	}

	public function getUpdateName() {
		return Config::inst()->get($this->data()->ClassName, 'update_name');
	}

	public function init() {
		parent::init();
		RSSFeed::linkToFeed($this->Link() . 'rss', $this->getSubscriptionTitle());
	}

	/**
	 * Parse URL parameters.
	 *
	 * @param $produceErrorMessages Set to false to omit session messages.
	 */
	public function parseParams($produceErrorMessages = true) {
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

		// If only "To" has been provided filter by single date. Normalise by swapping with "From".
		if (isset($to) && !isset($from)) {
			list($to, $from) = array($from, $to);
		}

		// Flip the dates if the order is wrong.
		if (isset($to) && isset($from) && strtotime($from)>strtotime($to)) {
			list($to, $from) = array($from, $to);

			if ($produceErrorMessages) {
				Session::setFormMessage(
					'Form_DateRangeForm',
					_t('DateUpdateHolder.FilterAppliedMessage','Filter has been applied with the dates reversed.'),
					'warning'
				);
			}
		}

		// Notify the user that filtering by single date is taking place.
		if (isset($from) && !isset($to)) {
			if ($produceErrorMessages) {
				Session::setFormMessage(
					'Form_DateRangeForm',
					_t('DateUpdateHolder.DateRangeFilterMessage','Filtered by a single date.'),
					'warning'
				);
			}
		}

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
		$link = HTTP::setGetVar('tag', null, null, '&');
		$link = HTTP::setGetVar('month', null, $link, '&');
		$link = HTTP::setGetVar('year', null, $link, '&');
		$link = HTTP::setGetVar('start', null, $link, '&');

		return $link;
	}

	/**
	 * List tags and attach links.
	 */
	public function UpdateTagsWithLinks() {
		$tags = $this->UpdateTags();

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

		return DatedUpdateHolder::ExtractMonths(
			$this->Updates($params['tag'], $params['from'], $params['to']),
			Director::makeRelative($_SERVER['REQUEST_URI']),
			$params['year'],
			$params['month']
		);
	}

	/**
	 * Get the updates based on the current query.
	 */
	public function FilteredUpdates($pageSize = 20) {
		$params = $this->parseParams();

		$items = $this->Updates(
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

	/**
	 * @return Form
	 */
	public function DateRangeForm() {
		$dateFromTitle = DBField::create_field('HTMLText', sprintf(
			'%s <span class="field-note">%s</span>',
			_t('DatedUpdateHolder.FROM_DATE', 'From date'),
			_t('DatedUpdateHolder.DATE_EXAMPLE', '(example: 2017/12/30)')
		));
		$dateToTitle = DBField::create_field('HTMLText', sprintf(
			'%s <span class="field-note">%s</span>',
			_t('DatedUpdateHolder.TO_DATE', 'To date'),
			_t('DatedUpdateHolder.DATE_EXAMPLE', '(example: 2017/12/30)')
		));

		$fields = new FieldList(
			DateField::create('from', $dateFromTitle)
				->setConfig('showcalendar', true),
			DateField::create('to', $dateToTitle)
				->setConfig('showcalendar', true),
			HiddenField::create('tag')
		);

		$actions = new FieldList(
			FormAction::create("doDateFilter")->setTitle("Filter")->addExtraClass('btn btn-primary primary'),
			FormAction::create("doDateReset")->setTitle("Clear")->addExtraClass('btn')
		);

		$form = new Form($this, 'DateRangeForm', $fields, $actions);
		$form->loadDataFrom($this->request->getVars());
		$form->setFormMethod('get');

		// Manually extract the message so we can clear it.
		$form->ErrorMessage = $form->Message();
		$form->ErrorMessageType = $form->MessageType();
		$form->clearMessage();

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
		$params = $this->parseParams(false);

		// Reset the link - only include the tag.
		$link = $this->AbsoluteLink();
		if (isset($params['tag'])) $link = HTTP::setGetVar('tag', $params['tag'], $link, '&');

		$this->redirect($link);
	}

	public function rss() {
		$rss = new RSSFeed(
			$this->Updates()->sort('Created DESC')->limit(20),
			$this->Link('rss'),
			$this->getSubscriptionTitle()
		);
		return $rss->outputToBrowser();
	}

	public function atom() {
		$atom = new CwpAtomFeed(
			$this->Updates()->sort('Created DESC')->limit(20),
			$this->Link('atom'),
			$this->getSubscriptionTitle()
		);
		return $atom->outputToBrowser();
	}
}

