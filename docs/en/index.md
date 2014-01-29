# Common Web Platform core

This document contains information relevant to developers that wish to develop websites to run on the CWP platform.

The scope of this document is only how to work with the Common Web Platform and those features exclusive to it. For
general information about working with SilverStripe please consult the
[developer documentation](http://doc.silverstripe.org/). If you are completely new to SilverStripe then you might like
to go through the [tutorials](http://doc.silverstripe.org/framework/en/tutorials).

 * [Preparation](preparation-of-the-developer-environment): The steps you need to take to get your development
 environment ready to work on a CWP project.
 * [Quick start](quick-start): Bullet-point list of tasks to get you up and running quickly
 * [Development tutorials](development-tutorials): Step through the most common development workflows of the CWP.
 * [Recipes](recipes): What a "recipe" is and the list of different site recipes that your site can start from.
 * [Maintaining your code](maintaining-your-code): How to keep your code maintained and maintenable.
 * [Theme customisation](customising-the-default-theme): Working with the default theme.
 * [Project customisation](customising-the-default-functionality): Customising your project with extra modules or
 features.
 * [CWP features](cwp-features): What you need to know about the custom CWP functionality, such as PDF
exporting, Solr search, related pages, and meta tags.
 * [How-tos](how-tos): Short focused tutorials, for example on how to add a calendar to your project.
 * [Infrastructural considerations](infrastructural-considerations): Some limitiations imposed by the way CWP has been
architected - for example how requests to enviornments will timeout after certain time.
 * [Supported releases and changelogs](/releases/): CWP-related release notes.

## Common tasks

There are a few common tasks that developers will face working on the CWP platform. What follows is a list of these
tasks and ways of implementing them.

 * [External HTTP Requests](how-tos/external_http_requests_with_proxy): You can't make a request to an external server
 without first going through the proxy.
 * [Adding a calendar](how-tos/adding-a-calendar): How to add a calendar to show events in a custom way.
 * [Custom embeds](how-tos/custom_embeds-in-the-WYSIWYG-editor): Adding custom embeds in the WYSIWYG editor.
 * [Export content](how-tos/exporting_content): How to use the RESTful server to export content.

## Contributing

### Translations

Translations of the natural language strings are managed through a third party translation interface,
[Transifex](http://transifex.com). Newly added strings will be periodically uploaded there for translation, and any new
translations will be merged back to the project source code.

Please register on Transifex and you will be able to contribute to all modules. Here is a list of translation projects
for CWP-hosted modules:

* [cwp/cwp](https://www.transifex.com/projects/p/silverstripe-cwp/)
* [cwp/cwp-core](https://www.transifex.com/projects/p/silverstripe-cwp-core/)
* [silverstripe/documentconverter](https://www.transifex.com/projects/p/silverstripe-documentconverter/)
