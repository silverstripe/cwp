# 2.6.0 (Unreleased)

## Overview

This release includes CMS and Framework version 4.6.0.

 * [Framework 4.6.0](https://docs.silverstripe.org/en/4/changelogs/4.6.0/)

Upgrading to Recipe 2.6.0 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

### Mimevalidator is now a part of silverstripe/recipe-core

For most CWP installations this should be a transparent change. However, if you changed the mimevalidator configuration,
a manual step is required when upgrading to CWP 2.6.0.

As a result of [RFC 8782](https://github.com/silverstripe/silverstripe-framework/issues/8782),
the module `silverstripe/mimevalidator` is now included into `silverstripe/recipe-core`,
which is a dependency of `cwp/cwp-recipe-core`.

Historically, `silverstripe/mimevalidator` was a dependency of `cwp/cwp-recipe-core < 2.6` and
`cwp/cwp < 2.6` contained configuration for that module (in [vendor/cwp/cwp/_config/mimevalidator.yml](https://github.com/silverstripe/cwp/blob/2.5.2/_config/mimevalidator.yml)).

After the upgrade, your project will get a new configuration file at [app/_config/mimevalidator.yml](https://github.com/silverstripe/recipe-core/blob/4.6.0/app/_config/mimevalidator.yml),
which is compatible with the pre-existing configuration file. However, if you have introduced any custom
settings for mimevalidator, the new file may override it by accident. We recommend either
moving your configuration into the new file, or deleting the new file so it does not interfere.

If you do not have any custom settings for the mimevalidator module, no action is required.

If you have opted-out of `silverstripe/mimevalidator` module by manually removing it from your composer.json,
you should consider disabling it via configuration, since it will be automatically reinstalled when upgrading to 2.6.0.

For more information see:
 - [RFC 8782](https://github.com/silverstripe/silverstripe-framework/issues/8782)
 - Silverstripe CMS [4.6.0 changelog](https://docs.silverstripe.org/en/4/changelogs/4.6.0/#mime-validator) explaining the impact
 - [silverstripe/mimevalidator](https://github.com/silverstripe/silverstripe-mimevalidator/) module documentation
 - Silverstripe CMS [documentation](https://docs.silverstripe.org/en/4/developer_guides/files/allowed_file_types/#mime-type-validation) about mime type validation


### Multi-factor authentication (MFA) modules become a part of the default CWP installation

The following modules are now included into [cwp/installer](https://github.com/silverstripe/cwp-installer)
 * [silverstripe/mfa](https://github.com/silverstripe/silverstripe-mfa/)
 * [silverstripe/totp-authenticator](https://github.com/silverstripe/silverstripe-totp-authenticator/)

All new projects starting with the recipe of version 2.6.0 will have MFA support included.
Common Web Platform (CWP infrastructure) has the support for it already, so no extra setup required.

Since the modules become a part of [cwp/installer](https://github.com/silverstripe/cwp-installer), the change will only affect
new projects. An upgrade to 2.6.0 will not install the MFA modules. However, manual installation is as easy as `composer require`.

## Solr no longer indexes draft content

This CWP release includes an update to the [fulltextsearch module](https://github.com/silverstripe/silverstripe-fulltextsearch) which now has more secure defaults. Most notably, draft content is now no longer added to the solr index by default. There is also a canView() check performed against an anonymous user before adding content to the solr index. After upgrading your website, ensure that you run Solr_Reindex on production to remove previously indexed content that should no longer be there.

If your website requires draft content to be indexed, you can [opt-out](https://github.com/silverstripe/silverstripe-fulltextsearch/blob/3/README.md#important-note-when-upgrading-to-fulltextsearch-37) of the new secure defaults.

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
