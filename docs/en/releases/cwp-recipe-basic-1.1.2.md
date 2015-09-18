# CWP Recipe 1.1.2

## Overview

This is a minor security release to resolve certain XSS vulnerabilities in the CMS and Framework.

This release tracks framework 3.1.15. Please see the changelogs for these following
releases for the list of core changes since recipe 1.1.1

 * [framework 3.1.14](http://doc.silverstripe.org/en/changelogs/3.1.14/)
 * [framework 3.1.15](http://doc.silverstripe.org/en/changelogs/3.1.15/)

It is not mandatory that agencies upgrade to this release. The fixed security issues
are only minor issues. In general, if you are unsure if you need to upgrade to this release,
it is safe to wait until your next scheduled upgrade cycle.

## Details of security issues

This release includes fixes for the following issues:

 * [SS-2015-015](https://www.silverstripe.org/software/download/security-releases/ss-2015-015/):
   A XSS risk exists in the returnURL parameter passed to
   dev/build. An unvalidated url could cause the user to redirect to an
   unverified third party url outside of the site.
 * [SS-2015-020](https://www.silverstripe.org/software/download/security-releases/ss-2015-020/):
   A member with the permission EDIT_PERMISSIONS is able to re-assign themselves (or another member) to ADMIN level.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.1.2@stable"
	}

### Accepted failing tests

#### framework

  * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
 to fail as the new MimeValidator module will no longer allow random content to
 be uploaded with a mismatched mime and file extension. The original test is
 attempting to upload a bunch of text as a gzip file.
 * FormTest.testMessageEscapeHtml - Test susceptible to custom unrelated changes in theme.
   Resolved in a future release.

#### cms

 * CMSMainTest.testCreationOfRestrictedPage — Problem with Requirements
 combining the same file twice. Non-critical Framework issue.

#### queuedjobs

 * QueuedJobsTest.testStartJob — Caused by global state, passes locally when
 the test is run individually.
 * QueuedJobsTest.testImmediateQueuedJob — Caused by global state, passes
 locally when run either individually or as a part of all queuedjobs tests.
