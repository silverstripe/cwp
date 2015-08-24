# CWP Recipe 1.1.1

## Overview

This release introduces many new features to UserForms, Solr, Full-text search and QueuedJobs modules.

## New Features and Modules

The following new major features are included in this release:

 * UserForms 3.0 has arrived. This version includes multi-page forms and nested field groups. There are many other new features, which you can find in the [module documentation](https://github.com/silverstripe/silverstripe-userforms/blob/master/docs/en/user-documentation.md).
 * Content authors can now create [share links to draft changes](https://github.com/silverstripe-labs/silverstripe-sharedraftcontent/blob/master/docs/introduction.md), allowing better collaboration on draft content.
 * Blog and Comments modules have received bug fixes and improvements.
 * Full-text document searching now supports boosting, synonyms and spelling suggestions.
 * Search re-indexing now happens incrementally, and can now be queued. New re-index jobs will cancel running ones, leading to faster, and more robust indexing overall.
 * QueuedJobs module has be greatly improved to be more stable and efficient. When enabled, jobs can now be executed in parallel processes. Failing parallel process jobs can no longer block the queue.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:


	:::js
	"require": {
		"cwp/cwp-recipe-basic": "~1.1.1@stable",
		"cwp-themes/default": "~1.1.1@stable"
	}


## Details

### Bugfixes

 * [OSS-650] - Non-admins using a future PublishDate throws an error in certain cases
 * [OSS-652] - Links to comment moderation links are broken
 * [OSS-667] - Share link is broken in preview mode
 * [CWP-644] - Unstyled error pages
 * [CWP-643] - Missing action handler leaks class name
 * [CWP-642] - Potential Log Entry Manipulation
 * [CWP-641] - Unescaped string interpolation in SQL

### Features

 * [OSS-574, OSS-577, OSS-580, OSS-615, OSS-704, OSS-735, OSS-803, OSS-828] - Released UserForms 3.0
 * [OSS-178, ORB-106] - Extended Solr search options: synonyms
 * [OSS-644, ORB-106] - Extended Solr search options: boosting
 * [OSS-573, ORB-106] - Extended Solr search options: misspellings
 * [OSS-530] - Extended Solr search: queueable re-index
 * [OSS-528] - Extended QueuedJobs: processor usage control
 * [OSS-527] - Extended QueuedJobs: reliable execution

### Accepted failing tests

#### framework

 * ControllerTest.testRedirectBackByBackUrl - Error caused by invalid test, resolved in a future release.
 * ControllerTest.testRedirectBackByReferer - Error caused by invalid test, resolved in a future release.
 * DirectorTest.testAlternativeBaseURL - Test passes locally when run in isolation.
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
