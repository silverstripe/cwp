## Highlighting Solr search results

By default, search term highlighting is enabled within the CWP recipe. For any term set in the search parameter `Search`
you can invoke the field method `ContextSummary` on any property to return highlighted results for that property.

E.g. this will highlight terms in the `Content` field

```
<div>$Content.ContextSummary</div>
```

Solr also returns a set of highlighted terms via the `excerpt` property on results, although this is not specific
to any field. Take note that this field may contain HTML content, and does not have default styles. 

```
<div>$Excerpt</div>
```

It is recommended to use `ContextSummary` in most cases as it is more likely to give content encoded appropriately
for the field type.
