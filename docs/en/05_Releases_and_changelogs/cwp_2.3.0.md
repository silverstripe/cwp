# 2.3.0 (Unreleased)

## Overview

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

### Major Theme Updates

Version 3.0.0 of the Starter and Wātea themes, available with CWP 2.3.0, are updated to use Bootstrap 4.x. Please
[see the Bootstrap migration guide](https://getbootstrap.com/docs/4.3/migration/) for Bootstrap-specific changes.

These updates also include an upgrade to Laravel Mix 4, along with other dependency upgrades (including Webpack 4 and
Babel 7). If you have modified any build configuration, this may need adjustment for compatibility.

## Known issues

TBC.

## Security considerations

TBC.

<!--- Changes below this line will be automatically regenerated -->
