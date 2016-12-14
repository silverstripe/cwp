title: Basic usage of Solr search
summary: Gives an understanding of basic use of Solr.

#  Basic usage of Solr search

The following as already been pre-configured in the cwp-core and cwp modules that are part of the CWP recipe codebase.
If you used the cwp-installer, or have included the basic recipe in your code you won't need to implement the steps below in your project.
Rather, these steps give you a high level idea of what is going on "under the hood" of Solr working with SilverStripe CMS.


Basic usage is a four step process:

1). Define an index in SilverStripe (Note: The specific connector index instance - that's what defines which engine gets used)


	:::php
	class MyIndex extends SolrIndex {
		function init() {
			$this->addClass('Page');
			$this->addFulltextField('Title');
			$this->addFulltextField('Content');
		}
	}


You can also skip listing all searchable fields, and have the index
figure it out automatically via `addAllFulltextFields()`.


2). Add something to the index (Note: You can also just update an existing document in the CMS. but adding _existing_ objects to the index is connector specific)

	:::php
	$page = new Page(array('Content' => 'Help me. My house is on fire. This is less than optimal.'));
	$page->write();


Note: There's usually a connector-specific "reindex" task for this.

3). Build a query

	:::php
	$query = new SearchQuery();
	$query->search('My house is on fire');


4). Apply that query to an index

	:::php
	$results = singleton('MyIndex')->search($query);


Note that for most connectors, changes won't be searchable until _after_ the request that triggered the change.

### Searching Specific Fields

By default, the index searches through all indexed fields.
This can be limited by arguments to the `search()` call.


	:::php
	$query = new SearchQuery();
	$query->search('My house is on fire', array('Page_Title'));
	// No results, since we're searching in title rather than page content
	$results = singleton('MyIndex')->search($query);


### Searching Value Ranges

Most values can be expressed as ranges, most commonly dates or numbers.
To search for a range of values rather than an exact match, 
use the `SearchQuery_Range` class. The range can include bounds on both sides,
or stay open ended by simply leaving the argument blank.

	:::php
	$query = new SearchQuery();
	$query->search('My house is on fire');
	// Only include documents edited in 2011 or earlier
	$query->filter('Page_LastEdited', new SearchQuery_Range(null, '2011-12-31T23:59:59Z'));
	$results = singleton('MyIndex')->search($query);	


Note: At the moment, the date format is specific to the search implementation.

### Searching Empty or Existing Values

Since there's a type conversion between the SilverStripe database, object properties
and the search index persistence, its often not clear which condition is searched for.
Should it equal an empty string, or only match if the field wasn't indexed at all?
The `SearchQuery` API has the concept of a "missing" and "present" field value for this:


	:::php
	$query = new SearchQuery();
	$query->search('My house is on fire');
	// Needs a value, although it can be false
	$query->filter('Page_ShowInMenus', SearchQuery::$present);
	$results = singleton('MyIndex')->search($query);	


### Indexing Multiple Classes

An index is a denormalized view of your data, so can hold data from more than one model.
As you can only search one index at a time, all searchable classes need to be included.


	:::php
	class MyIndex extends SolrIndex {
		function init() {
			$this->addClass('Page');
			$this->addClass('Member');
			$this->addFulltextField('Content'); // only applies to Page class
			$this->addFulltextField('FirstName'); // only applies to Member class
		}
	}


### Using Multiple Indexes

Multiple indexes can be created and searched independently, but if you wish to override an existing
index with another, you can use the `$hide_ancestor` config.


	:::php
	class MyReplacementIndex extends MyIndex {
		private static $hide_ancestor = 'MyIndex';

		public function init() {
			parent::init();
			$this->addClass('File');
			$this->addFulltextField('Title');
		}
	}


You can also filter all indexes globally to a set of pre-defined classes if you wish to 
prevent any unknown indexes from being automatically included.


	:::yaml
	FullTextSearch:
	  indexes:
	    - MyReplacementIndex
	    - CoreSearchIndex