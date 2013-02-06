<?php

class EventHolder extends Page {

	static $allowed_children = array('EventPage');

	static $default_child = 'EventPage';

	static $icon = 'cwp/images/icons/sitetree_images/event_holder.png';

	public $pageIcon =  'images/icons/sitetree_images/event_holder.png';

	public function Children() {
		return parent::Children()->exclude('ClassName', 'EventPage');
	}

	public function EventTags() {
		// Find all terms associated with the EventPages under this holder.
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

class EventHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();

		RSSFeed::linkToFeed($this->Link() . 'rss', SiteConfig::current_site_config()->Title . ' news');
	}

	/**
	 * Check if the currently filtered tag matches the one passed as the argument.
	 *
	 * @param Boolean
	 */
	public function IsActiveTag($tag) {
		$current = $this->CurrentTag();

		if ($current) {
			return $current->ID==$tag->ID;
		}

		return false;
	}

	public function EventItems($pageSize = 10) {
		$tag = $this->CurrentTag();

		$items = EventPage::get()->sort('Date', 'DESC');

		// Filter by currently selected tag.
		if ($tag) {
			$items = $items->innerJoin(
					'BasePage_Terms',
					'"EventPage"."ID"="BasePage_Terms"."BasePageID"'
				)->innerJoin(
					'TaxonomyTerm',
					"\"BasePage_Terms\".\"TaxonomyTermID\"=\"TaxonomyTerm\".\"ID\" AND \"TaxonomyTerm\".\"ID\"='$tag->ID'"
				);
		}

		$list = new PaginatedList($items, $this->request);
		$list->setPageLength($pageSize);
		return $list;
	}

	public function CurrentTag() {
		$tagID = $this->request->getVar('tag');
		if (isset($tagID)) {
			return TaxonomyTerm::get_by_id('TaxonomyTerm', (int)$tagID);
		}
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

