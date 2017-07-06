title: Working with APIs
summary: Keep your site fast when working with APIs
introduction: There can be a lot of areas to trip up on when working with third-party APIs; find out how to make sure 
your website is not adversely affected by external integrations

## Integrating external APIs

SilverStripe recommends using an external library such as [Guzzle](https://github.com/guzzle/guzzle) to perform external
requests - SilverStripe's `RestfulService` class is now deprecated.

### Request timeouts

When making an external request a "request timeout" setting can be set to limit how long the application will wait 
for a response to a request. Setting a sensible timeout can have a significant effect on page response times, 
especially when external resources are unreachable.

Picking a timeout should be done on a case-by-case basis as you may expect some requests to respond relatively quickly 
(less than 1 second) while you might expect others to take longer. Other requests may take longer - in some cases it's 
worth speaking with the external provider to find out what their expectation is around response times.

A good rule of thumb is to expect most requests to respond within 5 seconds; but remember, if you set a timeout to 5 
seconds, then on some page loads you may see loading times increase by this much to accommodate slow responses. 

<div class="notice">
Note that if a response from your site to your visitor takes over 30 seconds, a 502 error response will be sent by the
CWP infrastructure, regardless of other timeout settings.
</div>

### Caching response data

The best way to avoid slowing down your site by making external requests is to avoid making them at all. A sensible 
caching policy goes a long way to ensuring that APIs are integrated efficiently. 

Caching can be complex but here are a few points to bear in mind when considering how long to cache each response for:

#### 1. Will this data be shown to all users?

If your external service is providing data that you will show to all users then it's worth caching this globally and 
having a task that refreshes your local copy at a set interval.

Examples of this would be news that is shown on the site or data that is used to build graphs.

If data is specific to a single user, it may not be practical to cache this data for every user in advance. You'll 
need to cache this data on request and then store it for a period of time that is reasonable.
 
Examples of this would be an account balance for a user or a transaction history.

#### 2. How frequently does the data change?

Many times the data you'll be fetching from external providers will change infrequently. This data can be cached for 
longer without going "stale" (where the data you've cached is out-of-date compared to the live data source). Often there
will be little harm in showing stale data to your visitors.

<div class="notice">
Discuss with your stakeholders what level of stale data is acceptable - it may be different for each piece of data 
you cache.
</div>

If the data you're accessing changes frequently, you should adjust your caching rules to account for this.

#### 3. How important is it for the data to be up-to-date?

Caching operates on the basis that we allow for data to be inaccurate for a short period of time. After the cache 
lifetime has passed, the cache will be refreshed and the latest data will be fetched. The tolerance for how old this 
data can be will vary.

### Pre-fetching data

For some external requests you may know what data you'll need before a user visits your site. External news, currency
conversion rates and so on can often be pre-fetched for the coming hours. By setting up a queued job (see 
[Deferring Work](https://www.cwp.govt.nz/developer-docs/en/performance_guide/deferring_work/)) you can fetch and cache 
external data at pre-defined times of the day. If the data is ready waiting for the user when they arrive, they won't be
held up while you fetch it for them.

### Handling API failures

When integrating APIs, we need to bear in mind that they will suffer from the same issues that we will in terms of 
availability and handling load. This requires that we take into account the availability of the APIs and what level of 
impact is acceptable for our site.

For some sites an API will be as integral to the site as the database; without it the site cannot work. When this is 
the case, you still want to handle API failures gracefully - perhaps by retrying - if the API continues to fail 
you'll want to log the issue internally and respond with an HTTP 502 error.

In most circumstances, APIs will add supplementary data to your site, meaning that the site can still function without 
it. In this case you want to make sure you're handling API failures gracefully. This could mean either have cached data 
to fall back on, or the ability to mark data as unavailable or hidden if you don't get a successful response.

An API can fail when you need to send some data to it; for example, contact form submissions may need to be sent to an
external CRM. In event of a failure you can store this in the site's database and use a queued job to retry later. You
should consider utilising the [Circuit Breaker Pattern](https://martinfowler.com/bliki/CircuitBreaker.html) to catch 
API failures before they happen if you can.
 
### When to make API requests

If it's possible you should avoid making API requests before you know you will need the data. Performing a request in
a controller's `init` method may have an unnecessary impact on your site's performance. It's best to perform an API 
request "just in time" to ensure you only fetch the data you need.

## Next

Continue to our performance guide on [404s](404s).
