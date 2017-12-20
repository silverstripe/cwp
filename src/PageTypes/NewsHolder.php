<?php

namespace CWP\CWP\PageTypes;



use CWP\CWP\PageTypes\NewsPage;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\Control\RSS\RSSFeed;
use CWP\Core\Feed\CwpAtomFeed;



class NewsHolder extends DatedUpdateHolder {

	private static $description = 'Container page for News Pages, provides news filtering and pagination';

	private static $allowed_children = array(NewsPage::class);

	private static $default_child = NewsPage::class;

	private static $update_name = 'News';

	private static $update_class = NewsPage::class;

	private static $icon = 'cwp/images/icons/sitetree_images/news_listing.png';

	public $pageIcon =  'images/icons/sitetree_images/news_listing.png';

	private static $singular_name = 'News Holder';

	private static $plural_name = 'News Holders';

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
	public static function AllUpdates($className = NewsPage::class, $parentID = null, $tagID = null, $dateFrom = null,
			$dateTo = null, $year = null, $monthNumber = null) {

		return parent::AllUpdates($className, $parentID, $tagID, $dateFrom, $dateTo, $year, $monthNumber)->Sort(DBDate::class, 'DESC');
	}
}

class NewsHolder_Controller extends DatedUpdateHolder_Controller {
	private static $allowed_actions = array(
		'rss',
		'atom'
	);

	public function rss() {
		$rss = new RSSFeed(
			$this->Updates()->sort('Created DESC')->limit(20),
			$this->Link('rss'),
			$this->getSubscriptionTitle()
		);
		$rss->setTemplate('NewsHolder_rss');
		return $rss->outputToBrowser();
	}

	public function atom() {
		$atom = new CwpAtomFeed(
			$this->Updates()->sort('Created DESC')->limit(20),
			$this->Link('atom'),
			$this->getSubscriptionTitle()
		);
		$atom->setTemplate('NewsHolder_atom');
		return $atom->outputToBrowser();
	}
}
