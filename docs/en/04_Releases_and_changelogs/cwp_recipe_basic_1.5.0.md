# CWP Recipe 1.5.0

## Overview

This upgrade includes CMS and Framework version 3.5.0 which includes bugfixes and 
some minor feature and API enhancements.

 * [framework 3.5.0](https://github.com/silverstripe/silverstripe-framework/blob/3.5/docs/en/04_Changelogs/3.5.0.md)

Upgrade to Recipe 1.5.0 is optional, but is recommended for all CWP sites. This recipe
includes an enhanced auditor module for improved security logging.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Details of security issues

This release includes fixes for the following minor security issues:

 * [SS-2016-010](http://www.silverstripe.org/download/security-releases/ss-2016-010)
   **ReadOnly transformation for formfields exploitable**: Read-only Form fields 
   are vulnerable to reflected XSS injections. Values submitted to through
   these form fields are not filtered out from the form session data,
   and might be shown to the user depending on the form behaviour.
   SilverStripe forms automatically load values from request data, which may contain 
   malicious HTML injected within the request, such as links to external sites.
   Readonly and disabled form fields are already filtered out in Form->saveInto(),
   so maliciously submitted data on these fields doesn't make it into the database
   unless you are accessing form values directly in your saving logic.
 * [SS-2016-016](http://www.silverstripe.org/download/security-releases/ss-2016-016)
   **XSS In CMSSecurity BackURL**: In follow up to 
   [SS-2016-001](https://www.silverstripe.org/download/security-releases/ss-2016-001)
   there is yet a minor unresolved fix to incorrectly encoded URL.

## New Features

This release also includes a new module
[silverstripe/auditor](https://github.com/silverstripe/silverstripe-auditor)
which will install and configure itself by default on upgrade. This module
is mandatory and cannot be removed from the core installation. This will
provide better and more complete system logging on all CWP sites.

Please see the [Centralised logging](/working_with_projects/centralised_logging/)
documentation for more information. Please note that if your application
uses `SS_SysLogWriter` there are some additional upgrading steps.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.5.0@stable",
		"cwp/cwp-recipe-blog": "~1.5.0@stable",
		"cwp-themes/default": "~1.3.0@stable"
	},
	"prefer-stable": true

## Details

### Bugfixes

 - [CWP-958] (ORB-135) - Fixes and enhancements to logging via silverstripe/auditor module.
 
<!--- Reticulated splines a bit more to get the vacuum tubes to warm up faster -->

### Known issues

In recipe 1.5.0 there are the following known issues in these failing tests:

#### framework

 * FolderTest.testRenameFolderAndCheckTheFile - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetNameChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetParentIDChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43

### Accepted failing tests

In recipe 1.4.1 these module unit tests cause external errors, but do not represent legitimate issues.

#### framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
   to fail as the new MimeValidator module will no longer allow random content to
   be uploaded with a mismatched mime and file extension. The original test is
   attempting to upload a bunch of text as a gzip file.

#### queuedjobs

 * QueuedJobsTest.testImmediateQueuedJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).
 * QueuedJobsTest.testStartJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).

#### translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223
 * TranslatableSiteConfigTest.testCanEditTranslatedRootPages - Test failure affected by global state.
   See https://github.com/silverstripe/silverstripe-translatable/issues/224
<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2016-11-11 [4440b88](https://github.com/silverstripe/silverstripe-framework/commit/4440b887304fe80ca77366800457cbc2ac705654) Form@httpSubmission will no longer load submitted data to disabled or readonly fields (Daniel Hensby) - See [ss-2016-010](http://www.silverstripe.org/download/security-releases/ss-2016-010)
 * 2016-11-11 [61e4055](https://github.com/silverstripe/silverstripe-framework/commit/61e4055bdb13e37df6aa0d8edca0bf5d9345dc7e) Cast FormField values as Text to prevent readonly fields embeding rogue HTML (Daniel Hensby) - See [ss-2016-010](http://www.silverstripe.org/download/security-releases/ss-2016-010)
 * 2016-10-27 [17097a4](https://github.com/silverstripe/silverstripe-framework/commit/17097a4d11274b157eadf64f32708acef204d510) Properly escape backURL for template injection (Daniel Hensby) - See [ss-2016-016](http://www.silverstripe.org/download/security-releases/ss-2016-016)
 * 2016-08-02 [049cdef](https://github.com/silverstripe/silverstripe-framework/commit/049cdefacfd3122d59d5488c1317f999fe8aacc4) value / title escaping in CheckboxSetField and OptionsetField (Damian Mooyman) - See [ss-2016-015](http://www.silverstripe.org/download/security-releases/ss-2016-015)
 * 2016-08-02 [62a2421](https://github.com/silverstripe/silverstripe-framework/commit/62a242154ec3508fe9b174a40713c8520ac1684c) value / title escaping in CheckboxSetField and OptionsetField (Damian Mooyman) - See [ss-2016-015](http://www.silverstripe.org/download/security-releases/ss-2016-015)
 * 2016-08-02 [12a6b35](https://github.com/silverstripe/silverstripe-framework/commit/12a6b357e761f09d818fd0013eb2d85014de79a0) value / title escaping in CheckboxSetField and OptionsetField (Damian Mooyman) - See [ss-2016-015](http://www.silverstripe.org/download/security-releases/ss-2016-015)
 * 2016-07-25 [b1f4497](https://github.com/silverstripe/silverstripe-framework/commit/b1f449762b5d11658b11d5036d5ae361a95fd61e) Autologin cookies are ignored if autologin is disabled (Daniel Hensby) - See [ss-2016-014](http://www.silverstripe.org/download/security-releases/ss-2016-014)
 * 2016-07-25 [fa7f5af](https://github.com/silverstripe/silverstripe-framework/commit/fa7f5af8618a83c865b11fd6cc981ad9661046e6) Autologin cookies are ignored if autologin is disabled (Daniel Hensby) - See [ss-2016-014](http://www.silverstripe.org/download/security-releases/ss-2016-014)
 * 2016-07-25 [1c7d5de](https://github.com/silverstripe/silverstripe-framework/commit/1c7d5de51bcdf16ebb21c5a0ebe5fe9e31f9a822) Autologin cookies are ignored if autologin is disabled (Daniel Hensby) - See [ss-2016-014](http://www.silverstripe.org/download/security-releases/ss-2016-014)
 * 2016-07-22 [6817c57](https://github.com/silverstripe/silverstripe-framework/commit/6817c57f64b9eb2b271b81662cd83b074a3daee4) Uncasted member name (Daniel Hensby) - See [ss-2016-013](http://www.silverstripe.org/download/security-releases/ss-2016-013)
 * 2016-07-22 [83e3302](https://github.com/silverstripe/silverstripe-framework/commit/83e3302c0425d9b0e4fe42e82e3df03379f4dca5) Uncasted member name (Daniel Hensby) - See [ss-2016-013](http://www.silverstripe.org/download/security-releases/ss-2016-013)
 * 2016-07-22 [281b0de](https://github.com/silverstripe/silverstripe-framework/commit/281b0de571fe0ae159ac47891c02acf2214fa619) Uncasted member name (Daniel Hensby) - See [ss-2016-013](http://www.silverstripe.org/download/security-releases/ss-2016-013)
 * 2016-07-15 [f85dea2](https://github.com/silverstripe/silverstripe-framework/commit/f85dea2e6d5b303abd43b5e5efc07c66c8d2acf4) Reset `Member::Salt` on password change (Daniel Hensby) - See [ss-2016-008](http://www.silverstripe.org/download/security-releases/ss-2016-008)
 * 2016-07-15 [dc47f7e](https://github.com/silverstripe/silverstripe-framework/commit/dc47f7ec9adf67a3f31887467de5b110e8e5b285) Reset `Member::Salt` on password change (Daniel Hensby) - See [ss-2016-008](http://www.silverstripe.org/download/security-releases/ss-2016-008)
 * 2016-07-15 [298f615](https://github.com/silverstripe/silverstripe-framework/commit/298f61521c55b07e5c898a92264dbe111735a87a) Reset `Member::Salt` on password change (Daniel Hensby) - See [ss-2016-008](http://www.silverstripe.org/download/security-releases/ss-2016-008)
 * 2016-07-14 [2b30ade](https://github.com/silverstripe/silverstripe-framework/commit/2b30ade44d333a4da4d13b31ffa28d0a34597442) ChangePasswordForm does not check $member-&gt;canLogin before login (Daniel Hensby) - See [ss-2016-011](http://www.silverstripe.org/download/security-releases/ss-2016-011)
 * 2016-07-14 [6606d98](https://github.com/silverstripe/silverstripe-framework/commit/6606d986634f5b5dec16462acaa8d9a513c29fec) ChangePasswordForm does not check $member-&gt;canLogin before login (Daniel Hensby) - See [ss-2016-011](http://www.silverstripe.org/download/security-releases/ss-2016-011)
 * 2016-07-14 [6d41db7](https://github.com/silverstripe/silverstripe-framework/commit/6d41db77fa78f473db7bcff389456c980ef4e412) ChangePasswordForm does not check $member-&gt;canLogin before login (Daniel Hensby) - See [ss-2016-011](http://www.silverstripe.org/download/security-releases/ss-2016-011)
 * 2016-07-14 [ca526b0](https://github.com/silverstripe/silverstripe-reports/commit/ca526b08c32ffe171368c1f6e456a8bfffa287d7) Missing ACL check on ReportAdmin (Daniel Hensby) - See [ss-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
 * 2016-07-14 [efa20d2](https://github.com/silverstripe/silverstripe-reports/commit/efa20d2da03f80758cce7fe697c62f7f42fe098a) Missing ACL check on ReportAdmin (Daniel Hensby) - See [ss-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
 * 2016-07-14 [cff2ea9](https://github.com/silverstripe/silverstripe-reports/commit/cff2ea9a98f592d80083633aef6bd082480281d9) Missing ACL check on ReportAdmin (Daniel Hensby) - See [ss-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
 * 2016-07-14 [04b4453](https://github.com/silverstripe/silverstripe-cms/commit/04b4453e041c2520d3658be1585146f79dca09d8) Missing ACL check on ReportAdmin (Daniel Hensby) - See [ss-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
 * 2016-07-14 [5f73d34](https://github.com/silverstripe/silverstripe-cms/commit/5f73d3454ecbc4850e91a0a3007102f6d4d9b853) Missing ACL check on ReportAdmin (Daniel Hensby) - See [ss-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
 * 2016-05-03 [3fa84cf](https://github.com/silverstripe/silverstripe-framework/commit/3fa84cf0c64a539d78600c36364817a8e38411d8) Encode user supplied URL for embeding into page (Daniel Hensby) - See [ss-2016-007](http://www.silverstripe.org/download/security-releases/ss-2016-007)

### API Changes

 * 2016-11-15 [f43a91a](https://github.com/silverstripe/silverstripe-framework/commit/f43a91a4f8d6d5b6bfdda0c67d8647c056f8d62e) Add FormField::canSubmitValue() (Damian Mooyman)
 * 2016-11-07 [ffd9938](https://github.com/silverstripe/silverstripe-framework/commit/ffd993865299522c66b0dd91beeab35dde1da5fb) ShortcodeParser getter and extension points (Jonathon Menz)
 * 2016-10-03 [9c60c38](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-blog/commit/9c60c38ed2c0414b731983b0a26e37adef8ba8ff) Add cow metadata (Damian Mooyman)
 * 2016-10-03 [537e4a9](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/commit/537e4a96f9cd1b2be995fc117bd9f6a0b82be25a) add cow metadata (Damian Mooyman)
 * 2016-09-15 [b87c668](https://github.com/silverstripe/silverstripe-framework/commit/b87c668bf4184abb4d7348e77a63853038ad2de2) support dblib (#5996) (Damian Mooyman)
 * 2016-09-05 [c6457c5](https://github.com/silverstripe/silverstripe-framework/commit/c6457c50e970654b43ff009933a80a1a493186fb) Allow has_many fixtures to be declared with array format as well as many_many (#5944) (Damian Mooyman)
 * 2016-07-15 [d08ab6a](https://github.com/silverstripe/silverstripe-framework/commit/d08ab6ac81b67220f08f80a16dd804a6d489ff97) Allow X-Frame-Options to be configured (Damian Mooyman)
 * 2016-06-20 [e810a99](https://github.com/silverstripe/silverstripe-framework/commit/e810a9928c2d0771ba8f44934ed6295bbed418b3) Add optimistic_connect to SS_Database (Damian Mooyman)

### Features and Enhancements

 * 2016-10-14 [10d4fa8](https://github.com/silverstripe-australia/silverstripe-advancedworkflow/commit/10d4fa8a914cc76948d06546a5b84f7e52bbe8ff) Introduced Assignee keyword for mail templates (Marcus Nyeholt)
 * 2016-08-11 [b701b25](https://github.com/silverstripe/silverstripe-userforms/commit/b701b250a3d9b903a59913e1c0a563dfa59d7e29) add customisable file upload size limit (muskie9)
 * 2016-06-10 [19b9413](https://github.com/silverstripe/silverstripe-framework/commit/19b9413432a8baa66ad262c24a4663be0ec7bb33) Use injector for MemberLoginForm fields (Daniel Hensby)
 * 2016-05-15 [c401d9d](https://github.com/silverstripe/silverstripe-framework/commit/c401d9daff6d4add3bbded2d1a97e66bedb66992) added hide_from_cms_tree and hide_from_hierarchy (John Milmine)
 * 2015-02-11 [dae2295](https://github.com/silverstripe/silverstripe-framework/commit/dae2295e16caed0c38076fdc5f3ed0a962e8f170) Allow the paddedresize to take another hex value to specify a transparency on the padded color (Nick)

### Bugfixes

 * 2016-11-28 [1d6024f](https://gitlab.cwp.govt.nz/cwp/cwp/commit/1d6024f02dc803bbceb08a4e17eebc57a83e83fa) upgrading notes for auditor module (Damian Mooyman)
 * 2016-11-16 [40a1ce4](https://github.com/silverstripe/silverstripe-contentreview/commit/40a1ce4ee800b2e3b655f6bbba1c37efe5e937d8) invalid composer.json (Damian Mooyman)
 * 2016-11-16 [e85feff](https://github.com/silverstripe/silverstripe-lumberjack/commit/e85feffec01c414024bd1ba9e6cd668f2056631b)  (Damian Mooyman)
 * 2016-11-11 [ae6badf](https://github.com/silverstripe/silverstripe-subsites/commit/ae6badf5c079b40c44dc6c443b9a67b9fa06af83) copying child pages to subsite (David Craig)
 * 2016-11-09 [ebae480](https://github.com/silverstripe/silverstripe-framework/commit/ebae480c662032d58a14f44055428b9309563874) Fix regression in aggregate column lookup from #6199 (Damian Mooyman)
 * 2016-11-09 [6bf36fb](https://github.com/silverstripe/silverstripe-framework/commit/6bf36fbd30c9d0e1375430e692b0e50206a0cfcb) Correct return type for Member::currentUser() (Loz Calver)
 * 2016-11-04 [1f3adae](https://github.com/silverstripe/silverstripe-secureassets/commit/1f3adae2135b3c5b54612f867524f3658ebab69f) for Silverstripe 3.3 downloading resampled assets (Ruud Arentsen)
 * 2016-11-03 [135a647](https://github.com/silverstripe/silverstripe-framework/commit/135a64761fac74cc7ac75640551c5a14874ade95) Ensure that builds use the 3.4 dependencies. (Sam Minnee)
 * 2016-11-03 [edfe514](https://github.com/silverstripe/silverstripe-framework/commit/edfe514540aae0772f49225f3614ce045ad9e1d4) Ensure that builds use the 3.4 dependencies. (Sam Minnee)
 * 2016-11-01 [c61d61d](https://github.com/silverstripe/silverstripe-framework/commit/c61d61d00324e764022489968b5a114271793522) default_records are no longer inherited to child classes (Daniel Hensby)
 * 2016-10-30 [747bd4c](https://github.com/silverstripe/silverstripe-framework/commit/747bd4cac00383fffea66dea75f7e21e13df7088) filterAny error message now refers to correct method name (Daniel Hensby)
 * 2016-10-22 [bec5adf](https://github.com/silverstripe/silverstripe-framework/commit/bec5adf09b733904a4e8d0aa55bdc337489af533) Versioned sort by ID (Jonathon Menz)
 * 2016-10-19 [b0445f7](https://github.com/silverstripe/silverstripe-framework/commit/b0445f72e4cce324308bb32384d578e43753cd6d) Ambiguous column SQL error (Jonathon Menz)
 * 2016-10-16 [fe81607](https://github.com/silverstripe/silverstripe-framework/commit/fe816076fc5a2b3b1e497b8c51c76430311eea2c) Make simplexml_load_file work on shared php-fpm (Nicola Fontana)
 * 2016-10-13 [1a5d5ea](https://github.com/silverstripe/silverstripe-userforms/commit/1a5d5eac4bf75dfd9a934f2e6514880877316f0c) incorrect method name (Nic Horstmeier)
 * 2016-10-11 [7368dec](https://github.com/silverstripe/silverstripe-framework/commit/7368deca8f409c5aba94a6b646d7c0ac4fbd452f) Fix issue with SS_List as datasource for dropdown field (Damian Mooyman)
 * 2016-10-07 [ae83b7b](https://github.com/silverstripe/silverstripe-cms/commit/ae83b7b5ef28df5f5b3f752435f3b36b078f619a) History controller now shows right comparison versions (Daniel Hensby)
 * 2016-10-04 [797be6a](https://github.com/silverstripe/silverstripe-framework/commit/797be6ac82f6938af06c24c99150648ff214f797) Revert natural sort (Jonathon Menz)
 * 2016-10-04 [6dde5ce](https://github.com/silverstripe/silverstripe-framework/commit/6dde5ce5718911d8e405eb590c68036ceaa6e608) Absolute alternate_base_url no longer breaks session cookies (Daniel Hensby)
 * 2016-10-03 [98d95cd](https://github.com/silverstripe/silverstripe-cms/commit/98d95cd70708ae1f15a9bf5c5a661cd66f449f2f) Sort order for duplicated child pages is now retained (Daniel Hensby)
 * 2016-09-29 [ae4108b](https://github.com/silverstripe/silverstripe-framework/commit/ae4108bf00e9503c5748c4129df7e1c3ea8c8b5f) Content-Disposition header breaks in Firefox (#4087) (Anton Smith)
 * 2016-09-26 [1ddfaf2](https://gitlab.cwp.govt.nz/cwp/cwp-installer/commit/1ddfaf2b75fb903b1c7751e3cd3b2aa74847fac0) Add silverstripe/auditor, silverstripe/contentreview, silverstripe/reports, silverstripe/siteconfig and silverstripe/sitewidecontent-report into gitignore so people don't accidentally commit changes that don't get reflected when deploying (madmatt)
 * 2016-09-21 [7648318](https://github.com/silverstripe/silverstripe-userforms/commit/76483188dc781394ed4b602a4192c21f121d104e) EditableFormHeading doesn't properly handle numeric values (Nic Horstmeier)
 * 2016-09-19 [32d1856](https://github.com/silverstripe/silverstripe-framework/commit/32d1856d40416438c52b8eb0651814a0fd32c0eb) Debug::caller() will now handle errors from outside function calls (#6029) (Daniel Hensby)
 * 2016-09-19 [d2d770c](https://github.com/silverstripe/silverstripe-framework/commit/d2d770c6fbaeb3ea209853dd44017198a6232c01) Frontend UploadField wouldn't call ssdialog (Cristian Torres)
 * 2016-09-14 [cd8904e](https://github.com/silverstripe/silverstripe-framework/commit/cd8904e0454617b243c8e89c06c694844817f212) ing button destroy bug (3Dgoo)
 * 2016-09-12 [a14df0b](https://github.com/silverstripe/silverstripe-framework/commit/a14df0bc2d08f953ff7dd6f57899dbf260ab13a5) Force line endings to LF on sake file (Daniel Hensby)
 * 2016-09-11 [266a2ff](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/266a2ffe26637978a6797e007e70884c6c6fc51d) Handle folders separately in the File Type column (Robbie Averill)
 * 2016-09-11 [5d9abdc](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/5d9abdca8449c7e58381febaf0250c14a6f99073) Use localised Page class name (Robbie Averill)
 * 2016-09-08 [ffab2df](https://github.com/silverstripe/silverstripe-blog/commit/ffab2df9d2e4474801e60a4f23c1a2d8e617701e) Excerpt should be casted as HTMLText (Daniel Hensby)
 * 2016-09-06 [e7ecf6c](https://github.com/silverstripe/silverstripe-framework/commit/e7ecf6cf15d4b3d4adaf0a415a5c4f9f2a15a003) Bad strpos call in HTTP::register_etag() (Daniel Hensby)
 * 2016-09-01 [f2ed59e](https://github.com/silverstripe/silverstripe-framework/commit/f2ed59e1851b4506f02994dd4a1f3ffa86938cb9) Empty dmyfields on DateField now validate as true (Daniel Hensby)
 * 2016-08-27 [91abe1f](https://github.com/silverstripe/silverstripe-blog/commit/91abe1f9f8411670efcbed5a0f3b436ea0dd22a7) Cast Date method on BlogPost (Daniel Hensby)
 * 2016-08-23 [0e61dfc](https://github.com/silverstripe/silverstripe-subsites/commit/0e61dfc3f6fa96a56c67abcdc5cfaac66e0b155e) Prevent translatable / subdirs interfering with test state (Damian Mooyman)
 * 2016-08-22 [59be597](https://github.com/silverstripe/silverstripe-cms/commit/59be597004da21064e51c6237fbb451628bebf66) #1052 (Daniel Hensby)
 * 2016-08-22 [4998b80](https://github.com/silverstripe/silverstripe-framework/commit/4998b8044530a83c617194d544b76a98f742386e) ArrayList sorting now caseinsensitive (Daniel Hensby)
 * 2016-08-16 [d021372](https://github.com/silverstripe-australia/silverstripe-advancedworkflow/commit/d021372acc32a95b8a6fe6e9daf3139710dc0190) (WorkflowInstance): Fix bug where using WorkflowInstance with frontend had inconsistencies between "index" and listing pages. Since the intent of the code points to it mainly being used for the canView(), I've moved the code there as it makes sense for a user to be able to view the WorkflowInstance of a Target() record they've written to. (Jake Bentvelzen)
 * 2016-08-15 [5ad8157](https://github.com/silverstripe/silverstripe-cms/commit/5ad8157655a5dd581cbc90a95e8588907794a9c9) Fix regression in FormField casting (Damian Mooyman)
 * 2016-08-15 [a6a9cd7](https://github.com/silverstripe/silverstripe-cms/commit/a6a9cd729fd24b19f7b39fdeb867a491489687e0) Fix regression in FormField casting (Damian Mooyman)
 * 2016-08-15 [95c640a](https://github.com/silverstripe/silverstripe-cms/commit/95c640ae6b5620be83d38e8060317554bc0820ed) Fix regression in FormField casting (Damian Mooyman)
 * 2016-08-11 [d4114b3](https://github.com/silverstripe/silverstripe-framework/commit/d4114b3dce73ffaf786af7ce76f2e1c6f1483d47) include related fields on canFilter() check (Jonathon Menz)
 * 2016-08-09 [63fc4db](https://github.com/silverstripe/silverstripe-cms/commit/63fc4dbcaebcc7063f8075681d8b1f09608afe1c) Fix extra border in page settings (Damian Mooyman)
 * 2016-08-07 [86add3e](https://github.com/silverstripe/silverstripe-framework/commit/86add3e02113f5087b168ee6529c55283c7243cc) Use create syntax for CMSMemberLoginForm remember me form (Daniel Hensby)
 * 2016-08-04 [5fcdf8c](https://github.com/silverstripe/silverstripe-framework/commit/5fcdf8c3132376d6724700235c960c8133711f14) don't look in node_modules (Michael Strong)
 * 2016-08-03 [a84a1b7](https://github.com/silverstripe/silverstripe-siteconfig/commit/a84a1b785c1e943951203ffdb584af5a34e41bdb) es issue #32 (Access tab JS) (Colin Tucker)
 * 2016-07-28 [56f0b72](https://github.com/silverstripe/silverstripe-framework/commit/56f0b72e8dbf5b7205ae12c80e0f4c9a0614d1a2) ETag header now properly quoted (Daniel Hensby)
 * 2016-07-15 [9282662](https://github.com/silverstripe/silverstripe-framework/commit/9282662293b28cce056abf88e94123c8cdd172f4) ing bad syntax from PR (Daniel Hensby)
 * 2016-07-15 [3662240](https://github.com/silverstripe/silverstripe-framework/commit/366224078b6b0d67aeebab2f9041c76a33ae5626) Allow caching of false config values (Fixes #4755) (#4762) (Sam Minnée)
 * 2016-07-08 [74c555e](https://github.com/silverstripe/silverstripe-framework/commit/74c555e00443b1bc619f0a3970beedc3dbce99e6) for #5784: Added -&gt;setReplyTo(), deprecated -&gt;replyTo() for API consistency. Revamping, fixing, and enhancing internal Email API documentation. Simplified code and brought up-to-date with latest standards. (Patrick Nelson)
 * 2016-07-05 [9afd602](https://github.com/silverstripe/silverstripe-framework/commit/9afd6020076dd1eb3b91f9566557cbe695121468) calling $record-&gt;write() breaks other 3rd party fields that write to an UnsavedRelationList. (Jake Bentvelzen)
 * 2016-07-04 [637167f](https://github.com/silverstripe/silverstripe-framework/commit/637167f2f9b97cdb3c3d2a64c38f87ce0d4c7e7a) Fix missing icons (Damian Mooyman)
 * 2016-06-09 [3bb32eb](https://github.com/silverstripe/silverstripe-reports/commit/3bb32eb013d5d12a1ba39e934181b92e75e38eab) Tests need the DB (Daniel Hensby)
 * 2016-06-09 [68c4040](https://github.com/silverstripe/silverstripe-reports/commit/68c40402999894d267e49674585913be1e913458) No longer hardcoding admin links (Daniel Hensby)
 * 2016-06-03 [429ce55](https://github.com/silverstripe/silverstripe-framework/commit/429ce557561f7d4fd648b73cb83d12c1f424cead) ViewableData::setFailover() didn't remove cached methods (Loz Calver)
 * 2016-06-01 [8a58041](https://github.com/silverstripe/silverstripe-framework/commit/8a58041fbaa01c5f5890fa274c001eee13164c24) Remove default from address for error emails (Sam Minnee)
 * 2016-05-27 [11aad47](https://github.com/silverstripe/silverstripe-framework/commit/11aad47eeb62c6b412282b6a6aaa3ee217bbeab3) invalid syntax in TinyMCE config (#5593) (Loz Calver)
 * 2016-05-19 [b1df9dc](https://github.com/silverstripe/silverstripe-framework/commit/b1df9dcb1d378c778e941a8fabd3c376e8a5a45a) check that we have a token and a UID before attempting a member auto login (Stevie Mayhew)
