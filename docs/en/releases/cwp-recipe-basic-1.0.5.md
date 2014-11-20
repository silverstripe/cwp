# CWP Basic Recipe 1.0.5

## Overview

This release tracks the Framework release 3.1.8 and fixes some module bugs. The highlights are:

* [CMS re-authentication](http://www.silverstripe.org/blog/silverstripe-3-1-7-released/) to allow
  expired sessions to be restored without having to reload the CMS.
* Improvements to performance of large updates in the
  [fulltext search module](https://github.com/silverstripe-labs/silverstripe-fulltextsearch), as well as improvements
  in compatibility for Solr 4.0.
* Improved user interface for the [taxonomy module](https://github.com/silverstripe-labs/silverstripe-taxonomy).
  Now rather than managing taxonomy terms via a flat table, an expandable hierarchical tool will enable multi-selection
  of nested taxonomy terms.

Please see the changelogs for these following releases for the list of core changes since recipe 1.0.4

 * [framework 3.1.7](http://doc.silverstripe.org/framework/en/3.1/changelogs/3.1.7)
 * [framework 3.1.8](http://doc.silverstripe.org/framework/en/3.1/changelogs/3.1.8)

## Details

### Bugfixes

 * [CWPBUG-126] Grid-field view of pages - filter bug
 * [CWPBUG-133] Trying to sort ReportsAdmin GridField header returns 404
 * [CWPBUG-149] Performance of long-running Solr update jobs
 * [CWPBUG-162] Deprecation issue in fulltextsearch module
 * [CWPBUG-169] fulltextsearch module breaking functional tests
 * [CWPBUG-187] .ico mimetype doesn't match FileInfo extension
 * [CWPBUG-189] Files with capitalised extensions fail validation
 * [PLAT-105] Apply "date filter" to files search

### Features

 * [ORB-3] Taxonomy terms can be maintained via a hierarchical selection tool within the CMS
 * [ORB-4] As a Content Author I can re-authenticate when my session times out without losing my current CMS state

### Accepted failing tests

#### framework

* CMSProfileControllerTest.testMemberCantEditAnother — Problem with Requirements combining the same file twice,
  non-critical Framework issue.
* UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected to fail as the new MimeValidator
  module will no longer allow random content to be uploaded with a mismatched mime and file extension.
  The original test is attempting to upload a bunch of text as a gzip file.
* i18nTextCollectorTest.testCollectFromThemesTemplates — Caused by global state, passes locally when the test is
  run individually.
* RequirementsTest.testCommentedOutScriptTagIsIgnored - Test passes locally when run in isolation

#### cms

* CMSMainTest.testCreationOfTopLevelPage — Problem with Requirements combining the same file twice. Non-critical
  Framework issue.

#### queuedjobs

* QueuedJobsTest.testStartJob — Caused by global state, passes locally when the test is run individually.
* QueuedJobsTest.testImmediateQueuedJob — Caused by global state, passes locally when run either individually or as
  a part of all queuedjobs tests.

#### versionfeed

* VersionFeedFunctionalTest.testContainsChangesForPageOnly — Caused by global state, tests are passing locally, in travis,
  and via manual testing. Unable to reproduce error.