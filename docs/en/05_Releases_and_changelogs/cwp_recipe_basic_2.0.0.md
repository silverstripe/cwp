# CWP Recipe 2.0.0 (unreleased)

_**Note:** This changelog is a work in progress, and is subject to change._

## Overview

This upgrade includes CMS and Framework version 4.1.0

 * [Framework 4.1.0](https://github.com/silverstripe/silverstripe-framework/blob/4.1.0/docs/en/04_Changelogs/4.1.0.md)

Upgrade to Recipe 2.0.0-rc2 is optional, but is recommended as the base to start all new CWP projects from.


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
 - `silverstrpe/dms` has been deprecated and has no upgrade path (however was _not_ part of the CWP installer or basic recipe)
 - `silverstripe/selectupload` is deprecated and is not upgraded for SilverStripe 4
 - `silverstripe/secure-assets` has been replaced by SilverStripe core functionality
 - `silverstripe/versionedfiles` has been replaced by SilverStripe core functionality

## Notable changes

 * The minimum PHP version has been raised to 5.6 or higher.
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

### Security changes

The `CwpControllerExtension` has been removed, which handled logic for UAT environment logins and basic authentication
rule exclusions for users given a "can access UAT site" permission, IP address whitelisting for basic authentication
and SSL redirection for specific URLs in test and live environments.

The IP whitelisting logic has been moved to `CwpBasicAuthMiddleware`, and will still be configured to read the
`CWP_IP_BYPASS_BASICAUTH` environment variable by default. For more information on these configuration settings please
see `cwp-core/_config/security.yml`.

For a detailed list of changes, see the full changelog below.


## Accepted Failing Tests

### Tests that fail due to the presence of the `cwp/starter-theme` altering the expected output:

 - SilverStripe\Forms\Tests\SelectionGroupTest::testFieldHolder
 - SilverStripe\Forms\Tests\SelectionGroupTest::testLegacyItemsFieldHolder
 - SilverStripe\Forms\Tests\SelectionGroupTest::testLegacyItemsFieldHolderWithTitle
 - SilverStripe\UserForms\Tests\Control\UserDefinedFormControllerTest::testRenderingIntoFormTemplate
 - SilverStripe\UserForms\Tests\Control\UserDefinedFormControllerTest::testRenderingIntoTemplateWithSubstringReplacement
 - SilverStripe\Forms\Tests\EmailFieldTest::testEmailFieldPopulation
 - SilverStripe\Forms\Tests\FormTest::testValidationExemptActions
 - SilverStripe\Forms\Tests\FormTest::testSessionValidationMessage
 - SilverStripe\Forms\Tests\GridField\GridFieldDetailFormTest::testValidator
 - SilverStripe\Forms\Tests\LookupFieldTest::testNullValueWithNumericArraySource
 - SilverStripe\Forms\Tests\LookupFieldTest::testStringValueWithNumericArraySource
 - SilverStripe\Forms\Tests\LookupFieldTest::testUnknownStringValueWithNumericArraySource
 - SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithAssociativeArraySource
 - SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithNumericArraySource
 - SilverStripe\Forms\Tests\LookupFieldTest::testArrayValueWithSqlMapSource
 - SilverStripe\Forms\Tests\LookupFieldTest::testWithMultiDimensionalSource
 - SilverStripe\Forms\Tests\TreeDropdownFieldTest::testReadonly
 
Many of these test are syntactically equivalent to the expected output, but include extra or different whitespace which is ignored by a browser when rendering a page.
Others have open issues at https://github.com/silverstripe/cwp-starter-theme/issues

### Tests failing because of altered global state:

 - SilverStripe\CMS\Tests\Model\SiteTreeFolderExtensionTest::testFindsFiles
SilverStripe\ORM\Connect\DatabaseException: Couldn't run query:
Table 'ss_tmpdb_1522269580_3585803.DocvertTestPage' doesn't exist

This error occurs due to the test iterating through all Page subclasses, which in the test enviornment includes those marked `TestOnly`. However as this `TestOnly` Page type is not actively being tested, it has not been added to the database, and thus the query fails.

 - SilverStripe\Control\Tests\DirectorTest::testForceSSLProtectsEntireSite
 - SilverStripe\Control\Tests\DirectorTest::testForceSSLandForceWWW

These tests fail due to `cwp/cwp-core` adding patterns that affect the functionality of this feature. This failure is actually intended behaviour by the core, however the test does not allow for it.

 - SilverStripe\Control\Tests\Email\SwiftPluginTest::testSendAllEmailsTo
 - SilverStripe\Control\Tests\Email\SwiftPluginTest::testSendAllEmailsFrom
 - SilverStripe\Control\Tests\Email\SwiftPluginTest::testCCAllEmailsTo
 - SilverStripe\Control\Tests\Email\SwiftPluginTest::testBCCAllEmailsTo

These email tests fail due to the presence of a development environment setting: `SS_SEND_ALL_EMAILS_TO`

 - SilverStripe\Assets\Tests\FileTest::testCanEdit
 - SilverStripe\Assets\Tests\FileTest::testCanCreate
 - SilverStripe\AssetAdmin\Tests\Controller\AssetAdminTest::testSaveOrPublish
 - SilverStripe\CMS\Tests\Model\SiteTreeTest::testCanEditWithAccessToAllSections
 - SilverStripe\CMS\Tests\Model\SiteTreeTest::testCanPublish

All fail because `silverstripe/subsites` alters the permissions model beyond what the tests allow for.

### Others

 - Error: Class 'org\bovigo\vfs\vfsStream' not found

The entire `silverstripe/config` suite fails due to a missing test only dependency (which is not installed because the core config module itself is a dependency - this is normal `composer` behaviour). Requiring [`mikey179/vfsStream`](https://github.com/silverstripe/silverstripe-config/blob/1.0.4/composer.json#L13) into the project sees all the tests pass.


<!--- Changes below this line will be automatically regenerated -->
