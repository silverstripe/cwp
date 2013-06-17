# Development

This document contains information relevant to developers that wish to develop websites to run on the CWP platform.

The scope of this document is only how to work with the Common Web Platform and those features exclusive to it. For
general information about working with SilverStripe please consult the
[developer documentation](http://doc.silverstripe.org/). If you are completely new to SilverStripe then you might like
to go through the [tutorials](http://doc.silverstripe.org/framework/en/tutorials).

 * [Preparation](preparation): The steps you need to take to get your development environment ready to work on a CWP
project.
 * [Gitlab](gitlab): The source control management software that CWP uses.
 * [Recipes](recipes): What a "recipe" is and the list of different site recipes that your site can start from.
 * [Theme customisation](theme_customisation): Working with the default theme.
 * [Project customisation](project_customisation): Customising your project with extra modules or features.
 * [CWP functionality](cwp_functionality): What you need to know about the custom CWP functionality, such as PDF
exporting, Solr search, related pages, and meta tags.

## Common tasks

There are a few common tasks that developers will face working on the CWP platform. What follows is a list of these
tasks and ways of implementing them.

 * [External HTTP Requests](external_http_requests): You can't make a request to an external server without first going
through the proxy.
 * [Adding a calendar](calendar): How to add a calendar to show events in a custom way.
 * [Custom embeds](custom_embeds): Adding custom embeds in the WYSIWYG editor.
 * [Export content](export_content): How to use the RESTful server to export content.