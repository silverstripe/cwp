<?php

namespace CWP\CWP\Search;

use Page;


use CWP\CWP\Search\CwpSearchPage;
use SilverStripe\Security\Permission;
use PageController;



/**
 * Dummy page to assist with display of search results
 */
class CwpSearchPage extends Page {
	
	private static $hide_ancestor = CwpSearchPage::class;
	
	public function canViewStage($stage = 'Live', $member = null) {
		if(Permission::checkMember($member, 'VIEW_DRAFT_CONTENT')) {
			return true;
		}
		
		return parent::canViewStage($stage, $member);
	}
}

/**
 * Description of SearchPageController
 *
 * @author dmooyman
 */
class CwpSearchPage_Controller extends PageController {
	
	/**
	 * Create the dummy search record for this page
	 * 
	 * @return CwpSearchPage
	 */
	protected function generateSearchRecord() {
		$searchPage = CwpSearchPage::create();
		$searchPage->URLSegment = 'search';
		$searchPage->Title = _t('SearchForm.SearchResults', 'Search Results');
		$searchPage->ID = -1;
		return $searchPage;
	}
	
	public function __construct($dataRecord = null) {
		if(!$dataRecord) {
			$dataRecord = $this->generateSearchRecord();
		}
		parent::__construct($dataRecord);
	}

}
