# 2.3.2

## Overview

This release includes only a hotfix to [silverstripe/fulltextsearch](https://github.com/silverstripe/silverstripe-fulltextsearch)

Upgrading to Recipe 2.3.2 is recommended for all CWP sites that use the "fulltextsearch" (Solr) module to provide search 
functionality. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you 
would like SilverStripe's assistance, you can request support via the 
[Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

### FullTextSearch

Recipe 2.3.0 shipped with a [bug](https://github.com/silverstripe/silverstripe-fulltextsearch/issues/260) that affected
reconfiguring your Solr index. This fix will restore the ability to re-configure your search indices on CWP.

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.3.2@stable",
    "cwp/cwp-recipe-cms": "2.3.2@stable",
    "silverstripe/recipe-blog": "1.3.2@stable",
    "silverstripe/recipe-form-building": "1.3.2@stable",
    "silverstripe/recipe-authoring-tools": "1.3.2@stable",
    "silverstripe/recipe-collaboration": "1.3.2@stable",
    "silverstripe/recipe-reporting-tools": "1.3.2@stable",
    "cwp/cwp-recipe-search": "2.3.2@stable",
    "silverstripe/recipe-services": "1.3.2@stable",
    "silverstripe/subsites": "2.3.2@stable",
    "tractorcow/silverstripe-fluent": "4.2.1@stable",
    "cwp/starter-theme": "3.0.0@stable"
},
"prefer-stable": true
```

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2019-07-28 [bb695b1](https://github.com/silverstripe/cwp/commit/bb695b1d89f56b85c10fec4f7ee25b7e901ff79b) Permissions to create Quicklinks are now resolved to the par… (#224) (Guy Marriott)
 * 2019-07-26 [203a0af](https://github.com/silverstripe/cwp/commit/203a0afbf10f4d95af033d33e4a93b307e044de8) Permissions to create Quicklinks are now resolved to the parent page edit permissions (Robbie Averill)
 * 2019-07-18 [c54f683](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/c54f683e953a87d9adf0bf889be0e86affe44676) Make remotepath optional to restore compatibility with CWP (Garion Herman)

### Other changes

 * 2019-07-29 [ae7073e](https://github.com/silverstripe/cwp-recipe-core/commit/ae7073ed58618273a4486cd10fc41fb85e7e33b1) Update development dependencies (Guy Marriott)
 * 2019-07-25 [afc4f57](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/afc4f571486a5f81148a809d832568bd01755d21) Enable color and font pickers by default (#42) (Guy Marriott)
 * 2019-07-25 [07db319](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/07db319b88110b83bb96f960a30be8432ad76e26) Enable color and font pickers by default (Ingo Schommer)
 * 2019-07-22 [b8c0a07](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/b8c0a07252dbde21734b2d32ebc519835102e96f) Add inline requirements for MFA modules in Travis builds for PHP 7.1 (Robbie Averill)
 * 2019-07-18 [1fb7830](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/1fb7830ff16b7ccb66f450f9057d885bb23fb341) Update core releases tested against in Travis config (Garion Herman)
 * 2019-07-02 [80cb35c](https://github.com/silverstripe/cwp/commit/80cb35c7605ce7c38c28a6267bc1263d736528b0) DOC add changelogs for 2.3.1 (#216) (Serge Latyntsev)
 * 2019-07-02 [69fb9df](https://github.com/silverstripe/cwp/commit/69fb9dfb032e4c2ff144e98dcf83169cacab31e0) Add CWP 2.3.1 to changelog index (Robbie Averill)
 * 2019-05-16 [14b35f1](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/14b35f1935c9954041fc995165d39ca82ff604a7) DOCS Fix doc block formatting in SolrService (Robbie Averill)
 * 2019-05-16 [b1ec2ed](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/b1ec2ed6d9cd35d6c5e8669ebc8d4fdb9b320558) Remove unused class imports, import docblock reference for Apache_Solr_Response, use strict comparison (Robbie Averill)
 * 2019-05-09 [565a9e1](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/565a9e11e4db49eebbb90cabd32cde7a53386a5d) Update translations (Robbie Averill)
 * 2019-04-17 [fece48c](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/fece48c5f03c3a1b9faea4d4e54bcdb4fe0253a4) DOCS Fix broken phpdoc types and tighten string comparison operators (Robbie Averill)
<!--- Changes above this line will be automatically regenerated -->
