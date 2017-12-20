title: Fine tuning the search results
summary: How to configure spelling suggestions, synonyms and keyword boosting to improve search results.

# Fine tuning the search results

## Before we begin

**This feature requires cwp recipe 1.1.1 or above including the [cwp](https://gitlab.cwp.govt.nz/cwp/cwp), [cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core) and [fulltextsearch](https://github.com/silverstripe-labs/silverstripe-fulltextsearch) modules specifically.**

## Spelling corrections and suggestions

Search results will automatically attempt to detect
misspellings of search terms. If corrections for these misspellings can be found, results
for these terms will be displayed instead.

In order to disable this automatic failover you can control this behaviour via config.


	:::yaml
	BasePage_Controller:
	  search_follow_suggestions: false


Disabling this will not prevent misspellings from being detected and displayed, but 
a prompt will be displayed rather than automatically performing the search.

In order to completely disable these suggestions, remove the suggestion placeholder
from the templates as necessary.

### Enhancing spelling suggestion behaviour

By default, all fulltext fields (everything you added through `SolrIndex->addFulltextField()`) are added
to the search index. The values of these fields are collected in a special `_text` field.
This built in `_text` field is appropriate for filtering and determining the relevance of search results,
but does not always provide appropriate spelling suggestions in all cases.

A second copy field, `_spellcheckText`, of type `textSpell`, is configured with appropriate rules for
determining spelling corrections from indexed content. These rules have been customised for generation of
spelling suggestions, rather than search results.

As with `_text`, all fulltext fields will be automatically copied into this field to generate the database
for use with spelling suggestions. In some cases it may be necessary to limit the source for these spelling
suggestions to specifically named fields. In which case, you can control which fields are copied into this
`_spellcheckText` field using the following code.


	:::php
	class MyIndex extends CwpSearchIndex {

		public function init() {
			// Copy all fields (as before) into `_text` for generating results
			$this->addClass('SiteTree');
			$this->addAllFulltextFields();
			$this->addFilterField('ShowInSearch');

			// Explicitly copy only these fields into the _spellcheckText for spelling suggestions
			$this->addCopyField('SiteTree_Title', '_spellcheckText');
			$this->addCopyField('SiteTree_Content', '_spellcheckText');

			parent::init();
		}

		
		/**
		 * Limit default destination to the `_text` field
		 * @return array
		 */
		protected function getCopyDestinations() {
			return array($this->getDefaultField());
		}

	}


### Search term synonyms

The use of custom synonym definitions is another way in which misspelling suggestions
can be controlled.

Based on the subject matter of a site, certain words could have synonymous meanings
which should be considered when performing searches. For instance, it may be desirable
for search queries for "cellphone" to match "mobile" or "cellular".

The ability to configure this is not automatically enabled by default, but can be enabled
by adding the `SynonymsSiteConfig` extension.


	:::yaml
	SiteConfig:
	  extensions:
	    - SynonymsSiteConfig


It is also necessary to ensure that any solr index configured either extends the base `CwpSolrIndex`
class, or includes the following code (as copied from the basic recipe) to override the 
`SolrIndex::uploadConfig` method.


	:::php
	class MyIndex extends SolrIndex {

		/**
		 * Upload config for this index to the given store
		 * 
		 * @param SolrConfigStore $store
		 */
		public function uploadConfig($store) {
			parent::uploadConfig($store);

			// Upload configured synonyms {@see SynonymsSiteConfig}
			$siteConfig = SiteConfig::current_site_config();
			if($siteConfig->SearchSynonyms) {
				$store->uploadString(
					$this->getIndexName(),
					'synonyms.txt',
					$siteConfig->SearchSynonyms
				);
			}
		}

	}


Once this is enabled, the Settings section of the CMS will have a tab called "Fulltext Search"
where a list of synonyms can be configured via an editable textarea. Each list of synonyms
should be configured on a single line, with individual terms separated by a comma. Explicit
mappings of alternatives to a preferred term can be specified using the `=>` operator.

See [the Apache Solr documentation](https://wiki.apache.org/solr/AnalyzersTokenizersTokenFilters#solr.SynonymFilterFactory)
for more information on this format.

Note that only admin users (who are those with privileges necessary to run the `Solr_Configure` task)
will be able to view and edit this field.

![Synonyms](/_images/synonyms.png)

It's essential that after changing this value, a CMS administrator should run the `Solr_Configure`
task at http://mysite.cwp.govt.nz/div/tasks/Solr_Configure. It's not necessary to run
Solr_Reindex in order for changes in synonyms to take effect.

## Boosting results

In cases where certain documents should appear higher in search results for specific terms, boosting can be used to
promote certain keywords on a per document basis.

In order to add this functionality to pages you can use the `CwpSearchBoostExtension` in your config. The default
`search_boost` option can also be customised from the default 2.


	SiteTree:
	  search_boost: 1.5
	  extensions:
		- CwpSearchBoostExtension


Ensure that you are using either the default CwpSolrIndex, or are extending CwpSearchIndex and are calling
`parent::init()` after your custom field definitions.


	:::php
	class MySolrSearchIndex extends CwpSearchIndex {
		public function init() {
			$this->addClass('SiteTree');
			$this->addClass('PortfolioItem');
			$this->addAllFulltextFields();
			$this->addFilterField('ShowInSearch');

			parent::init();
		}
	}


Within the CMS, you can now provide a list of boost terms for each page.

![boost cms](/_images/boost_fields.png)



