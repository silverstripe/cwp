# 2.6.1

## Overview

This release includes [Silverstripe CMS recipe version 4.6.1](https://docs.silverstripe.org/en/4/changelogs/4.6.1/).

Upgrading to Recipe 2.6.1 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe and the CWP team's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## Notable bugfixes

### Elemental content rendering issue fix
This release contains a fix for an issue that some people have reported where Elemental content may not be rendered on the page after the page type was changed.  After upgrading you may need to manually re-save affected pages to get the content to render.

## Known issues

There are no known CWP issues in this release.

## Expected test failures

The following PHPUnit test failures are expected and do not represent functional issues in CWP:
- SilverStripe\Forms\Tests\GroupedDropdownFieldTest::testReadonlyValue may have a failed test due to a missing line break.  It has no effect on live sites.

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.6.1@stable",
    "cwp/cwp-recipe-cms": "2.6.1@stable",
    "silverstripe/recipe-blog": "1.6.1@stable",
    "silverstripe/recipe-form-building": "1.6.1@stable",
    "silverstripe/recipe-authoring-tools": "1.6.1@stable",
    "silverstripe/recipe-collaboration": "1.6.1@stable",
    "silverstripe/recipe-reporting-tools": "1.6.1@stable",
    "cwp/cwp-recipe-search": "2.6.1@stable",
    "silverstripe/recipe-services": "1.6.1@stable",
    "tractorcow/silverstripe-fluent": "4.5.0@stable",
    "silverstripe/registry": "2.2.1@stable",
    "cwp/starter-theme": "3.0.5@stable"
},
"prefer-stable": true
```




<!--- Changes below this line will be automatically regenerated -->



## Change Log

### Bugfixes

 * 2020-09-02 [f5d07aa](https://github.com/silverstripe/silverstripe-userforms/commit/f5d07aa682f8ebd8036effe052a8e5c5be31e433) Check hidden inputs exist to prevent browser alert when submitting form (Steve Boyd)
 * 2020-08-18 [8d09cb1](https://github.com/silverstripe/silverstripe-userforms/commit/8d09cb171f167530568bbdaec9ae244371ee485b) Use translation string that belongs to UserDefinedFormAdmin (Steve Boyd)
 * 2020-08-07 [c5e4f62](https://github.com/silverstripe/silverstripe-mfa/commit/c5e4f62ca82809f89224005a61644bb738826274) Handle 429 rate limiting status code (Steve Boyd)
 * 2020-07-27 [5ffe56f](https://github.com/dnadesign/silverstripe-elemental/commit/7d076de8133236ccfb844cad1e32453baf3775ee) Update "OwnerClassName" on the EA when necessary (Lee Bradley)
 * 2020-07-22 [792fd82](https://github.com/silverstripe/silverstripe-userforms/commit/792fd824193ff9b49a1f2791355e4f59875adcaf) Place validation messages on .field if .middleColumn is missing (Garion Herman)
 * 2020-07-22 [4317c47](https://github.com/silverstripe/silverstripe-security-extensions/commit/4317c47fcd65df2ca1842011ed584e50e808b272) Set the invalid prop when errorMessage (Steve Boyd)
 * 2020-07-21 [31e6a7a](https://github.com/silverstripe/cwp-starter-theme/commit/31e6a7a5b1c26d8651460052dc6887bcc2e80d9e) Support validation attributes in UserForms templates (Garion Herman)
 * 2020-07-16 [a79a568](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/a79a568428be49747ca9d17991d965a4fbe6dcde) Handle string null CallToActionLink in database (#51) (Steve Boyd)
 * 2020-07-14 [59cd87d](https://github.com/silverstripe/silverstripe-userforms/commit/59cd87d842ce7006857f80e296a9e8938ba8ae47) Trim recipient email addresses before write (Steve Boyd)
 * 2020-07-06 [a61612e](https://github.com/silverstripe/silverstripe-tagfield/commit/a61612ec4b64131ecc9812190af95e46e179fd8d) Resolve issue with react select values not being saved (Damian Mooyman)
 * 2020-07-02 [75f1936](https://github.com/silverstripe/silverstripe-login-forms/commit/75f19367d59056dada584f42142c3903249864cf) Localise login screen (#61) (Maxime Rainville)
 * 2020-06-25 [6f04f95](https://github.com/silverstripe/silverstripe-userforms/commit/6f04f9537d3db09fa5a90c85dc1b75f1223c8e9b) Fix linting issue (Maxime Rainville)
 * 2020-06-21 [b359c80](https://github.com/silverstripe/cwp-recipe-search/commit/b359c802a79708f01ac473ffb101349291adad26) Fix PHP 7.4 (Steve Boyd)
 * 2020-06-17 [d11b947](https://github.com/silverstripe/silverstripe-tagfield/commit/d11b9474ed868710a8739099224f6979263b8d4b) Fix readonly transformation of field with setTitleField() (Sam Minnee)
 * 2019-11-14 [1fe0938](https://github.com/silverstripe/recipe-content-blocks/commit/1fe0938959426059e4d0e80c6bfbe593188988c7) Fix travis build (Serge Latyntcev)

### Other changes

 * 2020-08-18 [6ceec71](https://github.com/silverstripe/recipe-authoring-tools/commit/6ceec712e2f8d8ce8f3af1de08c55d643e44ee4f) Update development dependencies (Garion Herman)
 * 2020-08-18 [d663ee3](https://github.com/silverstripe/recipe-reporting-tools/commit/d663ee3682e969676383d74670bf6281864fab13) Update development dependencies (Garion Herman)
 * 2020-08-18 [728248f](https://github.com/silverstripe/recipe-collaboration/commit/728248f914a39e27844cb7570e2e3f3631d67f0b) Update development dependencies (Garion Herman)
 * 2020-08-18 [5556c2c](https://github.com/silverstripe/recipe-authoring-tools/commit/5556c2ce49456809a604b0d20bb27f6638338822) Update development dependencies (Garion Herman)
 * 2020-08-18 [7bec11c](https://github.com/silverstripe/recipe-form-building/commit/7bec11c38eadad1c96afc50592807910bb266d25) Update development dependencies (Garion Herman)
 * 2020-08-18 [a412c7d](https://github.com/silverstripe/recipe-blog/commit/a412c7d419591b71f6cff7f7021a3c26de33917c) Update development dependencies (Garion Herman)
 * 2020-08-17 [002eba3](https://github.com/silverstripe/silverstripe-mfa/commit/002eba3daed0cadda6058b4e8b1f08c70fad5507) Update translations (Garion Herman)
 * 2020-08-17 [caeef2f](https://github.com/silverstripe/silverstripe-userforms/commit/caeef2fc481aa3aed84f62b73d61a1dcbe4e0ed1) Update translations (Garion Herman)
 * 2020-08-17 [3b362c9](https://github.com/silverstripe/silverstripe-login-forms/commit/3b362c9340225890ad5dbdeb29ae00b44c8aea1f) Update translations (Garion Herman)
 * 2020-08-17 [21a56b2](https://github.com/silverstripe/silverstripe-security-extensions/commit/21a56b20ff64895e27a618f6e5c4fcdb40643a4d) Update translations (Garion Herman)
 * 2020-07-13 [bf76f7d](https://github.com/silverstripe/cwp/commit/bf76f7d5a5c00774d6ec2ba2da0691f5302c1b53) DOC Add 2.6.0 to the changelog index (Serge Latyntcev)
 * 2020-07-06 [fd4efba](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/fd4efbaa4f94bdb9ddca2e6e5f57748ca4c67ecf) Bring back subsite in the CWP kitchen sink (Maxime Rainville)
 * 2020-07-06 [748ef1a](https://github.com/silverstripe/silverstripe-tagfield/commit/748ef1a8f098fdde729fe5032a924bcefc4427ad) Actually save the values (Damian Mooyman)
 * 2020-07-06 [2790d75](https://github.com/silverstripe/silverstripe-tagfield/commit/2790d7504afb041a0683f0a79dfdf28ea24c3302) PHP 5 compatibility 🙄 (Damian Mooyman)
 * 2020-07-05 [0c09eec](https://github.com/silverstripe/silverstripe-userforms/commit/0c09eec6f84ab541e0c0615313b39231a22b4bda) DOC Add docs around creating custom fields. Fixed #928 (#932) (Chris Penny)
 * 2020-07-02 [cb0ab2e](https://github.com/silverstripe/cwp/commit/cb0ab2e75dfab12a759757ba3cccff76f15b0ce9) DOCS Expand documentation of fulltextsearch changes in 2.6.0 changelog (#280) (Garion Herman)
 * 2020-06-25 [a3896eb](https://github.com/silverstripe/silverstripe-userforms/commit/a3896eb39e1b9051a99311dbad06648e4e6c59db) Test postgresql (#979) (Maxime Rainville)
 * 2020-06-25 [e3ab309](https://github.com/silverstripe/cwp/commit/e3ab309330fd54aa7b6ba96c175819fa96b7949f) DOC 2.6.0 changelog record about mimevalidator (Serge Latyntcev)
 * 2020-06-24 [680be2d](https://github.com/silverstripe/cwp/commit/680be2df00f5b86ec7dc656462f273a32cbb4f4a) DOCS Add note to 2.6.0 changelog about removal of Subsites module (Garion Herman)
 * 2020-06-24 [b09501d](https://github.com/silverstripe/cwp/commit/b09501df2609d293f4451197b1862192cb1c4d35) DOCS Adjust references to Subsites to account for its removal in 2.6.0 (Garion Herman)
 * 2020-06-23 [3d3ad7a](https://github.com/silverstripe/cwp-recipe-core/commit/3d3ad7abe78314ee1cbbac08e428d058810ecb08) Update travis (Steve Boyd)
 * 2020-06-23 [cf7e01a](https://github.com/silverstripe/cwp-recipe-cms/commit/cf7e01a6779b804adac021cb53046990794a68be) Update travis (Steve Boyd)
 * 2020-06-23 [d5198a7](https://github.com/silverstripe/recipe-authoring-tools/commit/d5198a7988cb8aba0c35035eb33f4ede4edabdf0) Update travis (Steve Boyd)
 * 2020-06-23 [bd98323](https://github.com/silverstripe/recipe-reporting-tools/commit/bd98323c065029dcb69367233b43cdfb084300fa) Update travis (Steve Boyd)
 * 2020-06-23 [74bd65f](https://github.com/silverstripe/silverstripe-mfa/commit/74bd65f26286e2879f67591bb705b8c679a751ed) Update travis (Steve Boyd)
 * 2020-06-23 [6c57952](https://github.com/silverstripe/silverstripe-login-forms/commit/6c57952a5e74f7fb430b1fcb7b606f3b10c5e8bd) Update travis (Steve Boyd)
 * 2020-06-23 [993ea5b](https://github.com/silverstripe/cwp/commit/993ea5b7274de9469b42b218237fcebae7e05f90) Travis 2.6 (Steve Boyd)
* 2020-06-16 [bdf3908](https://github.com/dnadesign/silverstripe-elemental/commit/bdf39085cb4c9a3c7f294699d1888e0c6a073b4f) Remove PHPCS double ups (Maxime Rainville)
* 2020-06-15 [01e7f50](https://github.com/dnadesign/silverstripe-elemental/commit/01e7f5063619ed25acdbc4523e82280aed7089ed) Restore old dependency constraint (Maxime Rainville)
* 2020-06-15 [6feb9c6](https://github.com/dnadesign/silverstripe-elemental/commit/6feb9c6cedd063623c7b6de540301f38fbde4ff1) Update for 4.4 (Steve Boyd)
 * 2019-11-18 [5b6c853](https://github.com/silverstripe/recipe-content-blocks/commit/5b6c85314310983291217f1dec59f4c45a915b58) Update development dependencies (Garion Herman)
 * 2019-11-18 [7875c94](https://github.com/silverstripe/cwp-recipe-search/commit/7875c94c43b5c367886bf9e37f33418153d5b181) Update development dependencies (Garion Herman)
 * 2019-11-18 [9894d31](https://github.com/silverstripe/recipe-form-building/commit/9894d314fd6ed064b977e081668b8c6e24414f49) Update development dependencies (Garion Herman)
 * 2019-11-18 [2e0371c](https://github.com/silverstripe/recipe-blog/commit/2e0371cc255b01ed3bc1873abbc7ae43a6b35dd2) Update development dependencies (Garion Herman)
 * 2019-11-14 [d34486b](https://github.com/silverstripe/recipe-authoring-tools/commit/d34486becaea4d8db2432057de47cf260ddc300b) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [a7f6ce0](https://github.com/silverstripe/recipe-form-building/commit/a7f6ce03828e3527f74b33a1279205393a3cb36f) Update Composer / Travis config to CMS 4.5 series (Garion Herman)
 * 2019-11-14 [635e205](https://github.com/silverstripe/recipe-collaboration/commit/635e205ba1ba35c4fdcde030ce23fd90bdd1dc93) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [9430cb2](https://github.com/silverstripe/recipe-blog/commit/9430cb20ba9f58ea6fa2afb36c1b245f6d1aa868) Update Composer / Travis config to CMS 4.5 series (Garion Herman)
 * 2019-11-14 [186c872](https://github.com/silverstripe/cwp-recipe-search/commit/186c872c4cc67a88260d469d5d86648cebe93dc4) Create 2.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [e5d8980](https://github.com/silverstripe/recipe-content-blocks/commit/e5d89801081670b9a51082e004d41f39d6f89afb) Create 2.5 minor branch (Serge Latyntcev)
 * 2019-08-14 [288ea4b](https://github.com/silverstripe/recipe-blog/commit/288ea4ba10d5890ef3e8014ef2b0be6b96202618) Update blog to 3.4 (Robbie Averill)
 * 2019-08-14 [91e7edf](https://github.com/silverstripe/recipe-blog/commit/91e7edf79924bca0b1ee32cb5dc069cffe272ba9) Switch to SilverStripe 4.4.x (Robbie Averill)


<!--- Changes above this line will be automatically regenerated -->
