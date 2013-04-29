# External HTTP requests with proxy

Sometimes you'll be needing to make external requests to sites on the internet from your site. A simple example of this
is fetching tweets to show on your website.

Sites running on the platform cannot make direct HTTP connections to internet, so the way around that is to use a proxy
server. Fortunately the platform provides one, however you'll need to modify your code so it knows how to contact it.

Let's take an example of fetching tweets from the SilverStripe Twitter account:

	:::php
	echo file_get_contents('http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=silverstripe');

The above code will fail on the platform, resulting in a "Connection refused" error.

Let's modify that a bit to use the proxy, located at `gateway.cwp.govt.nz` on port `8888`:

	:::php
	$context = stream_context_create(array(
		'http' => array(
			'proxy' => 'tcp://gateway.cwp.govt.nz:8888',
			'request_fulluri' => true
		)
	));
	
	echo file_get_contents('http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=silverstripe', false, $context);

The above code will now successfully return the tweets, as the proxy is now configured with `file_get_contents()`.

The same proxy settings can be applied to other HTTP clients in PHP. Using cURL, for example: 

	:::php
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_PROXY, 'gateway.cwp.govt.nz');
	curl_setopt($ch, CURLOPT_PROXYPORT, 8888);
	curl_setopt($ch, CURLOPT_URL, 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=silverstripe');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	echo curl_exec($ch);

Note that the proxy settings won't work if you're running your site on a local development environment not hosted on
the platform, so you'll need to modify your code to work without the proxy settings as well. One simple way would be
using `Director::isDev()` like this:

	:::php
	// use proxy if the site is in test or live mode
	if(!Director::isDev()) {
		$context = stream_context_create(array(
			'http' => array(
				'proxy' => 'tcp://gateway.cwp.govt.nz:8888',
				'request_fulluri' => true
			)
		));
		
		echo file_get_contents('http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=silverstripe', false, $context);
	} else {
		echo file_get_contents('http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=silverstripe');
	}