# 1.9.2

We're happy to announce the 1.9.2 release of the CWP recipe. 

## Upgrading Instructions

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if would like

SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

In order to update an existing site to use the new basic recipe the following changes to your composer.json can be made:

```json
"require": {
    "cwp/cwp-recipe-basic": "~1.9.2@stable",
    "cwp/cwp-recipe-blog": "~1.9.2@stable",
},
"prefer-stable": true
```

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Features and Enhancements

* 2019-07-23 [f2e3db6](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/f2e3db6586daae035f7371be00fe63b85e7f7a35) Bump minimum PHP to 7.1, SilverStripe to 3.7, replace PHP 7.2 incompatible code (Robbie Averill)
* 2019-07-23 [0b770aa](https://github.com/symbiote/silverstripe-advancedworkflow/commit/0b770aaa15b50d10006d3ad0a7e01ef7d43234d9) Add support for PHP 7.2 and increase minimum SilverStripe ve… (#403) (Guy Marriott)
* 2019-07-23 [75a02c6](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/75a02c6d026777e0b54cf211ea710060507cfdcd) Add support for PHP 7.2 and increase minimum SilverStripe ver… (#45) (Guy Marriott)
* 2019-07-23 [017e77e](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/017e77e5e2cf4add37251007c9193d8ba0f30d36) Add support for PHP 7.2 and increase minimum SilverStripe ver… (#50) (Guy Marriott)
* 2019-07-23 [6c7d460](https://github.com/bringyourownideas/silverstripe-maintenance/commit/6c7d460b78c132dd676d644d7e6cca3befea739b) Add support for PHP 7.2 and increase minimum SilverStripe ve… (#133) (Guy Marriott)
* 2019-07-22 [c5dca7b](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/c5dca7bff2d689bd5db4cea2ae98653284bbf716) Add support for PHP 7.2 and increase minimum SilverStripe version to 3.7 (Robbie Averill)
* 2019-07-22 [6627552](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/66275523f8729195ff292e2a3ba1a4e382383ea9) Add support for PHP 7.2 and increase minimum SilverStripe version to 3.7 (Robbie Averill)
* 2019-07-22 [697a264](https://github.com/bringyourownideas/silverstripe-maintenance/commit/697a264317e230a0ff620a911cffc9ab8bc7e668) Add support for PHP 7.2 and increase minimum SilverStripe version to 3.7 (Robbie Averill)
* 2019-07-22 [9d2cee2](https://github.com/symbiote/silverstripe-advancedworkflow/commit/9d2cee2a64b4988535d187fe2e23a3cc61d67320) Add support for PHP 7.2 and increase minimum SilverStripe version to 3.7 (Robbie Averill)
* 2018-07-16 [d327f0d](https://github.com/silverstripe/silverstripe-userforms/commit/d327f0d53f229998300daf825e6399bfe790bb2b) Add SS 3.7 and PHP 7.2 compatability (Andreas Gerhards)

### Bugfixes

* 2019-08-12 [d45c6ae](https://github.com/silverstripe/cwp-recipe-basic/commit/d45c6ae5547eb8641f118b4061e0500870dadab9) Fix syntax error (Robbie Averill)
* 2019-08-12 [a724dc7](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/a724dc7117b536c6796bc84ea03551b7b04c6ffa) Restore PHP 5.6 support (Robbie Averill)
* 2019-08-12 [848563c](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/848563cbcdc532eb21d19afde35f8da8022ec81f) Restore PHP 5.6 support (Robbie Averill)
* 2019-08-12 [1e5c3bb](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/1e5c3bbfca1433ff63e12da533ed4df8e333a58d) Restore PHP 5.6 support (Robbie Averill)
* 2019-08-12 [e3865a8](https://github.com/bringyourownideas/silverstripe-maintenance/commit/e3865a835bcfaf16e3701840b1891483ad2cb632) Restore PHP 5.6 support (Robbie Averill)
* 2019-07-23 [6a3a4d0](https://github.com/silverstripe/silverstripe-spamprotection/commit/6a3a4d0fe203a28ebd358154c05d185df15a72ba) PHP 7.2 error trying to count null validation result (Robbie Averill)
* 2019-03-26 [0a3ebcb](https://github.com/silverstripe/silverstripe-userforms/commit/0a3ebcb224690847eaef186bfaeea0c6c463a1f9) Display rules for page breaks/editable form steps now works again (Robbie Averill)
* 2019-03-19 [5410029](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/54100291093037d24c13975ebc4f14bef4fddf45) Make task work (Ingo Schommer)
* 2019-02-20 [4d15355](https://github.com/silverstripe/cwp-recipe-basic/commit/4d15355a41b36819a85c311bd49b45346e8d67ce) Fix userforms to 4.3.1 (Robbie Averill)
* 2018-11-07 [3ee822b](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/3ee822b72fad84a4e8bd03e40046e70b6ce23407) Updating symbiote dependency to ^5 for new endpoint (Guy Marriott)
* 2018-09-13 [a2a3ad5](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/a2a3ad51abe4b9eda4035204eb5ba1e0af13124b) Don't blindly assume that HOME is writable (Guy Marriott)
* 2018-09-10 [4c79f68](https://github.com/silverstripe/silverstripe-widgets/commit/4c79f68b023c34a969e965e831606ea17743730f) Cast subclassesFor as array and remove isset nesting (Robbie Averill)
* 2018-06-26 [4395daa](https://github.com/bringyourownideas/silverstripe-maintenance/commit/4395daa85c75a11f0c1d45e309885eb7edc4b3b5) Guzzle Client options can be configured by extensions (Robbie Averill)

### Other changes

* 2019-08-15 [c9baa50](https://github.com/silverstripe/cwp-core/commit/c9baa500ff29c83d5ff55b66f162607d58d556cf) Remove PHP 5.5 from Travis builds (Robbie Averill)
* 2019-08-12 [a867fab](https://github.com/silverstripe/cwp-recipe-basic/commit/a867fabf2ff8d0f1294c06e1ac249752c137acfe) Bump sharedraftcontent (Robbie Averill)
* 2019-08-12 [b321379](https://github.com/silverstripe/cwp-installer/commit/b3213795eeddf89b07a2e6809e5bb665567e389b) Use phpunit 5 (Robbie Averill)
* 2019-08-12 [62fac4f](https://github.com/silverstripe/cwp-recipe-basic/commit/62fac4f9b3f4d24f360eb89909665a5019bdb8a9) Bump dependencies for PHP 7.2 compatibility (Robbie Averill)
* 2019-08-12 [173a880](https://github.com/silverstripe/cwp-recipe-basic/commit/173a8807e6051f0b7a3049cde75e6ee7e572d9ea) Bump silverstripe-maintenance modules to 1.1.x-dev for PHP 7.2 compatibility (Robbie Averill)
* 2019-07-24 [b11dda4](https://github.com/silverstripe/silverstripe-spamprotection/commit/b11dda493adcd8bfd742905a8add67ed7a3e16d6) Update Travis builds to include PHP 7, update PHPUnit to 5.7 (Robbie Averill)
* 2019-07-23 [b1c7366](https://github.com/silverstripe/silverstripe-widgets/commit/b1c73661967175940e2fadf78577aff7c6f8c24f) Add PHP 7.3 to Travis builds (Robbie Averill)
* 2019-07-22 [a073bfa](https://github.com/silverstripe/cwp-core/commit/a073bfa1ff95787ec366b71eefe617859d02c8db) Remove CwpControllerExtensionTest, it relies entirely on mocking static methods which PHPUnit 5 does not support (Robbie Averill)
* 2019-04-14 [ab8e316](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/ab8e316f5bea087a451131b5d01d7aeb673e3be8) Added php 7.2 support (Magnus Bengtsson)
* 2019-03-26 [c2aaec3](https://github.com/silverstripe/silverstripe-userforms/commit/c2aaec36ac1cd0efebc4fe306e670a044f2ce65d) Remove PHP 5.3 from Travis builds (Robbie Averill)
* 2019-03-08 [3607649](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/3607649d9f9f16846a9e41d1603a18e7a6277f93) Document ignored packages config default on class (Dylan Wagstaff)
* 2019-03-06 [3446674](https://github.com/silverstripe/silverstripe-userforms/commit/34466742a8650d1d967bd6f5a7a7d0c8e3c81223) Remove PHP 5.3 from Travis builds (Robbie Averill)
* 2019-03-04 [f451af1](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/f451af112a3450e2162eacec3384ada11d78b763) Change config to be on UpdatePackageInfoTask (James Ayers)
* 2019-03-04 [2146f15](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/2146f1542143baa74d94cfe55bedaea0ca9f7e2e) Add Ignored Packages (James Ayers)
* 2019-02-21 [6dc983b](https://github.com/silverstripe/cwp/commit/6dc983b8d908be438dc7283acb9c54e95522b903) Remove notes about custom package configuration as it is no longer required (Robbie Averill)
* 2019-02-20 [cc32943](https://github.com/silverstripe/cwp/commit/cc329430c21c6003e0398b023e1cbc70b6a21999) DOCS Update changelogs for 1.6.1 and 1.6.2 referencing upgrade instructions (Robbie Averill)
* 2019-02-20 [b5b2f5b](https://github.com/silverstripe/cwp-recipe-basic/commit/b5b2f5b8c8e43e144175746487be7541f98dde51) Revert "Update composer.json" (Robbie Averill)
* 2019-02-20 [52e50b8](https://github.com/silverstripe/cwp-recipe-basic/commit/52e50b81c86d2ee53250f7f9d8e053be554b2d58) Revert "Update multivaluefield dependency" (Robbie Averill)
* 2019-02-19 [b6a881b](https://github.com/silverstripe/cwp/commit/b6a881b11ac29f0e1c765b487bcb773edd25a1f2) Updated end of support date for 1.9.0 (Bryn Whyman)
* 2019-02-19 [cbeccc9](https://github.com/silverstripe/cwp-recipe-basic/commit/cbeccc9cdf9d627a637551c07c36bbf8a2e8e966) Update multivaluefield dependency (Guy Marriott)
* 2019-02-19 [2382059](https://github.com/silverstripe/cwp-recipe-basic/commit/23820598e8cd25b0881c4eef8a2e1581cf1326f0) Update composer.json (Guy Marriott)
* 2018-11-21 [437dd2f](https://github.com/symbiote/silverstripe-queuedjobs/commit/437dd2f2a1cfb19cf7e4e8909b23da77d3e2ced5) add(Readme): Info for query_limit config option (jcarter)
* 2018-11-21 [78ebf99](https://github.com/symbiote/silverstripe-queuedjobs/commit/78ebf9993fbc2009625ed75beeb6c50835c65786) add(CleanupJob): query_limit config option (default 100k) (jcarter)
* 2018-10-04 [267b8da](https://github.com/symbiote/silverstripe-queuedjobs/commit/267b8da6a7fcad92d8ed18410c5cc4ad84c99143) Ensure compatibility with SS 3.7 & PHP 7.2 (Marc Espiard)
* 2018-09-07 [1cd4d99](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/1cd4d99b6cee161e53a41fe9ed07d48fcb8d07a0) indent with 4 spaces instead of tab (zemiacsik)
* 2018-09-07 [299086e](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/299086ea998b57940f9159a7f3c9a47b68c1b783) updated styling to follow PSR-2 (zemiacsik)
* 2018-09-07 [b28ded7](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/b28ded715cb2177ae4ea6dca9ea6f516a1afeac2) added support for PHP 7.2 (matej)
* 2018-09-06 [ac1c1da](https://github.com/silverstripe/silverstripe-widgets/commit/ac1c1dabc8e2dd47bac5bc6b372cefec5466f14f) Update WidgetAreaEditor.php (sinan-evanshunt)
* 2018-07-16 [74559ff](https://github.com/silverstripe/silverstripe-userforms/commit/74559ff5a1a4f64d204783e387c8b1e92d414365) Update travis to test 7.2 and SS 3.7 (Andreas Gerhards)
* 2018-02-21 [46fdd68](https://github.com/silverstripe/cwp-recipe-basic/commit/46fdd682bbfb377c815aa253ded947638ed5f318) Update development dependencies (Robbie Averill)
* 2018-02-21 [8fbd8d6](https://github.com/silverstripe/cwp-recipe-basic/commit/8fbd8d638e8ef62b0c6fa308782a286749b0ed49) Revert "Update child-stability-inherit to match new cow schema" (Robbie Averill)
* 2018-02-21 [91dc5d5](https://github.com/silverstripe/cwp-recipe-basic/commit/91dc5d5acfe3f5f01f876aa9b4b035c5793bc457) Update constraint for subsites to 1.4 (Robbie Averill)
* 2018-02-21 [1d316d3](https://github.com/silverstripe/cwp-recipe-basic/commit/1d316d3e00b41c0497d067f4c44b987dcbdeea43) Update constraint for external links (Robbie Averill)
* 2018-02-21 [e51ff10](https://github.com/silverstripe/cwp-recipe-basic/commit/e51ff10c1867d2e271c085105427e3271cd0fafe) Update constraint for queuedjobs (Robbie Averill)
* 2018-02-21 [6dcc6c0](https://github.com/silverstripe/cwp-recipe-basic/commit/6dcc6c06e1c6fe8cbddc620c3193a491445cf4e0) Update constraint for advancedworkflow (Robbie Averill)
* 2018-02-21 [f98471d](https://github.com/silverstripe/cwp-recipe-basic/commit/f98471dfd26e4388678b370e5c4ea273193ba0de) Update child-stability-inherit to match new cow schema (Robbie Averill)
* 2018-02-21 [70f6dbe](https://github.com/silverstripe/cwp-recipe-basic/commit/70f6dbe2e946d3f54bc1e09acc21281ef56668d9) Update constraint for translatable (Robbie Averill)
* 2018-02-21 [6ac5610](https://github.com/silverstripe/cwp-recipe-basic/commit/6ac56108455c5e24cbdb3ab4f85be616bddf7006) Update constraint for taxonomy (Robbie Averill)
* 2017-12-19 [68ba83d](https://github.com/silverstripe/silverstripe-spamprotection/commit/68ba83dd6df23ab9fdf5bfd6f38cb4c99aafd53e) Remove Transifex configuration. Please commit directly to lang files. (Raissa North)
* 2017-12-19 [4513998](https://github.com/silverstripe/silverstripe-spamprotection/commit/4513998f1ec800f6589419a4cf8e9b5d95c467f8) Remove PHP 5.3 from Travis builds (Raissa North)
* 2017-12-10 [d531d08](https://github.com/silverstripe/cwp-recipe-basic/commit/d531d08d3ef746b44759388c4737bd7b43abafd6) Update constraint for silverstripe/sharedraftcontent (Robbie Averill)
* 2017-11-08 [fdbac60](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/fdbac6030007ff89bc8a563a61250d709e6e0608) Remove PHP 5.3 from Travis builds (Robbie Averill)
* 2017-09-22 [23c0a58](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/23c0a58e481296f8561ba874dfeabb9b037b2afc) TEST Cover base table last edited update (Daniel Hensby)

<!--- Changes above this line will be automatically regenerated -->


