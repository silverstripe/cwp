title: Caching
summary: Improve performance with caching.

# Caching your website

This page describes the three types of caching that can readily be used on Common Web Platform. For tips about where to 
apply your caching, please see our [Performance Guide section on caching](http://www.cwp.govt.nz/developer-docs/en/performance_guide/caching).

**Transparent caches** are a black-box solution which can be interacted with through the HTTP headers - it's always-on and external to the instances.

**Partial caching** is a feature of the SilverStripe templates allowing developers to cache repetitive content blocks - such as menus.

## Transparent caches

CWP clusters are equipped with two levels of transparent cache: a cache in the CWP data centre and an external CDN provided by Content Delivery Network (CDN) provided by [Incapsula](https://www.incapsula.com/).

All instance responses are analysed and some of them may be cached to increase performance. Their behaviour can be controlled:

* through the response headers configured in your code (see the "Configuration via headers" chapter)
* if you opted for the Premium Managed Service, through Incapsula configuration panel (see the "Configuration via Incapsula" chapter)

The default recipe is configured conservatively to protect the data. This means SilverStripe framework responses will not be cached at all. All other resources (static files) will be cached for a short period of time (see below for details).

Leveraging the caching will result in significantly faster page response times and will increase instance reliability making it able to cope with far higher volumes of instantaneous traffic (spikes).

### Content Security

All caches, if misconfigured, are in danger of leaking user-specific or confidential information to non-privileged visitors. To avoid this, the default recipe will produce uncache-able responses even if it means less cache utilisation. Caching needs to be considered on a site-by-site basis.

Here is an example of how things could go wrong: let's assume a site serves "Hello, (FirstName)" snippet to logged-in users only. Further assume a cache is misconfigured, and a logged-in user "John" requests a page: the cache retains the response containing the "Hello John" string. Now, if user Steve comes along he will be served the cached version of the page erroneously containing "Hello John" string (unless the cache times out before his arrival).

It's easy to extend this example to more significant user details - addresses, private messages, personal records, etc. We will show below how to avoid this kind of issues, and always highlight secure defaults.

### Possible performance gains

A simplistic test conducted by the CWP team has shown the CDN can sustain 400 resource requests per second in certain configurations without impacting the instance considerably. In our case the test harness turned out to be the bottleneck and the top limit was not established.

This test should not be treated as representative for all CWP sites as it depends on many variables such as site's architecture, configuration and traffic profile. Agencies are urged to carry out their own load testing to determine the exact performance profile of their site.

Also see the *"Can I leverage caching so that I can fit a large site on a small instance?"* question in the 
[FAQ below](#faq-2).

### Cache tiers

To help explain how actively the content could be cached on CWP let's split the possible behaviours into three tiers.

| Tier | Caches used | Potential response times | Instance load |
| - | - | - | - |
| 0 | - | >100ms | Full |
| 1 | Local | 10 - 100ms for NZ users, more for overseas users due to the transmission latency. | Reduced in proportion to the amount of cache-able responses and their cache duration. |
| 2 | Local + CDN | 10-100ms for all users regardless of location. | Same as Tier 1. |

### Configuration via headers

Your best approach in controlling the caching behaviour is setting your response headers in accordance with the [RFC-2616](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html). This will ensure that all caches on the way of the response will be able to make reasonable decisions. This includes the cluster-local cache, CDN, any other public proxies (such as corporate gateways) and the browser cache.

We will now explain some simple techniques on how to increase your cache utilisation. Let's have a look at the mapping between the tiers and specific response headers.

| Tier | _Cache-Control_ header | _Vary_ header | Appropriate for |
| - | - | - |
| 0 | "no-cache, max-age=0" | _n/a_ | all |
| 1 | "max-age=X" | "Cookie, […]" | all |
| 2 | "max-age=X" | _none_ or "Accept-Encoding" | non-varying* |

*) see "Varying content" chapter below

#### Content caching defaults

With the basic recipe all SilverStripe Framework responses come with the following _Cache-Control_ directive. You will see this response headers coming from the default recipe site.

```
Cache-Control: no-cache, max-age=0, must-revalidate, no-transform
```

This means the response is _tier 0_ (not cache-able).

#### Asset caching defaults

Furthermore, all CWP instances are configured to set the following header on anything that is NOT served by the framework. This includes all requests for theme files and any asset requests that are not served by the "silverstripe-secureassets" module.

```
Cache-Control: max-age=120, public
```

These responses are effectively _tier 2_. Note the max-age value is currently 120 seconds, but could change in the future. CWP customers can’t actively clear CDN caches on Incapsula unless they purchase an optional Premium Managed Service plan. Due to this restriction, asset invalidation needs to take place via the URL, through so called “cache busters”. SilverStripe adds a GET parameter with the last file modification timestamp to each stylesheet and javascript file included through its [Requirements API](http://docs.silverstripe.org/en/3.2/developer_guides/templates/requirements/). If you are referencing files in other ways, please take care to add your own “cache busters”, e.g. through a Grunt build task modifying the including SilverStripe template.

#### Tier 1 on dynamic content

The easiest way increase the tier on your dynamic responses is to use the [controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) module. You will then be able to customise the response headers per `Controller` without the need to modify the PHP code.

If an agreement with the business owner can be reached as to the cache duration, the following policy is generally safe. Some specific controllers may need tweaks however - for example the "userforms" module requires caching to be disabled through a `NoopPolicy` because it generates a unique form submission token for each visitor. See the module's README for more information.

```
Injector:
  Tier1CachingPolicy:
    class: CachingPolicy
    properties:
      cacheAge: <cache-duration>
Page_Controller:
  dependencies:
    Policies: '%$Tier1CachingPolicy'
```

You might also want to inspect the default _Vary_ used by this module to see if it works well with your content, and perhaps adjust it via `CachingPolicy::vary` configuration option. See the "Varying content" chapter on the possible permutations of this header.

#### Tier 2 on dynamic content

_Tier 2_ can only be achieved on dynamic content if that content is non-varying (see "Varying content" chapter).

__Be cautious!__ If you feel uncertain about identifying content as non-varying, better stick to _tier 1_ and avoid the danger of leaking user-specific or confidential data altogether.

```
Injector:
  Tier2CachingPolicy:
    class: CachingPolicy
    properties:
      cacheAge: <cache-duration>
      vary: ''
MyTier2_Controller:
  dependencies:
    Policies: '%$Tier2CachingPolicy'
```

You will need to adjust the `MyTier2_Controller` to the controller(s) of choice for this policy to work.

Note that 'Accept-Encoding' will automatically be added to the _Vary_ header by Apache's mod_deflate.

#### Varying content

As a rule of thumb, if you configure your _Cache-Control_ and _Vary_ correctly, you don't need to be worried about the caching tiers.

Varying content is any URL which content depends on an impulse from the visitor. Lack of a session (_Cookie_ or _Authorization_ headers in the request) is usually a good first step to find non-varying URLs.

Login, IP whitelisting, BasicAuth all imply the content varies per user. All header-driven content changes need to be properly highlighted via a _Vary_ response header (which will automatically reduce the tier to 1).

Additionally, if you are serving both https and http from the same instance, you need to vary on _X-Forwarded-Protocol_ because of the `BaseURL` differences and the CWP network layout. You won't currently be able to use tier 2 on such double-protocol site.

A table of some more obvious _Vary_ headers can be found in the [controllerpolicy documentation](https://github.com/silverstripe-labs/silverstripe-controllerpolicy/blob/master/README.md#vary-headers). Keep in mind the more of these you specify, the more partitioned the cache, which will nullify potential gains. Use as few as you are confident with.

If your content truly does not vary depending on the request, you will be able to utilise tier 2 for that URL - see the "Tier 2 on dynamic content" chapter.

#### Custom static response headers

Although we recommend to stick with the CWP-configured headers for static files so that CWP operations can keep an eye on the site performance, you can customise these through your `.htaccess` file.

As an example the following will apply a new "cache for 900 seconds" header to all static responses:

```
  <IfModule mod_headers.c>
    SetEnvIf Request_URI ".*.php$" NO_CACHE=true
    Header set Cache-Control "max-age=900, public" env=!NO_CACHE
  </IfModule>
```
  
#### Caching and SSL

Since SSL traffic is terminated before it hits the Varnish cache layer, you can also cache content delivered through HTTPS. 

### Configuration via Incapsula

The [Incapsula](http://incapsula.com) CDN is active for all requests on all CWP sites by default. It respects HTTP cache
headers both from static assets (usually configured through `.htaccess`), as well as dynamic SilverStripe responses
configured through the controllerpolicy module.

If you opted for the Premium Managed Service you will have an additional way to control the cache through your own Incapsula web-based dashboard. Please see the [site performance settings](https://incapsula.zendesk.com/hc/en-us/articles/200627760-Site-performance-settings) in the Incapsula docs for more information.

If you haven't opted for the Premium Managed Service, requests to change Incapsula settings need to go through the CWP help desk.
These changes only apply to your production environment. Other environments like Test or UAT share a common CWP configuration
and can't be changed.

By default Incapsula is configured to be in __Static only__ mode, with "Comply with Vary: User-Agent" enabled. This safe default allows you to use all of the techniques described in the "Configuration via Headers" section above: _Static only_ makes sure the _Cache-Control_ header is respected and "Comply with Vary: User-Agent" makes Incapsula respect the "Vary" header.
On CWP the _Static+Dynamic_ mode was not observed to be any different from the _Static only_ mode. The timeout settable on _Static+Dynamic_  will always be overriden by the "max-age" directive provided by the backend.

Incapsula will also attempt to compress JPEG and PNG images as well as minify CSS, but will not minify JS.

#### Potentially dangerous settings

We do not recommend switching the mode to __Aggressive__ nor disabling "Comply with Vary: User-Agent". These put you at a risk of leaking user-specific or confidential data and should only be considered for sites without varying content. The reasons are explained in the "Content Security" chapter.

You should not change these if any of the following is true:

- You are actively using `secureassets` module
- Sections of your publicly-accessible site are protected by HTTP Basic authentication
- Your site is protected by an IP whitelist which wasn’t requested through CWP Service Desk

See "Varying content" chapter for more details. If your site is completely public information, or you endeavour to maintain a tightly controlled list of Incapsula exceptions, you can change these __at your own risk__.

#### *.cwp.govt.nz domain

Your Incapsula dashboard only controls handling of the responses from the publicly accessible domain. Content under "*.cwp.govt.nz" will not be affected by your changes - this conveniently includes the CMS admin area for the live site which shouldn't be retained in the cache.

You would need to reconsider your configuration if you ever decide to serve the "admin" or "Security" area from your public domain.

## Static caching

To make this work, you need to use the [staticpublishqueue](https://github.com/silverstripe-labs/silverstripe-staticpublishqueue) module to produce the static content into the "cache" folder in your webroot.

## Partial caching

SilverStripe Framework provides a **partial caching** template tag to easily cache template parts through the `<% cached %>` syntax. This is especially useful for computationally intense parts of the site that don't change often. 

Partial caching lets you trade off memory for processing power. If overused (e.g. if the block IDs are too sparse), your environment can run out of memory.

You can read more about it in the [partial caching documentation](https://docs.silverstripe.org/en/3.2/developer_guides/performance/partial_caching/).

## Debugging

Request caching is complex and depends on many factors. The main method to debug efficiently are the HTTP response headers received by your HTTP client (e.g. your browser). Google Chrome has a developer toolbar for this purpose, but please ensure you don’t disable caching there. Otherwise a good old `curl -I <your-url>` will serve the purpose.

The primary indicator for caching behaviour is the `Age` header, which determines the cache age in seconds. For cached content, it should increase on subsequent requests. For uncached content, it either stays at zero or is not set at all. The controllerpolicy module has more details on the various caching headers and how they influence caching behaviour.

A common case for lack of caching is the presence of cookies in the HTTP request or response. Make sure that SilverStripe is not trying to start a PHP session alongside your request. SilverStripe will only attempt this if required by using the Session API in SilverStripe Framework. A PHP session will be started whenever a SilverStripe form is included in the generated HTML, in order to create a secure submission token. Please refer to SilverStripe’s [Secure Coding Guidelines](http://docs.silverstripe.org/en/3.2/developer_guides/security/secure_coding/#cross-site-request-forgery-csrf) to find out how and when to disable this submission token.

Conditional HTTP basic authentication through IP whitelists might also interfere with caching. Please keep in mind that Incapsula won’t cache any responses which are sent with this authentication challenge. Since the same caching is applied to multiple requesting IPs, Incapsula might have already decided that the response is uncacheable based on previous requests.

If you have opted to purchase the Premium Managed Service, the Incapsula dashboard will show you statistics on cache hit ratios. Otherwise you can contact the CWP Service Desk to retrieve this information for you.

## FAQ

**Q: Can I leverage caching so that I can fit my site on a "small" instance?**

To a certain degree, yes - if you are just worried about infrequent but large spikes of traffic. However since Incapsula has a bandwidth cap as well as CWP, you should not use this scheme to regularly go over the bandwidth and throughput limits allocated for your instance size. If your site consistently breaches these we will need to to upgrade your instance.

**Q: What if I really don't want something cached in the transparent caches?**

It depends on the headers supplied by your site and your Incapsula options. If you absolutely don't want to use the cache make sure you supply a _Cache-Control_ header of "no-cache" and "max-age=0". You also need to avoid Incapsula "Aggressive" setting.

If you are using [controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) you can apply a `NoopPolicy` to cancel any implicit policy on a specific controller - see the module's README instructon under "Overriding policies".

**Q: How do I perform load testing on a CWP environment?**

There are various triggers in the CWP infrastructure which could detect unusually high load as denial of service attacks (DDos), and temporarily deny access to the originating IPs. In order to perform load testing, you need to contact the CWP Service Desk to whitelist IPs for this purpose. 

*If you have any other questions, please contact the Service Desk.*
