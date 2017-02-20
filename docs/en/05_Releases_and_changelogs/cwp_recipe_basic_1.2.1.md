# CWP Recipe 1.2.1

## Overview

This release tracks the Framework release 3.2.3. This includes only bugfixes and security fixes, and an upgrade of the translatable module.
Please see the changelogs for these following releases for the list of core changes since recipe 1.2.0

 * [framework 3.2.2](https://docs.silverstripe.org/en/3.2/changelogs/3.2.2/)
 * [framework 3.2.3](https://docs.silverstripe.org/en/3.2/changelogs/3.2.3/)

## Upgraded modules

 • [Translatable](https://github.com/silverstripe/silverstripe-translatable) has been upgraded to version 2.1.1 which includes updated userdocs, updated translations and a minor bugfix.

## Details of security issues

This release includes fixes for the following issues:

 * [ss-2016-003](http://www.silverstripe.org/download/security-releases/ss-2016-003): In it's default
   configuration, SilverStripe trusts all originating IPs to include HTTP headers for Hostname, IP and
   Protocol. This enables reverse proxies to forward requests while still retaining the original request
   information. Trusted IPs can be limited via the SS_TRUSTED_PROXY_IPS constant. Even with this
   restriction in place, SilverStripe trusts a variety of HTTP headers due to different proxy notations
   (e.g. X-Forwarded-For vs. Client-IP). Unless a proxy explicitly unsets invalid HTTP headers from
   connecting clients, this can lead to spoofing requests being passed through trusted proxies.
   The impact of spoofed headers can include Director::forceSSL() not being enforced,
   SS_HTTPRequest->getIP() returning a wrong IP (disabling any IP restrictions), and spoofed hostnames
   circumventing any hostname-specific restrictions enforced in SilverStripe Controllers.
 * [ss-2015-028](http://www.silverstripe.org/download/security-releases/ss-2015-028): The buildDefaults
   method on DevelopmentAdmin is missing a permission check. In live mode, if you access /dev/build,
   you are requested to login first. However, if you access /dev/build/defaults, then the action is
   performed without any login check. This should be protected in the same way that /dev/build is.
   The buildDefaults view is requireDefaultRecords() on each DataObject class, and hence has the
   potential to modify database state. It also lists all modified tables, allowing attackers more
   insight into which modules are used, and how the database tables are structured.
 * [ss-2016-002](http://www.silverstripe.org/download/security-releases/ss-2016-002): GridField does
   not have sufficient CSRF protection, meaning that in some cases users with CMS access can be tricked
   into posting unspecified data into the CMS from external websites. Amongst other default CMS interfaces,
   GridField is used for management of groups, users and permissions in the CMS.
   The resolution for this issue is to ensure that all gridFieldAlterAction submissions are checked
   for the SecurityID token during submission.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.2.1@stable",
		"cwp/cwp-recipe-blog": "~1.2.0@stable",
		"cwp-themes/default": "~1.2.1@stable"
	}

### Known issues

In recipe 1.2.1 there are the following known issues in these failing tests:

#### framework

 * FolderTest.testRenameFolderAndCheckTheFile - Known compatibility issue in versionedfiles
  with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetNameChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
  with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43
 * FolderTest.testSetParentIDChangesFilesystemOnWrite - Known compatibility issue in versionedfiles
  with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43

#### subsites

 * FileSubsitesTest.testWritingSubsiteID - Known compatibility issue in versionedfiles
  with 3.2. See https://github.com/silverstripe-australia/silverstripe-versionedfiles/issues/43

### Accepted failing tests

In recipe 1.2.1 these module unit tests cause external errors, but do not represent legitimate issues.

#### framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
  to fail as the new MimeValidator module will no longer allow random content to
  be uploaded with a mismatched mime and file extension. The original test is
  attempting to upload a bunch of text as a gzip file.
 * FormTest.testMessageEscapeHtml - Test susceptible to custom unrelated changes in theme.
  Resolved in a future release.

#### sortablegridfield

 * GridFieldSortableRowsAutoSortTest.testAutoSort - Verified to work, tests need updating
 * GridFieldSortableRowsAutoSortTest.testAppendToTopAutoSort - Verified to work, tests need updating
 * GridFieldSortableRowsTest.testSortActionWithoutCorrectPermission - Verified to work, tests need updating
 * GridFieldSortableRowsTest.testSortActionWithAdminPermission - Verified to work, tests need updating

#### versionfeed
 * VersionFeedFunctionalTest.testContainsChangesForPageOnly - Verified to pass locally
