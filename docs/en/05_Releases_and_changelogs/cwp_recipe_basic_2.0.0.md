# CWP Recipe 2.0.0

## Overview

This upgrade includes CMS and Framework version 4.1.1

 * [SilverStripe 4.1.1](https://docs.silverstripe.org/en/4/changelogs/4.1.1)
 * [SilverStripe 4.1.0](https://docs.silverstripe.org/en/4/changelogs/4.1.0)
 * [SilverStripe 4.0.0](https://docs.silverstripe.org/en/4/changelogs/4.0.0)

Upgrade to Recipe 2.0.0 is optional, but is recommended as the base to start all new CWP projects from.

## Upgrading Instructions

This is a major version change, and will require a fair amount of input from developers. All notes from the SilverStripe core team regarding [general upgrades to Framework version 4](https://docs.silverstripe.org/en/4/changelogs/4.0.0/) will need to be adhered to, and there should be appropriate investment in regression testing changes before release.

There is a new recipe format for CWP 2, providing a more modular approach to constructing your site. However, there is still the `cwp/cwp-installer` recipe, which provides feature parity in terms of functionality as it did with CWP 1.x.

In particular, if one is to replace `cwp/cwp-recipe-basic`, the following combination of new recipes should be used:

```
    "require": {
        "php": ">=5.6.0",
        "silverstripe/recipe-plugin": "^1",
        "cwp/cwp-recipe-cms": "2.x-dev",
        "cwp/cwp-recipe-core": "2.x-dev",
        "cwp/cwp-recipe-search": "2.x-dev",
        "silverstripe/recipe-blog": "1.x-dev",
        "silverstripe/recipe-authoring-tools": "1.x-dev",
        "silverstripe/recipe-collaboration": "1.x-dev",
        "silverstripe/recipe-form-building": "1.x-dev",
        "silverstripe/recipe-reporting-tools": "1.x-dev",
        "silverstripe/recipe-services": "1.x-dev",
        "silverstripe/registry": "2.x-dev"
        "silverstripe/subsites": "2.0.x-dev",
        "tractorcow/silverstripe-fluent": "4.0.x-dev",
    },
```

More information on upgrading major versions of CWP can be found in the [online documentation](https://www.cwp.govt.nz/developer-docs/en/2/working_with_projects/upgrading/)

Please note that the following modules have been superseded and do not have a direct upgrade path:

 - `silverstripe/translatable` has been replaced by `tractorcow/silverstripe-fluent`
 - `silverstripe/active-directory` has been split into `silverstripe/ldap` (commercially supported) and `silverstripe/saml` (_not_ commercially supported)
 - `undefinedoffset/sortablegridfield` was a dependency of supported modules, which have been updated to use the equivalent functionality provided by `symbiote/silverstripe-gridfieldextensions`. If your project makes use of this module, it will need to specifically require it rather than assume its presence (if it does not already).
 - `silverstripe/selectupload` is deprecated and is not upgraded for SilverStripe 4
 - `silverstripe/secureassets` has been replaced by SilverStripe core functionality
 - `silverstripe/versionedfiles` has been replaced by SilverStripe core functionality

The following optional CWP modules are yet to be upgraded for CWP 2.0 compatibility:
 - `silverstripe/realme`
 - `silverstripe/textextraction`

## Notable changes

 * The minimum PHP version has been raised to 5.6 or higher.
 * All web server requests will be served from the `/public` project subfolder (see point below).
 * All module classes have had PHP namespaces added, and template file locations may have changed to support this.
 * Previously deprecated code has been removed. This includes the following:
   * `BasePage::getBaseStyles`: use the [starter theme](https://github.com/silverstripe/cwp-starter-theme) instead.
   * `BasePage::getBaseScripts`: use the starter theme instead.
   * `SitemapPageController::Page`: use the `showpage()` action instead.
   * `CwpSolr::options_from_environment`: use the implicit Solr configuration provided by the CwpSolr class in the cwp-core module.
 * Search related classes have been moved from cwp/cwp and cwp/cwp-core to cwp/cwp-search.
 * Public search related properties in `BasePageController` have been moved to `SearchControllerExtension` in the cwp/cwp-search module, and converted to configuration options:
   * `$results_per_page`
   * `$classes_to_search`
   * `$search_index_class` removed, use `Injector::inst()->get(\CWP\Search\CwpSearchEngine::class . '.search_index')` instead.
 * `BasePage::getAvailableTranslations` has been removed, use `FluentExtension::Locales` instead (`$Locales` from a template).
 * All PDF export functionality from `BasePage` and `BasePageController` has been removed and moved to a new module [cwp/cwp-pdfexport](https://github.com/silverstripe/cwp-pdfexport).
 * `CwpStatsReport` has been moved from the cwp/cwp-core module to cwp/cwp.
 * `CwpControllerExtension` has been removed:
   * `CwpControllerExtension.ssl_redirection_enabled` moved to configuration in security.yml.
   * `CwpControllerExtension.ssl_redirection_force_domain` moved to configuration in security.yml.
   * Forced SSL rules and domain policies have been implemented with core middleware configurations settings - see `cwp-core/_config/security.yml`.
   * IP whitelisting rules for basic authentication have been moved to `CwpBasicAuthMiddleware`.

### Public webroot

CWP 2.0 enforces the default SilverStripe 4.1 configuration to serve web requests from the `/public` project subfolder.
This also applies to any frontend CSS, JavaScript and images that are
[exposed from modules and project code](https://docs.silverstripe.org/en/4/changelogs/4.1.0/#expose-root-project-files),
as well as assets uploaded via the CMS.

When configuring your local development environment, ensure to set `/public` as the document root. The Common Web 
Platform servers are already configured for this.

Also ensure that you prepend your themes configuration list to contain `$public`.

For more information please [see here](https://docs.silverstripe.org/en/4/changelogs/4.1.0/#upgrade-public-folder-optional), 
but note that this configuration is mandatory in CWP 2.0.

### Security changes

The `CwpControllerExtension` has been removed, which handled logic for UAT environment logins and basic authentication
rule exclusions for users given a "can access UAT site" permission, IP address whitelisting for basic authentication
and SSL redirection for specific URLs in test and live environments.

The IP whitelisting logic has been moved to `CwpBasicAuthMiddleware`, and will still be configured to read the
`CWP_IP_BYPASS_BASICAUTH` environment variable by default. For more information on these configuration settings please
see `cwp-core/_config/security.yml`.

This release removes the following file extensions from the default whitelist of accepted types for 
uploaded files: `dotm`, `potm`, `jar`, `css`, `js` and `xltm`.

If you require the ability to upload these file types in your projects, you will need to add them back in again.
For more information, see ["Configuring: File types"](https://docs.silverstripe.org/en/4/developer_guides/files/file_security/#configuring-file-types).

For a detailed list of changes, see the full changelog below.

## Accepted Failing Tests

### recipe-core

 * SilverStripe\Assets\Tests\UploadTest::testUploadTarGzFileTwiceAppendsNumber: This test is now expected to fail as
   the MimeValidator module will no longer allow random content to be uploaded with a mismatched mime and file
   extension. The original test is attempting to upload text as a gzip file ([issue](https://github.com/silverstripe/silverstripe-assets/issues/135)).
 * SilverStripe\Forms\Tests\EmailFieldTest::testEmailFieldPopulation ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\FormTest::testValidationExemptActions ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\FormTest::testSessionValidationMessage ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\GridField\GridFieldDetailFormTest::testValidator ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testNullValueWithNumericArraySource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testUnknownStringValueWithNumericArraySource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithAssociativeArraySource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithNumericArraySource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithSqlMapSource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\LookupFieldTest::testWithMultiDimensionalSource ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\SelectionGroupTest::testSelectedFieldHolder ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Forms\Tests\TreeDropdownFieldTest::testReadonly ([issue](https://github.com/silverstripe/silverstripe-framework/issues/8105))
 * SilverStripe\Assets\Tests\FileTest::testCanEdit ([issue](https://github.com/silverstripe/silverstripe-assets/issues/136))
 * SilverStripe\Assets\Tests\FileTest::testCanCreate ([issue](https://github.com/silverstripe/silverstripe-assets/issues/136))
 * SilverStripe\Assets\Tests\UploadTest::testPHPUploadErrors ([issue](https://github.com/silverstripe/silverstripe-assets/issues/136))
 * SilverStripe\Control\Tests\DirectorTest::testForceSSLProtectsEntireSite  ([fix](https://github.com/silverstripe/silverstripe-framework/pull/8102))
 * SilverStripe\Control\Tests\DirectorTest::testForceSSLandForceWWW ([fix](https://github.com/silverstripe/silverstripe-framework/pull/8102))
 
### recipe-cms

 * SilverStripe\CMS\Tests\Model\SiteTreeFolderExtensionTest::testFindsFiles: Affected by global test state ([issue](https://github.com/silverstripe/silverstripe-framework/issues/7978)).
 * SilverStripe\AssetAdmin\Tests\Controller\AssetAdminTest::testSaveOrPublish ([issue](https://github.com/silverstripe/silverstripe-asset-admin/issues/787))
 * SilverStripe\CMS\Tests\Model\SiteTreeTest::testCanEditWithAccessToAllSections ([issue](https://github.com/silverstripe/silverstripe-cms/issues/2178))
 * SilverStripe\CMS\Tests\Model\SiteTreeTest::testCanPublish ([issue](https://github.com/silverstripe/silverstripe-cms/issues/2178))

### recipe-blog

 * SilverStripe\Comments\Tests\CommentingControllerTest::testRSS: Validated to not be an issue in practice ([issue](https://github.com/silverstripe/silverstripe-comments/issues/252))
 * SilverStripe\Comments\Tests\CommentingControllerTest::testCommentsForm: Validated to not be an issue in practice ([issue](https://github.com/silverstripe/recipe-blog/issues/14)) 
 * SilverStripe\Comments\Tests\CommentsExtensionTest::testCommentsForm ([issue](https://github.com/silverstripe/silverstripe-comments/issues/251))

### recipe-content-blocks

There are numerous test errors relating to missing database tables which are tests affected by global
state ([issue](https://github.com/silverstripe/silverstripe-framework/issues/7978)).

 * DNADesign\Elemental\Tests\ElementalAreaTest::testCanBePublished: Affected by global state ([issue]())
 * DNADesign\Elemental\Tests\Reports\ElementTypeReportTest::testReportShowsBlockTypes

### recipe-form-building

 * SilverStripe\UserForms\Tests\Control\UserDefinedFormControllerTest::testRenderingIntoFormTemplate: Affected by starter theme templates ([issue](https://github.com/silverstripe/silverstripe-userforms/issues/780))
 * SilverStripe\UserForms\Tests\Control\UserDefinedFormControllerTest::testRenderingIntoTemplateWithSubstringReplacement: Affected by starter theme templates ([issue](https://github.com/silverstripe/silverstripe-userforms/issues/780))
 * Symbiote\QueuedJobs\Tests\QueuedJobsTest::testStartJob: Affected by global state ([issue](https://github.com/symbiote/silverstripe-queuedjobs/issues/190))
 * Symbiote\QueuedJobs\Tests\QueuedJobsTest::testImmediateQueuedJob: Affected by global state ([issue](https://github.com/symbiote/silverstripe-queuedjobs/issues/190))

### recipe-services

 * SilverStripe\VersionFeed\Tests\VersionFeedTest::testDiffedChangesTitle: Compatibility issue with
   tractorcow/silverstripe-fluent ([issue](https://github.com/silverstripe/silverstripe-versionfeed/issues/54))

### Other

Error: Class 'org\bovigo\vfs\vfsStream' not found: the `silverstripe/config` suite will fail without this dev
dependency installed in your project.

<!--- Changes below this line will be automatically regenerated -->
