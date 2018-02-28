title: Content review
summary: Set up content review times and send reminder emails to ensure content is regularly reviewed.
 
# Content review

Content review in the CWP basic recipe is implemented using:

 * [silverstripe/contentreview](https://github.com/silverstripe/silverstripe-contentreview) - provides the main functionality for the feature.
 * [silverstripe/sitewidecontent-report](https://github.com/silverstripe/silverstripe-sitewidecontent-report) - provides an extension and report to show the review status of all content (including across subsites).
 * [silverstripe/queuedjobs](https://github.com/symbiote/silverstripe-queuedjobs) - handles sending of reminder emails for content review at regular intervals.
 
Both modules are pre-configured to apply a series of `DataExtension` classes so no additional configuration is required to enable once installed.

## Sending of content review reminder emails

In order to send reminder emails on CWP you must use the [`silverstripe/queuedjobs`](https://github.com/symbiote/silverstripe-queuedjobs) module. 

This is installed by default when using the [CWP search recipe](https://github.com/silverstripe/cwp-recipe-search) codebase (if you have used this), otherwise you'll 
need to ensure you have installed.
  
Queuedjobs will then send content review reminder emails (if any) daily at 9am.  

## Customising the content review report columns

The `silverstripe/sitewidecontent-report` module when used alongside the `silverstripe/contentreview` module 
automatically applies an extension to the SitewideContentReview report. This adds the required columns 
to display the review status of content.

You can add further custom columns to this report depending on the projects needs (see [site wide content report developer documentation](https://github.com/silverstripe/silverstripe-sitewidecontent-report/blob/master/docs/en/developer-documentation.md)).

