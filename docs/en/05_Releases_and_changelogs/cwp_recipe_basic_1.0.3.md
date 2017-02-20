# CWP Basic Recipe 1.0.3

## Overview

This release tracks the Framework release 3.1.5 and fixes some module bugs. The highlights are:

 * Addition of two new modules:
   [security report](https://github.com/silverstripe-labs/silverstripe-securityreport) and
   [secure assets](https://www.cwp.govt.nz/guides/core-technical-documentation/secureassets-module/en).
 * Many fixes to fulltext search to fix issues with data being updated or invalidated incorrectly.
   It will be necessary to reindex all content after upgrading to 1.0.3.
 * Update to form validation to improve accessibility and resolve theme issues.
 * Improvements to CWP core technical documentation with the addition of a new security section.
 * Many security and vulnerability exploits have been patched. See
   [security releases](http://www.silverstripe.org/security-releases/) for more information.

Please see the changelogs for these following releases for the list of core changes since recipe 1.0.2

 * [framework 3.1.3](http://doc.silverstripe.org/framework/en/3.2/changelogs/3.1.3)
 * [framework 3.1.4](http://doc.silverstripe.org/framework/en/3.2/changelogs/3.1.4)
 * [framework 3.1.5](http://doc.silverstripe.org/framework/en/3.2/changelogs/3.1.5)

## Details

### Bugfixes

* [CWPBUG-29] - Fix allchanges/changes feeds
* [CWPBUG-41] - Comments: cannot export to CSV
* [CWPBUG-98] - Auto publishing text as an author
* [CWPBUG-99] - 'Apply for approval' button doesn't save first
* [CWPBUG-102] - Rich Text Indent inserting blockquote
* [CWPBUG-105] - Fulltext search module doesn't seem to update solr indexes after write(s) (SD-1134)
* [CWPBUG-108] - Fulltextsearch results include orphaned pages
* [CWPBUG-110] - JS validation on Email field on userforms multiplies errors.
* [CWPBUG-112] - Security Permission issues with creating new security groups
* [CWPBUG-121] - index.php surfacing in URLs
* [CWPBUG-125] - CMS preview with subsites breaks if no 'href' attribute on anchor
* [CWPBUG-130] - AdvancedWorkflow Module allows standard users to delete workflow's
* [CWPBUG-134] - Ability to disable the public history RSS
* [CWPBUG-135] - Disappearing child page indicators
* [CWPBUG-136] - Search Issue on NZ Blood
* [CWPBUG-137] - XSS
* [CWPBUG-138] - Risky file upload functionality
* [CWPBUG-139] - Inaction session timeout
* [CWPBUG-140] - Username remembered on CMS login form
* [CWPBUG-141] - More accurate CMS GUI dates
* [CWPBUG-142] - Improve CMS page filtering
* [CWPBUG-143] - Document (and maybe fix) CMS pagination group sizes
* [CWPBUG-144] - Search files by date
* [CWPBUG-146] - Bug when duplicating pages
* [CWPBUG-153] - SearchForm doesn't find results [with apostrophe]
* [CWPBUG-155] - Renaming of folders allows for JS injection
* [CWPBUG-156] - Unsafe explicit PHP MIME type declaration
* [CWPBUG-157] - Reflected Cross Site Scripting
* [CWPBUG-158] - Directory Path Traversal
* [CWPBUG-160] - CMS Security User summary report

### Accepted failing tests

#### framework

* CMSProfileControllerTest.testMemberCantEditAnother — Problem with Requirements combining the same file twice,
  non-critical Framework issue.
* i18nTextCollectorTest.testCollectFromThemesTemplates — Caused by global state, passes locally when the test is
  run individually.

#### cms

* CMSMainTest.testCreationOfTopLevelPage — Problem with Requirements combining the same file twice. Non-critical
  Framework issue.
* ErrorPageTest.testBehaviourOf403 - Caused by global state, passes locally when run individually or as a part of
  all cms tests.

#### queuedjobs

* QueuedJobsTest.testStartJob — Caused by global state, passes locally when the test is run individually.
* QueuedJobsTest.testImmediateQueuedJob — Caused by global state, passes locally when run either individually or as
  a part of all queuedjobs tests.

#### versionfeed

* VersionFeedFunctionalTest.testFeedViewability — Caused by global state, tests are passing locally, in travis,
  and via manual testing. Unable to reproduce error.
