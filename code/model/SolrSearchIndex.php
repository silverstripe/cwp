<?php
class SolrSearchIndex extends SolrIndex {

	public function init() {
		$this->addClass('SiteTree');
		$this->addAllFulltextFields();
		$this->addFilterField('ShowInSearch');
	}

}
