<?php

class NewsHolder extends Page {
	static $allowed_children = array('NewsPage');
	static $default_child = 'NewsPage';
	static $icon = "themes/express/images/icons/sitetree_images/news_listing.png";
	public $pageIcon =  "images/icons/sitetree_images/news_listing.png";

	public function MenuChildren() {
		return parent::MenuChildren()->exclude('ClassName', 'NewsPage');
	}

	public function getCategories() {
		return NewsCategory::get()->sort('Title', 'DESC');
	}

	public function getDefaultRSSLink() {
		return $this->Link('rss');
	}
}

class NewsHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();

		RSSFeed::linkToFeed($this->Link() . 'rss', SiteConfig::current_site_config()->Title . ' news');
	}

	public function getNewsItems($pageSize = 10) {
		$items = DataObject::get('NewsPage', "ParentID = $this->ID")->sort('Date', 'DESC');
		$category = $this->getCategory();
		if ($category) $items = $items->filter('CategoryID', $category->ID);
		$list = new PaginatedList($items, $this->request);
		$list->setPageLength($pageSize);
		return $list;
	}

	public function getCategory() {
		$categoryID = $this->request->getVar('category');
		if (!is_null($categoryID)) {
			return NewsCategory::get_by_id('NewsCategory', $categoryID);
		}
	}

	public function rss() {
		$rss = new RSSFeed($this->Children(), $this->Link, SiteConfig::current_site_config()->Title . ' news');
		return $rss->outputToBrowser();
	}
}