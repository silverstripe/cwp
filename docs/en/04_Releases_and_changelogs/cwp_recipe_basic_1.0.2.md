# CWP Basic Recipe 1.0.2

## Overview

This release tracks the Framework release 3.1.2 and fixes some module bugs. The highlights are:

 * Several bugs affecting subsites were fixed. Any site using subsites is strongly recommended to upgrade
 * Several bugs affecting managing images and videos in the admin area were fixed.
 * Improvements were made to feedback provided to the content administrator in the admin area.

See [SilverStripe Framework 3.1.2 changelog](http://doc.silverstripe.org/framework/en/3.1/changelogs/3.1.2) for the
list of core changes.

## Details

### Bugfixes

* CWPBUG-15 - File replacement doesn't work
* CWPBUG-17 - Can't embed youTube or Vimeo assets
* CWPBUG-26 - IE8 unsaved modifications dialog
* CWPBUG-27 - Subsites documentation
* CWPBUG-104 - Move to using the silverstripe-australia/versionedfiles module in recipe
* CWPBUG-106 - Security updates to Solr module
* CWPBUG-111 - Registry + VersionFeeds module: View import history has a non-allowed action.
* CWPBUG-113 - Subsite permission issues
* CWPBUG-115 - Issue with the carousel's "Add item" on subsite.
* CWPBUG-116 - New failing tests in modules
* CWPBUG-117 - Subsite cross-talk reported

### Accepted failing tests

#### framework

* CMSMenuTest.testAdvancedMenuHandling — Translatable adding locale parameter to the link, so test doesn't match. Fixed in https://github.com/silverstripe/silverstripe-framework/pull/2785, will be solved once we upgrade to next version.
* CMSMenuTest.testBasicMenuHandling — Translatable adding locale parameter to the link, so test doesn't match. Fixed in https://github.com/silverstripe/silverstripe-framework/pull/2785, will be solved once we upgrade to next version.
* CMSProfileControllerTest.testMemberCantEditAnother — Problem with Requirements combining the same file twice, non-critical Framework issue.
* i18nTextCollectorTest.testCollectFromThemesTemplates — Caused by global state, passes locally when the test is run individually.

#### cms

* CMSMainSearchFormTest.testTitleFilter — Fixed in https://github.com/silverstripe/silverstripe-framework/pull/2785, but we need to wait for next stable release of SilverStripe 3.1
* CMSMainTest.testCreationOfTopLevelPage — Problem with Requirements combining the same file twice. Non-critical Framework issue.
* SiteTreeTest.testValidURLSegmentURLSegmentConflicts — Will be fixed when framework/cms upgraded to next stable release.

#### queuedjobs

* QueuedJobsTest.testStartJob — Caused by global state, passes locally when the test is run individually.
