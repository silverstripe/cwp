<!--
title: Recipes
pagenumber: 3
-->

# Recipes

The CWP platform comes with template projects that contain all the elements of the basic site. Each recipe is
essentially a `composer.json` file that specifies all the required modules to include in the website, as well as the
basic site code.

Recipes can be treated as starting points and can be copied to quickly create your own project. We recommend doing so
over starting from scratch. The recipes include the essential `cwp/cwp` module.

<div class="warning" markdown='1'>
Starting from recipe ensures compatibility with platform features. Not including the necessary modules could mean you're
implementing similar features with unsupported code, in which case we won't be able to provide bug or security fixes, or
guarantee correct operation on the platform.
</div>

In case it's not possible to use the recipe, it is strongly recommended to pull in the `cwp/cwp` module and use the
features contained therein. It is through this module that we will provide future updates.

If the above doesn't work for you, the last resort is including the `cwp/cwp-core`, which `cwp/cwp` requires
automatically. This at least will ensure the compatibility with the platform infrastructure and will allow us to deliver
some subset of fixes and features. This scenario is meant mostly for the early stages of migration though, and the
aforementioned stability and compatibility caveats apply.

If you decide to go down the path of including neither `cwp/cwp` nor `cwp/cwp-core` you will need to follow the releases
of these two modules to see if any patches are applicable to your code.

## Basic recipe (recipe-basic).

This is the recommended recipe at the moment and can be obtained from `https://gitlab.cwp.govt.nz/cwp/recipe-basic.git`.
It contains the SilverStripe CMS as well as the following modules:

 * [cwp](https://gitlab.cwp.govt.nz/cwp/cwp/): The custom behaviours for the default CWP site. Includes things like the
custom page types, support for the theme, documentation, and extra text editor options. Pulls in `cwp-core` as a
dependency.
 * [advancedworkflow](https://github.com/silverstripe-australia/advancedworkflow): Custom workflows and embargo/expiry
dates for pages.
 * [fulltextsearch](https://github.com/silverstripe-labs/silverstripe-fulltextsearch): Solr-powered search.
 * [html5](https://github.com/silverstripe/silverstripe-html5): HTML5 compatibility.
 * [iframe](https://github.com/silverstripe-labs/silverstripe-iframe): Adds the **IFramePage** page type.
 * [queuedjobs](https://github.com/nyeholt/silverstripe-queuedjobs): Run jobs on a regular basis. Required by the other
 * [registry](https://github.com/silverstripe-labs/silverstripe-registry): Exposes large datasets to website users.
 * [restfulserver](https://github.com/silverstripe/silverstripe-restfulserver/): Allow other websites and applications
to query information from the website.
 * [sortablegridfield](https://github.com/UndefinedOffset/SortableGridField): Drag-and-drop from SilverStripe's
gridfields.
 * [subsites](https://github.com/silverstripe/silverstripe-subsites): Run multiple sites from one instance.
 * [translatable](https://github.com/silverstripe/silverstripe-translatable): Support multiple languages of your site's
sets.
 content.
 * [userforms](https://github.com/silverstripe/silverstripe-userforms): Adds the **UserDefinedForm** page type.
 * [versionedfiles](https://github.com/ajshort/silverstripe-versionedfiles): Adds versioning of files.
 * [versionfeed](https://github.com/silverstripe-labs/silverstripe-versionfeed): Allows RSS feeds of page changes.
modules.

`cwp/cwp` package includes the following modules:

 * [taxonomy](https://github.com/silverstripe-labs/silverstripe-taxonomy): Adds a hierarchical tag system. Required by
the news and events pages.
 * [cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core/): Basic CWP compatibility package.

The following theme-related packages are included:

 * [default](https://gitlab.cwp.govt.nz/cwp-themes/default): Default CWP theme.
 * [module_bootstrap](https://github.com/silverstripe-ux/sass-twitter-bootstrap): Bootstrap module required by the
 default theme.
