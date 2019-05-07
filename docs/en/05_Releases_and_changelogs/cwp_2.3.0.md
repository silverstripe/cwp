# 2.3.0 (Unreleased)

## Overview

This upgrade includes CMS and Framework version 4.4.0.

 * [Framework 4.4.0](https://github.com/silverstripe/silverstripe-framework/blob/4.4.0/docs/en/04_Changelogs/4.4.0.md)

Upgrade to Recipe 2.3.0 is optional, but is recommended for all CWP sites.

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

## Known issues

TBC.

## Security considerations

TBC.

<!--- Changes below this line will be automatically regenerated -->
