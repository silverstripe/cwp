title: Recipes and supported modules
summary: Information about the default CWP codebase referred to as the CWP recipes.

# CWP recipes

CWP supplies developers with a default set of packages for setting up their SilverStripe CMS projects.

The [Common Web Platform Installer](https://github.com/silverstripe/cwp-installer)) package is created from the original
[installer for SilverStripe CMS and Framework](https://github.com/silverstripe/silverstripe-installer). It can be used 
as a base for jump-starting development of a CWP project. This is a recommended way of creating a CWP project.

The installer comes with a `composer.json` file which defines dependencies. These make up the feature set of a default 
CWP ready website by pulling sets of commercially supported SilverStripe CMS modules. 

The [Common Web Platform Installer](https://github.com/silverstripe/cwp-installer) package includes the 
[CWP CMS Recipe](https://github.com/silverstripe/cwp-recipe-cms), 
the [CWP Search Recipe](https://github.com/silverstripe/cwp-recipe-search), 
the [Registry module](https://github.com/silverstripe/silverstripe-registry), 
the [Fluent module](https://github.com/tractorcow/silverstripe-fluent).

Versions prior to 2.6.0 also included the [Subsites module](https://github.com/silverstripe/silverstripe-subsites).

These 'metapackages' will be from now on referred to as "recipes", and are crucial elements of keeping your CWP
deployment running.

## CWP recipe options

There are different recipe variations you can install for a CWP project. By default you get the kitchen sink (e.g. a 
blog even if your site doesn't need one). 

### [CWP Core Recipe](https://github.com/silverstripe/cwp-recipe-core)

Core functionality only recipe for a CWP 2.0 installation. It includes the following core SilverStripe and CWP modules:

* [SilverStripe Core Recipe](https://github.com/silverstripe/recipe-core) - The recipe containing framework, config, 
and assets.
* [CWP Core Module](https://github.com/silverstripe/cwp-core) - The CWP platform compatibility module
* [SilverStripe Auditor](https://github.com/silverstripe/silverstripe-auditor) - The module provides audit trail logging for various events in the system
* [SilverStripe Environment Checker](https://github.com/silverstripe/silverstripe-environmentcheck) - The module adds automated checks to monitor an environment's health status
* [Hybrid Sessions](https://github.com/silverstripe/silverstripe-hybridsessions) - The module adds a hybrid cookie/database session store for SilverStripe
* [MIME Upload Validator](https://github.com/silverstripe/silverstripe-mimevalidator) - The module checks that uploaded file content roughly matches a known MIME type for the file extension

<div class="alert alert-info" markdown='1'>
Note, that this recipe is required if you are running an Active Disaster Recovery (DR) instance. Find out more about [preparing your site for active DR](/how_tos/preparing_your_site_for_active_dr).
</div>

### [CWP CMS Recipe](https://github.com/silverstripe/cwp-recipe-cms) 

An extra CMS functionality recipe for a CWP 2.0 installation. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc.
* [CWP Core Recipe](https://github.com/silverstripe/cwp-recipe-core) - The CWP core functionality recipe
* [CWP features module](https://github.com/silverstripe/cwp) - The modules provides additional CMS functionality, page types, configuration
* [CWP PDF Export](https://github.com/silverstripe/cwp-pdfexport) - The module adds PDF exporting functionality to pages
* [HTML5 Support for SilverStripe](https://github.com/silverstripe/silverstripe-html5) - The module adds further HTML5 support to the CMS
* [SilverStripe GridField Extensions](https://github.com/symbiote/silverstripe-gridfieldextensions)- This module adds extra feature components for GridFields

### [CWP Search Recipe](https://github.com/silverstripe/cwp-recipe-search) 

A recipe of modules to add search functionality to your CWP 2 project. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) 
* [CWP CMS Recipe](https://github.com/silverstripe/cwp-recipe-cms) - The CWP CMS requirements recipe
* [CWP Search Integration](https://github.com/silverstripe/cwp-search) - The module enables CWP fulltext search integration 
* [FullTextSearch](https://github.com/silverstripe/silverstripe-fulltextsearch) - The module adds external full text search engine support to SilverStripe, specifically with Solr in a CWP context
* [SilverStripe Queued Jobs](https://github.com/symbiote/silverstripe-queuedjobs) - The module provides interfaces for scheduling jobs for certain times

### [SilverStripe Authoring Tools Recipe](https://github.com/silverstripe/recipe-authoring-tools) 

Extra tools for CMS authoring in SilverStripe. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms)
* [SilverStripe Document Converter](https://github.com/silverstripe/silverstripe-documentconverter) - The module adds functionality to import OpenOffice-compatible files (doc, docx, etc) into SilverStripe pages and content
* [IFrame](https://github.com/silverstripe/silverstripe-iframe) - The module provides an IFrame page type that allows you to embed an IFrame into a page without resorting to custom code
* [Spellcheck for SilverStripe](https://github.com/silverstripe/silverstripe-spellcheck) - The module improves spellcheck support for SilverStripe CMS, including an implementation for HunSpell
* [Tag Field](https://github.com/silverstripe/silverstripe-tagfield) - The SilverStripe module for editing tags (both in the CMS and other forms)
* [Taxonomy](https://github.com/silverstripe/silverstripe-taxonomy) - The module provides the capability to add and edit simple taxonomies within SilverStripe

### [SilverStripe Blog Recipe](https://github.com/silverstripe/recipe-blog) 

Adds blog functionality for your project. It includes the following core SilverStripe and CWP modules:

* [Widgets](https://github.com/silverstripe/silverstripe-widgets) - The module enables the adding of widgets, which are small pieces of functionality 
* [SilverStripe Content Widget](https://github.com/silverstripe/silverstripe-content-widget) - The module adds functionality to display HTML content in a widget
* [SpamProtection](https://github.com/silverstripe/silverstripe-spamprotection) - The module provides an API for adding spam protection to SilverStripe forms
* [Akismet](https://github.com/silverstripe/silverstripe-akismet) - The module adds a simple spam filter using Akismet
* [Comments](https://github.com/silverstripe/silverstripe-comments) - The module provides commenting functionality for Pages and other DataObjects
* [Comment Notifications](https://github.com/silverstripe/comment-notifications) - The module provides simple email notification functionality for when new visitor comments are posted. 
* [GridField Bulk Editing Tools](https://github.com/colymba/GridFieldBulkEditingTools) - The module provides a set of GridField components to facilitate bulk file upload & record editing.
* [SilverStripe Lumberjack](https://github.com/silverstripe/silverstripe-lumberjack) - The module enables easy managing of pages in a GridField.

### [SilverStripe Collaboration Recipe](https://github.com/silverstripe/recipe-collaboration) 

Adds functionality to enhance CMS author collaboration. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc.
* [Content Review](https://github.com/silverstripe/silverstripe-contentreview) - The module adds functionality to mark a page in SilverStripe CMS with a date and an owner for future review
* [Share Draft Content](https://github.com/silverstripe/silverstripe-sharedraftcontent) - The modules enables the sharing of draft page content with non-CMS users
* [Advanced Workflow Module](https://github.com/symbiote/silverstripe-advancedworkflow) - This module provides highly configurable step-based workflow functionality

### [SilverStripe CMS Reporting Tools Recipe](https://github.com/silverstripe/recipe-reporting-tools) 

Adds extra CMS reporting tools to your SilverStripe project. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc.
* [External Links](https://github.com/silverstripe/silverstripe-externallinks) - The module tracks external broken links in SilverStripe CMS pages
* [Reports](https://github.com/silverstripe/silverstripe-reports) The module contains the API for creating backend reports in the SilverStripe Framework
* [Security Report](https://github.com/silverstripe/silverstripe-securityreport) - The module adds a "Users, Groups and Permissions" report in the SilverStripe CMS
* [Site-wide Content Report](https://github.com/silverstripe/silverstripe-sitewidecontent-report) - The module adds a report of all pages and files across all the project, including subsites (if installed)
* [SilverStripe Maintenance](https://github.com/bringyourownideas/silverstripe-maintenance) - The module reduces your maintenance related work.
* [SilverStripe Security Checker](https://github.com/bringyourownideas/silverstripe-composer-security-checker) - The module adds a task which runs a check if any of the dependencies has known security vulnerabilities.
* [SilverStripe Composer Update Checker](https://github.com/bringyourownideas/silverstripe-composer-update-checker) - The module checks if any of your Composer dependencies needs to be updated, and tracks the available and latest versions that can be updated to.

### [SilverStripe Content Blocks Recipe](https://github.com/silverstripe/recipe-content-blocks) 

Adds content blocks to your SilverStripe project. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc.
* [SilverStripe Elemental](https://github.com/dnadesign/silverstripe-elemental) - The module enables adding content "elements" to your pages
* [SilverStripe Elemental Blocks](https://github.com/silverstripe/silverstripe-elemental-blocks) - The module enables adding some standard content blocks

### [SilverStripe Form Building Recipe](https://github.com/silverstripe/recipe-form-building) 

A recipe of modules to help you build forms in SilverStripe. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc
* [SilverStripe Segment Field](https://github.com/silverstripe/silverstripe-segment-field) - The module provides a reusable approach to segment-generating fields
* [UserForms](https://github.com/silverstripe/silverstripe-userforms) - The module provides a visual form builder for the SilverStripe CMS
* [SilverStripe Queued Jobs](https://github.com/symbiote/silverstripe-queuedjobs) - The module provides interfaces for scheduling jobs for certain times

### [SilverStripe Services Recipe](https://github.com/silverstripe/recipe-services) 

Adds API and content service modules to your SilverStripe project. It includes the following core SilverStripe and CWP modules:

* [SilverStripe CMS Recipe](https://github.com/silverstripe/recipe-cms) - The recipe containing CMS, versioned, asset-admin, etc.
* [SilverStripe RestfulServer](https://github.com/silverstripe/silverstripe-restfulserver) - The RestfulServer module for SilverStripe CMS; it adds REST API capability
* [Version Feed](https://github.com/silverstripe/silverstripe-versionfeed) - The module provides an RSS feed for global site changes

<div class="alert alert-info" markdown='1'>
Note, when installing the Services Recipe you will also install 
[the GraphQL module](https://github.com/silverstripe/silverstripe-graphql) which is bundled with the core SilverStripe
4 CMS. You may choose to use this over RestfulServer.
</div>

## Recipe combinations

The above recipes can be combined as follows:

* Bare bones - SilverStripe plus CWP mandated configuration.
* Bare bones plus the [SilverStripe Blog Recipe](https://github.com/silverstripe/recipe-blog), or plus the [SilverStripe Form Building Recipe](https://github.com/silverstripe/recipe-form-building), etc.
* The [Common Web Platform Installer](https://github.com/silverstripe/cwp-installer) includes all of the above.
* The [CWP Agency Extensions Module](https://github.com/silverstripe/cwp-agencyextensions) can be added to any of the above.

## Theme options

There are two themes provided for the Common Web Platform 2.0 that help government agencies quickly get their sites up and running:

* The [**CWP Starter theme**](https://github.com/silverstripe/cwp-starter-theme) is a developer focused highly accessible Bootstrap 3 theme. It is suited for sites that require more customisation and a design applied with minimal restrictions.
* The [**Wātea theme**](https://github.com/silverstripe/cwp-watea-theme) includes more design elements than the CWP Starter theme. It is well suited for smaller agencies with smaller sites, smaller budgets and less developer involvement.

<div class="alert alert-info" markdown='1'>
The Wātea theme is a more "designed" subtheme which can be installed over the top of the Starter theme to provide a 
more visually appealing starter project. It also requires the [CWP Agency Extensions Module](https://github.com/silverstripe/cwp-agencyextensions) to be installed.
</div>

## Stabilising the project

Even if you did not start from the installer, you can make your project "stable" by
including the following in your `composer.json`:

```
"require": {
    "cwp/cwp-recipe-cms": "~2.0.0@stable"
    ...
```

So if the above dependency can be found in your root `composer.json` file it can be said that you are running on a
stable CWP recipe version. If you request help from the CWP Team, this will be one of the first things that will be checked - if you are not running on a stable CWP recipe, we may not be able to easily help you.

You may add more modules to your project by modifying your base `composer.json`. Please note that these modules will
interact with the recipe, so you need to test for regressions as only the base combination of packages is tested in the CWP recipe
release process.

## Can I remove the default recipes?

We strongly recommend using the supported SilverStripe and CWP recipes that come by default with a CWP installation.

The reasons include:

* Reused code makes maintenance simple - it's easier to apply security updates
* The CWP Service Desk might not be able to help you if you are on a heavily customised codebase
* Custom code is usually less stable than the one that's frequently used
* Advertised CWP features may not work
* Your site may break when infrastructure changes are rolled out - these changes will only be tested against the official CWP recipe releases

You are welcome to remove recipes or features from the list of dependencies that are not required for your project. 

If after careful consideration your development team decides to depart from the recipe model, it is recommended to pull
in at least the [CWP CMS recipe](https://github.com/silverstripe/cwp-recipe-cms). If even this doesn't work for you, the last resort is
including the [CWP Core recipe](https://github.com/silverstripe/cwp-recipe-core). This at least will ensure the minimal compatibility

with the platform infrastructure and will allow us to deliver some subset of fixes and features to you as they are released.

Your development team will need to follow the releases of the recipe on their own and make sure the modules are either
updated, or the issues acknowledged as not posing security or technical risk.

## Recipe releases

We use [semantic versioning](http://semver.org) for the SilverStripe Framework, CMS and supported modules. In CWP recipes we use major, minor and point
releases. From time to time the fourth level - micro (1.2.3.4) - might be used if more granularity is needed.

Stable recipe releases will often be released alongside a stable release of the core SilverStripe framework and CMS, but
we may also release new features or bugfixes for CWP independently of this.

If we announce a new point/micro recipe release (e.g. if you are on 1.0.1, these will be 1.0.1.1, 1.0.1.2, 1.0.2,
1.0.2.1 and so forth) you will need to upgrade, test and deploy your updated project code within a relatively short
timeframe which will be specified on the release notification. While such point/micro releases will be
backwards-compatible and should not break any existing APIs, we still recommend at least running a few smoke tests on your
UAT environment or dev machine before deploying to production.

As a rule of thumb you need to remain on the latest point/minor release version of the recipe to receive all security
fixes.

Major and minor recipe releases (if you are on 1.0.1 these will be 1.1.0, 1.2.0, 2.0.0 and so on) could take more time
to apply. One old minor and one old major branch will still receive security patches, so you have more time to do these.
We estimate that on a small site you may need to spend a day upgrading to a new minor version, and a few days or more
upgrading to a new major version.

The CWP support team may in some situations hot-patch (possibly in a destructive way) your site or pull an environment down if it is
found to endanger other sites on the CWP infrastructure. The timeframe in which this could happen will be specified on the release
notification.

See the [upgrading guide](upgrading) for instructions.

## Recipe contents

To obtain the composition of the latest stable recipes, the easiest way is to head to the
[recipe repositories](https://github.com/topics/silverstripe-recipes) and look at the respective composer file and the dependencies
contained there.

For example, [here is the blog recipe contents](https://github.com/silverstripe/recipe-blog/blob/master/composer.json).

To find the location of a specific repository check on [Packagist](http://packagist.org/).

## Dev recipe

The installer's `composer.json` also provides a single "dev" metapackage dependency for CWP:

```
"require-dev": {
    "cwp/cwp-recipe-basic-dev": "~2.0.0@stable"
    ...
```

[cwp-recipe-basic-dev](https://github.com/silverstripe/cwp-recipe-basic-dev) pulls in dev dependencies specific for
development based on the CWP codebase. These packages will NOT be installed on the environments (neither prod, UAT nor
test). You can also elect not to install it by specifying `--no-dev` with your `composer install` or `composer update`
commands on your local dev machine.
