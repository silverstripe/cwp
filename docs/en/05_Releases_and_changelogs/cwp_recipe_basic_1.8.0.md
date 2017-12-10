# CWP Recipe 1.8.0

## Overview

This upgrade includes CMS and Framework version 3.6.3 which includes bugfixes, some minor feature and API
enhancements and some security fixes (listed below). Also included are some minor enhancements to the Fulltext Search, Blog and Secure Assets modules.

 * [Framework 3.6.3](https://github.com/silverstripe/silverstripe-framework/blob/3.6.3/docs/en/04_Changelogs/3.6.2.md)

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
    "cwp/starter-theme": "~1.1.0@stable"
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

 * 2017-11-30 [6ba00e829](https://github.com/silverstripe/silverstripe-framework/commit/6ba00e829a9fb360dfe5cb0bc3d4544016c82357) Prevent disclosure of sensitive information via LoginAttempt (Damian Mooyman) - See [ss-2017-009](http://www.silverstripe.org/download/security-releases/ss-2017-009)
 * 2017-11-30 [db54112f3](https://github.com/silverstripe/silverstripe-framework/commit/db54112f3cca012e33257c782dffd7154bf663a5) user agent invalidation on session startup (Damian Mooyman) - See [ss-2017-006](http://www.silverstripe.org/download/security-releases/ss-2017-006)
 * 2017-11-29 [22ccf3e2f](https://github.com/silverstripe/silverstripe-framework/commit/22ccf3e2f9092f51e7f7288ce108598c6f17b49c) Ensure xls formulae are safely sanitised on output (Damian Mooyman) - See [ss-2017-007](http://www.silverstripe.org/download/security-releases/ss-2017-007)
 * 2017-11-21 [0f2049d4d](https://github.com/silverstripe/silverstripe-framework/commit/0f2049d4d466e05f5d7f07fc63580836de8c6bff) SQL injection in search engine (Daniel Hensby) - See [ss-2017-008](http://www.silverstripe.org/download/security-releases/ss-2017-008)
 * 2017-09-04 [f0262a8fd](https://github.com/silverstripe/silverstripe-framework/commit/f0262a8fd9ab5fb51b178ace3c3487351217f5a0) User enumeration via timing attack mitigated (Daniel Hensby) - See [ss-2017-005](http://www.silverstripe.org/download/security-releases/ss-2017-005)

### Features and Enhancements

 * 2017-11-16 [96231bc](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-blog/commit/96231bca74ecf708751e8bbab89292c1fc6decfb) Update blog to 2.5 (Robbie Averill)
 * 2017-11-16 [c038c4e](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/commit/c038c4ea9f6f49a4443d9f883d807635fc61a5e3) Update fulltextsearch and secureassets (Robbie Averill)
 * 2017-09-08 [17b7f5c](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/17b7f5c2f597bbc7c0938b8b1b6fc6a47e827d2e) Add extension to update page request, add Subsites compatibility extension (Robbie Averill)
 * 2017-08-24 [fdd501182](https://github.com/silverstripe/silverstripe-framework/commit/fdd501182e8403ef082c2954bb66e0b8b6dd7b71) Ability to override SS_TemplateManifest via Injector (fixes #7305) (Patrick Nelson)
 * 2017-07-03 [d5340a8](https://github.com/silverstripe/silverstripe-blog/commit/d5340a87dce5939cd99dd8e25c55cc1bc7af679e) config to disable sending spam notifications (Cam Findlay)

### Bugfixes

 * 2017-12-05 [8477de15](https://github.com/silverstripe/silverstripe-siteconfig/commit/8477de15203c4c80ca55365200fa3c7c031d70d8) Remove unused Behat tests from 3.6 branch (Robbie Averill)
 * 2017-11-30 [84d7afb34](https://github.com/silverstripe/silverstripe-framework/commit/84d7afb3477885e9d69f2ac10838179efc1d3b91) Use baseDataClass for allVersions as with other methods (Daniel Hensby)
 * 2017-11-24 [09a003bc1](https://github.com/silverstripe/silverstripe-framework/commit/09a003bc13390359fa717a4256f9278303d59544) deprecated usage of getMock in unit tests (Daniel Hensby)
 * 2017-11-23 [2ad3cc07d](https://github.com/silverstripe/silverstripe-framework/commit/2ad3cc07d583041e23a5dca0d53ffbdf8c9cd0d0) Update meber passwordencryption to default on password change (Daniel Hensby)
 * 2017-11-22 [ef6d86f2c](https://github.com/silverstripe/silverstripe-framework/commit/ef6d86f2c695d319f9c07ccd9f4d93e83263e356) Allow lowercase and uppercase delcaration of legacy Int class (Daniel Hensby)
 * 2017-11-17 [be255c2](https://github.com/silverstripe/silverstripe-restfulserver/commit/be255c2af16da0cf51be06a1c098365c42da5534) Total items count in output respects canView on records (Robbie Averill)
 * 2017-11-17 [b3fc680](https://github.com/silverstripe/silverstripe-restfulserver/commit/b3fc6803fd36c1b71483476bbe6fc24c5591011a) Return string directly when no body content is provided to put/post methods (Robbie Averill)
 * 2017-11-16 [dda14e895](https://github.com/silverstripe/silverstripe-framework/commit/dda14e89596a0de0b70eace27f7015bc0bb40669) HTTP::get_mime_type with uppercase filenames. (Roman Schmid)
 * 2017-11-16 [52f0eadd3](https://github.com/silverstripe/silverstripe-framework/commit/52f0eadd3b1ad37806a95b6dd05427add3166cc5) for #7606: Ensure the object we're handling is actually an Image instance before calling methods specific to that class (e.g. in case of using SVG's in &lt;img&gt; tag which may be File instances). (Patrick Nelson)
 * 2017-11-15 [ce3fd370f](https://github.com/silverstripe/silverstripe-framework/commit/ce3fd370fb07ffc18742323b0dd99f30cf28cf14) ManyMany link table joined with LEFT JOIN (Daniel Hensby)
 * 2017-11-09 [1053de7ec](https://github.com/silverstripe/silverstripe-framework/commit/1053de7ec39d1a2ce6826ea2db8f55114755098d) Don't redirect in force_redirect() in CLI (Damian Mooyman)
 * 2017-11-02 [c2f5850](https://github.com/silverstripe/silverstripe-blog/commit/c2f58507a048a140c99d1b94204cd760175a99bb) Ensure that draft blog posts are always viewable to users with view draft permission (Robbie Averill)
 * 2017-11-02 [cb92696](https://github.com/silverstripe/silverstripe-restfulserver/commit/cb926963923298e81abf961971e8219ad250ffc5) Ensure a Member object is passed to canView etc methods if available (Robbie Averill)
 * 2017-11-02 [087c8ca](https://github.com/symbiote/silverstripe-queuedjobs/commit/087c8ca1ac10b2b0b38810417e6880d1e671f26d) ImmediateQueueHandler needs `scheduleJob` method to match expected API (Daniel Hensby)
 * 2017-10-25 [cbac37559](https://github.com/silverstripe/silverstripe-framework/commit/cbac3755909bc5d72d923b07747fd6a98e2215dc) Helpful warning when phpunit bootstrap appears misconfigured (Daniel Hensby)
 * 2017-10-25 [32cef975e](https://github.com/silverstripe/silverstripe-framework/commit/32cef975ef6c816d8b5bc953cffbd18492686281) Use self::inst() for Injector/Config nest methods (Daniel Hensby)
 * 2017-10-19 [a73d5b41](https://github.com/silverstripe/silverstripe-cms/commit/a73d5b4177be445128a6fa42e20dd8df13eaf554) revert to this button after archiving (Christopher Joe)
 * 2017-10-12 [fd39faee](https://github.com/silverstripe/silverstripe-cms/commit/fd39faeefd5241cf96313e968142183de767c51b) UploadField overwriteWarning isn't working in AssetAdmin (Jason)
 * 2017-10-09 [264cec123](https://github.com/silverstripe/silverstripe-framework/commit/264cec1239ee8d75e67c5402970a91cf58e50539) Dont use var_export for cache key generation as it fails on circular references (Daniel Hensby)
 * 2017-10-06 [11a5dc7](https://github.com/silverstripe/silverstripe-contentreview/commit/11a5dc7617d61820c43de6f870bc71a485999e6f) Ensure SiteConfig defaults are used as fallback options (Robbie Averill)
 * 2017-10-05 [4c4a3d4](https://github.com/silverstripe/silverstripe-userforms/commit/4c4a3d492843699b58554f4caa21904eeea3f8b2) for broken validation on optionsets (MikeyC)
 * 2017-10-04 [24e190ea](https://github.com/silverstripe/silverstripe-cms/commit/24e190ea8265d16445a3210f7b06de191e474004) TreeDropdownField showing broken page icons (fixes silverstripe/silverstripe-framework#7420) (Loz Calver)
 * 2017-09-28 [378c7fa](https://github.com/symbiote/silverstripe-multivaluefield/commit/378c7fa70461cbb36cb5bba664695dbb28f4286d) Return self for setValue (Daniel Hensby)
 * 2017-09-28 [d47648a](https://github.com/silverstripe/silverstripe-blog/commit/d47648a86d92dffbde8e3e286e67e573df37f604) Archive widget shows months from posts published that day (Robbie Averill)
 * 2017-09-26 [ebe1de8d8](https://github.com/silverstripe/silverstripe-framework/commit/ebe1de8d8b5bc739e74b1001aec3110b6175a303) ArrayList sort error with old (supported) PHP (Dylan Wagstaff)
 * 2017-09-26 [4b8ab26](https://github.com/silverstripe/silverstripe-lumberjack/commit/4b8ab2675a25299d6e26ace4c7d81be4bcbcd93c) excludeSiteTreeClassNames (#64) (Ralph Slooten)
 * 2017-09-22 [7edc058](https://github.com/silverstripe/silverstripe-userforms/commit/7edc05812158e0e8a74018cd1818cb7e982ef023) Escape dollar signs in UserForm contents before inserting them with regex (Robbie Averill)
 * 2017-09-12 [0aac4ddb](https://github.com/silverstripe/silverstripe-cms/commit/0aac4ddb7ecf0f17eda8add235017c10c9f57255) Default LoginForm generated from default_authenticator (Daniel Hensby)
 * 2017-09-12 [091d99f59](https://github.com/silverstripe/silverstripe-framework/commit/091d99f599dcacf6aef2ad1df48311c2399f150c) Authenticators are more resilient to incomplete configuration (Daniel Hensby)
 * 2017-09-05 [e0cca79](https://github.com/silverstripe/silverstripe-registry/commit/e0cca79b4f06b1500cea2611482908845e7362ea) ed psr2 issue and removed empty id check condition. (Roopam Jain)
 * 2017-08-28 [7b200a2a6](https://github.com/silverstripe/silverstripe-framework/commit/7b200a2a642a78bffcf0a2f417a4757fb216ecfb) add combinedFiles to clear logic (Christopher Joe)
 * 2017-08-25 [57fbfc6](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/commit/57fbfc649c2642662a07eed293b2fad65b58cb09) no comma after lisence (Franco Springveldt)
 * 2017-08-18 [e196de2](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/e196de2ac2942a8b73e593134fc3d6166ad3a4b7) Set SearchUpdateCommitJobProcessor::$dirty_indexes prop type to array, not bool (cpenny)
 * 2017-08-16 [eb80a5f9e](https://github.com/silverstripe/silverstripe-framework/commit/eb80a5f9e89e69480edc7f1c9c66cc7403f547f1) LastEdited no longer updated on skipped writes (Daniel Hensby)
 * 2017-08-14 [b04a1ab41](https://github.com/silverstripe/silverstripe-framework/commit/b04a1ab41c4051923e9d9a9af5dedfa5a3ef67d8) Truncate Error Issue when using views in a Unittest. (James Pluck)
 * 2017-08-13 [2f579b64c](https://github.com/silverstripe/silverstripe-framework/commit/2f579b64cb9cb8986489e312b253dba5061e304b) Files without extensions (folders) do not have a trailing period added (Robbie Averill)
 * 2017-08-10 [ab81117](https://github.com/silverstripe/silverstripe-subsites/commit/ab81117c5e0cc65a8ad6f312b950f4fc023abcc1) page rendering with proper subsite locale (Gregory Smirnov)
 * 2017-08-06 [59b28f7d5](https://github.com/silverstripe/silverstripe-framework/commit/59b28f7d5bcefd477766611a99643f121af3dc56) Fixes #7181 to config system for userland config of node display limits. (Russell Michell)
 * 2017-07-26 [31c5eebda](https://github.com/silverstripe/silverstripe-framework/commit/31c5eebda089867d61546106b36ca20b21a00026) Avoid JS errors for HTMLEditorFields in small holders (Daniel Hensby)
 * 2017-07-26 [82c0632f4](https://github.com/silverstripe/silverstripe-framework/commit/82c0632f46e00a251d287811652429036d200eff) Use Config API for MemberAuthenticator::$migrate_legacy_hashes (fixes #7208) (Loz Calver)
 * 2017-07-19 [292aaf653](https://github.com/silverstripe/silverstripe-framework/commit/292aaf65301b2be4bb5e6e1505ccbe98b8ade67f) Cache IDs grouped by site first (Daniel Hensby)
 * 2017-07-18 [b77274c1a](https://github.com/silverstripe/silverstripe-framework/commit/b77274c1a3c3ab8cfa0abf939aa2e4735e534171) Add unique prefix to cache stores to prevent cache leak (Daniel Hensby)
 * 2017-07-17 [515a7cb5](https://github.com/silverstripe/silverstripe-cms/commit/515a7cb569f0cf90787b44fca8845760b539fabe) Make sure VirtualPage renders correct templates (Daniel Hensby)
 * 2017-07-10 [960a0f834](https://github.com/silverstripe/silverstripe-framework/commit/960a0f8343e5ff8379906c2476af4b74da0fd9c9) Make File::ini2bytes() compliant with binary prefixes (fixes #7145) (Loz Calver)
 * 2017-07-06 [a6db16b22](https://github.com/silverstripe/silverstripe-framework/commit/a6db16b2298738e1ef1329329cbef7c6b33f993e) OS X issue with `Convert::html2raw`, `HTMLText::FirstSentence`, `HTMLText::Summary` and `Text::FirstSentence`. (Roman Schmid)
 * 2017-07-04 [00f1ad5d6](https://github.com/silverstripe/silverstripe-framework/commit/00f1ad5d692f0a44b58bb216e5378e51dc96243d) Fixes #7116 Improves server requirements docs viz: OpCaches. (Russell Michell)
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
 * 2016-03-20 [805c38f10](https://github.com/silverstripe/silverstripe-framework/commit/805c38f107e7e332d2846407e0a89cade1d33ed1) don't try and switch out of context of the tab system (Stevie Mayhew)
