# CWP Recipe 1.5.2

## Overview

This upgrade includes CMS and Framework version 3.5.3 which includes bugfixes and 
some minor feature and API enhancements.

 * [framework 3.5.3](https://github.com/silverstripe/silverstripe-framework/blob/3/docs/en/04_Changelogs/rc/3.5.3-rc1.md)

Upgrade to Recipe 1.5.2 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Details of security issues

This release includes a fix for the following minor security issue:

 * [SS-2016-001](http://www.silverstripe.org/download/security-releases/ss-2017-001) **XSS in page name**

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.5.2@stable",
		"cwp/cwp-recipe-blog": "~1.5.2@stable",
		"cwp-themes/default": "~1.3.0@stable"
	},
	"prefer-stable": true

## Details

### Bugfixes

 - [CWP-825] - Fixes exporting BrokenLinksReport missing columns.
 
<!--- Reticulated splines a bit more to get the vacuum tubes to warm up faster -->

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

 * 2017-01-13 [c6c6c13](https://github.com/silverstripe/silverstripe-framework/commit/c6c6c13fc265aeedf5de7226b3cde39d185ba49d) Unescaped title attribute in LeftAndMain_TreeNode::forTemplate (Daniel Hensby) - See [ss-2017-001](http://www.silverstripe.org/download/security-releases/ss-2017-001)

### Bugfixes

 * 2017-02-09 [59cc516](https://gitlab.cwp.govt.nz/cwp/cwp/commit/59cc516e46fa89bf4b9de111c6e6ecc3320ee131) docs reference to incorrect framework version on release 1.5.2 (Brett Tasker)
 * 2017-02-08 [1f3d46b](https://github.com/silverstripe/silverstripe-framework/commit/1f3d46b832c4f69b7c9accd38476491e304a4877) #6606 the JS SiteTree lib depends on whitespace (Daniel Hensby)
 * 2017-02-08 [d313fe6](https://github.com/silverstripe-australia/silverstripe-versionedfiles/commit/d313fe61370ebc164f7396eac5ca2928dfa31f9f) Fix issue with VersionedFiles crashing mid-folder-rename due to outdated has_one cache (Damian Mooyman)
 * 2017-02-08 [06f224c](https://gitlab.cwp.govt.nz/cwp/cwp/commit/06f224c855b00c52c0ad7e0b0fdb4535cb1544db) Fix sql group error in mysql 5.7 (Damian Mooyman)
 * 2017-02-07 [4072408](https://github.com/silverstripe-australia/silverstripe-queuedjobs/commit/4072408ce6e597ea966ca2c025bd44b964fab53c) (QueuedJobService) Broken job status set Wait (Marcus Nyeholt)
 * 2017-01-31 [e302c4e](https://github.com/silverstripe/silverstripe-translatable/commit/e302c4ec46f107d309eab443087786709d300bd3) Fixed ambiguous column crash caused when publishing a versioned object if the query is joined against another table (UndefinedOffset)
 * 2017-01-31 [e9880ca](https://github.com/silverstripe/silverstripe-spamprotection/commit/e9880ca3e5ec9a7339afd6aad51aaf47616ef20a) ing travis setup (Daniel Hensby)
 * 2017-01-30 [10d9f90](https://github.com/silverstripe/silverstripe-cms/commit/10d9f9080b6cc6c909abdae796e8ce944036ccc2) to allow ASSETS_DIR to be a subdirectory (Brendan Halley)
 * 2017-01-24 [2f710d6](https://github.com/silverstripe/silverstripe-userforms/commit/2f710d6518ccfad163cfb2fba6fcd3105e001840) Improve publish performance for formfields (#538) (Daniel Hensby)
 * 2017-01-24 [c640ade](https://github.com/silverstripe/silverstripe-framework/commit/c640ade9112c703068754c7d7061d646da7307bd) ed iframe postmessage breaking non-string messages (Ruud Arentsen)
 * 2017-01-16 [17d123a](https://github.com/silverstripe/silverstripe-framework/commit/17d123a3be3a2c9e21845fda89c61f00301f78f5) Ensure correct regeneration of ConfigManifest if only one of the cache files is missing (Stephan Bauer)
 * 2017-01-14 [1f1fffe](https://github.com/silverstripe/silverstripe-framework/commit/1f1fffe73454930c1aef394e9b106a484e6d59ee) Ensure correct regeneration of ConfigManifest if only one of the cache files is missing (fixes #6467) (Stephan Bauer)
 * 2017-01-10 [5bba726](https://github.com/silverstripe/silverstripe-cms/commit/5bba7264c69b654ac5bcb87769781138be61cb92) Dont attempt to iterate over null in SiteTree::allowedChildren (Daniel Hensby)
 * 2016-12-21 [f314b86](https://github.com/silverstripe/silverstripe-framework/commit/f314b86ad804b021cda255e4645e99e8d971fa8a) Temp disable shortcode SPLIT behaviour due to crash (#6436) (Damian Mooyman)
 * 2016-12-21 [ffdb99e](https://github.com/silverstripe/silverstripe-framework/commit/ffdb99e78d6ff179c22c5b53f0517fdd75abb858) Temp disable shortcode SPLIT behaviour due to crash (#6436) (Damian Mooyman)
 * 2016-12-18 [222ee6b](https://github.com/silverstripe/silverstripe-framework/commit/222ee6bde270712fee60c1b796a65f7b7dd4979f) ed a pagination bug (PingMetal)
 * 2016-12-16 [c007e85](https://github.com/silverstripe/silverstripe-framework/commit/c007e85d1b9a1affd0ea7646b6a8c37d78b4450c) Suppress HtmlEditorField casting (Damian Mooyman)
 * 2016-12-13 [964827f](https://gitlab.cwp.govt.nz/cwp/cwp/commit/964827fa9c5d6f2d0949e6380beac2bdb94543e0) Update docs to reference changes in cwp/cwp-corephp -i | grep pthre (Matt Peel)
 * 2016-12-08 [5248be9](https://github.com/silverstripe/silverstripe-framework/commit/5248be92268e343dc0bacafd4c15de0c79d1f592) Handle fields with square brackets (Daniel Hensby)
 * 2016-12-06 [3fca7b3](https://github.com/silverstripe/silverstripe-framework/commit/3fca7b3c4d8ada19e8abbed70548eb63d1f476e3) hard-coded boolean in CsvBulkLoader (Colin Tucker)
 * 2016-12-05 [2181e3b](https://github.com/silverstripe/silverstripe-framework/commit/2181e3b86b3663352efdfb2e3896081b1e0ae4db) Fix localisation issues (Damian Mooyman)
 * 2016-12-05 [224b2a4](https://github.com/silverstripe/silverstripe-cms/commit/224b2a4cbad768f27a19b14c2b9ce53efa619619) Fix localisation issues in CMS (Damian Mooyman)
 * 2016-12-02 [465c072](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/465c072a9965c1994d63540fbaf210dba2654a3b) Regression where pages would be indexed under all subsites (Daniel Hensby)
 * 2016-11-29 [9ec1d35](https://github.com/silverstripe/silverstripe-framework/commit/9ec1d35f2bd09bee50d3a3629d9589f8871abd98) Fix behat tests unable to capture HTML editor fields (Damian Mooyman)
 * 2016-11-24 [a4760b8](https://github.com/silverstripe/silverstripe-framework/commit/a4760b8ee409c2c96a0e77445debf931259cb9aa) Fixed issue where a shortcode's location would not get set to split when using the class leftAlone (UndefinedOffset)
 * 2016-11-23 [03b4e6e](https://github.com/silverstripe/silverstripe-framework/commit/03b4e6ea3201736c62a73e301489fe6a65a01a0f) Tests shouldnt set date or time format to null (Daniel Hensby)
 * 2016-11-22 [b2503ac](https://github.com/silverstripe/silverstripe-cms/commit/b2503ac004f5e99d2041732dea702735128ecf1e) content authors unable to duplicate top-level pages (fixes #1685) (Loz Calver)
 * 2016-11-21 [682e607](https://github.com/silverstripe/silverstripe-cms/commit/682e6070e556f8e56b727b600c556da7507c2f44) Correct response code generated from error pages (Damian Mooyman)
 * 2016-11-04 [dd9ade4](https://github.com/silverstripe/silverstripe-framework/commit/dd9ade429454b1053ab5c2003663eeb66b5866d6) UploadField incorrectly setting max upload size (Daniel Hensby)
 * 2015-05-13 [ed6114a](https://github.com/silverstripe/silverstripe-widgets/commit/ed6114a7dcbca9d67e3e74917b972645d8a313ca) Fix incorrect extension variable (Damian Mooyman)
 * 2015-04-01 [54599b9](https://github.com/silverstripe/silverstripe-widgets/commit/54599b98d11fae2870bce951d87fd64826578bfe) Fixed issue where Widget::CMSEditor() can't see the enabled checkbox (UndefinedOffset)
