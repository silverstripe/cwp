# 2.3.0 (Unreleased)

## Overview

#### Please note, this version is not yet released. See the [release candidate](https://www.cwp.govt.nz/developer-docs/en/2/releases_and_changelogs/cwp_2.3.0-rc1/) for information on what's planned to be released.

This upgrade includes CMS and Framework version 4.4.0.

 * [Framework 4.4.0](https://github.com/silverstripe/silverstripe-framework/blob/4.4.0/docs/en/04_Changelogs/4.4.0.md)

Upgrading to Recipe 2.3.0 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-core": "2.3.0@stable",
    "cwp/cwp-recipe-cms": "2.3.0@stable",
    "silverstripe/recipe-blog": "1.3.0@stable",
    "silverstripe/recipe-form-building": "1.3.0@stable",
    "silverstripe/recipe-authoring-tools": "1.3.0@stable",
    "silverstripe/recipe-collaboration": "1.3.0@stable",
    "silverstripe/recipe-reporting-tools": "1.3.0@stable",
    "cwp/cwp-recipe-search": "2.3.0@stable",
    "silverstripe/recipe-services": "1.3.0@stable",
    "silverstripe/subsites": "2.3.0@stable",
    "tractorcow/silverstripe-fluent": "4.2.1@stable",
    "cwp/starter-theme": "3.0.0@stable"
},
"prefer-stable": true
```

### Major theme updates

Version 3.0.0 of the Starter and Wātea themes, available with CWP 2.3.0, are updated to use Bootstrap 4.x. Please
[see the Bootstrap migration guide](https://getbootstrap.com/docs/4.3/migration/) for Bootstrap-specific changes. These updates also include an upgrade to Laravel Mix 4, along with other dependency upgrades (including Webpack 4 and
Babel 7).

If you rely on either of these themes as a base for your own, the 3.x upgrade will be a fairly significant undertaking, so you may wish to keep using the latest 2.0.x release when upgrading to CWP 2.3.0.

## Known issues


* [Editing in IE 11 breaks at resolutions below 1400px #2432
](https://github.com/silverstripe/silverstripe-cms/issues/2432)
* [Unable to set memory limit to unlimited #9029
](https://github.com/silverstripe/silverstripe-framework/issues/9029)
* [BadMethodCallException when scafolding search #8792
](https://github.com/silverstripe/silverstripe-framework/issues/8792)
* [TinyMCE text alignment and image floating relies on "simple" theme to work (both in CMS and User Frontend) #8785
](https://github.com/silverstripe/silverstripe-framework/issues/8785)
* [Null size images are wrongly inlined in GraphQL thumbnail responses #930
](https://github.com/silverstripe/silverstripe-asset-admin/issues/930)
* [Multiple entries appear for single item on the "Used on" when a file is selected #903
](https://github.com/silverstripe/silverstripe-asset-admin/issues/903)
* [Default "Content Author" group does not have file edit permissions #276
](https://github.com/silverstripe/silverstripe-assets/issues/276)
* [ShowInSearch should default to 0 #247
](https://github.com/silverstripe/silverstripe-assets/issues/247)
* [File::canView() not checked when a File is linked from a Page #220
](https://github.com/silverstripe/silverstripe-assets/issues/220)
* [Restore batch action is unusable #2426](https://github.com/silverstripe/silverstripe-cms/issues/2426)
* [SiteTree Search does not display expected results on multiple searches using filters. #2415
](https://github.com/silverstripe/silverstripe-cms/issues/2415)
* [GridFieldArchiveAction archives the end object in a versioned many_many relation #200
](https://github.com/silverstripe/silverstripe-versioned/issues/200)
* [Nested queries don't respect can* permissions #217
](https://github.com/silverstripe/silverstripe-graphql/issues/217)
* [Gridfield Better Buttons don't handle sorting and pagination #886
](https://github.com/silverstripe/silverstripe-admin/issues/886)
* [North toolbar presentation issues in smaller viewports #827
](https://github.com/silverstripe/silverstripe-admin/issues/827)
* [Admin tab position bug in smaller viewport #826
](https://github.com/silverstripe/silverstripe-admin/issues/826)
* [Actions in south toolbar in smaller viewport don't fit, reduce action sizes #825
](https://github.com/silverstripe/silverstripe-admin/issues/825)
* [PopoverOptionSet doesn't deal well with long button labels #823
](https://github.com/silverstripe/silverstripe-admin/issues/823)
* [Filter tags disappear when re-searching another term in the Files Search bar #808
](https://github.com/silverstripe/silverstripe-admin/issues/808)
* [Multiple "LIVE" badges when only one version can be live #95
](https://github.com/silverstripe/silverstripe-versioned-admin/issues/95)


## Security considerations

TBC.

<!--- Changes below this line will be automatically regenerated -->
