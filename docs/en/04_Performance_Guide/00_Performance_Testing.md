title: Performance Testing
summary: How and what to test on your CWP instance
introduction: Before you can make performance improvements to your CWP site, you need to have a baseline to compare your
work to.

### What to test

If you are migrating an existing site, analysis of the access logs will help will help you identify areas for testing,
such as the most commonly accessed pages, sections, or user behaviours. A great tool for a visual representation of your
log data is [GoAccess](https://goaccess.io/).

<div class='warning'>
Be wary of using Google Analytics as a source of your most-hit URLs - they don't include bot visitors, which can end up
skewing your traffic a long way towards URLs that you would not expect. This is also why you should take your pageviews
statistic with a grain of salt if it comes from Google Analytics - access logs are the truest record.
</div>

If you are building a site from scratch, there are a few good rules of thumb for pages to test:

- the homepage
- the login page
- pages with forms
- pages that make API calls
- pages that display user-specific information

These are all pages that would expect a high proportion of your traffic and/or have the potential to make expensive
requests. It's up to you as the developer to identify areas of your site that may have detrimental performance impacts
and do your best to mitigate them.

### How to test

Testing on your local environment can be problematic if you use the results as a basis for your real-world expectations,
but it certainly can be useful if framed correctly. The best method is to establish a baseline for your site fairly
early on in development, and then re-run your performance tests frequently to track changes. It's not a matter of
keeping the times as they were in the beginning, but tracking changes - if there is a sudden spike after a code change,
it will be a good indicator that something needs to be analysed or explained.

Remember, increased page load time is acceptable sometimes, especially if you've made a lot of changes - but you need to
have expected correlations between your code and your load times.

#### Tools for local testing

[Siege](https://www.joedog.org/siege-readme/) is a common and popular tool for HTTP load testing. It's quick to set up
and easy to pass around between teammates to replicate the testing you are doing. The simple premise is to take a set of
URLs, hit them a certain number of times in a certain timeframe and monitor the responses.

[Locust.io](http://docs.locust.io/en/latest/quickstart.html) is a Python-based load-testing tool which allows you to
simulate a user's path through your website (including form submissions and sessions), then scale this up to multiple
concurrent users. It's easy to write even if you don't know much Python, and comes with a browser-based reporting tool.

[Page Speed Insights](https://developers.google.com/speed/pagespeed/insights/) is a great tool for analysing where your
page could be improved. This is done on a per-URL basis and provides in-depth examples for how to fix problem areas,
and identifies which fixes will have the greatest impact. This is a particularly good follow up if you can identify a
page that has a problem.

You can [set up Page Speed Insights for a development environment](https://una.im/gulp-local-psi/) using Ngrok and Gulp
if you want to include it in your development workflow.

The [SilverStripe DebugBar](https://github.com/lekoala/silverstripe-debugbar) module will allow developers to profile SilverStripe page execution, database queries, `SS_Log` messages, requirements, template use and environment settings from within a toolbar at the bottom of a page. It can help developers to identify bottlenecks in an application, duplicated or slow running database queries and pages that are taking longer than a configurable amount of time to load.

### Requesting a performance testing window

In addition to local testing, you want to get real world performance samples on the CWP infrastructure early and
frequently. While you can run low concurrency tests with a handful of users unannounced, please contact the
[CWP Helpdesk](https://www.cwp.govt.nz/service-desk/new-request/) before testing with high request volumes - this allows
the team to configure the site to expect unusual traffic peaks, whitelist testing IP addresses, and generally not panic
if the site begins to show signs of struggle. You should do this at least three days before you intend to test.
Generally this will performed by a specialist testing company.
