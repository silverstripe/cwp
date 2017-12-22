<?php

namespace CWP\CWP\Search;

use PageController;

/**
 * Description of SearchPageController
 *
 * @author dmooyman
 */
class CwpSearchPageController extends PageController
{
    /**
     * Create the dummy search record for this page
     *
     * @return CwpSearchPage
     */
    protected function generateSearchRecord()
    {
        $searchPage = CwpSearchPage::create();
        $searchPage->URLSegment = 'search';
        $searchPage->Title = _t('SearchForm.SearchResults', 'Search Results');
        $searchPage->ID = -1;
        return $searchPage;
    }

    public function __construct($dataRecord = null)
    {
        if (!$dataRecord) {
            $dataRecord = $this->generateSearchRecord();
        }
        parent::__construct($dataRecord);
    }
}
