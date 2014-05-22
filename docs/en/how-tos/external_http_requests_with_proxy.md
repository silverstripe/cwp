<!--
title: External HTTP requests with proxy
-->

# External HTTP requests with proxy

Sometimes you'll be needing to make external requests to sites on the internet from your site. A simple example of this
is fetching tweets to show on your website. All CWP environments are positioned behind a proxy. You need to be aware of
that if you are making egress requests without using curl nor `RestfulService`.

By default, we configure the PHP environment with `http_proxy` and `https_proxy` variables which will be automatically
picked up by curl. This means both `RestfulService` and any curl requests made by upstream modules should work out of
the box.

You can look up the implementation details in the `CwpInitialisationFilter` in the `cwp-core` module.

## Stream-based requests

Stream-based requests however will need extra manual configuration. For example the following will not work, resulting
in a "Connection refused" error:

	:::php
	echo file_get_contents('http://www.silverstripe.org/blog/rss');

We can modify it to use the proxy. Proxy URL on CWP environments is provided via `SS_OUTBOUND_PROXY` define, and port is
provided via `SS_OUTBOUND_PROXY_PORT`. We can check for the existence of these so we are not forced to use the proxy on
the development machine:

	:::php
	// use proxy if the environment file has a proxy definition
	if(defined('SS_OUTBOUND_PROXY') && defined('SS_OUTBOUND_PROXY_PORT')) {
		$context = stream_context_create(array(
			'http' => array(
				'proxy' => sprintf('tcp://%s:%s', SS_OUTBOUND_PROXY, SS_OUTBOUND_PROXY_PORT),
				'request_fulluri' => true
			)
		));
		
		echo file_get_contents('http://www.silverstripe.org/blog/rss', false, $context);
	} else {
		echo file_get_contents('http://www.silverstripe.org/blog/rss');
	}

## Disabling egress proxy

In some situations you might want to disable the proxy. You can do it by customising curl configuration per request:

	:::php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_PROXY, false);
	curl_setopt($ch, CURLOPT_PROXYPORT, false);
	curl_setopt($ch, CURLOPT_URL, '<non-proxied-URL>');
	echo curl_exec($ch);

You can also disable automatic proxy configuration globally by putting the following in one of your config files:

	:::yml
	---
	Name: mysiteconfig
	After: '#cwpcoreconfig'
	---
	CwpInitialisationFilter:
	  egress_proxy_default_enabled: false
