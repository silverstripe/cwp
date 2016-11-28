# CWP Recipe 1.5.0

## Overview

This upgrade includes CMS and Framework version 3.5.0 which includes bugfixes and 
some minor feature and API enhancements.

 * [framework 3.5.0](https://docs.silverstripe.org/en/3.5/changelogs/3.5.0/)

Upgrade to Recipe 1.5.0 is optional, but is recommended for all CWP sites. This recipe
includes an enhanced auditor module for improved security logging.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.5.0@stable",
		"cwp/cwp-recipe-blog": "~1.5.0@stable",
		"cwp-themes/default": "~1.2.1@stable"
	},
	"prefer-stable": true

Note that the default theme has not been modified since recipe 1.2.0, and can be left unchanged.

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
