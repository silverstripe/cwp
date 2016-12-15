title: Default CWP search index
summary: Information about how the SOlr search index is pre-configured for CWP.

## Default CWP search index

By default, a standard search index `SolrSearchIndex` is included in the default recipe. This includes basic configuration
necessary for searching pages.

	```php
	class SolrSearchIndex extends CwpSearchIndex {
		public function init() {
			$this->addClass('SiteTree');

			// By default, we only add text fields that are 'visible' to users (where the content is directly visible on 
			// the website), along with the 'meta' fields that are commonly used to boost / refine search results
			$this->addFulltextField('Title');
			$this->addFulltextField('MenuTitle');
			$this->addFulltextField('Content');
			$this->addFulltextField('MetaDescription');
			$this->addFulltextField('ExtraMeta');

			// Adds 'ShowInSearch' boolean field to Solr document so we can later ensure that only documents included in 
			// search are returned by Solr.
			$this->addFilterField('ShowInSearch');

			parent::init();
		}
	}
	```

This index extends the core `CwpSearchIndex` abstract class, which includes additional functionality specific to CWP.
Please note that if you want to index other database fields or need to create a custom index, it is necessary to extend this base class (`CwpSearchIndex`) in order to use much of the functionality detailed in this section (e.g. spell checking).

*Note:* The line `$this->addFilterField('ShowInSearch');` is a standard requirement for all CWP recipe versions, and will need to be added to any custom indexes created.


<div class="notice" markdown='1'>
If you are using cwp recipe 1.1.0 or below please refer to [version 1.1 and before documentation archive](https://www.cwp.govt.nz/developer-docs/en/1.1/features/solr_search#default-search-index-2) for the index code
</div>
