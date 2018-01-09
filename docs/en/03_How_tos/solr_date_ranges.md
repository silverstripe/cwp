title: Solr queries using date ranges
summary: How do I use date ranges where dates might not be defined?

### How do I use date ranges where dates might not be defined?

The Solr index updater only includes dates with values,
so the field might not exist in all your index entries.
A simple bounded range query (`<field>:[* TO <date>]`) will fail in this case.
In order to query the field, reverse the search conditions and exclude the ranges you don't want:

```php
use SilverStripe\FullTextSearch\Search\Queries\SearchQuery_Range;

// Wrong: Filter will ignore all empty field values
$myQuery->filter(<field>, new SearchQuery_Range('*', <date>));

// Better: Exclude the opposite range
$myQuery->exclude(<field>, new SearchQuery_Range(<date>, '*'));
```
