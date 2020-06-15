title: Basic usage of Solr search
summary: Gives an understanding of basic use of Solr.

# Basic usage of Solr search

The following as already been pre-configured in the cwp-core and cwp modules that are part of the CWP recipe codebase.
If you used the cwp-installer, or have included the basic recipe in your code you won't need to implement the steps below in your project.
Rather, these steps give you a high level idea of what is going on "under the hood" of Solr working with SilverStripe CMS.

This document aims to describe the CWP-specific configuration.
More options are described in the main [fulltextsearch module documentation](https://github.com/silverstripe/silverstripe-fulltextsearch/blob/master/docs/en/index.md).

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

$query = SearchQuery::create()
    ->addSearchTerm('My house is on fire');
```

4) Apply that query to an index

```php
$results = singleton(MyIndex::class)->search($query);
```

### Querying

To find out more about querying and how to write more complex queries, visit the main [fulltextsearch module documentation](https://github.com/silverstripe/silverstripe-fulltextsearch/blob/master/docs/en/04_querying.md). 

### Filtering of records on canView() and ShowInSearch

As of CWP 2.6, a canView() and ShowInSearch check is performed on records before being added to the solr index and also before being shown in search results.
Prior to 2.6, these checks were not done before being added to the solr index, they were only done before results were shown.  This meant there was potentially
data residing in the solr index that should not have been there.

When upgrading from CWP 2.5 or earlier, it's highly recommended you run a solr_reindex to flush any old data that should not have been in the solr index.

For further details, see the [fulltextsearch module readme](https://github.com/silverstripe/silverstripe-fulltextsearch/blob/3/README.md). 

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
