# 2.6.0 (Unreleased)

## Overview

This release includes CMS and Framework version 4.6.0.

 * [Framework 4.6.0](https://docs.silverstripe.org/en/4/changelogs/4.6.0/)

Upgrading to Recipe 2.6.0 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

### Multi-factor authentication (MFA) modules become a part of the default CWP installation

The following modules are now included into [cwp/installer](https://github.com/silverstripe/cwp-installer)
 * [silverstripe/mfa](https://github.com/silverstripe/silverstripe-mfa/)
 * [silverstripe/totp-authenticator](https://github.com/silverstripe/silverstripe-totp-authenticator/)

All new projects starting with the recipe of version 2.6.0 will have MFA support included.
Common Web Platform (CWP infrastructure) has the support for it already, so no extra setup required.

Since the modules become a part of [cwp/installer](https://github.com/silverstripe/cwp-installer), the change will only affect
new projects. An upgrade to 2.6.0 will not install the MFA modules. However, manual installation is as easy as `composer require`.

### Solr no longer indexes draft / restricted content

This CWP release includes an update to the [fulltextsearch module](https://github.com/silverstripe/silverstripe-fulltextsearch) to introduce more secure defaults. Most notably, **draft and restricted content will no longer be indexed by default**, due to a `canView()` check being performed against an anonymous user prior to (re)indexing.  Restricted content means that it has a permission level of either `Logged-in users` or `Only these groups`.

After upgrading your website, ensure that you run the `Solr_Reindex` task on your production environment to remove previously indexed content that should no longer be there.

If your website requires draft or restricted content to be indexed, you can [opt-out](https://github.com/silverstripe/silverstripe-fulltextsearch/blob/3/README.md#important-note-when-upgrading-to-fulltextsearch-37) of the new secure defaults on a per-model basis.

This is a great opportunity to make sure that any custom indexes / search controllers in your project are correctly filtering results based on permissions and search visibility, which you can now achieve via a unified method (see `SilverStripe\FullTextSearch\Search\ServicesSearchableService::isSearchable()`.)

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.6.0@stable",
    "cwp/cwp-recipe-cms": "2.6.0@stable",
    "silverstripe/recipe-blog": "1.6.0@stable",
    "silverstripe/recipe-form-building": "1.6.0@stable",
    "silverstripe/recipe-authoring-tools": "1.6.0@stable",
    "silverstripe/recipe-collaboration": "1.6.0@stable",
    "silverstripe/recipe-reporting-tools": "1.6.0@stable",
    "cwp/cwp-recipe-search": "2.6.0@stable",
    "silverstripe/recipe-services": "1.6.0@stable",

    TODO: confirm new version (below are the old versions, which may still be correct)
    "silverstripe/subsites": "2.3.3@stable",
    "tractorcow/silverstripe-fluent": "4.4.5@stable",
    "silverstripe/registry": "2.2.1@stable",
    "cwp/starter-theme": "3.0.3@stable"
},
"prefer-stable": true
```

<!--- Changes below this line will be automatically regenerated -->

<!--- Changes above this line will be automatically regenerated -->
