title: HTTP Caching
summary: Improve performance with HTTP caching layers built into CWP

# HTTP Caching

This page describes how you can use **Transparent HTTP caches** to speed up your website.
These caches are a black-box solution which can be interacted with through the HTTP headers
They're always-on and external to the instances.

Most caching is disabled by default in CWP to avoid accidental information leaks.
As a CWP developer, you can make your site significantly faster
by understanding how caching works, applying it correctly and learning to diagnose issues.
Caching will also increase your site's reliability, making it able to cope with traffic spikes. 

## System Overview

CWP is equipped with two transparent cache systems: A *Local Cache Layer* in the CWP data centre (Varnish), and an external *CDN Cache Layer* (Content Delivery Network) provided by [Incapsula](https://www.incapsula.com/).

All instance responses are analysed and some of them may be cached to increase performance. Their behaviour can be controlled:

* through the response headers configured in your code (see the "Configuration via headers" chapter)
* if you opted for the Premium Managed Service, through Incapsula configuration panel (see the "Configuration via Incapsula" chapter)

The default recipe is configured conservatively to protect the data. This means SilverStripe Framework responses will not be cached at all. All other resources (static files) will be cached for a short period of time (see below for details).

### Content Security

All caches, if misconfigured, are in danger of leaking user-specific or confidential information to non-privileged visitors. To avoid this, the default recipe will produce uncache-able responses even if it means less cache utilisation. Caching needs to be considered on a site-by-site basis.

Here is an example of how things could go wrong: Let's assume a site serves "Hello, (FirstName)" snippet to logged-in users only. Further assume a cache is misconfigured, and a logged-in user "John" requests a page: the cache retains the response containing the "Hello John" string. Now, if user Steve comes along he will be served the cached version of the page erroneously containing "Hello John" string (unless the cache times out before his arrival).

It's easy to extend this example to more significant user details - addresses, private messages, personal records, etc. We will show below how to avoid this kind of issues, and always highlight secure defaults.

### Possible performance gains

A simplistic test conducted by the CWP team has shown the CDN can sustain 400 resource requests per second in certain configurations without impacting the instance considerably. In our case the test harness turned out to be the bottleneck and the top limit was not established.

This test should not be treated as representative for all CWP sites as it depends on many variables such as site's architecture, configuration and traffic profile. Agencies are urged to carry out their own load testing to determine the exact performance profile of their site.

Also see the *"Can I leverage caching so that I can fit a large site on a small instance?"* question in the 
[FAQ below](#faq-2).

### Cache levels

To help explain how actively the content could be cached on CWP let's split the possible behaviours into three levels.

| Cache level | Caches used | Potential response times | Instance load |
| - | - | - | - |
| None | - | >100ms | Full |
| Light | Local | 10 - 100ms for NZ users, more for overseas users due to the transmission latency. | Reduced in proportion to the amount of cache-able responses and their cache duration. |
| Full | Local + CDN | 10-100ms for all users regardless of location. | Same as the "Light" cache level. |

### Configuration via headers

Your best approach in controlling the caching behaviour is setting your response headers in accordance with the [RFC-2616](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html). This will ensure that all caches on the way of the response will be able to make reasonable decisions. This includes CWP's Local Cache, the CDN (Incapsula), any other public proxies (such as corporate gateways) and the browser cache.

We will now explain some simple techniques on how to increase your cache utilisation. Let's have a look at the mapping between the cache levels and specific response headers.

| Cache level | _Cache-Control_ header | _Vary_ header | Appropriate for |
| - | - | - |
| None | "no-cache, max-age=0" | _n/a_ | all |
| Light | "max-age=X" | "Cookie, […]" | all |
| Full | "max-age=X" | _none_ or "Accept-Encoding" | non-varying* |

The easiest way improve caching on your dynamic responses is to use the [controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) module. It allows you to customise the response headers per `Controller` without the need to modify any PHP code.
For deeper customisations, you also [set HTTP Cache headers directly](https://docs.silverstripe.org/en/3/developer_guides/performance/http_cache_headers/).

#### Defaults

With the basic recipe all SilverStripe Framework responses come with the following _Cache-Control_ directive. You will see this response headers coming from the default recipe site.
This means the response is classified as the "None" cache level.

```
Cache-Control: no-cache, max-age=0, must-revalidate, no-transform
```

Furthermore, all CWP instances are configured to set the following header on anything that is NOT served by the framework. This includes all requests for theme files and any asset requests that are not served by the [secureassets](https://github.com/silverstripe/silverstripe-secureassets) module.
These responses are effectively the "Full" cache level. The `max-age` value is currently 120 seconds, but could change in the future. CWP customers can’t actively clear CDN caches on Incapsula unless they purchase an optional Premium Managed Service plan. Due to this restriction, asset invalidation needs to take place via the URL, through so called “cache busters”. SilverStripe adds a GET parameter with the last file modification timestamp to each stylesheet and javascript file included through its [Requirements API](http://docs.silverstripe.org/en/3/developer_guides/templates/requirements/). If you are referencing files in other ways, please take care to add your own “cache busters”, e.g. through a Grunt build task modifying the including SilverStripe template.

```
Cache-Control: max-age=120, public
```

#### Light caching on dynamic content

You'll need to talk to your business owner about cache lifetimes: Updated content might not reach visitors until caches expire. This policy is generally safe, but specific controllers may need tweaks. For example the "userforms" module requires caching to be disabled through a `NoopPolicy` because it generates a unique form submission token for each visitor.

```
Injector:
  LightCachingPolicy:
    class: CachingPolicy
    properties:
      cacheAge: <cache-duration>
Page_Controller:
  dependencies:
    Policies: '%$LightCachingPolicy'
```

You might also want to inspect the default _Vary_ used by this module to see if it works well with your content, and perhaps adjust it via `CachingPolicy::vary` configuration option. See the "Varying content" chapter on the possible permutations of this header.

#### Full caching on dynamic content

Full caching can only be achieved on dynamic content if that content is non-varying (see "Varying content" chapter).

__Be cautious!__ If you feel uncertain about identifying content as non-varying, better stick to "Light" caching and avoid the danger of leaking user-specific or confidential data altogether.

```
Injector:
  FullCachingPolicy:
    class: CachingPolicy
    properties:
      cacheAge: <cache-duration>
      vary: ''
MyFullyCached_Controller:
  dependencies:
    Policies: '%$FullCachingPolicy'
```

You will need to adjust the `MyFullyCached_Controller` to the controller(s) of choice for this policy to work.

Note that 'Accept-Encoding' will automatically be added to the _Vary_ header by Apache's mod_deflate.

#### Varying content

As a rule of thumb, if you configure your _Cache-Control_ and _Vary_ correctly, you don't need to be worried about the caching levels.

Varying content is any URL which content depends on request data from the visitor. Lack of a session (_Cookie_ or _Authorization_ headers in the request) is usually a good first step to find non-varying URLs.

Login abilities, IP whitelisting, and Basic Authentication all imply the content varies per user. All header-driven content changes need to be properly highlighted via a _Vary_ response header (which will automatically reduce to the "Light" cache level).

Additionally, if you are serving both https and http from the same instance, you need to vary on _X-Forwarded-Protocol_ because of the `BaseURL` differences and the CWP network layout. You won't currently be able to use full caching on such double-protocol site.

A table of some more obvious _Vary_ headers can be found in the [controllerpolicy documentation](https://github.com/silverstripe-labs/silverstripe-controllerpolicy/blob/master/README.md#vary-headers). Keep in mind the more of these you specify, the more cache variations you'll create. More variations make it less likely that your visitors will get a cached response.

Check your `.htaccess` files in the webroot and any subfolders, as they can influence the `Vary` header. For example, a `%{HTTP_HOST}` rewrite condition will [auto-add](http://httpd.apache.org/docs/current/mod/mod_rewrite.html) a `Vary: Host` header.

If your content truly does not vary depending on the request, you will be able to utilise full caching for that URL - see the "Full caching on dynamic content" chapter.

Note that CWP's Local Cache (Varnish) has slightly different caching rules from the CDN (Incapsula). Depending on your headers, you might see cache hits from the Local Cache, but not from the CDN.

#### Custom static response headers

Although we recommend to stick with the CWP-configured headers for static files so that CWP operations can keep an eye on the site performance, you can customise these through your `.htaccess` file.

As an example the following will apply a new "cache for 900 seconds" header to all static responses:

```
  <IfModule mod_headers.c>
    SetEnvIf Request_URI ".*.php$" NO_CACHE=true
    Header set Cache-Control "max-age=900, public" env=!NO_CACHE
  </IfModule>
``` 

### Configuration via Incapsula

The [Incapsula](http://incapsula.com) CDN is active for all requests on all CWP sites by default. It respects HTTP cache
headers both from static assets (usually configured through `.htaccess`), as well as dynamic SilverStripe responses
configured through the controllerpolicy module.

If you opted for the Premium Managed Service you get readonly access to the Incapsula web-based dashboard incl. metrics. The CWP operations team remains responsible for changing configuration there. Please see the [site performance settings](https://incapsula.zendesk.com/hc/en-us/articles/200627760-Site-performance-settings) in the Incapsula docs for more information.

If you haven't opted for the Premium Managed Service, requests to change Incapsula settings need to go through the CWP help desk.
These changes only apply to your production environment. Other environments like Test or UAT share a common CWP configuration
and can't be changed.

By default the [Incapsula's performance settings](https://docs.incapsula.com/Content/management-console-and-settings/performance-settings.htm) are configured to be in __Static only__ mode, with "Comply with Vary: User-Agent" enabled. This safe default allows you to use all of the techniques described in the "Configuration via Headers" section above: _Static only_ makes sure the _Cache-Control_ header is respected and "Comply with Vary: User-Agent" makes Incapsula respect the "Vary" header.
On CWP the _Static+Dynamic_ mode was not observed to be any different from the _Static only_ mode. The timeout settable on _Static+Dynamic_  will always be overriden by the "max-age" directive provided by the backend.

Incapsula will also attempt to compress JPEG and PNG images as well as minify CSS, but will not minify JS.


Important: If you have a access to the Incapsula dashboard through the Premium Managed Service,
your settings there only influence responses from your own domain(s).
Content served through "*.cwp.govt.nz" domains will not be affected by your changes.
This conveniently includes responses generated from the CMS admin area which shouldn't be retained in the cache at all.

### Potentially dangerous settings in Incapsula

We do not recommend switching the mode to __Aggressive__ nor disabling "Comply with Vary: User-Agent". These put you at a risk of leaking user-specific or confidential data and should only be considered for sites without varying content. The reasons are explained in the "Content Security" chapter.

You should not change these if any of the following is true:

- You are actively using the [secureassets](https://github.com/silverstripe/silverstripe-secureassets) module
- Sections of your publicly-accessible site are protected by HTTP Basic authentication
- Your site is protected by an IP whitelist which wasn’t requested through CWP Service Desk

See "Varying content" chapter for more details. If your site is completely public information, or you endeavour to maintain a tightly controlled list of Incapsula exceptions, you can change these __at your own risk__.

## Debugging

### Tools

Request caching is complex and depends on many factors. The main method to debug efficiently are the HTTP response headers received by your HTTP client (e.g. your browser). It is quite easy to send a request which disables caching, so ensure that you follow the steps below to diagnose caching behaviour on your site.

 * **Through CURL**: The `curl` commandline tool is widely available, and can be controlled more granularly than a browser. The following command sends a `GET` request, but only returns the HTTP headers. It also shows total time taken for the request. 
 `curl -s -D - -w 'Total (secs): %{time_total}' http://www.mydomain.govt.nz -o /dev/null`
 * **Through your browser**: Google Chrome has a developer toolbar with a "Network" panel. Always use an "Incognito" session to avoid using browser caches, and clear cookies before any request. Do not rely on the "disable cache" setting or hard reloads, since these methods will create inaccurate responses.

### Caching indicators

 * **Does the `Age` header count up?** It determines the cache age in seconds. For cached content, it should increase on subsequent requests. For uncached content, it either stays at zero or is not set at all. The [controllerpolicy](https://github.com/silverstripe-archive/silverstripe-controllerpolicy) module has more details on the various caching headers and how they influence caching behaviour.
 * **Does the `X-Varnish` header contain two numbers?** Varnish [indicates](https://www.varnish-cache.org/docs/2.1/faq/http.html) cache hits through the presence of two numbers.
 * **Does the `X-Iinfo` header contain `C` values?** This Incapsula specific response header contains four characters which declare the caching level of the response (`NNNN` means not cached, `CNNN` or `NCNN` means cached). This behaviour is not officially documented by Incapsula, your mileage may vary.
 * **Incapsula cache stats** If you have opted to purchase the Premium Managed Service, the Incapsula dashboard will show you statistics on cache hit ratios. Otherwise you can contact the CWP Service Desk to retrieve this information for you.

### Checklist

The following are reasons why your response might not be cached:

 * **Vary header** Does your `Vary` header contain anything other than `Accept-Encoding`? See "Varying content" for more details.
 * **Cookies** Do you have any cookies set for this domain? Incapsula ignores it's own “utm” and “incap” cookies, any other cookies will likely prevent caching.
 * **PHP sessions** Any requests with a PHP session will prevent caching. Make sure that SilverStripe is not trying to start a PHP session alongside your request. SilverStripe will only attempt this if required by using the Session API in SilverStripe Framework. A PHP session will be started whenever a SilverStripe form is included in the generated HTML, in order to create a secure submission token. Please refer to SilverStripe’s [Secure Coding Guidelines](http://docs.silverstripe.org/en/3/developer_guides/security/secure_coding/#cross-site-request-forgery-csrf) to find out how and when to disable this submission token.
 * **Basic Authentication** Are you running HTTP Basic Authentication (e.g. on a UAT site)? This will prevent caching. You can disable authentication on a non-live site through YAML configuration (`BasicAuth.entire_site_protected`). Conditional HTTP basic authentication through IP whitelists might also interfere with caching. Please keep in mind that Incapsula won’t cache any responses which are sent with this authentication challenge. Since the same caching is applied to multiple requesting IPs, Incapsula might have already decided that the response is uncacheable based on previous requests.
 * **HTTP request verbs** Are you sending a GET request? Any other HTTP verb will prevent caching. This includes HEAD (commonly used through `curl -I`)
 * **HTTP response codes** Are you getting a HTTP 200 response code? Incapsula might not cache 3xx, 4xx or 5xx response codes  
 * **Cache preventing request headers:** Are you preventing caching through a “Cache-Control: private” or “Cache-Control: max-age=0” header? Are you sending `Pragma: no-cache`?
 * **Incapsula settings** Are you running any non-standard settings or have [path-specific cache rules](https://docs.incapsula.com/Content/management-console-and-settings/performance-settings.htm)? Contact CWP Service Desk or check your dashboard for Premium Managed Service
 * **nginx settings** Has CWP operations set up any custom nginx rules for you?
 * **Different CDN nodes** By nature, a Content Delivery Network consists of globally distributed nodes. Subsequent requests might be processed by different nodes, even when coming from the same IP. Each of these nodes have their own caches. Retry your request a few times, the cache might still be propagating.

## FAQ

**Q: Can I leverage caching so that I can fit my site on a "small" instance?**

To a certain degree, yes - if you are just worried about infrequent but large spikes of traffic. However since Incapsula has a bandwidth cap as well as CWP, you should not use this scheme to regularly go over the bandwidth and throughput limits allocated for your instance size. If your site consistently breaches these we will need to to upgrade your instance.

**Q: What if I really don't want something cached in the transparent caches?**

It depends on the headers supplied by your site and your Incapsula options. If you absolutely don't want to use the cache make sure you supply a _Cache-Control_ header of "no-cache" and "max-age=0". You also need to avoid Incapsula "Aggressive" setting.
If you are using [controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) you can apply a `NoopPolicy` to cancel any implicit policy on a specific controller - see the module's README instructon under "Overriding policies".

**Q: How do I perform load testing on a CWP environment?**

There are various triggers in the CWP infrastructure which could detect unusually high load as denial of service attacks (DDos), and temporarily deny access to the originating IPs. In order to perform load testing, you need to contact the CWP Service Desk to whitelist IPs for this purpose. 

**Q: Can I use HTTP-based caching with SSL?**

Since SSL traffic is terminated before it hits CWP's Local Cache layer, you can also cache content delivered through HTTPS.

*If you have any other questions, please contact the Service Desk.*

## Resources

 * [Google Web Fundamentals: Caching](https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/http-caching)

## Next

Continue to our performance guide on [Deferring Work](deferring_work)
