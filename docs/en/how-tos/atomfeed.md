# Atom Feed

## Introduction

The CwpAtomFeed class extends from the RSSFeed class.


To setup a Atom feed follow the documentation for setting up a RSS Feed 
and replace the RSSFeed class with the CwpAtomFeed class.

[https://www.cwp.govt.nz/guides/core-technical-documentation/framework/en/reference/rssfeed
](https://www.cwp.govt.nz/guides/core-technical-documentation/framework/en/reference/rssfeed)

### Customizing the Atom Feed template

The default template used is located at cwp-core/templates/AtomFeed.ss
The template for news items is located at themes/default/templates/NewsHolder_atom.ss
The template for search results is located at themes/default/templates/Page_results_atom.ss
The template for printing and subscribing to feeds is located at themes/default/templates/Includes/PrintShare.ss
you may want to modify this template to replace the default RSS feed subscribe link for the Atom feed link by replacing
RSSLink with AtomLink.

## Related

*  [blog module](http://silverstripe.org/blog-module)

## API Documentation

* `[api:RSSFeed]`
