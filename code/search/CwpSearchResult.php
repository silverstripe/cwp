<?php

/**
 * Container for a set of search results
 */
class CwpSearchResult extends ViewableData {
	
	private static $casting = array(
		'Original' => 'Text',
		'OriginalLink' => 'Text',
		'Suggestion' => 'Text',
		'SuggestionLink' => 'Text',
		'Query' => 'Text',
		'SearchLink' => 'Text',
		'RSSLink' => 'Text',
		'AtomLink' => 'Text',
	);
	
	/**
	 * List of results
	 *
	 * @var PaginatedList
	 */
	protected $matches;
	
	/**
	 * Search terms for these results
	 *
	 * @var string 
	 */
	protected $query;
	
	/**
	 * Suggested search keywords
	 * Used when this search has suggested terms, but following suggestions isn't enabled
	 *
	 * @var string 
	 */
	protected $suggestion;
	
	/**
	 * Original terms superceded by these result.
	 * Used when a prior search had suggested terms, and follow suggestions is enabled.
	 *
	 * @var type 
	 */
	protected $original;
	
	/**
	 * Create a new CwpSearchResult
	 * 
	 * @param string $terms
	 * @param ArrayData $results Result from SolrIndex
	 */
	public function __construct($terms = '', ArrayData $results = null) {
		$this->query = $terms;
		if($results) {
			// Clean up the results.
			$matches = $results->Matches;
			foreach($matches as $result) {
				if(!$result->canView()) {
					$matches->remove($result);
				}
			}

			$this->matches = $matches;
			$this->suggestion = $results->SuggestionNice;
		}
	}
	
	/**
	 * Get search results
	 * 
	 * @return PaginatedList
	 */
	public function getResults() {
		return $this->matches;
	}

	/**
	 * Check if there are found results
	 * 
	 * @return bool
	 */
	public function hasResults() {
		return $this->matches && $this->matches->exists();
	}

	/**
	 * Get search keywords matching these results
	 * 
	 * @return string
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * Get suggested search keywords
	 * 
	 * @return string
	 */
	public function getSuggestion() {
		return $this->suggestion;
	}

	/**
	 * Get original search keywords superceded by these results
	 * 
	 * @return string
	 */
	public function getOriginal() {
		return $this->original;
	}

	/**
	 * Set original keywords
	 * 
	 * @param string $original
	 */
	public function setOriginal($original) {
		$this->original = $original;
	}

	/**
	 * Get the link to the suggested search
	 * 
	 * @param string $format Optional output format
	 * @return string
	 */
	public function getSuggestionLink($format = null) {
		return $this->getLink($this->suggestion, $format);
	}
	
	/**
	 * Gets the link to the given search
	 * 
	 * @param string $format Optional output format
	 * @return string
	 */
	public function getSearchLink($format = null) {
		return $this->getLink($this->query, $format);
	}
	
	/**
	 * Gets the link to the original search, with suggestions disabled
	 * 
	 * @param string $format Optional output format
	 * @return string
	 */
	public function getOriginalLink($format = null) {
		return $this->getLink($this->original, $format) . "&suggestions=0";
	}
	
	/**
	 * Get link to these results in RSS format
	 * 
	 * @return string
	 */
	public function getRSSLink() {
		return $this->getLink($this->query, 'rss');
	}
	
	/**
	 * Get link to these results in atom format
	 * 
	 * @return string
	 */
	public function getAtomLink() {
		return $this->getLink($this->query, 'atom');
	}
	
	/**
	 * Get a search link for given terms
	 * 
	 * @param string $terms
	 * @return string|null
	 */
	protected function getLink($terms, $format = null) {
		if(!$terms) {
			return null;
		}
		$link = 'search/SearchForm?Search='.rawurlencode($terms);
		if($format) {
			$link .= '&format='.rawurlencode($format);
		}
		return $link;
	}
	
	public function hasField($field) {
		// Fix customise not detecting custom field getters
		return array_key_exists($field, $this->config()->casting);
	}
}
