<!--
title: Caching
-->

# Caching

Every CWP instance is positioned behind a CDN-equipped transparent cache (Incapsula) and behind an internal platform transparent cache. This means that instance responses will be analysed and some of them may be retained to increase performance. 

This behaviour can be controlled to a certain degree:

* through caching headers in your site's responses (see Headers chapter)
* if you opted for the Premium Managed Service, through Incapsula configuration options (see Incapsula Options chapter)

By default, the cache and the site provided via the recipe are configured conservatively to protect the data (see the Security chapter). This means anything that is produced by the SilverStripe framework (all dynamic requests) will not be cached. All other resources (static requests) will be cached for a short period of time.

To be able to leverage the cache you need to decide which dynamic content can be cached and for how long. See the following chapters for some rules of thumb of how to accomplish this technically.

## Performance

A simplistic test conducted by the CWP team has shown Incapsula can sustain 400 resource requests per second in the "aggressive" mode without impacting the instance considerably. The bottleneck turned out to be the test harness, so the top limit may be higher.

This test should not be treated as representative for CWP sites in general as it depends on many variables such as site's architecture, and the traffic profile. Agencies are urged to carry out their own load testing to determine the exact performance profile of their site.

Also see the "Can I leverage caching so that I can fit a large site on a small instance?" question in the FAQ below.

## Content Security

The danger of using a transparent cache lies in its ability to see and intercept all instance traffic including user-specific or confidential information. That's why by default we are not caching anything that could be a dynamic response, even if that means Framework traffic is never cached.

Here is an example of how things could go wrong: let's assume a site serves "Hello, (FirstName)" snippet to logged-in users only. Further assume a cache is misconfigured, and a logged-in user John comes to the site: the cache retains the response containing "Hello John". When user Steve comes in he will be served a "Hello John" page until the cache times out. 

It's easy to extend this example to more significant user details - addresses, private messages, personal records, etc.

## Headers

Your best approach in controlling the caching behaviour is setting your response headers in accordance with the RFC. This will ensure that all caches on the way of the response will be able to make reasonable decisions. This includes the internal CWP cache, Incapsula, any other public proxies on the way (such as corporate proxies) and the browser cache.

Please refer to [RFC-2616](http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html) for the detailed description of all the possibilities or continue to read the rules of thumb on CWP.

### CWP Defaults

By default, all SilverStripe Framework responses come with the following Cache-Control directive. You will see this response headers coming from the default recipe site.

	Cache-Control: no-cache, max-age=0, must-revalidate, no-transform

This means the response is not cacheable at all.

Furthermore, all CWP instances are configured to set the following header on anything that is NOT served by the framework. This includes all requests for theme files and asset requests not served by the "silverstripe-secureassets" module.

	Cache-Control: max-age=120, public
	
We are still experimenting with the best configuration for the `max-age` timeout here - at the moment it's set conservatively to 2 minutes. It may vary in the future between instances, environments, and between asset and non-asset files.

### Configuring dynamic response headers

The easiest way to configure dynamic response headers is to use the [silverstripe-controllerpolicy](https://github.com/mateusz/silverstripe-controllerpolicy) module. This allows you to customise the response headers per `Controller` without the need to modify the PHP code.

Configuring this module requires deciding which controller's responses are cacheable. In the "Simple policy" example in the module README, the decision has been made that only the `HomePage_Controller` is cacheable. You could just as easily decide that you want everything served by the `Page_Controller` and its inheriting controllers to be cached.

You can also override the policy in the inheriting controllers by explicitly applying a different policy. See the "Overriding" section in the module's README.

Again, refer to Content Security chapter for an indication on how to decide what is cacheable and what is not. If you are unsure - don't cache the resource.

### Customising static response headers

Although we recommend to stick with the CWP-configured headers for static files so that CWP operations can keep an eye on the site performance, you can customise these through your .htaccess file using Apache's mod_headers module.

As an example the following will apply a new "cache for 900 seconds" header to all static responses:

	<IfModule mod_headers.c>
		SetEnvIf Request_URI ".*.php$" NO_CACHE=true
		Header set Cache-Control "max-age=900, public" env=!NO_CACHE
	</IfModule>

## Incapsula Options

If you opt for the Premium Managed Service you will have an additional way to control the cache through your own Incapsula web-based dashboard. Please see the [Site performance settings](https://incapsula.zendesk.com/hc/en-us/articles/200627760-Site-performance-settings) in the Incapsula docs for more information.

The most important setting here is the "Caching mode". By default all sites are configured as **Static only**. This will cache content *mostly* according to the caching headers supplied by the webserver. There are some RFC-violating exceptions to the behaviour though - one of them is if there is any "Vary" header present other than "Accept-Encoding", the resource will not be cached at all. The "Static only" setting can be considered a safe default.

The **Static+dynamic** mode will trigger a proprietary algorithm that will try to cache also the content that the instance claims is non-cacheable. We are still testing this feature, so if you wish to use this mode we can only repeat Incapsula's assertion that this mode uses a learning algorithm to work out if the content is user-specific or not (see the Content Security chapter for potential dangers). This setting is potentially dangerous, unless the site is completely public information, or exceptions have been set.

The **Aggressive** mode will disregard headers completely and cache all responses for the specified period of time. This option should not be enabled on a site that serves any user-specific or confidential content (again, see Content Security chapter). This setting is dangerous unless the site is completely public information, or tightly controlled list of exceptions is in place. See the [Site performance settings](https://incapsula.zendesk.com/hc/en-us/articles/200627760-Site-performance-settings) for how to set exceptions.

Your Incapsula dashboard only controls handling of the responses from the publicly accessible domain. Content under "*.cwp.govt.nz" will not be affected by your changes - this conveniently includes the CMS admin area for the live site which shouldn't be retained in the cache.

You would need to reconsider your configuration if you ever decide to serve the CMS admin area from your public domain.

### FAQ

**Q: Can I leverage caching so that I can fit my site on a "small" instance?**

To a certain degree, yes - if you are just worried about infrequent but large spikes of traffic. However since Incapsula has a bandwidth cap as well as CWP, you should not use this scheme to regularly go over the bandwidth and throughput limits allocated for your instance size. If your site consistently breaches these we will need to to upgrade your instance.

**Q: What if I really don't want something cached?**

It depends on the headers supplied by your site and the Incapsula Options. If you absolutely don't want to cache something, you need to stick to "Static only" Incapsula setting (the default), and make sure you supply a Cache-Control header of "no-cache" and "max-age=0". These headers will be added by the default recipe on all Framework responses.

If you are using [silverstripe-controllerpolicy](https://github.com/mateusz/silverstripe-controllerpolicy) you can apply a `NoopPolicy` to cancel any implicit policy on a specific controller - see the module's README instructon under "Overriding policies".

**Q: What if I really want something cached?**

First and foremost you can provide appropriate response headers from the SilverStripe Framework - this way the content has a good chance to be cached either in the CWP internal proxy, or in the Incapsula.

You can use [silverstripe-controllerpolicy](https://github.com/mateusz/silverstripe-controllerpolicy) to configure the headers - apart from setting the `cacheAge` you can also remove the Vary header to get Incapsula to cache the response. Caution: make sure you understand what is the implication of removing the Vary header as it's potentially dangerous.

Another way to achieve this is by using "Aggressive" mode in Incapsula. This option is only good for public information sites that are cache-able in their entirety, or sites that have tightly controlled exception list. Otherwise you are at risk of leaking confidential content to the public. 

*If you have any other questions, please contact the Service Desk.*