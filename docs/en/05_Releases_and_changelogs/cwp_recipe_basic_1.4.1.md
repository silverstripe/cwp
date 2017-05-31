# CWP Recipe 1.4.1

## Overview

This upgrade includes CMS and Framework version 3.4.1, which includes mostly bugfixes
and security patches, and does not include any new features over 3.4.0.

Also included in this release are security fixes to the document converter module.

Please see the changelog below for these following releases for the list of core changes since recipe 1.4.0

 * [framework 3.4.1](https://docs.silverstripe.org/en/3.4/changelogs/3.4.1/)

Upgrade to Recipe 1.4.1 is optional, but is recommended for all CWP sites as it contains several
low-level security vulnerabilities. SilverStripe has determined that the severity and breadth
of applicability of the flaws does not constitute a need for a CWP-wide emergency upgrade.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Details of security issues

This release includes fixes for the following issues:

 * A risk in the document converter module elevated the risk that harmful scripts could persist
   between conversion from PDF to HTML. A fix has been put in place to safely sanitise
   any converted content.
 * [SS-2016-007](http://www.silverstripe.org/download/security-releases/ss-2016-007)
   **VersionedRequestFilter vulnerability**: If an incoming user request should not be able to access
   the requested stage, an error message is created for display on the CMS login page that they
   are redirected to. In this error message, the URL of the requested page is interpolated into
   the error message without being escaped; hence, arbitrary HTML can be injected into the CMS
   login page.
 * [SS-2016-008](http://www.silverstripe.org/download/security-releases/ss-2016-008)
   **Password encryption salt expiry**: When a user changes their password, the internal salt
   used for hashing their password is not updated. Although this is not considered a security
   vulnerability, this behaviour has been improved to ensure the salt is reset on change of password.
 * [SS-2016-011](http://www.silverstripe.org/download/security-releases/ss-2016-011)
   **ChangePasswordForm doesn't check Member::canLogIn()**: After performing a password reset,
   ChangePasswordForm::doChangePassword() logs in the user without checking Member::canLogIn().
   This presents an issue for sites that are using the extension point in that method to deny
   access to users (for example members that have not been “approved”, or members that have had
   their access revoked temporarily). It looks like Member::canLogIn() was originally designed
   to only be used for checking whether the user is locked out (due to too many incorrect login
   attempts) but has been opened up to other uses.
 * [SS-2016-012](http://www.silverstripe.org/download/security-releases/ss-2016-012)
   **Missing ACL on reports**: The SS_Report, and the reports CMS section only checks canView()
   when listing the reports that can be viewed by the current user. It does not (and should)
   perform canView checks when the report is actually viewed, so if you know the URL to a
   report and can otherwise access the Reports section of the CMS, you can view any report.
 * [SS-2016-013](http://www.silverstripe.org/download/security-releases/ss-2016-013)
   **Member.Name isn't escaped**: The core template framework/templates/Includes/GridField_print.ss
   uses "Printed by $Member.Name". If the currently logged in members first name or surname contain
   XSS, this prints the raw HTML out, because Member->getName() just returns the raw FirstName +
   Surname as a string, which is injected directly.
 * [SS-2016-014](http://www.silverstripe.org/download/security-releases/ss-2016-014)
   **Pre-existing alc_enc cookies log users in if remember me is disabled**: If remember me is on
   and users log in with the box checked, if the developer then disabled "remember me" function,
   any pre-existing cookies will continue to authenticate users.
 * [SS-2016-015](http://www.silverstripe.org/download/security-releases/ss-2016-015)
   **XSS In OptionsetField and CheckboxSetField**: List of key / value pairs assigned to
   OptionsetField or CheckboxSetField do not have a default casting assigned to them. The
   effect of this is a potential XSS vulnerability in lists where either key or value contain
   unescaped HTML.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.4.1@stable",
		"cwp/cwp-recipe-blog": "~1.4.1@stable",
		"cwp-themes/default": "~1.2.1@stable"
	},
	"prefer-stable": true

Note that the default theme has not been modified since recipe 1.2.0, and can be left unchanged.

## Details

### Bugfixes

 * [CWP-887] - **CWP**: Forcing http on pdf generation is not working
 * [OSS-1864] - **CMS**: Apostrophes cause userforms to fail validation
 * [open-sourcerers#2] - **Subsites**: Subsite asset CMS URL broken
 * [open-sourcerers#8] - **Document converter**: Docvert XSS issue
 * [[silverstripe-userforms#506](https://github.com/silverstripe/silverstripe-userforms/issues/506)] -
   **Userforms**: Userforms doesn't work with gridfieldextensions 1.4
 * [[silverstripe-userforms#492](https://github.com/silverstripe/silverstripe-userforms/issues/492)] -
   **Userforms**: Improve behaviour of gridfield drag drop and item creation.

### Known issues

In recipe 1.4.1 there are the following known issues in these failing tests:

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

### Subsites

 * SiteTreeSubsitesTest.testCopyToSubsite - Test failure due to tests not considering possible test
   environment location. Test only error. Resolved with https://github.com/silverstripe/silverstripe-subsites/pull/259
 * SubsitesVirtualPageTest.testSubsiteVirtualPageCanHaveSameUrlsegmentAsOtherSubsite - Test failure
   due to change in unexpected change in global state due to Translatable module. Resolved with
   https://github.com/silverstripe/silverstripe-subsites/pull/247

#### translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223
 * TranslatableSiteConfigTest.testCanEditTranslatedRootPages - Test failure affected by global state.
   See https://github.com/silverstripe/silverstripe-translatable/issues/224
