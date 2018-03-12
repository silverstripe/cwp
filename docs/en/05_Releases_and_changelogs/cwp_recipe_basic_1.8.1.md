# CWP Recipe 1.8.1

## Overview

This upgrade includes CMS and Framework version 3.6.5.

 * [Framework 3.6.5](https://github.com/silverstripe/silverstripe-framework/blob/3.6.5/docs/en/04_Changelogs/3.6.5.md)

Upgrade to Recipe 1.8.1 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-basic": "~1.8.1@stable",
    "cwp/cwp-recipe-blog": "~1.8.1@stable",
    "cwp/starter-theme": "~1.1.0@stable"
},
"prefer-stable": true
```

## Security fixes

No security fixes have been discovered since the previous CWP Recipe Release (1.8.0).

## Accepted failing tests

#### silverstripe/comments

 * CommentingControllerTest::testCommentsForm - fails due to Akismet integration needing user defined configuration.

##### Expected output modified by the starter theme

 * CommentsExtensionTest::testCommentsForm
 * CommentsGridFieldActionTest::testGetColumnContent
 * CommentsTest::testReplyForm

#### silverstripe/externallinks

 * ExternalLinksTest::testLinks - test process is modified by global state.
   c.f. https://travis-ci.org/silverstripe/silverstripe-externallinks/builds/352124753

#### silverstripe/framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
   to fail as the new MimeValidator module will no longer allow random content to
   be uploaded with a mismatched mime and file extension. The original test is
   attempting to upload a bunch of text as a gzip file.

##### Expected output modified by the starter theme

 * CheckboxSetFieldTest.testSetDefaultItems
 * EmailFieldTest.testEmailFieldPopulation
 * LookupFieldTest.testNullValueWithNumericArraySource
 * LookupFieldTest.testStringValueWithNumericArraySource
 * LookupFieldTest.testUnknownStringValueWithNumericArraySource
 * LookupFieldTest.testArrayValueWithAssociativeArraySource
 * LookupFieldTest.testArrayValueWithNumericArraySource
 * LookupFieldTest.testArrayValueWithSqlMapSource
 * LookupFieldTest.testWithMultiDimensionalSource
 * OptionsetFieldTest.testSetDisabledItems
 * GridFieldDetailFormTest.testValidator
 * GridFieldSortableHeaderTest.testRenderHeaders

#### silverstripe/queuedjobs

 * QueuedJobsTest.testStartJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).
 * QueuedJobsTest.testImmediateQueuedJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).


#### silverstripe/translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223
 * TranslatableSiteConfigTest::testCanEditTranslatedRootPages - Test failure
   affected by global state. See https://travis-ci.org/silverstripe/silverstripe-translatable/builds/352129040

#### silverstripe/userforms

##### Expected output modified by the starter theme

 * UserDefinedFormControllerTest.testValidation - Test failure affected by global state (starter theme template overrides).
 * UserDefinedFormControllerTest.testRenderingIntoFormTemplate - Test failure affected by global state.
 * UserDefinedFormControllerTest.testRenderingIntoTemplateWithSubstringReplacement - Test failure affected by global state.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Features and Enhancements

 * 2017-11-14 [47f87be](https://github.com/symbiote/silverstripe-queuedjobs/commit/47f87bed67cb711c29f4d82a099c6a7f542fbe3f) Log job output into the job messages. (Sam Minnee)
 * 2017-11-13 [1f0d551](https://github.com/symbiote/silverstripe-queuedjobs/commit/1f0d5515b45e99107b82ac0319cb5e1212de865e) Add DeleteAllJobsTask (Sam Minnee)
 * 2017-11-10 [a99f165](https://github.com/symbiote/silverstripe-queuedjobs/commit/a99f165b730e1f7cd07a6ddd2f5b3780083e1e1f) Allow queueing of build tasks (Sam Minnee)

### Bugfixes

 * 2018-03-12 [e80d7ad](https://github.com/silverstripe/silverstripe-comments/commit/e80d7ad312fb297ff58257556208f3f10ac921c3) Skip test if optional dependency not present (Dylan Wagstaff)
 * 2018-03-11 [dc6ea39](https://github.com/silverstripe/silverstripe-comments/commit/dc6ea3934d875ec26e7a2747db40daa4990e5302) backport fix for lack of HTMLPurifier breakage (Dylan Wagstaff)
 * 2018-02-19 [f948afe](https://github.com/silverstripe/silverstripe-blog/commit/f948afe2710d90d0392b6647327010644f2de229) ing non int pagination variable server error (3Dgoo)
 * 2018-02-04 [96cde0f](https://github.com/silverstripe/silverstripe-userforms/commit/96cde0f04c4de1b6d90976839826ee22b8a6a4b5) Ensure display rules work correctly for EditableFormHeading (#712) (Scott Hutchinson)
 * 2018-01-26 [416915b](https://github.com/silverstripe/silverstripe-framework/commit/416915b08248285083518850ad8d015ca8ed25c2) tableName is blank in CompositeDBField-&gt;addToQuery (Dominik Beerbohm)
 * 2018-01-25 [cf69d04](https://github.com/silverstripe/silverstripe-framework/commit/cf69d048665befa90eb43146f86cde984b876b3a) Fix ping including requirements (Damian Mooyman)
 * 2018-01-24 [c2cd6b3](https://github.com/silverstripe/silverstripe-framework/commit/c2cd6b3832c6bc4775b2742df593b445c2aca391) Fix Member_GroupSet::removeAll() (fixes #3948) (Loz Calver)
 * 2018-01-24 [f2b4c19](https://github.com/silverstripe/silverstripe-framework/commit/f2b4c192ec4d70779f7c667a976e741a7f3a26c5) Fix UploadField cuts off “Save” button (closes #2862) (Loz Calver)
 * 2018-01-23 [7384e3f](https://github.com/silverstripe/silverstripe-framework/commit/7384e3fc25987742ea08af74b704857a936e8ec0) Gridfields with dropdowns having lots of overflow (Scott Hutchinson)
 * 2018-01-09 [2ef4a2d](https://github.com/silverstripe/silverstripe-framework/commit/2ef4a2d4ee86577b00311e65bbeb0439f7aaa1fc) , adding a missing return statement. (Nathan)
 * 2017-12-21 [44930f2](https://github.com/silverstripe/silverstripe-framework/commit/44930f211be3f658fc92f2d5318255de03078701) Allow HTML 5 input tags in FunctionalTest form submissions (Daniel Hensby)
 * 2017-12-14 [81150c5](https://github.com/silverstripe/silverstripe-framework/commit/81150c59225dbf1e95bb0b4dbcfbe18346f2bdff) Use PHP 5.3 array syntax (Daniel Hensby)
 * 2017-12-12 [91dedf6](https://github.com/symbiote/silverstripe-multivaluefield/commit/91dedf6f7e1e4e53b426a5fb2ed3b15349c6632c) (MultiValueField) Better support for 3.5+ which uses the 'value' field in attributes exclusively (Marcus Nyeholt)
 * 2017-12-12 [0d9ed71](https://github.com/symbiote/silverstripe-multivaluefield/commit/0d9ed71217de4109a832bada497a66c316bf2241) (multivaluefield.css) Revert previous display inline block which breaks the field in the CMS (Marcus Nyeholt)
 * 2017-12-12 [9256ddb](https://github.com/symbiote/silverstripe-multivaluefield/commit/9256ddb15a4fb89b66e32bba20a027d7a9f9ace6) (MultiValueField) solves issue 51 (not tagging it because it's not fixed in master yet) (Marcus Nyeholt)
 * 2017-12-01 [18fe0a9](https://github.com/silverstripe/silverstripe-blog/commit/18fe0a96e78e28e4b147253fd7f327c4e02e0cbb) Add missing translation for GridFieldBlogPostState (Raissa North)
 * 2017-11-30 [0927553](https://github.com/symbiote/silverstripe-advancedworkflow/commit/09275532be59946b3785119e94e4bee16db0ccba) Remove PHP 5.3 from build matrix and include PHP 7.1 (Robbie Averill)
 * 2017-11-30 [e5ec697](https://github.com/symbiote/silverstripe-advancedworkflow/commit/e5ec6975a629ccdade0998360c5bfcd4d46cfdd6) Do not assign a default title if one has been set already (Robbie Averill)
 * 2017-11-22 [ec8ad45](https://github.com/silverstripe/cwp/commit/ec8ad45609a1dc00899f34c7d48235d91f86a149) added missing image for private modules (Tomas Cantwell)
 * 2017-11-15 [a950213](https://github.com/symbiote/silverstripe-queuedjobs/commit/a950213a8e741beb795d2051291581bcb8b063d4) Better messages. (Sam Minnee)
 * 2017-09-08 [2cbdeba](https://github.com/silverstripe/silverstripe-subsites/commit/2cbdeba69aff5a9f984cfcb471a287b6f4bfb073) Remove Behat tests from Travis matrix for SS3 (Robbie Averill)
 * 2017-09-04 [04a07d5](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/04a07d505f32f3256f35c7653389198e18e0bccd) Backport and sanitiseClassName for the "Save" action URL (Jake B)
 * 2017-08-31 [58200f8](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/58200f847fbdeeae6f593274846e939e482cbdd5) When setting the page sizes, reset items per page to the first value (Robbie Averill)
 * 2016-10-21 [8e5bb6f](https://github.com/silverstripe/silverstripe-framework/commit/8e5bb6fbdce0b2ca2d08a45534df2264db5e6b12) Fix : relObject() should return null if one of the node is null (Jason)
 * 2016-03-15 [22b3a71](https://github.com/silverstripe/silverstripe-framework/commit/22b3a71ec0c8cd8c38030fa0bf5449abefafe8a3) ing val reference to url in https hotlink (Denise Rivera)
 * 2015-04-22 [1f63637](https://github.com/silverstripe/silverstripe-framework/commit/1f63637b9369d4644a92523ada5d1a5dc0576c12) for #4095, TinyMCE not able to modify props of embed media (bug 1) and invalid HTML inserted (bug 2) (Patrick Nelson)
