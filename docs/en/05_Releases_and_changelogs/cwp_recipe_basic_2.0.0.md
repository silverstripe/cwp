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
        "cwp/cwp-recipe-cms": "2.0.0@stable",
        "cwp/cwp-recipe-core": "2.0.0@stable",
        "cwp/cwp-recipe-search": "2.0.0@stable",
        "silverstripe/recipe-blog": "1.0.0@stable",
        "silverstripe/recipe-form-building": "1.0.0@stable",
        "silverstripe/recipe-authoring-tools": "1.0.0@stable",
        "silverstripe/recipe-collaboration": "1.0.0@stable",
        "silverstripe/recipe-reporting-tools": "1.0.0@stable",
        "silverstripe/recipe-services": "1.0.0@stable",
        "silverstripe/subsites": "2.0.2@stable",
        "tractorcow/silverstripe-fluent": "4.0.2@stable",
        "silverstripe/registry": "2.0.1@stable",
        "cwp/starter-theme": "2.0.0@stable"
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

The Common Web Platform servers set their webroot to your project root,
but are automatically sending all requests to the `/public` folder
via an [.htaccess passthrough](https://github.com/silverstripe/cwp-installer/blob/2.0.0/.htaccess).

When configuring your local development environment, 
either set `/public` as the document root, or ensure that you're respecting
the [.htaccess passthrough](https://github.com/silverstripe/cwp-installer/blob/2.0.0/.htaccess).
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

## Change Log

### Security

 * 2018-05-24 [3bddea7](https://github.com/silverstripe/cwp-installer/commit/3bddea788374a3ba4289d86630db164f9701c1a9) Prevent php code execution in assets folder, and remove file extensions (Robbie Averill) - See [ss-2018-012](https://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-26 [02db1cc](https://github.com/silverstripe/silverstripe-comments/commit/02db1cc86e60ae7d822d5476a60d5bad0ecdb948) Update jQuery version, remove entwine from frontend use (Dylan Wagstaff) - See [ss-2018-015](http://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [d665f60](https://github.com/silverstripe/cwp-starter-theme/commit/d665f60461f5c2a4b6258becb2b6fe02c195bda3) Update jQuery version used in templates (Dylan Wagstaff) - See [ss-2018-015](https://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [238ae51](https://github.com/silverstripe/cwp-watea-theme/commit/238ae5166a9e5d507a69023503301ff807c021ce) Update jQuery version used in templates (Dylan Wagstaff) - See [ss-2018-015](http://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [299131ed2](https://github.com/silverstripe/silverstripe-framework/commit/299131ed2) File security documentation (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-25 [be96858](https://github.com/silverstripe/silverstripe-installer/commit/be96858e85272ca62f6f0ff3e24a44aa0248ac4d) Remove jar, dotm, potm, xltm from file extension whitelist, hard-code CSS and JS for TinyMCE support (Robbie Averill) - See [ss-2018-014](http://www.silverstripe.org/download/security-releases/ss-2018-014)
 * 2018-04-24 [f847f186b](https://github.com/silverstripe/silverstripe-framework/commit/f847f186b) Remove password text from session data on failed submission (Aaron Carlino) - See [ss-2018-013](http://www.silverstripe.org/download/security-releases/ss-2018-013)
 * 2018-04-23 [aa365e0](https://github.com/silverstripe/silverstripe-assets/commit/aa365e0) Remove dotm, potm, jar, css, js, xltm from default File.allowed_extensions (Robbie Averill) - See [ss-2018-014](http://www.silverstripe.org/download/security-releases/ss-2018-014)
 * 2018-04-23 [cf330de](https://github.com/silverstripe/cwp-core/commit/cf330def0f0afb7f82876a30eab4c0c658d40a1d) Enforce HTTPS for all URLs when in test mode (Robbie Averill) - See [ss-2018-009](http://www.silverstripe.org/download/security-releases/ss-2018-009)
 * 2018-04-23 [f9c03fa](https://github.com/silverstripe/silverstripe-installer/commit/f9c03fa623dc7237005901efd863256b7d356db7) Prevent php code execution in assets folder (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-23 [1e27835](https://github.com/silverstripe/silverstripe-assets/commit/1e27835) Prevent php code execution in assets folder (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-22 [beec0c0d4](https://github.com/silverstripe/silverstripe-framework/commit/beec0c0d4) regression of SS-2017-002 (Robbie Averill) - See [ss-2018-010](http://www.silverstripe.org/download/security-releases/ss-2018-010)
 * 2018-04-19 [b2c5576](https://github.com/silverstripe/silverstripe-taxonomy/commit/b2c5576) Fix search term escaping to prevent possible SQL injection attack (Robbie Averill) - See [ss-2018-11](http://www.silverstripe.org/download/security-releases/ss-2018-011)
 * 2018-04-11 [e409d6f67](https://github.com/silverstripe/silverstripe-framework/commit/e409d6f67) Restrict non-admins from being assigned to admin groups (Damian Mooyman) - See [ss-2018-001](http://www.silverstripe.org/download/security-releases/ss-2018-001)
 * 2018-04-10 [9053014a7](https://github.com/silverstripe/silverstripe-framework/commit/9053014a7) Validate against malformed urls (Damian Mooyman) - See [ss-2018-008](http://www.silverstripe.org/download/security-releases/ss-2018-008)
 * 2018-04-10 [2e13ae746](https://github.com/silverstripe/silverstripe-framework/commit/2e13ae746) Prevent code execution in template value resolution (Damian Mooyman) - See [ss-2018-006](http://www.silverstripe.org/download/security-releases/ss-2018-006)
 * 2018-04-09 [db04ed9](https://github.com/silverstripe/silverstripe-admin/commit/db04ed9) Remove on* events as allowed properties (Damian Mooyman) - See [ss-2018-004](http://www.silverstripe.org/download/security-releases/ss-2018-004)
 * 2018-04-08 [d935140a9](https://github.com/silverstripe/silverstripe-framework/commit/d935140a9) Prevent unauthenticated isDev / isTest being allowed (Damian Mooyman) - See [ss-2018-005](http://www.silverstripe.org/download/security-releases/ss-2018-005)

### API Changes

 * 2018-04-03 [3e0cae0](https://github.com/silverstripe/silverstripe-comments/commit/3e0cae0cc96e80123bfaad42588edd1c06aaf81e) Reintroduce abstract handler (previously removed in 192ddbb) and deprecate for future removal (Robbie Averill)
 * 2018-03-21 [100be38](https://github.com/silverstripe/silverstripe-userforms/commit/100be38ab1df82f411243e4213794b7974672b64) Remove use of getEscapedTitle() and deprecated for future removal. Use $Title directly instead. (Robbie Averill)
 * 2018-03-15 [1f3fa7f](https://github.com/silverstripe/cwp-pdfexport/commit/1f3fa7ff383cface4181116dde37b75c467ccbf9) Rename doUnpublish to onAfterUnpublish to prevent collisions with Versioned (Robbie Averill)
 * 2018-03-14 [991fb0c](https://github.com/silverstripe/silverstripe-auditor/commit/991fb0cb42d04201e06cd538950bbb1b0f38b73a) Deprecate bind_manipulation_capture() and onBeforeInit() in AuditHook (Robbie Averill)
 * 2018-02-26 [404d4dc](https://github.com/silverstripe/recipe-blog/commit/404d4dc756aad445a0c541abd771e60a5e2d7dc4) Shift default comment extension from SiteTree to Blog and BlogPost (Robbie Averill)
 * 2018-02-25 [192ddbb](https://github.com/silverstripe/silverstripe-comments/commit/192ddbb4b5f3c27598e92b40489c4ffdd0f90b1b) Use concrete Handler implementations for Spam and Approve bulk editing (Robbie Averill)
 * 2018-01-25 [0e5f792](https://github.com/silverstripe/cwp-starter-theme/commit/0e5f792071367f1bbff8c7f343ae4044821d6f09) Update version (Raissa North)
 * 2018-01-25 [79f07a2](https://github.com/silverstripe/cwp-starter-theme/commit/79f07a25373140782ec0bd39abfe78cd30c7c452) Add namespaces (Raissa North)
 * 2018-01-24 [590157b](https://github.com/silverstripe/cwp-starter-theme/commit/590157b51c3542f2111f45a959e82b04ad4261ee) Update template file structure to align with  namespacing (Raissa North)
 * 2018-01-10 [5496abd](https://github.com/silverstripe/cwp-starter-theme/commit/5496abd9d3eb2266c9f702fd66badf3f76162734) Switch Translatable implementation for Fluent (Robbie Averill)
 * 2017-12-22 [168cc1e](https://github.com/silverstripe/cwp-starter-theme/commit/168cc1e993a0a623eed95094486ca02874420232) Move other CWP templates to match new namespaces (Robbie Averill)
 * 2017-12-21 [d3ab3be](https://github.com/silverstripe/cwp-starter-theme/commit/d3ab3bef5153e98f5efd648782c0667f38f86a3b) Move Sitemap page template into new namespaces cwp/cwp location (Robbie Averill)
 * 2017-10-31 [4e596df](https://github.com/silverstripe/cwp-starter-theme/commit/4e596df909d1c2e91044d00e691a3a4b2184a5b0) Rename namespaces core and userforms templates, remove CreditCardField and PhoneNumberField (Robbie Averill)
 * 2017-10-31 [7df9e65](https://github.com/silverstripe/cwp-starter-theme/commit/7df9e6551cb6ae36b3f0039f5215a9892b3399a5) Move Google Analytics to its own include template (Robbie Averill)
 * 2017-10-31 [8a80d9b](https://github.com/silverstripe/cwp-starter-theme/commit/8a80d9b7973cf0662e0eb97c615325c1124b37c8) Update theme references and enable silverstripe-elemental if installed (Robbie Averill)
 * 2017-10-31 [cf18c56](https://github.com/silverstripe/cwp-starter-theme/commit/cf18c561996d8fd3f52d02bad26e03606bf841bf) Use themed requirements and add SS4 as a dependency (Robbie Averill)

### Features and Enhancements

 * 2018-04-13 [24ff267](https://github.com/symbiote/silverstripe-queuedjobs/commit/24ff267b1311d7f10fa81f91211481a8a624b35d) Ability to inject a different process manager class. (Frank Mullenger)
 * 2018-04-08 [fa2bb55](https://github.com/silverstripe/silverstripe-documentconverter/commit/fa2bb5569641cd713d858c11c6a723845fad80a6) Replace HeaderField with LiteralField (Raissa North)
 * 2018-04-04 [ee6b9c8](https://github.com/symbiote/silverstripe-queuedjobs/commit/ee6b9c82c94b1e91bca415a555711b149fc40b0f) Allow ProcessManager log path to be configurable via environment variable (Robbie Averill)
 * 2018-03-20 [7a3e2d0](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/7a3e2d0823efe6bd8e18c1662efa92883da1097a) Allow autoconfigure to be disabled via configuration (Robbie Averill)
 * 2018-03-14 [3f24858](https://github.com/silverstripe/silverstripe-blog/commit/3f24858b73424f731b34d25824d91cb740400b93) added MinutesToRead() (zanderwar)
 * 2018-03-14 [1e2ef35](https://github.com/silverstripe/silverstripe-auditor/commit/1e2ef351a1a17476595fca851ae7f0c42050c9e9) Implement Database manipulate() method proxy for audit hook (Robbie Averill)
 * 2018-03-14 [e7420a5](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/e7420a584db71b45ad84ff02f0ed31e24ab5ce60) Update to use proxied DB instead of self-proxied (Raissa North)
 * 2018-02-23 [6e5b37e](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/6e5b37e72887d42674057eb5a6c7997cdae3843c) Add SearchVariant::withCommon to run callbacks on relevant variants rather than all (Robbie Averill)
 * 2018-02-13 [d241585](https://github.com/silverstripe/cwp-installer/commit/d241585afc15b42ad706bfe52eecb07d20113fa5) Add htaccess rule to rewrite traffic to public web directory (Robbie Averill)
 * 2018-01-24 [4cc11d2](https://github.com/silverstripe/cwp-starter-theme/commit/4cc11d2994d0fcb02f0ff9dbf5be2be2dddfc9cb) Update copyright date (Raissa North)
 * 2017-12-21 [4d60f01](https://github.com/silverstripe/silverstripe-installer/commit/4d60f01d2dd17febcf15c08ecdc07af7380694d0) add test for a `--no-dev` build (Christopher Joe)
 * 2017-12-20 [35fa3c3](https://github.com/symbiote/silverstripe-queuedjobs/commit/35fa3c382dca145a2104fcb2f25a50c10f107373) Convert to vendor module, update use of cli-script with sake and some readme examples (Robbie Averill)
 * 2017-11-14 [47f87be](https://github.com/symbiote/silverstripe-queuedjobs/commit/47f87bed67cb711c29f4d82a099c6a7f542fbe3f) Log job output into the job messages. (Sam Minnee)
 * 2017-11-13 [1f0d551](https://github.com/symbiote/silverstripe-queuedjobs/commit/1f0d5515b45e99107b82ac0319cb5e1212de865e) Add DeleteAllJobsTask (Sam Minnee)
 * 2017-11-10 [a99f165](https://github.com/symbiote/silverstripe-queuedjobs/commit/a99f165b730e1f7cd07a6ddd2f5b3780083e1e1f) Allow queueing of build tasks (Sam Minnee)
 * 2017-11-01 [cfd4c3e](https://github.com/silverstripe/cwp-starter-theme/commit/cfd4c3e7b5de7321e3cdbff760d5fed713712251) Add margin to bottom of file block (Robbie Averill)
 * 2017-11-01 [66621b8](https://github.com/silverstripe/cwp-starter-theme/commit/66621b8589c24f6986e88edfcd95259f4b0b7fe9) Add styles for banner block (Robbie Averill)


### Bugfixes

 * 2018-05-28 [e272422](https://github.com/silverstripe/cwp-starter-theme/commit/e272422b290c7a6e7a3be8fee63aac915d54c293) Refactor starter theme readme for consistency (Sacha Judd)

 * 2018-05-23 [e7e32d13a](https://github.com/silverstripe/silverstripe-framework/commit/e7e32d13a) Add namespace and encryptor to tests that expect blowfish to be available (Robbie Averill)
 * 2018-05-22 [a0230a3](https://github.com/silverstripe/silverstripe-spellcheck/commit/a0230a3360ece10495958b34a4e93e6a7a288258) Manually replace Maori with Māori (intl bug) (Robbie Averill)
 * 2018-05-18 [c7ab8df](https://github.com/silverstripe/cwp/commit/c7ab8df9d6b6deeaf05a66d026b348f0e784872d) broken links (Raissa North)
 * 2018-05-18 [4913290](https://github.com/silverstripe/silverstripe-userforms/commit/491329044b38314f217e750d810ec1237451c660) Add extension to remap polymorphic relationship classes for Parent and Form fields (Robbie Averill)
 * 2018-05-09 [8f363d6](https://github.com/silverstripe/silverstripe-userforms/commit/8f363d6b608b08a70c423a56473d673cbda923ff) Remove unnecessary translation of parameterised field value (Raissa North)
 * 2018-05-03 [a40daef](https://github.com/silverstripe/cwp/commit/a40daefc966e2143f57edd8e115fd89c87bebeeb) Set default_locale to en_NZ, and allow errors to be returned as 200 OK (Robbie Averill)
 * 2018-05-03 [a3b586a](https://github.com/silverstripe/silverstripe-spellcheck/commit/a3b586a3978ae1df00f8552142d96aa45f3ce23f) Allow configurable default locale, or use the first defined locale (Robbie Averill)
 * 2018-05-03 [c0bd59c](https://github.com/silverstripe/silverstripe-spellcheck/commit/c0bd59cc593c0fb8216a9942de6172ecae528592) Allow errors to be returned with 200 header codes (Robbie Averill)
 * 2018-04-23 [838ce23](https://github.com/silverstripe/cwp/commit/838ce231febc505c177e302931771740c953e2e5) regex in performance guide htaccess rules (Tomas Cantwell)
 * 2018-04-22 [dca8ae5](https://github.com/silverstripe/cwp/commit/dca8ae53a678a9de964dc3b5bbc11c71fcd7b5d3) regex issue in performance docs (Tomas Cantwell)
 * 2018-04-20 [b4943fb](https://github.com/silverstripe/silverstripe-subsites/commit/b4943fb77c4ee612bb8bc16772866f0f06e2501b) Automatically create default SiteTree records for new subsites (Robbie Averill)
 * 2018-04-20 [f47a222](https://github.com/silverstripe/cwp/commit/f47a2225d8b52f81f8038767e8e82be7764f4366) Unentice direct BasePage creation in the CMS (Dylan Wagstaff)
 * 2018-04-15 [4d333b2](https://github.com/silverstripe/silverstripe-taxonomy/commit/4d333b2a06bb5dd23fd106a56dcae892c60c6b93) Move directory controller template into correct location (Robbie Averill)
 * 2018-04-11 [caab511](https://github.com/silverstripe/silverstripe-userforms/commit/caab51122b0aedf4decd02a931391ebe24ea88ff) the each loop to propperly get the field passed in (Simon Erkelens)
 * 2018-04-08 [cbca821](https://github.com/silverstripe/silverstripe-restfulserver/commit/cbca821c9b8975270c2828c5b1068b00c9fc9605) comply with psr-2 (Andreas Piening)
 * 2018-04-08 [d0149f8](https://github.com/silverstripe/silverstripe-restfulserver/commit/d0149f899596103fefeb7d442d779c64c107ec7c) add missing canView check in json (Andreas Piening)
 * 2018-04-06 [30704f5](https://github.com/symbiote/silverstripe-advancedworkflow/commit/30704f50de30189f7228c9271c22b2ea56bbfdf7) Update path to template (Raissa North)
 * 2018-04-05 [b4aae0f](https://github.com/silverstripe/cwp-core/commit/b4aae0fa891f9e840c7a82523b3a48f3f92040bb) Remove attempt to import environment into conifg for docvert (Dylan Wagstaff)
 * 2018-04-05 [39044de](https://github.com/silverstripe/silverstripe-externallinks/commit/39044de8ad7d05cd07e51ee0f10149d465205012) Use correct CacheInterface API methods and remove doubled up logic (Robbie Averill)
 * 2018-04-04 [a886f68](https://github.com/silverstripe/silverstripe-comments/commit/a886f68c58c3b45ae70cd91906cbd0677e9fd821) reintroduce extension hook for comment form rendering (Raissa North)
 * 2018-04-04 [d45a407](https://github.com/silverstripe/silverstripe-restfulserver/commit/d45a407185fae6d11353dbe259eb4db27423bb7b) make RestfulServer:: configurable (Andreas Piening)
 * 2018-04-03 [4544cd3](https://github.com/silverstripe/cwp/commit/4544cd3c5b0fbc102ad72f892064859777fed704) module references and mention base module (Ingo Schommer)
 * 2018-04-03 [7eba03a](https://github.com/silverstripe/cwp/commit/7eba03a3b4eb48d3783f23bacd707da78d174192) Switch example date format to match HTML5 datetime field format (Robbie Averill)
 * 2018-04-03 [fbabf03](https://github.com/silverstripe/cwp-starter-theme/commit/fbabf03b72ae8c886dde32a93c2bdbc97515ed66) Use CLDR date formats and check for namespaced class names in conditions (Robbie Averill)
 * 2018-04-03 [866619f](https://github.com/silverstripe/cwp-starter-theme/commit/866619fa5413c784de3b5721e444e8bfa1ef84a7) Encode entities appropriately using the new core method (Dylan Wagstaff)
 * 2018-04-03 [ff885e9](https://github.com/silverstripe/cwp/commit/ff885e98889f5c2cf8e283d484b31a30df3984b7) Remove rogue nbsp; from Start Time field labels (Robbie Averill)
 * 2018-04-03 [b450b5c](https://github.com/silverstripe/cwp/commit/b450b5ccbfcbab1bbe482a0bcc8b3699cd202b03) Only add File_ShowInSearch if File class is in query (Raissa North)
 * 2018-04-03 [2b3b0c8](https://github.com/silverstripe/silverstripe-iframe/commit/2b3b0c84ebf22fa2334e6390ab1717ee101936eb) Cast IFrameURL right title as HTMLText to avoid double escaping (Robbie Averill)
 * 2018-03-29 [0ca0b2c](https://github.com/silverstripe/cwp-starter-theme/commit/0ca0b2c0f56e88afdb395b979bf30e6153fb6af9) let CompositeField subclasses render themselves (Dylan Wagstaff)
 * 2018-03-29 [0ca0b2c](https://github.com/silverstripe/cwp-starter-theme/commit/0ca0b2c0f56e88afdb395b979bf30e6153fb6af9) let CompositeField subclasses render themselves (Dylan Wagstaff)
 * 2018-03-26 [9996e38](https://github.com/silverstripe/cwp-starter-theme/commit/9996e38cda15879bf8dfa5a871af17a3cec4a0f9) use correct case vars to correctly render (Dylan)
 * 2018-03-23 [7e9f6ce](https://github.com/silverstripe/silverstripe-auditor/commit/7e9f6cef53fc235ea5997e0c295c82a653f4c8af) Handle nullable $original object argument in onAfterPublish (Robbie Averill)
 * 2018-03-23 [f7ffb70](https://github.com/silverstripe/silverstripe-userforms/commit/f7ffb706ce784fbdcf388ce888b0df9ff934b5b9) Use userforms template for member list field, fixes display rule issue (Robbie Averill)
 * 2018-03-21 [d1943c8](https://github.com/silverstripe/cwp-starter-theme/commit/d1943c83695b5b750f7dccbf33c22c497cfd6ad1) Rename dropdown field template, fixes #35 (Robbie Averill)
 * 2018-03-21 [282d0d4](https://github.com/silverstripe/cwp-starter-theme/commit/282d0d42850afc6bdc44fef681dde0de2391e416) Correct template names for checkbox and checkbox set/group templates (Robbie Averill)
 * 2018-03-21 [a833161](https://github.com/silverstripe/cwp-starter-theme/commit/a833161b9d85e964dfd30f139f0eb5e2997a4776) Move textarea field template to the correct filename, remove old field template and holder (Robbie Averill)
 * 2018-03-21 [177656b](https://github.com/silverstripe/cwp-starter-theme/commit/177656b89be59bd3e5360420e60eb9be8acea470) Correctly render optionset fields with their labels inline (Robbie Averill)
 * 2018-03-20 [bb3e9d6](https://github.com/symbiote/silverstripe-queuedjobs/commit/bb3e9d6ab64aa6ba2b4c03a2e00fe986122ac299) Missing use statement for ProcessManager (Gordon Anderson)
 * 2018-03-20 [be166bd](https://github.com/silverstripe/cwp-starter-theme/commit/be166bde19c47460bd33c9355f0a1f77b721de30) Correct unprocessed count variable in translation for step progress (Robbie Averill)
 * 2018-03-20 [9bb639d](https://github.com/silverstripe/cwp-starter-theme/commit/9bb639d95b090dc083e0ed3779e6152034477df7) Remove reference to incorrect blog stylesheet (Robbie Averill)
 * 2018-02-26 [4413db4](https://github.com/silverstripe/cwp-search/commit/4413db4135b0a7f24d8995709fa4ecad9c2061a7) use appropriate constraints for our CI testing (Dylan Wagstaff)
 * 2018-02-25 [ceba6c1](https://github.com/silverstripe/silverstripe-externallinks/commit/ceba6c14069e06eeb3659e3a159fd632eba213be) Update requirements & travis config to be consistent with acutal requirements (Dylan Wagstaff)
 * 2018-02-22 [cf51eba](https://github.com/silverstripe/cwp-starter-theme/commit/cf51eba90047da7cfacb473e30fa106511cabb84) Move template to correct location for SearchForm_header, update translation keys in Header template (Robbie Averill)
 * 2018-02-20 [e91d10e](https://github.com/silverstripe/cwp-starter-theme/commit/e91d10e99c6975bae04227c161abfd10734932f9) Update resource references to actual locations (Dylan Wagstaff)
 * 2018-02-20 [7e2a86d](https://github.com/silverstripe/cwp-installer/commit/7e2a86d25ff0b9ff8dcdaa09693c9cb3725938ef) don't try to test non existent files (Dylan Wagstaff)
 * 2018-02-20 [1f5e156](https://github.com/silverstripe/cwp-starter-theme/commit/1f5e156e4aca2d1b7cf2b648a59df193682976b9) also expose ico and images from module root (Dylan Wagstaff)
 * 2018-02-20 [6ad5822](https://github.com/silverstripe/cwp-starter-theme/commit/6ad58223baf44c2cfecd3191d3cf2947d7303d2c) expose public resources since it's necessary (Dylan Wagstaff)
 * 2018-02-06 [5bff64b47](https://github.com/silverstripe/silverstripe-framework/commit/5bff64b47) Fix Director::test() not persisting removed session keys on teardown (Damian Mooyman)
 * 2018-02-05 [9a8c290](https://github.com/silverstripe/cwp-installer/commit/9a8c2909513ed84aa24c3b1601063127b8e46422) Tidy up, fix classname errors (Raissa North)
 * 2018-01-25 [eca83bb](https://github.com/silverstripe/cwp-starter-theme/commit/eca83bbc44825abe4981c9c3d10e8cda7050f542) Add class to re-enable click action (Raissa North)
 * 2018-01-24 [8632bc6](https://github.com/silverstripe/cwp-starter-theme/commit/8632bc614db2a940b622b4c6ccd171bf5d0e3868) Replace deprecated setWidth/Height functions with scaleWidth/Height (Raissa North)
 * 2018-01-24 [4abe8e8](https://github.com/silverstripe/cwp-starter-theme/commit/4abe8e82a24d121772f6eebcccc94405b830e8d4) Fix EventHolder namespace (Raissa North)
 * 2018-01-23 [ab67e5c](https://github.com/silverstripe/cwp-starter-theme/commit/ab67e5c8480aa4090e429daebee824ef0b76b51d) Update to CLDR date format and update namespaces in PageUtilities (Robbie Averill)
 * 2018-01-09 [5e6bbf8](https://github.com/silverstripe/cwp-starter-theme/commit/5e6bbf8dcbfdc4316530d83de173984319888f26) Update form message handling to match core Form.ss template (Robbie Averill)
 * 2017-12-07 [c96d479](https://github.com/silverstripe/cwp-starter-theme/commit/c96d479ecf40341e1881e79598f5a9468a9c24e8) Core has SearchForm template as an Include, copy this layout (Dylan Wagstaff)
 * 2017-11-07 [4efffca](https://github.com/silverstripe/cwp-starter-theme/commit/4efffcad8f995f606796b3ee9dfa3c4ec0ebcdde) Add max-height to banner block (Robbie Averill)
