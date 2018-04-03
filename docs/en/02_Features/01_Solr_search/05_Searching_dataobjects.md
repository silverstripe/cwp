title: Searching DataObjects
summary: How to add other DataObject classes to the Solr search index.

## Searching DataObjects

If you create a class that extends `DataObject` (and not `Page`) then it won't be automatically added to the search
index. You'll have to make some changes to add it in.

So, let's take an example of `StaffMember`:

```php
<?php

use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataObject;

class StaffMember extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
        'Abstract' => 'Text',
        'PhoneNumber' => 'Varchar(50)',
    ];
    
    public function Link($action = 'show')
    {
        return Controller::join_links('my-controller', $action, $this->ID);
    }
    
    public function getShowInSearch()
    {
        return 1;
    }
    
    public canView()
    {
        return true;
    }
}
```

This `DataObject` class has the minimum code necessary to allow it to be viewed in the site search.

 * `Link()` will return a URL for where a user goes to view the data in more detail in the search results.
 * `Name` will be used as the result title, and `Abstract` the summary of the staff member which will show under the
search result title.
 * `getShowInSearch` is required to get the record to show in search, since all results are filtered by `ShowInSearch`.
 * `canView()` is a permission setting, you may need to address this depending on your application needs (returning true means anyone can see this data in your application and defaults to admin users only if left out).

So with that, let's create a new class called `MySolrSearchIndex`:

```php
use CWP\Search\CwpSearchIndex;
use SilverStripe\CMS\Model\SiteTree;
use StaffMember;

class MySolrSearchIndex extends CwpSearchIndex
{
    public function init()
    {
        $this->addClass(SiteTree::class);
        $this->addClass(StaffMember::class);
        $this->addAllFulltextFields();
        $this->addFilterField('ShowInSearch');
    }
}
```

<div class="alert alert-info" markdown='1'>
If you are using cwp recipe 1.1.0 or below please refer to the [version 1.1 and before documentation archive](https://www.cwp.govt.nz/developer-docs/en/1.1/features/solr_search#adding-dataobject-classes-to-solr-search-2) for the index code
</div>

These are both implementations of the base configuration but with the addition of `StaffMember`.

Once you've created the above classes and run `flush=1`, access `dev/tasks/Solr_Configure` and `dev/tasks/Solr_Reindex`
to tell Solr about the new index you've just created. This will add `StaffMember` and the text fields it has to the
index.

Now in your `mysite/_config/search.yml` file (for example), add the following:

```yaml
---
Name: mysearchconfig
After: #cwpsearch
---
SilverStripe\Core\Injector\Injector:
  CWP\Search\CwpSearchEngine.search_index:
    class: MySolrSearchIndex

CWP\Search\Extensions\SearchControllerExtension:
  classes_to_search:
    StaffMember:
      class: StaffMember
```

Now when you search on the site, `StaffMember` results will show alongside normal `Page` results.
