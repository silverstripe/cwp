title: Caching
summary: Optimising site performance through caching
introduction: One of the most effective ways to realise performance gains on your site is through caching.

## What is caching?

Caching is the temporary storage of data so that future requests can be served more quickly. Caching works best by 
storing the output from a previous computation so it can then be reused for subsequent requests. For a deeper technical 
introduction to caching, see our ["How-to" guide](https://www.cwp.govt.nz/developer-docs/en/how_tos/caching). Below 
we'll explore the different ways we can cache data on SilverStripe websites to maximise performance.

### Server-side vs client-side caching

There are many layers where caching can be implemented; it can start with the client side (in the browser). With the 
correct use of 
[HTTP caching](https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/http-caching)
resources can be stored by browsers and re-used, removing the need for them to make duplicate requests to your site. 
Client-side caching will reduce load on your site as well as loading times for your end users. Additionally, this will 
allow Incapsula to cache more of your content, preventing unnecessary server processing.

Server side caching has many areas where optimisations can be made, from 
[MySQL's query cache](https://dev.mysql.com/doc/refman/5.7/en/query-cache.html)
to [template partial caching](https://docs.silverstripe.org/en/3/developer_guides/performance/partial_caching/). As 
developers we have varying degrees of control over how we can utilise these caches, as we'll explore in this article.

For this guide we'll be concentrating on caching within the SilverStripe application layer, though it's good to look
at how to avoid breaking the MySQL query cache.

### How to identify if a piece of code should be cached

One of the most important aspects of caching is being able to identify where caching is going to make a difference. 
We want to look out for code that's either doing a lot of computational work or that depends on other services that 
may be slow.

Spotting (the potential for) excessive computational work is fairly easy: you want to look out for looping and recursion.
In SilverStripe there are several patterns that are used frequently but are quite resource intensive.

#### Looping over DataLists

Looping over DataLists is unavoidable in SilverStripe. Typically you may see something like this:

```php
$houses = Hogwarts\House::get();
$prefects = ArrayList::create();
foreach ($houses as $house) {
	if ($house->Prefects()->exists()) {
		foreach ($house->Prefects() as $prefect) {
			$prefects->push($prefect);
		}
	}
}
return $prefects;
```

There could be at least 4 distinct database queries *per iteration* of this loop. As more classes are added, the number 
of queries will increase exponentially. While initial testing may not highlight any significant performance degradation,
if a site experiences high load the cost of these loops will be magnified.

In most instances the data that is returned will not change from one request to another, indicating that this is a 
perfect candidate for caching.

#### Looking through page hierarchies

Another typical action in SilverStripe is looping over hierarchies:

```php
function findRootParent() {
	$parent = $this;
	while ($parent->exists()) {
		$lastParent = $parent;
		$parent = $parent->Parent();
	}
	return $lastParent;
}
```

As with the previous example, this can be an expensive operation that increases at scale and will likely change 
infrequently for large pages.

## How to cache data

In SilverStripe we have two main approaches for caching. We can use either "manual" caching using the `SS_Cache` class 
or we can use the built-in template caching (known as "Partial Caching").

#### Caching with SS_Cache

SilverStripe comes with a built-in caching class called `SS_Cache` - you can read more about it in the [SilverStripe 
caching documentation](https://docs.silverstripe.org/en/3/developer_guides/performance/caching/). Caching in PHP 
(rather than the template) gives you extra flexibility over what and how you cache your data, allowing you to cache 
some data that you can do more work on later.

`SS_Cache` provides added flexibility and a more fine-grained control over caching in PHP. The `SS_Cache` class works 
as a text based key-value store, so anything you wish to cache has to be able to be saved as a string. This can cause
some isues when trying to store complex data types, such as `DataObject`s. Using one of the examples above we can do
something like this:

```php
function findRootParent() {
	$cache = SS_Cache::factory('rootparents');
	if (!$cache->test($this->ID)) {
		$parent = $this;
		whilst ($parent->exists()) {
			$lastParent = $parent;
			$parent = $parent->Parent();
		}
		$cache->save(serialize($lastParent), $this->ID);
	}
	return unserialize($cache->load($this->ID));
}
```

#### Caching in templates

Using `SS_Cache` provides a great deal of control over what's cached and how you utilise this cache, but there can 
often be optimisations made in the template to reduce loops and the cost of rendering. If we cache in the template 
layer then we are caching after all the work is done, which allows us to achieve the best performance gains.

Partial caching is covered extensively in 
[the core docs](https://docs.silverstripe.org/en/3/developer_guides/performance/partial_caching/).

#### Static caching

Static caching is the most aggressive form of caching and will result in the highest performance gains. Static caching
takes a copy of the page that is rendered and saves it to an HTML file. This file is then sent to a user's browser 
immediately. For a typical SilverStripe site this means reducing response times from hundreds of milliseconds to tens
of milliseconds.
 
When implementing static caching we can also push the entire site to Content Distribution Network (CDN) edge nodes, 
keeping large portions of server requests from ever hitting our servers at all. In CWP context, this would mean that 
Incapsula is serving all requests, minimising the potential for downtime due to server load.

##### Limitations of static caching

Total static caching can only be used in a few specific cases. Your site will only be suitable for static caching if 
there is no dynamic content on the site, including user login and forms.

If you have a dynamic area of your site but still wish to use some static caching, you can statically cache parts of 
your site and leave other parts uncached. You could investigate caching your most popular or busy pages while leaving
the others to be generated on request. This is the most common implementation of static caching.

##### Mostly static caching

Some modules that provide static caching functionality also provide a compromise where PHP can be used to add some 
minor dynamic behaviour without having SilverStripe handle the entire request-response cycle.

Here are some modules that can help:

- https://github.com/silverstripe/silverstripe-staticpublishqueue
- https://github.com/markguinn/silverstripe-livepub