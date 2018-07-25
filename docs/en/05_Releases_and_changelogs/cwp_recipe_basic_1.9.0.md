# 1.9.0

## Overview

This upgrade includes CMS and Framework version 3.7.0

 * [SilverStripe 3.7.0](https://docs.silverstripe.org/en/3/changelogs/3.7.0)

Upgrade to Recipe 1.9.0 is optional, but is recommended for all CWP sites currently on CWP 1.0.0 or above.

## Upgrading Instructions

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if would like
SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

```json
"require": {
    "cwp/cwp-recipe-basic": "~1.9.0@stable",
    "cwp/cwp-recipe-blog": "~1.9.0@stable",
    "cwp/starter-theme": "~1.1.1@stable"
},
"prefer-stable": true
```

More information on upgrading major versions of CWP can be found in the [online documentation](https://www.cwp.govt.nz/developer-docs/en/2/working_with_projects/upgrading/)

## Notable changes

 * New "installed modules" report in the CMS
 * Caching improvements. See the [CWP Performance Guide](https://www.cwp.govt.nz/developer-docs/en/1/performance_guide/)

## Accepted Failing Tests

#### silverstripe/framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
   to fail as the new MimeValidator module will no longer allow random content to
   be uploaded with a mismatched mime and file extension. The original test is
   attempting to upload a bunch of text as a gzip file.
 * CMSFormTest.testValidationExemptActions — Expected output modified by the starter theme

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

 * 2018-07-16 [4e1bb1b]() Convert serialisation to JSON where possible. PHP serialise is still used as a deprecated fallback (Guy Marriott) - See [ss-2018-017](https://www.silverstripe.org/download/security-releases/ss-2018-017)
 * 2018-07-16 [ef4801a]() Potential XSS vulnerability in checkbox field, update overloading from core (Robbie Averill) - See [ss-2018-017](https://www.silverstripe.org/download/security-releases/ss-2018-017)
 * 2018-04-24 [e4c0f271b](https://github.com/silverstripe/silverstripe-framework/commit/e4c0f271b00765b46ce85e614d0c48aad4e72630) Ensure passwords do not get added to session on submission failure (Aaron Carlino) - See [ss-2018-013](https://www.silverstripe.org/download/security-releases/ss-2018-013)

### API Changes

 * 2017-12-11 [0ec4b17](https://github.com/silverstripe/silverstripe-spellcheck/commit/0ec4b1772262c18b6d54f95683883a96a94221f8) Delete .tx folder (Raissa North)
 * 2017-06-10 [413b4936a](https://github.com/silverstripe/silverstripe-framework/commit/413b4936a1cfe6447832c08c26a4fceb9a3a36a6) Add extension hook to FormField::extraClass() (Damian Mooyman)
 * 2016-11-28 [f16d7e183](https://github.com/silverstripe/silverstripe-framework/commit/f16d7e1838d834575738086326d1191db3a5cfd8) Deprecate unused / undesirable create_new_password implementation (Damian Mooyman)

### Features and Enhancements

 * 2018-06-17 [6ab06cd](https://github.com/silverstripe/silverstripe-spellcheck/commit/6ab06cd5fb62408192bf5e5d5bb9066cf5bbacf1) Lazy-load spellcheck config instead of every request (Damian Mooyman)
 * 2018-06-11 [e12aec8](https://github.com/silverstripe/cwp-recipe-basic/commit/e12aec89d64f5662ede222908bc8fa8e3793e036) Adding maintenance and additional composer modules (Guy)
 * 2018-06-07 [2b4954035](https://github.com/silverstripe/silverstripe-framework/commit/2b4954035f950beef9be8ba8e36a2b620d6aa332) Add better HTTP cache-control manipulation (#8086) (Daniel Hensby)
 * 2018-06-06 [c639ffa9c](https://github.com/silverstripe/silverstripe-framework/commit/c639ffa9ce181cdb979a5c954e912ebfc4162f42) isPopulated method to allow StringField subclasses to check existence without RAW (Aaron Carlino)
 * 2018-05-29 [987798f](https://github.com/silverstripe/cwp/commit/987798f11785471adf34663240b441917d8fb808) Adding extension for relabelling filter options on report (Guy)
 * 2018-05-23 [7c86995](https://github.com/silverstripe/cwp/commit/7c8699598d67485a57abb3fe69774e5c61ba8b7e) Adding an extension for the silverstripe-maintenance "Site Summary" report to display a more appropriate version label (Guy)
 * 2018-05-07 [dfdaac48](https://github.com/silverstripe/silverstripe-cms/commit/dfdaac48ca38e179efcfb2cfd905baa577b379fd) Backport versioned querystring fix (#2153) (Damian Mooyman)
 * 2018-05-07 [47a9cdfd4](https://github.com/silverstripe/silverstripe-framework/commit/47a9cdfd49146e769760e8d8db3f01925597de41) Backport of querystring work to 3.x (#8026) (Damian Mooyman)
 * 2017-11-30 [910381633](https://github.com/silverstripe/silverstripe-framework/commit/9103816333e790a9b7cd84994e00e0941e34de39) Add php 7.2 support (Daniel Hensby)
 * 2017-11-06 [2e43780a8](https://github.com/silverstripe/silverstripe-framework/commit/2e43780a8ae664ead109bd99c094f3873defbfea) Add sort columns to DB index automatically (Daniel Hensby)
 * 2017-09-28 [2f0a0cb63](https://github.com/silverstripe/silverstripe-framework/commit/2f0a0cb63f12c9428cce9403fdd11dd155f73116) Add (alt text) to title field for clarity (Robbie Averill)
 * 2017-09-28 [67ebd5e](https://github.com/symbiote/silverstripe-advancedworkflow/commit/67ebd5efe05ffc389d2a761d8347576bb79541a1) (WorkflowService) Allow explicit passing of workflow definition to startWorkflow (Marcus Nyeholt)
 * 2017-08-28 [0b34066f0](https://github.com/silverstripe/silverstripe-framework/commit/0b34066f0cec8de2c1afdd717613ffab201d02a8) incorrect scalar types in doc blocks, add chainable returns in setters (Robbie Averill)
 * 2017-08-03 [8577ad128](https://github.com/silverstripe/silverstripe-framework/commit/8577ad128059f4c508f03df4e5566c09fe161be5) Added SSL support for MySQLi Connector (fixes #7242) (John)
 * 2017-08-02 [2f9bfae1f](https://github.com/silverstripe/silverstripe-framework/commit/2f9bfae1f9f6bb2d33e3f979601e0abae243a7f6) Added MySQL SSL PDO Support (John)
 * 2017-07-04 [b347ab86](https://github.com/silverstripe/silverstripe-cms/commit/b347ab866d50a589a598fa4f27fef787a24d9879) Add version provider configuration (Robbie Averill)
 * 2017-07-04 [ee4d8b4d4](https://github.com/silverstripe/silverstripe-framework/commit/ee4d8b4d4e22a25b86c90785c45cc480f8423861) Add new SilverStripeVersionProvider to provider module versions (Robbie Averill)
 * 2017-06-15 [a990c99d6](https://github.com/silverstripe/silverstripe-framework/commit/a990c99d6e6f477ab6e973ada13f9dff234682f5) suffix subfolder in silverstripe-cache with php-version (#6810) (Lukas)

### Bugfixes

 * 2018-07-25 [51b2883](https://github.com/silverstripe/cwp-installer/commit/51b28835aea2dfbc563bd9a2dc7fb68bec9b08ef) ing lock (Guy Marriott)
 * 2018-07-17 [e38c30ff0](https://github.com/silverstripe/silverstripe-framework/commit/e38c30ff0d9e4ae8ae31a59836fb8e9891f559a5) sizeof doesnt work with null types (Daniel Hensby)
 * 2018-06-26 [837920a](https://github.com/silverstripe/cwp/commit/837920a6bd00d190444c70fb69f6566d1d02f975) Maintenance module extension now provides CWP proxy information for HTTP requests (Robbie Averill)
 * 2018-06-19 [d392ca7](https://github.com/silverstripe/silverstripe-blog/commit/d392ca72f19e607f69973f635b559229c61d337a) Make sure `setAllowMultibyte` is on when looking up by URLSegment (Daniel Hensby)
 * 2018-06-19 [58bd6c224](https://github.com/silverstripe/silverstripe-framework/commit/58bd6c2248282b9ef6fb940cc6792a7b8c436fbf) Switch to Trusty in Travis (Robbie Averill)
 * 2018-06-19 [7656ced](https://github.com/silverstripe/silverstripe-spellcheck/commit/7656ced351f85d43d2a0a48e370c01543d472a1f) Updating spellchecker to use new HTTPCacheControl API (Guy)
 * 2018-06-12 [6a6bc6d](https://github.com/silverstripe/silverstripe-translatable/commit/6a6bc6d677e079064bed77a084c54adb240e2c98) Fix invalid stage being specified for queried records (Guy)
 * 2018-06-12 [73cccf9](https://github.com/silverstripe/cwp-installer/commit/73cccf9eb62f8481452ab85e2b684936e3a5ead2) Removing syntax error in config file (Guy)
 * 2018-06-11 [07112dbb](https://github.com/silverstripe/silverstripe-cms/commit/07112dbb0bbc4bd624e44586ef3faccdcff1acd1) Remove blind reliance on current versioning stage being valid (Guy)
 * 2018-06-11 [bea626e](https://github.com/silverstripe/silverstripe-translatable/commit/bea626eba3b641872e63fcba548dcc407599c218) Fix invalid stage being specified for queried records (Damian Mooyman)
 * 2018-06-11 [02cd32acb](https://github.com/silverstripe/silverstripe-framework/commit/02cd32acb3db7b8e3ec5b3617ce6fb5c84fca9d8) Error if invalid stage specified for get_by_stage (Damian Mooyman)
 * 2018-06-09 [42e799bc4](https://github.com/silverstripe/silverstripe-framework/commit/42e799bc43eb83660bc4d35c9c6c5bf7f23989a8) Versioned::choose_site_stage() if no request given (Florian Thoma)
 * 2018-06-07 [833db05](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/833db051616ab34c1ab5808be6539cd3e8c2d2fc) Fix for 3.7 compat (Damian Mooyman)
 * 2018-06-07 [4a0e5b636](https://github.com/silverstripe/silverstripe-framework/commit/4a0e5b63678cab6e62f175f61040bfda7ac0ab48) Fix crash on fixed_fields in default_sort (Damian Mooyman)
 * 2018-06-04 [85a712e1c](https://github.com/silverstripe/silverstripe-framework/commit/85a712e1c9288a398de03e374a8a3bb980486d82) postgres test (Damian Mooyman)
 * 2018-06-04 [41e601a03](https://github.com/silverstripe/silverstripe-framework/commit/41e601a036307065d9ea2ba8862f67be738d402f) Regression from #8009 (Daniel Hensby)
 * 2018-06-04 [a20b0a4aa](https://github.com/silverstripe/silverstripe-framework/commit/a20b0a4aa6ea7390f20513c3205debda652f5ca0) Remove use of deprecated each method (Daniel Hensby)
 * 2018-06-01 [5b47edc](https://github.com/silverstripe/cwp/commit/5b47edc5416cf8a4c8b1b9e2b6bea4bd50f0fb17) broken links (#94) (Raissa North)
 * 2018-06-01 [ce1db58](https://github.com/silverstripe/cwp/commit/ce1db58045b6b1cfcfda8cc2ef7d88d1a3e0f17d) broken link (#92) (Raissa North)
 * 2018-06-01 [1012ccb](https://github.com/silverstripe/cwp/commit/1012ccbb4c231caae30faa398c4aca935c5a3048) broken link (Raissa North)
 * 2018-06-01 [05a519ecc](https://github.com/silverstripe/silverstripe-framework/commit/05a519ecc5c8f68e049b68714c2ea60d9abd0e54) code style / php 5.3 compat (Damian Mooyman)
 * 2018-06-01 [af89140](https://github.com/silverstripe/cwp/commit/af8914063d3a3a8298ef6c3936f72ddd51d7174d) broken link in developer docs (#91) (Raissa North)
 * 2018-06-01 [c5205ecc](https://github.com/silverstripe/silverstripe-cms/commit/c5205ecc1fe291ca453c94b28e31af296219b921) Ensure errorpage is built in live mode (Damian Mooyman)
 * 2018-06-01 [2756d60da](https://github.com/silverstripe/silverstripe-framework/commit/2756d60da28e371ea16bec7d478594c1579fc77b) Prevent stage querystring args during dev/build (Damian Mooyman)
 * 2018-06-01 [60a98be](https://github.com/silverstripe/cwp/commit/60a98be6391ec70f7fc6c4847ed2c9f60a44686c) broken links in developer docs (Raissa North)
 * 2018-05-29 [1cbf27e0f](https://github.com/silverstripe/silverstripe-framework/commit/1cbf27e0f47c3547914b03193d0f5f77c87ff8d5) PHP 5.3 compat for referencing $this in closure, and make method public for same reason (Robbie Averill)
 * 2018-05-23 [b6dbae8b](https://github.com/silverstripe/silverstripe-cms/commit/b6dbae8b07911f3e3a55babbb6c671ededa2d3b4) Make RedirectorPage::Link compatible with SiteTree::Link (Daniel Hensby)
 * 2018-05-09 [8f363d6](https://github.com/silverstripe/silverstripe-userforms/commit/8f363d6b608b08a70c423a56473d673cbda923ff) Remove unnecessary translation of parameterised field value (Raissa North)
 * 2018-04-20 [b4943fb](https://github.com/silverstripe/silverstripe-subsites/commit/b4943fb77c4ee612bb8bc16772866f0f06e2501b) Automatically create default SiteTree records for new subsites (Robbie Averill)
 * 2018-04-17 [af3a9f3ec](https://github.com/silverstripe/silverstripe-framework/commit/af3a9f3ec8a5465f841c5aa8ee1faf40c1b76bf4) Duplicating many_many relationships looses the extra fields (fixes #7973) (UndefinedOffset)
 * 2018-03-23 [f7ffb70](https://github.com/silverstripe/silverstripe-userforms/commit/f7ffb706ce784fbdcf388ce888b0df9ff934b5b9) Use userforms template for member list field, fixes display rule issue (Robbie Averill)
 * 2018-03-20 [ebd3fb652](https://github.com/silverstripe/silverstripe-framework/commit/ebd3fb6526eb3ee9359111e548d9f6b6e0323e97) Don't auto-generate indexes for Text field types (fixes #7900) (Loz Calver)
 * 2018-03-15 [61ce4771f](https://github.com/silverstripe/silverstripe-framework/commit/61ce4771f91367cbb4b8a1bf61e2af51964714df) ing HTMLEditorField API documentation (3Dgoo)
 * 2018-03-15 [d17d93f7](https://github.com/silverstripe/silverstripe-cms/commit/d17d93f784a6e01f3d396c55adc623d69a90261a) Remove SearchForm results() function from allowed_actions (Steve Dixon)
 * 2018-03-14 [97f22cbaa](https://github.com/silverstripe/silverstripe-framework/commit/97f22cbaa5d683cca2f65370a9b827314317436d) ing FormAction API documentation (3Dgoo)
 * 2018-03-01 [6523d7a6e](https://github.com/silverstripe/silverstripe-framework/commit/6523d7a6eb3905d5e3cf24120d33232e1eb5d789) ing HTMLEditorField API documentation (3Dgoo)
 * 2018-02-27 [c755f7728](https://github.com/silverstripe/silverstripe-framework/commit/c755f77288bcbd5e6777f94d8499264446b456f0) indentation (Aaron Carlino)
 * 2018-02-21 [0ce8b95](https://github.com/silverstripe/silverstripe-userforms/commit/0ce8b95546f234bc2e1d2727d0816ccb9017e305) Escape dollar signs in UserForm contents before inserting them with regex (#723) (Scott Hutchinson)
 * 2018-02-16 [86addea1d](https://github.com/silverstripe/silverstripe-framework/commit/86addea1d2a7b2e28ae8115279ae358bcb46648a) Split HTML manipulation to onadd, so elements are not accidentally duplicated (Christopher Joe)
 * 2018-02-13 [c767e472d](https://github.com/silverstripe/silverstripe-framework/commit/c767e472dc494408460ef47c27b8d34475da4ac6) DataObject singleton creation (Jonathon Menz)
 * 2017-12-21 [b58f6d0](https://github.com/symbiote/silverstripe-queuedjobs/commit/b58f6d0af2ec4374422a6563b2cde749ab46f630) (travis) remove php 5.3 from Travis config as it's no longer supported (Stephen McMahon)
 * 2017-12-21 [f6750a9](https://github.com/symbiote/silverstripe-queuedjobs/commit/f6750a9849eaa3fa51d08460282e4a114a10cd50) (Service) ensure run as user is cleared at the end of each runJob (Stephen McMahon)
 * 2017-12-01 [74a3ba54a](https://github.com/silverstripe/silverstripe-framework/commit/74a3ba54ae3f02158ba81622bd9933ae3e98c665) count size of $relations (Daniel Hensby)
 * 2017-11-29 [2717f0134](https://github.com/silverstripe/silverstripe-framework/commit/2717f013447069fd1879b24140dd84145ece9cef) link to nginx.org wiki (JorisDebonnet)
 * 2017-08-08 [1a4a006d0](https://github.com/silverstripe/silverstripe-framework/commit/1a4a006d09e4397c3126fcf32c61692f90834b8a) PDOConnector ssl_cipher bug fixes #7258 (John)
 * 2017-04-12 [8999f70ac](https://github.com/silverstripe/silverstripe-framework/commit/8999f70acc0fa9853c94786da8c3b5c713f8a359) ing broken search in SecurityAdmin Groups field (Sean Harvey)
 * 2017-02-03 [3679cb7](https://github.com/silverstripe/silverstripe-contentreview/commit/3679cb7f7d35716f5309fd46fd26541009e7ee91) Ensure QueuedJob health check doesn't kill long running review jobs (Jake Bentvelzen)
 * 2017-01-31 [e302c4e](https://github.com/silverstripe/silverstripe-translatable/commit/e302c4ec46f107d309eab443087786709d300bd3) Fixed ambiguous column crash caused when publishing a versioned object if the query is joined against another table (UndefinedOffset)
