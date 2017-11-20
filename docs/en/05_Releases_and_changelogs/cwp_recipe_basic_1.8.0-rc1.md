# CWP Recipe 1.8.0

## Overview

This upgrade includes CMS and Framework version 3.6.2 which includes bugfixes and some minor feature and API
enhancements. Also included are some minor enhancements to the Fulltext Search, Blog and Secure Assets modules.

 * [framework 3.6.2](https://github.com/silverstripe/silverstripe-framework/blob/3.6.2/docs/en/04_Changelogs/3.6.2.md)

Upgrade to Recipe 1.8.0 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-basic": "~1.8.0@stable",
    "cwp/cwp-recipe-blog": "~1.8.0@stable",
    "cwp/starter-theme": "~1.8.0@stable"
},
"prefer-stable": true
```

## Accepted failing tests

In recipe 1.8.0 these module unit tests cause external errors, but do not represent legitimate issues.

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

 * QueuedJobsTest.testImmediateQueuedJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).
 * QueuedJobsTest.testStartJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).

#### silverstripe/translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223

#### silverstripe/userforms

 * UserDefinedFormControllerTest.testValidation - Test failure affected by global state (starter theme template overrides).
 * UserDefinedFormControllerTest.testRenderingIntoFormTemplate - Test failure affected by global state.
 * UserDefinedFormControllerTest.testRenderingIntoTemplateWithSubstringReplacement - Test failure affected by global state.

<!--- Changes below this line will be automatically regenerated -->
