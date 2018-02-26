title: Caching
summary: Optimising site performance through caching
introduction: One of the most effective ways to realise performance gains on your site is through caching.

## What is caching?

Caching is the temporary storage of data so that future requests can do less work.
It can make a major difference to both user experience and stability of your CWP website.
As a CWP developer, it is crucial to understand both SilverStripe and CWP infrastructure
capabilities for caching, in addition to following general best practices around caching.

## What should I cache?

One of the most important aspects of caching is being able to identify where caching is going to make a difference.
Spotting excessive computational work is fairly easy: you want to look out for looping and recursion.
In SilverStripe there are several patterns that are used frequently that are quite resource intensive.

 * Looping over large `DataList` collections (e.g. via `SiteTree::get()`)
 * Using (potentially large) relation getters on `DataObject` (has_many and many_many)
 * Nesting relation getters within loops on large `DataList` collections
 * Using expensive SQL join operations
 * Network calls to third party services (see [Deferring Work](deferring_work))
 * Frequent filesystem access

We'll describe common caching approaches below. You'll want to apply a layered approach to
caching to get the best results, and combine multiple approaches.

## HTTP Caching in the browser

The fastest server request is one that's never made.
With the correct use of [HTTP Caching](http_caching), resources can be stored by browsers for a defined amount of time.
This applies both to "static" resources likes images and JavaScript files, as well as dynamic requests coming from SilverStripe.
Client-side caching will reduce load on your site as well as loading times for your end users.

Read more about [Frontend Performance Best Practices](frontend_best_practices) in our CWP Performance Guide.

## HTTP Caching on the server

In the same way that you can instruct browsers on how to cache,
intermediary caching layers in CWP can help you avoid making fully dynamic requests.
If your site serves the same content to all visitors, this is the easiest way to get more performance.
You can only cache a full response, so this approach isn't suitable for granular caching strategies
or personalised content.

Read more about [HTTP Caching](http_caching) in our CWP Performance Guide.

## Object Caching with SS_Cache

SilverStripe comes with a built-in caching class called `SS_Cache`. Caching in PHP
(rather than the template) gives you extra flexibility over what and how you cache your data, allowing you to cache
some data that you can do more work on later. `SS_Cache` provides fine-grained control: The `SS_Cache` class works
as a text based key-value store, so anything you wish to cache has to be able to be saved as a string.

Here's an example of a potentially expensive recursion method, commonly used to create breadcrumbs on a page.
We create a 'rootparents' cache store, and set the cache key to the `$ID` of the current page.
The cache stores the serialised root element. If a cache entry already exists, we'll return it instead
of doing the expensive calculation again. Each cache has a default expiry time which can be customised.

```php
function findRootParent() 
{
	$cache = SS_Cache::factory('rootparents');
	if (!$cache->test($this->ID)) {
		$parent = $this;
		while ($parent->exists()) {
			$lastParent = $parent;
			$parent = $parent->Parent();
		}
		$cache->save(serialize($lastParent), $this->ID);
	}
	return unserialize($cache->load($this->ID));
}
```

Read more about [Object Caching](https://docs.silverstripe.org/en/4/developer_guides/performance/caching/)
on docs.silverstripe.org.

## Template Caching ("Partial Caching")

Using `SS_Cache` provides a great deal of control over what's cached and how you utilise this cache, but there can
often be optimisations made in the template to reduce loops and the cost of rendering. If we cache in the template
layer then we are caching after all the work is done, which allows us to achieve the best performance gains.

Here's an example of an expensive nested loop over a `DataList`.
It'll execute at least four database queries per iteration.
You better hope there's not too many `House` records,
or your visitors will start to notice longer rendering times.


```php
public function getPrefectsList()
{
	$houses = Hogwarts\House::get();
	$prefects = [];
	foreach ($houses as $house) {
		if ($house->Prefects()->exists()) {
			foreach ($house->Prefects() as $prefect) {
				$prefects[] = $prefect->Title;
			}
		}
	}
	return join(',', $prefects);
}
```

This might be used in a template through `$PrefectsList`,
causing lots of database queries even though the response is the same for every visitor.

By wrapping this template logic in a `<% cached %>` tag,
you are only executing this expensive calculation every 10 minutes
(the default cache lifetime). More sophisticated cache logic is possible.

Read more about
[Partial Caching](https://docs.silverstripe.org/en/4/developer_guides/performance/partial_caching/) on docs.silverstripe.org


## Static caching on the server

Static caching is similar to HTTP Caching on the server. It takes a copy of the page that is rendered and saves
it to an HTML file. Cached files are then used to respond to user requests without hitting the SilverStripe
application layer. In contrast to HTTP Caching, you have full control over when when these files expire:
You can regenerate them on every publish and serve new content straight away to visitors,
without waiting for an intermediary cache layer to expire. Similarly to HTTP Caching,
this approach relies on sending the same response to all of your visitors.

A common way to implement static caching in SilverStripe is the
[Static Publisher with Queue module](https://github.com/silverstripe/silverstripe-staticpublishqueue).
With this module, you'll need to define dependencies between pages
to ensure accuracy, making static caching a relatively advanced technique.

This approach can also be combined with HTTP Caching for maximum effect:
In this scenario, the generated HTML files are further cached in intermediary layers.

*Limitations*: Total static caching can only be used in a few specific cases.
Your site will only be suitable for static caching if
there is no dynamic content on the site, including user login and forms.

If you have a dynamic area of your site, but still wish to use some static caching, you can statically cache parts of
your site and leave other parts uncached. You could investigate caching your most popular or busy pages while leaving
the others to be generated on request. This is the most common implementation of static caching.

## Mostly static caching on the server

Both HTTP Caching and Static Caching rely on serving the same content to all visitors.
If your website is mostly cacheable, but you have minor dynamic behaviour such as a "logged in" menu indicator,
you can use the best of both worlds: Generate static HTML content once for all visitors,
but run the response through a lightweight SilverStripe PHP request in order to add dynamic bits to the response.
You can do this with the [Static Publisher with Queue module](https://github.com/silverstripe/silverstripe-staticpublishqueue)
module as well as the [LivePub module](https://github.com/markguinn/silverstripe-livepub).

## Next

Continue to our performance guide on [HTTP Caching](http_caching)
