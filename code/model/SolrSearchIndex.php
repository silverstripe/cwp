<?php
class SolrSearchIndex extends SolrIndex {

	public function init() {
		$this->addClass('BasePage');
		$this->addAllFulltextFields();
	}

}
