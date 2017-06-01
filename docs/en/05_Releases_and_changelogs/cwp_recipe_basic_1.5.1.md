# CWP Recipe 1.5.1

## Overview

This release includes a single bugfix to the userforms module, incrementing it from 4.2.0 to 4.2.1.
Agencies should upgrade if they rely on the userforms module and have previously upgraded to recipe 1.5.0.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made. Only the `cwp/cwp-recipe-basic` module needs to be upgraded.

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.5.1@stable",
	}

## Details

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

### Bugfixes

 * 2016-12-13 [b047a14](https://github.com/silverstripe/silverstripe-userforms/commit/b047a1468c451adbe3328d2ae71d0c700e17a5c6) Fix issue with UserFormsCheckboxSetField (Damian Mooyman)
