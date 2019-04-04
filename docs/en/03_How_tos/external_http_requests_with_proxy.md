title: External HTTP requests with proxy
summary: How to access external  

# External HTTP requests with proxy


All CWP environments are positioned behind a proxy. All requests out to external services must go through this proxy.

By default, we configure the PHP environment with `http_proxy` and `https_proxy` environment variables, as well as the `SS_OUTBOUND_PROXY` and `SS_OUTBOUND_PROXY_PORT` constants. These environment variables can be used within your code to send requests through the proxy.

If you are seeing issues connecting to an external service, double check to make sure you are going through the proxy
(compare against the constants `SS_OUTBOUND_PROXY` and `SS_OUTBOUND_PROXY_PORT`).

Because of this proxy, outgoing requests have a different IP than configured for incoming requests to your CWP hostname.

If third party providers require whitelisting of IPs (for example on API requests performed through PHP on a CWP server),
please add the following IP addresses: 
* 202.55.102.136 
* 202.55.96.178

You can look up the implementation details in the `CwpInitialisationFilter` in the `cwp-core` module.

## Known limitations

Requests to internally resolved CWP hostnames will fail to connect when using the proxy.
Additionally requests over https (i.e. https://yourstack-uat.cwp.govt.nz) will fail to connect to the webserver via the CWP proxy and will fail without using the proxy too. We recommend adding a custom domain to the stack via the [CWP Service Desk](https://www.cwp.govt.nz/service-desk) and using that instead (i.e. yourstack-test.govt.nz). This will ensure that the request is resolved via external DNS.

## Stream-based requests

Stream-based requests however will need extra manual configuration. For example, the following will not work, resulting
in a "Connection refused" error:

```php
echo file_get_contents('http://www.silverstripe.org/blog/rss');
```

We can modify it to use the proxy. Proxy URL on CWP environments is provided via `SS_OUTBOUND_PROXY` define, and port is
provided via `SS_OUTBOUND_PROXY_PORT`. We can check for the existence of these so we are not forced to use the proxy on
the development machine:

```php
// use proxy if the environment file has a proxy definition
if(Environment::getEnv('SS_OUTBOUND_PROXY') && Environment::getEnv('SS_OUTBOUND_PROXY_PORT')) {
    $context = stream_context_create([
        'http' => [
            'proxy' => sprintf('tcp://%s:%s', Environment::getEnv('SS_OUTBOUND_PROXY'), Environment::getEnv('SS_OUTBOUND_PROXY_PORT')),
            'request_fulluri' => true
        ]
    ]);
    
    echo file_get_contents('http://www.silverstripe.org/blog/rss', false, $context);
} else {
    echo file_get_contents('http://www.silverstripe.org/blog/rss');
}
```

## Disabling egress proxy

In some situations you might want to disable the proxy for requests that remain within the CWP network. You can do it by customising cURL configuration per request:

```php
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, false);
curl_setopt($ch, CURLOPT_PROXYPORT, false);
curl_setopt($ch, CURLOPT_URL, '<non-proxied-URL>');
echo curl_exec($ch);
```

You can also disable automatic proxy configuration globally by putting the following in one of your config files:

```yaml
---
Name: mysiteconfig
After: '#cwpcoreconfig'
---
CWP\Core\Control\InitialisationMiddleware:
  egress_proxy_default_enabled: false
```

## Excluding domains from egress proxy

It's possible to exclude just some domains from being forced through the proxy if disabling it completely is not
desirable. By default this is used by the Solr and Docvert services internal to CWP. The configuration can be appended
to as follows:

```yaml
---
Name: mysiteconfig
After: '#cwpcoreconfig'
---
CwpInitialisationFilter:
  egress_proxy_exclude_domains:
    - somewhere.cwp.govt.nz
```

<div class="alert alert-warning" markdown='1'>
Regardless of the excluded domains in your configuration, any external request not passed through the proxy will result in a 400-type error response code.
</div> 

## Troubleshooting external requests
If you're unable to make a connection to an external endpoint, verify that your request is being set with the `SS_OUTBOUND_PROXY` and `SS_OUTBOUND_PROXY_PORT` constants. You can use the [`curl_getinfo`](http://php.net/manual/en/function.curl-getinfo.php) function to see what configuration was used for the request.

Some third-party libraries like Guzzle may not automatically configure the proxy, meaning you'll need to ensure the environment variables are used when initialising the client:

```php
use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;

$proxy = null;
if(!Director::isDev()) {
    $proxy = sprintf('%s:%s', Environment::getEnv('SS_OUTBOUND_PROXY'), Environment::getEnv('SS_OUTBOUND_PROXY_PORT'));
}

$client = new GuzzleHttp\Client([
    'proxy' => $proxy
]);
```

If you're still not able to make external requests and have confirmed that your requests are using the CWP proxy settings, please raise a ticket via the [CWP Service Desk](https://www.cwp.govt.nz/service-desk) and include: 
* the URL of the external service you're attempting to connect to
* the relevant portion of code making the external request
* steps to reproduce the issue, such as a URL or the name of a BuildTask
