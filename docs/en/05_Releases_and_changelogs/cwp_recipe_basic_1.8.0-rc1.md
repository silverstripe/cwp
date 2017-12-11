# CWP Recipe 1.8.0

## Overview

This upgrade includes CMS and Framework version 3.6.2 which includes bugfixes and some minor feature and API
enhancements. Also included are some minor enhancements to the Fulltext Search, Blog and Secure Assets modules.

 * [framework 3.6.2](https://github.com/silverstripe/silverstripe-framework/blob/3.6.2/docs/en/04_Changelogs/3.6.2.md)

Upgrade to Recipe 1.8.0 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-basic": "~1.8.0@stable",
    "cwp/cwp-recipe-blog": "~1.8.0@stable",
    "cwp/starter-theme": "~1.8.0@stable"
},
"prefer-stable": true
```

## Accepted failing tests

In recipe 1.8.0 these module unit tests cause external errors, but do not represent legitimate issues.

#### silverstripe/framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
   to fail as the new MimeValidator module will no longer allow random content to
   be uploaded with a mismatched mime and file extension. The original test is
   attempting to upload a bunch of text as a gzip file.

##### Expected output modified by the starter theme

 * CheckboxSetFieldTest.testSetDefaultItems
 * EmailFieldTest.testEmailFieldPopulation
 * LookupFieldTest.testNullValueWithNumericArraySource
 * LookupFieldTest.testStringValueWithNumericArraySource
 * LookupFieldTest.testUnknownStringValueWithNumericArraySource
 * LookupFieldTest.testArrayValueWithAssociativeArraySource
 * LookupFieldTest.testArrayValueWithNumericArraySource
 * LookupFieldTest.testArrayValueWithSqlMapSource
 * LookupFieldTest.testWithMultiDimensionalSource
 * OptionsetFieldTest.testSetDisabledItems
 * GridFieldDetailFormTest.testValidator
 * GridFieldSortableHeaderTest.testRenderHeaders

#### silverstripe/queuedjobs

 * QueuedJobsTest.testImmediateQueuedJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).
 * QueuedJobsTest.testStartJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).

#### silverstripe/translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223

#### silverstripe/userforms

 * UserDefinedFormControllerTest.testValidation - Test failure affected by global state (starter theme template overrides).
 * UserDefinedFormControllerTest.testRenderingIntoFormTemplate - Test failure affected by global state.
 * UserDefinedFormControllerTest.testRenderingIntoTemplateWithSubstringReplacement - Test failure affected by global state.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2017-09-04 [f0262a8fd](https://github.com/silverstripe/silverstripe-framework/commit/f0262a8fd9ab5fb51b178ace3c3487351217f5a0) User enumeration via timing attack mitigated (Daniel Hensby) - See [ss-2017-005](http://www.silverstripe.org/download/security-releases/ss-2017-005)

### Features and Enhancements

 * 2017-11-16 [96231bc](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-blog/commit/96231bca74ecf708751e8bbab89292c1fc6decfb) Update blog to 2.5 (Robbie Averill)
 * 2017-11-16 [c038c4e](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/commit/c038c4ea9f6f49a4443d9f883d807635fc61a5e3) Update fulltextsearch and secureassets (Robbie Averill)
 * 2017-08-24 [fdd501182](https://github.com/silverstripe/silverstripe-framework/commit/fdd501182e8403ef082c2954bb66e0b8b6dd7b71) Ability to override SS_TemplateManifest via Injector (fixes #7305) (Patrick Nelson)
 * 2017-07-03 [d5340a8](https://github.com/silverstripe/silverstripe-blog/commit/d5340a87dce5939cd99dd8e25c55cc1bc7af679e) config to disable sending spam notifications (Cam Findlay)

### Bugfixes

 * 2017-11-17 [be255c2](https://github.com/silverstripe/silverstripe-restfulserver/commit/be255c2af16da0cf51be06a1c098365c42da5534) Total items count in output respects canView on records (Robbie Averill)
 * 2017-11-17 [b3fc680](https://github.com/silverstripe/silverstripe-restfulserver/commit/b3fc6803fd36c1b71483476bbe6fc24c5591011a) Return string directly when no body content is provided to put/post methods (Robbie Averill)
 * 2017-11-02 [c2f5850](https://github.com/silverstripe/silverstripe-blog/commit/c2f58507a048a140c99d1b94204cd760175a99bb) Ensure that draft blog posts are always viewable to users with view draft permission (Robbie Averill)
 * 2017-11-02 [cb92696](https://github.com/silverstripe/silverstripe-restfulserver/commit/cb926963923298e81abf961971e8219ad250ffc5) Ensure a Member object is passed to canView etc methods if available (Robbie Averill)
 * 2017-11-02 [087c8ca](https://github.com/symbiote/silverstripe-queuedjobs/commit/087c8ca1ac10b2b0b38810417e6880d1e671f26d) ImmediateQueueHandler needs `scheduleJob` method to match expected API (Daniel Hensby)
 * 2017-10-06 [11a5dc7](https://github.com/silverstripe/silverstripe-contentreview/commit/11a5dc7617d61820c43de6f870bc71a485999e6f) Ensure SiteConfig defaults are used as fallback options (Robbie Averill)
 * 2017-10-05 [4c4a3d4](https://github.com/silverstripe/silverstripe-userforms/commit/4c4a3d492843699b58554f4caa21904eeea3f8b2) for broken validation on optionsets (MikeyC)
 * 2017-09-28 [378c7fa](https://github.com/symbiote/silverstripe-multivaluefield/commit/378c7fa70461cbb36cb5bba664695dbb28f4286d) Return self for setValue (Daniel Hensby)
 * 2017-09-28 [d47648a](https://github.com/silverstripe/silverstripe-blog/commit/d47648a86d92dffbde8e3e286e67e573df37f604) Archive widget shows months from posts published that day (Robbie Averill)
 * 2017-09-26 [ebe1de8d8](https://github.com/silverstripe/silverstripe-framework/commit/ebe1de8d8b5bc739e74b1001aec3110b6175a303) ArrayList sort error with old (supported) PHP (Dylan Wagstaff)
 * 2017-09-26 [4b8ab26](https://github.com/silverstripe/silverstripe-lumberjack/commit/4b8ab2675a25299d6e26ace4c7d81be4bcbcd93c) excludeSiteTreeClassNames (#64) (Ralph Slooten)
 * 2017-09-22 [7edc058](https://github.com/silverstripe/silverstripe-userforms/commit/7edc05812158e0e8a74018cd1818cb7e982ef023) Escape dollar signs in UserForm contents before inserting them with regex (Robbie Averill)
 * 2017-09-12 [091d99f59](https://github.com/silverstripe/silverstripe-framework/commit/091d99f599dcacf6aef2ad1df48311c2399f150c) Authenticators are more resilient to incomplete configuration (Daniel Hensby)
 * 2017-09-05 [e0cca79](https://github.com/silverstripe/silverstripe-registry/commit/e0cca79b4f06b1500cea2611482908845e7362ea) ed psr2 issue and removed empty id check condition. (Roopam Jain)
 * 2017-08-28 [7b200a2a6](https://github.com/silverstripe/silverstripe-framework/commit/7b200a2a642a78bffcf0a2f417a4757fb216ecfb) add combinedFiles to clear logic (Christopher Joe)
 * 2017-08-25 [57fbfc6](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/commit/57fbfc649c2642662a07eed293b2fad65b58cb09) no comma after lisence (Franco Springveldt)
 * 2017-08-18 [e196de2](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/e196de2ac2942a8b73e593134fc3d6166ad3a4b7) Set SearchUpdateCommitJobProcessor::$dirty_indexes prop type to array, not bool (cpenny)
 * 2017-08-16 [eb80a5f9e](https://github.com/silverstripe/silverstripe-framework/commit/eb80a5f9e89e69480edc7f1c9c66cc7403f547f1) LastEdited no longer updated on skipped writes (Daniel Hensby)
 * 2017-08-14 [b04a1ab41](https://github.com/silverstripe/silverstripe-framework/commit/b04a1ab41c4051923e9d9a9af5dedfa5a3ef67d8) Truncate Error Issue when using views in a Unittest. (James Pluck)
 * 2017-08-10 [ab81117](https://github.com/silverstripe/silverstripe-subsites/commit/ab81117c5e0cc65a8ad6f312b950f4fc023abcc1) page rendering with proper subsite locale (Gregory Smirnov)
 * 2017-08-06 [59b28f7d5](https://github.com/silverstripe/silverstripe-framework/commit/59b28f7d5bcefd477766611a99643f121af3dc56) Fixes #7181 to config system for userland config of node display limits. (Russell Michell)
 * 2017-07-26 [31c5eebda](https://github.com/silverstripe/silverstripe-framework/commit/31c5eebda089867d61546106b36ca20b21a00026) Avoid JS errors for HTMLEditorFields in small holders (Daniel Hensby)
 * 2017-07-26 [82c0632f4](https://github.com/silverstripe/silverstripe-framework/commit/82c0632f46e00a251d287811652429036d200eff) Use Config API for MemberAuthenticator::$migrate_legacy_hashes (fixes #7208) (Loz Calver)
 * 2017-07-19 [292aaf653](https://github.com/silverstripe/silverstripe-framework/commit/292aaf65301b2be4bb5e6e1505ccbe98b8ade67f) Cache IDs grouped by site first (Daniel Hensby)
 * 2017-07-18 [b77274c1a](https://github.com/silverstripe/silverstripe-framework/commit/b77274c1a3c3ab8cfa0abf939aa2e4735e534171) Add unique prefix to cache stores to prevent cache leak (Daniel Hensby)
 * 2017-07-17 [515a7cb5](https://github.com/silverstripe/silverstripe-cms/commit/515a7cb569f0cf90787b44fca8845760b539fabe) Make sure VirtualPage renders correct templates (Daniel Hensby)
 * 2017-07-10 [960a0f834](https://github.com/silverstripe/silverstripe-framework/commit/960a0f8343e5ff8379906c2476af4b74da0fd9c9) Make File::ini2bytes() compliant with binary prefixes (fixes #7145) (Loz Calver)
 * 2017-07-06 [a6db16b22](https://github.com/silverstripe/silverstripe-framework/commit/a6db16b2298738e1ef1329329cbef7c6b33f993e) OS X issue with `Convert::html2raw`, `HTMLText::FirstSentence`, `HTMLText::Summary` and `Text::FirstSentence`. (Roman Schmid)
 * 2017-06-30 [a98e02f](https://github.com/symbiote/silverstripe-queuedjobs/commit/a98e02f38d518c9d21c2bc118cb20b4c1bf86225) , correcting an issue where the module would end up on the wrong path. (Nathan Glasl)
 * 2017-06-30 [81b0a15](https://github.com/symbiote/silverstripe-multivaluefield/commit/81b0a152ae022cfcd323cc0a274e588376d12940) (composer) Installer path fix (Marcus Nyeholt)
 * 2017-06-29 [79a7b1016](https://github.com/silverstripe/silverstripe-framework/commit/79a7b1016e6046af4f07fcd8bfb40773d1066b7e) add missing $rootCall param from LeftAndMain (Daniel Hensby)
 * 2017-06-20 [e2116a70e](https://github.com/silverstripe/silverstripe-framework/commit/e2116a70ef34433bfe712b4164ae416a76d4430d) Text colour in GridField filter headers for dropdown fields (Robbie Averill)
 * 2017-06-14 [2afe018dc](https://github.com/silverstripe/silverstripe-framework/commit/2afe018dc7e380ac84f8e1f7986ce0247e9a254b) Ensure HasManyList foreign ID filter includes table name (fixes #7023) (Loz Calver)
 * 2017-06-12 [53c84d93d](https://github.com/silverstripe/silverstripe-framework/commit/53c84d93da0f0681fdcb3a061ebe529fd3cd9a9e) changetracker checkbox bugs (Brian Cairns)
 * 2017-06-12 [a5c84b12a](https://github.com/silverstripe/silverstripe-framework/commit/a5c84b12ab3c0759f696fc48fee3475bab6b3e20) Order of conditionals for getting default admin (Daniel Hensby)
 * 2017-06-06 [4ad2cae86](https://github.com/silverstripe/silverstripe-framework/commit/4ad2cae8642d21e37b5132e4040ca45d2d66c193) Upload_Validator failed to fetch max size from PHP ini values (fixes #6999) (Loz Calver)
 * 2017-06-05 [5f5bfa5e7](https://github.com/silverstripe/silverstripe-framework/commit/5f5bfa5e7045cc96f89fca417f0a7d99dc662fab) create temp folder if it does not exist (Christopher Joe)
 * 2017-06-02 [4b9d5dceb](https://github.com/silverstripe/silverstripe-framework/commit/4b9d5dceb892a9c41925d058d953a8849b407276) tinymce image selection issue in newer versions of Chrome (Christopher Joe)
 * 2017-05-09 [764fbe4](https://gitlab.cwp.govt.nz/cwp/cwp-core/commit/764fbe4a4fa98307c821a267529b5f9f7f898f5d) Remove After: 'mysite/*' in solr.yml (Brett Tasker)
 * 2017-05-09 [3dd303679](https://github.com/silverstripe/silverstripe-framework/commit/3dd3036792962d5384a72aa0132a64aca7d2ebc2) Ensure GridState_Component is added to GridField config even if we set config with GridField::setConfig (Klemen Dolinsek)
 * 2017-02-21 [f647b1c](https://github.com/symbiote/silverstripe-multivaluefield/commit/f647b1c8897b7e0662817855f365087ba59fc8ad) , check whether sortable exists before trying to use it. (Nathan Glasl)
 * 2017-02-06 [51749c6](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/51749c603ae3b884b280e4cb9100871c1ca52bf5) ed Travis URL (Ingo Schommer)
 * 2016-12-20 [4fb4255](https://github.com/silverstripe/silverstripe-secureassets/commit/4fb4255d2bebab3658ff201d1b03d68ccfb05a15) Fixed crash on older versions of PHP when the file does not exist (UndefinedOffset)
 * 2016-08-15 [0fbe9c7](https://gitlab.cwp.govt.nz/cwp/cwp/commit/0fbe9c7ee974f1f36b4723a4914231c346d5940d) formatting (Jake Ovenden)
 * 2016-08-04 [2fa550e](https://gitlab.cwp.govt.nz/cwp/cwp/commit/2fa550eacf2f0fee8e93ccc26165fe3ecbcb688e) typo (Jake Ovenden)
