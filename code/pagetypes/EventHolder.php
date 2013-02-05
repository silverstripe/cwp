<?php

class EventHolder extends Page {

	static $allowed_children = array('EventPage');

	static $default_child = 'EventPage';

	static $icon = 'cwp/images/icons/sitetree_images/event_holder.png';

	public $pageIcon =  'images/icons/sitetree_images/event_holder.png';

	public function Children() {
		return parent::Children()->exclude('ClassName', 'EventPage');
	}

	public function getCategories() {
		return EventCategory::get()->sort('Title', 'DESC');
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}
}

class EventHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();

		RSSFeed::linkToFeed($this->Link() . 'rss', SiteConfig::current_site_config()->Title . ' news');
	}

	public function getEventItems($pageSize = 10) {
		$items = DataObject::get('EventPage')->sort('Date', 'DESC');
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

