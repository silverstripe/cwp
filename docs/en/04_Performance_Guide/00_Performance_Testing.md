title: Performance Testing
summary: How and what to test on your CWP instance
introduction: Before you can make performance improvements to your CWP site, you need to have a baseline to compare your
work to.

### What to test

If you are migrating an existing site and the logs are available, getting a copy of the access logs will help immensely 
when establishing what patterns you should be testing against. You should be able to generate a list of the most common 
URLs hit on the site, and the URLs that take the longest to respond.

<div class='warning'>
Be aware of using Google Analytics as a source of your most-hit URLs - they don't include bot visitors, which can end up
skewing your traffic a long way towards URLs that you would not expect. This is also why you should take your pageviews
statistic with a grain of salt if it comes from Google Analytics - access logs are the truest record.
</div>

If you are building a site from scratch, there are a few good rules of thumb for pages to test:

- the homepage
- the login page
- pages with forms
- pages that make API calls
- pages that display user-specific information

These are all pages that would either expect a high proportion of your traffic, or have the potential to make expensive
requests, or both. It's up to you as the developer to identify areas of your site that may have detrimental performance
impacts and do your best to mitigate them.

### How to test

Testing on your local environment can be problematic if you use the results as a basis for your real-world expectations,
but it certainly can be useful if framed correctly. The best method is to establish a baseline for your site fairly 
early on in development, and then re-run your performance tests frequently to track changes. It's not a matter of 
keeping the times as they were in the beginning, but tracking changes - if there is a sudden spike after a code change, 
it will be a good indicator that something either needs to be analysed, or explained.

Remember, increased page load time is acceptable sometimes, especially if you've made a lot of changes - but you need to
have expected correlations between your code and your load times.

#### Tools for local testing

[Siege](https://www.joedog.org/siege-readme/) is a common and popular tool for HTTP load testing. It's quick to set up 
and easy to pass around between teammates to replicate the testing you are doing. The simple premise is to take a set of 
URLs, hit them a certain number of times in a certain timeframe and monitor the responses.

[Locust.io](http://docs.locust.io/en/latest/quickstart.html) is a Python-based load-testing tool which gives you some 
more granular control and a nice user-interface in browser. It does essentially the same thing as Siege.

[Page Speed Insights (PSI)](https://developers.google.com/speed/pagespeed/insights/) is a great tool for analysing where 
your page could be improved. This is done on a per-URL basis and provides in-depth examples for how to fix problem areas,
and identifies which fixes will have the greatest impact. This is a particularly good follow up if you can identify a 
page that has a problem - but the URL will need to be accessible to the public.

You can [set up PSI for a development environment](https://una.im/gulp-local-psi/) using Ngrok and Gulp if you want to
include it in your development workflow.

### Requesting a performance testing window

Before you go live with your site on CWP, it is recommended that you conduct a performance test on the CWP
infrastructure, to ensure that the site you have on your local development environment behaves in the same way in the
real world. The first thing you should do is schedule it in via the 
[CWP Helpdesk](https://www.cwp.govt.nz/service-desk/new-request/) - this allows the team to configure the site to 
expect unusual traffic peaks, whitelist testing IP addresses, and generally not panic if the site begins to show
signs of struggle. You should do this at least 3 days before you intend to test - and preferably a week, especially
if you want to test against the Production environment. Generally this will performed by a specialist testing company.
