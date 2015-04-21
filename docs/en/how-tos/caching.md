<!--
title: Caching
-->

# Caching

This page describes the three types of caching that can readily be used on Common Web Platform.

**Transparent caches** are a black-box solution which can be interacted with through the HTTP headers - it's always-on and external to the instances.

**Static caching** allows agencies to generate a static version of their sites. This is accomplished through a special instance type and is an alternative to the usual small/medium/large instances.

**Partial caching** is a feature of the SilverStripe templates allowing developers to cache repetitive content blocks - such as menus.

## Transparent caches

CWP clusters are equipped with two levels of transparent cache: a cluster-local cache and an external CDN provided by Incapsula.

All instance responses are analysed and some of them may be retained to increase performance. Their behaviour can be controlled:

* through the response headers configured in your code (see the "Configuration via headers" chapter)
* if you opted for the Premium Managed Service, through Incapsula configuration panel (see the "Configuration via Incapsula" chapter)

The default recipe is configured conservatively to protect the data. This means SilverStripe framework responses will not be cached at all. All other resources (static files) will be cached for a short period of time.

Leveraging the caching will result in significantly faster page response times and will increase instance reliability making it able to cope with far higher volumes of instantaneous traffic (spikes).

### Content Security

All caches, if misconfigured, are in danger of leaking user-specific or confidential information to non-privileged visitors. To avoid this, the default recipe will produce uncache-able responses even if it means less cache utilisation. Caching needs to be considered on a site-by-site basis.

Here is an example of how things could go wrong: let's assume a site serves "Hello, (FirstName)" snippet to logged-in users only. Further assume a cache is misconfigured, and a logged-in user "John" requests a page: the cache retains the response containing the "Hello John" string. Now, if user Steve comes along he will be served the cached version of the page errorneously containing "Hello John" string (unless the cache times out before his arrival).

It's easy to extend this example to more significant user details - addresses, private messages, personal records, etc. We will show below how to avoid this kind of issues, and always highlight secure defaults.

### Possible performance gains

A simplistic test conducted by the CWP team has shown the CDN can sustain 400 resource requests per second in certain configurations without impacting the instance considerably. In our case the test harness turned out to be the bottleneck and the top limit was not established.

This test should not be treated as representative for all CWP sites as it depends on many variables such as site's architecture, configuration and traffic profile. Agencies are urged to carry out their own load testing to determine the exact performance profile of their site.

Also see the "Can I leverage caching so that I can fit a large site on a small instance?" question in the FAQ below.

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

#### Safe defaults

With the basic recipe all SilverStripe Framework responses come with the following _Cache-Control_ directive. You will see this response headers coming from the default recipe site.

	Cache-Control: no-cache, max-age=0, must-revalidate, no-transform

This means the response is _tier 0_ (not cache-able).

Furthermore, all CWP instances are configured to set the following header on anything that is NOT served by the framework. This includes all requests for theme files and any asset requests that are not served by the "silverstripe-secureassets" module.

	Cache-Control: max-age=120, public
	
These responses are effectively _tier 2_. Note the max-age value is currently 120 seconds, but could change in the future.

#### Tier 1 on dynamic content

The easiest way increase the tier on your dynamic responses is to use the [silverstripe-controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) module. You will then be able to customise the response headers per `Controller` without the need to modify the PHP code.

If an agreement with the business owner can be reached as to the cache duration, the following policy is generally safe. Some specific controllers may need tweaks however - for example multi-form requires overriding with `NoopPolicy`. See the module's README for more information.

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

_Tier 2_ can only be achieved on dynamic content if that content is non-varying (see "Varying content" chapter). To achieve this, the following configuration should be used.

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

A table of some more obvious _Vary_ headers can be found in the [silverstripe-controllerpolicy documentation](https://github.com/silverstripe-labs/silverstripe-controllerpolicy/blob/master/README.md#vary-headers). Keep in mind the more of these you specify, the more partitioned the cache, which will nullify potential gains. Use as few as you are confident with.

If your content truly does not vary depending on the request, you will be able to utilise tier 2 for that URL - see the "Tier 2 on dynamic content" chapter.

#### Custom static response headers

Although we recommend to stick with the CWP-configured headers for static files so that CWP operations can keep an eye on the site performance, you can customise these through your `.htaccess` file.

As an example the following will apply a new "cache for 900 seconds" header to all static responses:

	<IfModule mod_headers.c>
		SetEnvIf Request_URI ".*.php$" NO_CACHE=true
		Header set Cache-Control "max-age=900, public" env=!NO_CACHE
	</IfModule>
	
#### Caching and SSL

Since SSL traffic is terminated before it hits the Varnish cache layer, you can also cache content delivered through HTTPS. 

### Configuraton via Incapsula

If you opted for the Premium Managed Service you will have an additional way to control the cache through your own Incapsula web-based dashboard. Please see the [Site performance settings](https://incapsula.zendesk.com/hc/en-us/articles/200627760-Site-performance-settings) in the Incapsula docs for more information.

By default Incapsula is configured to be in __Static only__ mode, with "Comply with Vary: User-Agent" enabled. This safe default allows you to use all of the techniques described in the "Configuration via Headers" section above: _Static only_ makes sure the _Cache-Control_ header is respected and "Comply with Vary: User-Agent" makes Incapsula respect the "Vary" header.

On CWP the _Static+Dynamic_ mode was not observed to be any different from the _Static only_ mode. The timeout settable on _Static+Dynamic_  will always be overriden by the "max-age" directive provided by the backend.

#### Potentially dangerous settings

We do not recommend switching the mode to __Aggressive__ nor disabling "Comply with Vary: User-Agent". These put you at a risk of leaking user-specific or confidential data and should only be considered for sites without varying content. The reasons are explained in the "Content Security" chapter.

You should not change these if any of the following is true:

- you are actively using `secureassets` module
- sections of your publicly-accessible site are protected by BasicAuth
- your site is protected by a non-Incapsula IP whitelist (i.e. the one you request via Service Desk)
- … and many more. See "Varying content" chapter for more details.

If your site is completely public information, or you endeavour to maintain a tightly controlled list of Incapsula exceptions, you can change these __at your own risk__.

#### *.cwp.govt.nz domain

Your Incapsula dashboard only controls handling of the responses from the publicly accessible domain. Content under "*.cwp.govt.nz" will not be affected by your changes - this conveniently includes the CMS admin area for the live site which shouldn't be retained in the cache.

You would need to reconsider your configuration if you ever decide to serve the "admin" or "Security" area from your public domain.

## Static caching

**Static caching** is a substantially more complex method of caching that generates static versions of all dynamic pages and serves these directly instead of passing the requests to the PHP backend. The side advantage is the potential for increased security.

To utilise static caching on CWP you will need to purchase a **statically-published instance type** which provides the two-node architecture:

* frontend: the front-line node where all the static files get shipped to. If static file does not exist, the node can be configured to either pass the request to the backend, or block it (resulting in a more secure isntance).
* backend: node that hosts the CMS interface and the database and is able to respond to dynamic requests. Access to this node can be restricted via a whitelist.

To make this work, you need to use the [silverstripe-staticpublishqueue](https://github.com/silverstripe-labs/silverstripe-staticpublishqueue) module to produce the static content into the "cache" folder in your webroot.

Contact Service Desk for more information about the suitability of this approach for your use case.

## Partial caching

SilverStripe Framework provides a **partial caching** template tag to easily cache template parts through the `<% cached %>` syntax. This is especially useful for computationally intense parts of the site that don't change often. 

Partial caching lets you trade off memory for processing power. If overused (e.g. if the block IDs are too sparse), your environment can run out of memory.

You can read more about it in the [partial caching documentation](https://www.cwp.govt.nz/guides/core-technical-documentation/framework/en/02_Developer_Guides/08_Performance/00_Partial_Caching).

## FAQ

**Q: Can I leverage caching so that I can fit my site on a "small" instance?**

To a certain degree, yes - if you are just worried about infrequent but large spikes of traffic. However since Incapsula has a bandwidth cap as well as CWP, you should not use this scheme to regularly go over the bandwidth and throughput limits allocated for your instance size. If your site consistently breaches these we will need to to upgrade your instance.

**Q: What if I really don't want something cached in the transparent caches?**

It depends on the headers supplied by your site and your Incapsula options. If you absolutely don't want to use the cache make sure you supply a _Cache-Control_ header of "no-cache" and "max-age=0". You also need to avoid Incapsula "Aggressive" setting.

If you are using [silverstripe-controllerpolicy](https://github.com/silverstripe-labs/silverstripe-controllerpolicy) you can apply a `NoopPolicy` to cancel any implicit policy on a specific controller - see the module's README instructon under "Overriding policies".

*If you have any other questions, please contact the Service Desk.*