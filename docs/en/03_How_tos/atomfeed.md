title: Atom feed (RSS)
summary: Creating custom Atom feeds (RSS).

# Atom Feed

The `CwpAtomFeed` class extends from the `RSSFeed` class.

To setup a Atom feed [follow the documentation for setting up a RSS Feed](https://docs.silverstripe.org/en/4/developer_guides/integration/rssfeed/) 
and replace the `RSSFeed` class with the `CwpAtomFeed` class.

### Customizing the Atom Feed template

 - The default template used is located at `cwp-core/templates/CWP/Core/Feed/CWPAtomFeed.ss`
 - The template for news items is located at `themes/starter/templates/CWP/CWP/PageTypes/NewsHolder_atom.ss`
 - The template for search results is located at `themes/starter/templates/Page_results_atom.ss`
 - The template for printing and subscribing to feeds is located at `themes/starter/templates/Includes/PageUtilities.ss`
 - You may want to modify this template to replace the default RSS feed subscribe link for the Atom feed link by replacing `$RSSLink` with `$AtomLink`.

## API Documentation

* [RSSFeed](http://api.silverstripe.org/4/SilverStripe/Control/RSS/RSSFeed.html)
