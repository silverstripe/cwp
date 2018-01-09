<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\ORM\PaginatedList;

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
class EventHolderController extends DatedUpdateHolderController
{
    public function getUpdateName()
    {
        $params = $this->parseParams();
        if ($params['upcomingOnly']) {
            return _t(__CLASS__ . '.Upcoming', 'Upcoming events');
        }

        return _t(__CLASS__ . '.Events', 'Events');
    }

    /**
     * Parse URL parameters.
     *
     * @param boolean $produceErrorMessages Set to false to omit session messages.
     */
    public function parseParams($produceErrorMessages = true)
    {
        $params = parent::parseParams($produceErrorMessages);

        // We need to set whether or not we're supposed to be displaying only upcoming events or all events.
        $params['upcomingOnly'] = !($params['from'] || $params['to'] || $params['year'] || $params['month']);

        return $params;
    }

    /**
     * Get the events based on the current query.
     */
    public function FilteredUpdates($pageSize = 20)
    {
        $params = $this->parseParams();

        $items = $this->Updates(
            $params['tag'],
            $params['from'],
            $params['to'],
            $params['year'],
            $params['month']
        );

        if ($params['upcomingOnly']) {
            $items = $items->filter(['Date:LessThan:Not' => DBDatetime::now()->Format('y-MM-dd')]);
        }

        // Apply pagination
        $list = PaginatedList::create($items, $this->getRequest());
        $list->setPageLength($pageSize);
        return $list;
    }
}
