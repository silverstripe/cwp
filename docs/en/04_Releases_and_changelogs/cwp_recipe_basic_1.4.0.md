# CWP Recipe 1.4.0

## Overview

This recipe includes a new minor release of CMS and Framework to version 3.4.0.

Please see the changelog below for these following releases for the list of core changes since recipe 1.3.0

 * [framework 3.4.0](https://docs.silverstripe.org/en/3.4/changelogs/rc/3.4.0-rc1/)

All Agencies using Recipe 1.3.0 or below must upgrade prior to 1st September 2016 to Recipe 1.4.0.
All sites using prior versions of the CWP Basic Recipe (1.3.0 and below) should be considered
vulnerable. Please organise this with your developers as soon as possible. 

## New Features

This upgrade includes CMS and Framework version 3.4.0, which introduces general API improvements
and enhancements. However, these changes are much less significant than those introduced in version
3.3.0, and the risk of regressions in this upgrade is minimal. 

The recipe includes two enhancements funded by the CWP co-fund pool:

 * Better CMS password protection when resetting password
 * Increased encryption strength on Active Directory module to 256 bits

Other enhancements include:

 * Improvement to ArrayList API
 * Improved permission checking
 * Improvements to Image manipulation API
 * Improved support for versioned and subsite content in fulltextsearch
 * Improvements in spam protection for userforms module

## Details of security issues

This release includes fixes for the following issues:

 * [SS-2016-006](http://www.silverstripe.org/download/security-releases/ss-2016-006): LoginForm calls
   disableSecurityToken(), which causes a "shared host domain" vulnerability: http://stackoverflow.com/a/15350123.
 * [SS-2016-005](http://www.silverstripe.org/download/security-releases/ss-2016-005): Default Administrator
   accounts were not subject to the same brute force protection afforded to other Member accounts. Failed
   login counts were not logged for default admins resulting in unlimited attempts on the default admin
   username and password.
 * [SS-2016-004](http://www.silverstripe.org/download/security-releases/ss-2016-004): Due to a lack of parameter
   sanitisation a carefully crafted URL could be used to inject arbitrary HTML into the CMS Edit page.
   An attacker could create a URL and share it with a site administrator to perform an attack. 
 * [SS-2016-001](http://www.silverstripe.org/download/security-releases/ss-2016-001): A XSS risk exists in
   the returnURL parameter passed to CMSSecurity/success. An unvalidated url could cause the user to redirect
   to an unverified third party url outside of the site.
 * [SS-2015-029](http://www.silverstripe.org/download/security-releases/ss-2015-029): savetreenode action does
   not have sufficient CSRF protection, meaning that in some cases users with CMS access can be tricked into
   posting unspecified data into the CMS from external websites. The resolution for this issue is to ensure
   that a security token is sent with the request and validated on the server side.

## Note on issues on sites supporting large numbers of files

Additional documentation on how to improve performance in the asset admin has been added under
[Supporting large numbers of files](/how_tos/supporting_large_numbers_of_files)

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.4.0@stable",
		"cwp/cwp-recipe-blog": "~1.4.0@stable",
		"cwp-themes/default": "~1.2.1@stable"
	}

Note that the default theme has not been modified since recipe 1.2.0, and can be left unchanged.

## Details

### Enhancements

 * [CWP-815] - *CMS*: Best Practice Password Changing
 * [CWP-814] - *Active Directory*: Security upgrade of CWP AD integration module

### Bugfixes

 * [OSS-1849] - *Framework*: Raw PHP errors to return HTTP Error code
 * [CWP-837] - *Content Review*: Dependant pages status change to ‘modified’ when you update another dependant page
 * [CWP-817] - *Userforms*: submissions with higher than ~1500 records can not be exported
 * [OSS-1737] - *Fulltext Search*: SearchVariantSubsites alterDefinition issue

### Known issues

In recipe 1.4.0 there are the following known issues in these failing tests:

#### framework

 * FolderTest.testRenameFolderAndCheckTheFile - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetNameChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetParentIDChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
   with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43

### Accepted failing tests

In recipe 1.4.0 these module unit tests cause external errors, but do not represent legitimate issues.

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
