# CWP Recipe 2.0.0 (unreleased)

_**Note:** This changelog is a work in progress, and is subject to change._

## Overview

The CWP 2.0.0 recipe includes updates to all modules for compatibility with SilverStripe 4.

For a full overview of the SilverStripe 4 changes, see [the 4.0.0 changelog](https://docs.silverstripe.org/en/4/changelogs/4.0.0).

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

<!--- Changes below this line will be automatically regenerated -->
