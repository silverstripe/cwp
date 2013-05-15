<?php

class EventHolder extends DatedUpdateHolder {
	
	private static $description = 'Container page for Event Pages, provides event filtering and pagination';

	private static $allowed_children = array('EventPage');

	private static $default_child = 'EventPage';

	private static $update_name = 'Events';

	private static $update_class = 'EventPage';

	private static $icon = 'cwp/images/icons/sitetree_images/event_holder.png';

	public $pageIcon =  'images/icons/sitetree_images/event_holder.png';

	/**
	 * Find all site's news items, based on some filters.
	 * Omitting parameters will prevent relevant filters from being applied. The filters are ANDed together.
	 *
	 * @param $className The name of the class to fetch.
	 * @param $parentID The ID of the holder to extract the news items from.
	 * @param $tagID The ID of the tag to filter the news items by.
	 * @param $dateFrom The beginning of a date filter range.
	 * @param $dateTo The end of the date filter range. If empty, only one day will be searched for.
	 * @param $year Numeric value of the year to show.
	 * @param $monthNumber Numeric value of the month to show.
	 *
	 * @returns DataList | PaginatedList
	 */
	public static function AllUpdates($className = 'Events', $parentID = null, $tagID = null, $dateFrom = null,
		$dateTo = null, $year = null, $monthNumber = null) {

		return parent::AllUpdates($className, $parentID, $tagID, $dateFrom, $dateTo, $year, $monthNumber)->Sort('Date', 'ASC');
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
class EventHolder_Controller extends DatedUpdateHolder_Controller {

	public function getUpdateName() {
		$params = $this->parseParams();
		if ($params['upcomingOnly']) {
			return 'Upcoming events';
		}

		return 'Events';
	}

	/**
	 * Parse URL parameters.
	 *
	 * @param $produceErrorMessages Set to false to omit session messages.
	 */
	public function parseParams($produceErrorMessages = true) {
		$params = parent::parseParams($produceErrorMessages);

		// We need to set whether or not we're supposed to be displaying only upcoming events or all events.
		$params['upcomingOnly'] = !($params['from'] || $params['to'] || $params['year'] || $params['month']);

		return $params;
	}

	/**
	 * Get the events based on the current query.
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

		if ($params['upcomingOnly']) {
			$items = $items->filter(array('Date:LessThan:Not' => SS_Datetime::now()->Format('Y-m-d')));
		}

		// Apply pagination
		$list = new PaginatedList($items, $this->request);
		$list->setPageLength($pageSize);
		return $list;
	}
}

