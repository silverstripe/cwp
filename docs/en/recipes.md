<!--
title: Recipes
pagenumber: 3
-->

# Recipes

The CWP platform comes with template projects that contain all the elements of the basic site. Each recipe is
essentially a `composer.json` file that specifies all the required modules to include in the website, as well as the
basic site code.

They are only mean as starting points and can be copied ("forked") to quickly create your own project which you can
modify as you need to.

## Default

This is the only recipe at the moment. It contains the SilverStripe CMS as well as the following modules:

 * [advancedworkflow](https://github.com/silverstripe-australia/advancedworkflow): Custom workflows and embargo/expiry
dates for pages.
 * [cwp](https://gitlab.cwp.govt.nz/cwp/cwp/): The custom behaviours for the default CWP site. Includes things like the
custom page types, support for the theme, documentation, and extra text editor options.
 * [fulltextsearch](https://github.com/silverstripe-labs/silverstripe-fulltextsearch): Solr-powered search.
 * [iframe](https://github.com/silverstripe-labs/silverstripe-iframe): Adds the **IFramePage** page type.
 * [registry](https://github.com/silverstripe-labs/silverstripe-registry): Exposes large datasets to website users.
 * [restfulserver](https://github.com/silverstripe/silverstripe-restfulserver/): Allow other websites and applications
to query information from the website.
 * [sortablegridfield](https://github.com/UndefinedOffset/SortableGridField): Drag-and-drop from SilverStripe's
gridfields.
 * [subsites](https://github.com/silverstripe/silverstripe-subsites): Run multiple sites from one instance.
 * [taxonomy](https://github.com/silverstripe-labs/silverstripe-taxonomy): Tag content items from hierarchical tag
sets.
 * [translatable](https://github.com/silverstripe/silverstripe-translatable): Support multiple languages of your site's
 content.
 * [userforms](https://github.com/silverstripe/silverstripe-userforms): Adds the **UserDefinedForm** page type.
 * [versionedfiles](https://github.com/ajshort/silverstripe-versionedfiles): Adds versioning of files.
 * [versionfeed](https://github.com/silverstripe-labs/silverstripe-versionfeed): Allows RSS feeds of page changes.
 * [queuedjobs](https://github.com/nyeholt/silverstripe-queuedjobs): Run jobs on a regular basis. Required by the other
modules.

CWP includes the following module:
 * [taxonomy](https://github.com/silverstripe-labs/silverstripe-taxonomy): Adds a hierarchical tag system. Required by
the news and events pages.

It also contains the [default CWP theme](https://gitlab.cwp.govt.nz/cwp-themes/default).
