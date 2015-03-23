# CWP Basic Recipe 1.0.7

## Overview

This release tracks the Framework release 3.1.12. This includes mainly security
fixes.

Please see the changelogs for these following releases for the list of core
changes since recipe 1.0.6

 * [framework 3.1.11](http://doc.silverstripe.org/en/changelogs/3.1.11/)
 * [framework 3.1.12](http://doc.silverstripe.org/en/changelogs/3.1.12/)

## Security Release Notes

For details on the specifics of these security fixes, please refer to our
[security release announcement page](http://www.silverstripe.org/software/download/security-releases/).

Agencies must upgrade prior to 31st May 2015. If an agency has not upgraded by
that date, SilverStripe is obliged to perform the upgrade under the terms of the
contract. This is a last resort as it will incur cost and creates a risk of
functionality breaking, so we hope that is plenty of time for your staff
to action the upgrade.

To meet the necessary upgrade acceptance agencies must update to the basic
recipe 1.0.7. Agencies not using the basic recipe can meet conformance by
updating to the minimum version of the below modules:

 * silverstripe/framework version 3.1.12
 * silverstripe/cms version 3.1.12

Information to help manage upgrades is [here](https://www.cwp.govt.nz/features/common-web-platform-services-explained/#releasemanagement).

## Details

### Bugfixes

 * [CWPBUG-203] - Fixed break with Suhosin and excessive request strings.

### Accepted failing tests

#### framework

 * DirectorTest.testAlternativeBaseURL - Test passes locally when run in
 isolation.
 * CMSProfileControllerTest.testMemberCantEditAnother — Problem with
 Requirements combining the same file twice, non-critical Framework issue.
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
 to fail as the new MimeValidator module will no longer allow random content to
 be uploaded with a mismatched mime and file extension. The original test is
 attempting to upload a bunch of text as a gzip file.
 * i18nTextCollectorTest.testCollectFromThemesTemplates — Caused by global
 state, passes locally when the test is run individually.
 * RequirementsTest.testCommentedOutScriptTagIsIgnored - Test passes locally
 when run in isolation.

#### cms

 * CMSMainTest.testCreationOfRestrictedPage — Problem with Requirements
 combining the same file twice. Non-critical Framework issue.

#### queuedjobs

 * QueuedJobsTest.testStartJob — Caused by global state, passes locally when
 the test is run individually.
 * QueuedJobsTest.testImmediateQueuedJob — Caused by global state, passes
 locally when run either individually or as a part of all queuedjobs tests.
