title: Basic usage of Solr search
summary: Gives an understanding of basic use of Solr.

# Basic usage of Solr search

The following as already been pre-configured in the cwp-core and cwp modules that are part of the CWP recipe codebase.
If you used the cwp-installer, or have included the basic recipe in your code you won't need to implement the steps below in your project.
Rather, these steps give you a high level idea of what is going on "under the hood" of Solr working with SilverStripe CMS.

1) Define an index, and which fields should be searchable.

```php
use Page;
use SilverStripe\FullTextSearch\Solr\SolrIndex;

class MyIndex extends SolrIndex
{
    public function init()
    {
        $this->addClass(Page::class);
        $this->addFulltextField('Title');
        $this->addFulltextField('Content');
    }
}
```

In CWP, the default class is called `CWP\Search\Solr\CwpSolrIndex`.
You can also skip listing all searchable fields, and have the index
figure it out automatically via `addAllFulltextFields()`.


2) Add something to the index, by creating or updating content in the CMS.
Here's an example on how to do it in code. The new content will be automatically indexed.

```php
$page = new Page([
    'Content' => 'Help me. My house is on fire. This is less than optimal.'
]);
$page->write();
```

3) Build a query

```php
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;

$query = new SearchQuery();
$query->search('My house is on fire');
```

4) Apply that query to an index

```php
$results = singleton(MyIndex::class)->search($query);
```

### Searching Specific Fields

By default, the index searches through all indexed fields.
This can be limited by arguments to the `search()` call.

```php
use Page;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;

$query = new SearchQuery();
$query->search('My house is on fire', [Page::class . '_Title']);
// No results, since we're searching in title rather than page content
$results = singleton(MyIndex::class)->search($query);
```

### Searching Value Ranges

Most values can be expressed as ranges, most commonly dates or numbers.
To search for a range of values rather than an exact match, 
use the `SearchQuery_Range` class. The range can include bounds on both sides,
or stay open ended by simply leaving the argument blank.

```php
use Page;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery_Range;

$query = new SearchQuery();
$query->search('My house is on fire');
// Only include documents edited in 2011 or earlier
$query->filter(Page::class . '_LastEdited', new SearchQuery_Range(null, '2011-12-31T23:59:59Z'));
$results = singleton(MyIndex::class)->search($query);
```

Note: At the moment, the date format is specific to the search implementation.

### Searching Empty or Existing Values

Since there's a type conversion between the SilverStripe database, object properties
and the search index persistence, its often not clear which condition is searched for.
Should it equal an empty string, or only match if the field wasn't indexed at all?
The `SearchQuery` API has the concept of a "missing" and "present" field value for this:

```php
use Page;
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery;

$query = new SearchQuery();
$query->search('My house is on fire');
// Needs a value, although it can be false
$query->filter(Page::class . '_ShowInMenus', SearchQuery::$present);
$results = singleton(MyIndex::class)->search($query);	
```

### Indexing Multiple Classes

An index is a denormalized view of your data, so can hold data from more than one model.
As you can only search one index at a time, all searchable classes need to be included.

```php
use Page;
use SilverStripe\FullTextSearch\Solr\SolrIndex;
use SilverStripe\Security\Member;

class MyIndex extends SolrIndex
{
    public function init()
    {
        $this->addClass(Page::class);
        $this->addClass(Member::class);
        $this->addFulltextField('Content'); // only applies to Page class
        $this->addFulltextField('FirstName'); // only applies to Member class
    }
}
```

### Using Multiple Indexes

Multiple indexes can be created and searched independently, but if you wish to override an existing
index with another, you can use the `$hide_ancestor` config.

```php
use MyIndex;
use SilverStripe\Assets\File;

class MyReplacementIndex extends MyIndex
{
    private static $hide_ancestor = MyIndex::class;

    public function init()
    {
        parent::init();
 
        $this->addClass(File::class);
        $this->addFulltextField('Title');
    }
}
```

You can also filter all indexes globally to a set of pre-defined classes if you wish to 
prevent any unknown indexes from being automatically included.

```yaml
SilverStripe\FullTextSearch\Search\FullTextSearch:
  indexes:
    - MyReplacementIndex
    - CoreSearchIndex
```
