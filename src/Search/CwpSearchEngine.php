<?php

namespace CWP\CWP\Search;

use Exception;
use Psr\Log\LoggerInterface;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Extensible;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;
use SilverStripe\FullTextSearch\Solr\SolrIndex;

/**
 * Provides interface for generating search results for a SolrIndex
 */
class CwpSearchEngine
{
    use Configurable;
    use Extensible;
    use Injectable;

    /**
     * Default search options
     *
     * @var array
     * @config
     */
    private static $search_options = [
        'hl' => 'true',
    ];

    /**
     * Additional search options to send to search when spellcheck
     * is included
     *
     * @var array
     * @config
     */
    private static $spellcheck_options = [
        'spellcheck' => 'true',
        'spellcheck.collate' => 'true',
        // spellcheck.dictionary can also be configured to use '_spellcheck'
        // dictionary when indexing fields under the _spellcheckText column
        'spellcheck.dictionary' => 'default',
    ];

    /**
     * Build a SearchQuery for a new search
     *
     * @param string $keywords
     * @param array $classes
     * @return SearchQuery
     */
    protected function getSearchQuery($keywords, $classes)
    {
        $query = new SearchQuery();
        $query->classes = $classes;
        $query->search($keywords);
        $query->exclude(SiteTree::class . '_ShowInSearch', 0);

        // Artificially lower the amount of results to prevent too high resource usage.
        // on subsequent canView check loop.
        $query->limit(100);

        // Allow user code to modify the search query before returning it
        $this->extend('updateSearchQuery', $query);

        return $query;
    }

    /**
     * Get solr search options for this query
     *
     * @param bool $spellcheck True if we should include spellcheck support
     * @return array
     */
    protected function getSearchOptions($spellcheck)
    {
        $options = $this->config()->get('search_options');
        if ($spellcheck) {
            $options = array_merge($options, $this->config()->get('spellcheck_options'));
        }
        return $options;
    }

    /**
     * Get results for a search term
     *
     * @param string $keywords
     * @param array $classes
     * @param SolrIndex $searchIndex
     * @param int $limit Max number of results for this page
     * @param int $start Skip this number of records
     * @param bool $spellcheck True to enable spellcheck
     * @return CwpSearchResult
     */
    protected function getResult($keywords, $classes, $searchIndex, $limit = -1, $start = 0, $spellcheck = false)
    {
        // Prepare options
        $query = $this->getSearchQuery($keywords, $classes);
        $options = $this->getSearchOptions($spellcheck);

        // Get results
        $solrResult = $searchIndex->search(
            $query,
            $start,
            $limit,
            $options
        );

        return CwpSearchResult::create($keywords, $solrResult);
    }

    /**
     * Get a CwpSearchResult for a given criterea
     *
     * @param string $keywords
     * @param array $classes
     * @param SolrIndex $searchIndex
     * @param int $limit Max number of results for this page
     * @param int $start Skip this number of records
     * @param bool $followSuggestions True to enable suggested searches to be returned immediately
     * @return CwpSearchResult|null
     */
    public function search($keywords, $classes, $searchIndex, $limit = -1, $start = 0, $followSuggestions = false)
    {
        if (empty($keywords)) {
            return null;
        }

        try {
            // Begin search
            $result = $this->getResult($keywords, $classes, $searchIndex, $limit, $start, true);

            // Return results if we don't need to refine this any further
            if (!$followSuggestions || $result->hasResults() || !$result->getSuggestion()) {
                return $result;
            }

            // Perform new search with the suggested terms
            $suggested = $result->getSuggestion();
            $newResult = $this->getResult($suggested, $classes, $searchIndex, $limit, $start, false);
            $newResult->setOriginal($keywords);

            // Compare new results to the original query
            if ($newResult->hasResults()) {
                return $newResult;
            }

            return $result;
        } catch (Exception $e) {
            Injector::inst()->get(LoggerInterface::class)->warning($e);
        }
    }
}
