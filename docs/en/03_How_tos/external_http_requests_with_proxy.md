title: External HTTP requests with proxy
summary: How to access external resources via the CWP proxy.

# External HTTP requests with proxy

All requests to resources outside of your stack must use a proxy. CWP environments have no direct, unproxied HTTP connectivity out to the internet nor to other CWP stacks internally.

## Explicit configuration

To explicitly configure the proxy when making external HTTP requests, use the `SS_OUTBOUND_PROXY` and `SS_OUTBOUND_PROXY_PORT` PHP constants provided. Configuration of the outgoing proxy is dependent on the library you are using, so please consult relevant documentation.

For example curl can be configured by setting the `CURLOPT_PROXY` option via `curl_setopt` before making the actual request.

If your library does not expose proxy configuration, you might be able to force it by configuring `http_proxy` and `https_proxy` environment variables through PHP's `putenv`. See [`InitialisationMiddleware`](https://github.com/silverstripe/cwp-core/blob/2/src/Control/InitialisationMiddleware.php) for a more specific code example.

## Special case: curl from request handlers

Plain `curl` requests will work out of the box, as long as you are making them from within request handlers (this might work for other libraries too).

This is because the [`InitialisationMiddleware`](https://github.com/silverstripe/cwp-core/blob/2/src/Control/InitialisationMiddleware.php) sets the `http_proxy` and `https_proxy` environment variables automatically during the request execution.

For requests made outside of request handling pipeline, you have to fall back to explicit library configuration.

## Originating IP

Outgoing requests originate at the proxy. This means they have an origin IP different from your stack's IP.

If third party providers require whitelisting of IPs (for example on API requests performed through PHP on a CWP server), use CWP global proxy origin IPs:

* 202.55.102.136 
* 202.55.96.178
* 220.247.132.110
* 103.253.48.27
* 220.247.133.24
* 103.253.48.56

Proxy origin IPs are shared by all stacks on CWP, which may be important during your solution's security assessment.


## A note on `fopen()` and `file_get_contents()`

<div class="alert alert-warning" markdown='1'>
Use of `fopen()` and `file_get_contents()` to retrieve remote content are discouraged - and are disabled by default on new CWP stacks - due to security risks.
</div>

Instead, CWP recommends using cURL commands, or ideally using a PHP library such as [Guzzle](https://github.com/guzzle/guzzle).

## Disabling the proxy

For CWP customers, there is no reason to disable the outgoing CWP proxy. 

Even if certain requests seem to work without the proxy, CWP is not able to guarantee continued operation of non-proxy connectivity.

The only valid use case for proxy being disabled on stacks is for interfacing with platform internals. This is purposefully designed into the recipe components. You should never need to do it yourself.

## Troubleshooting external requests

If you're unable to make a connection to an external endpoint, verify that your request is being set with the `SS_OUTBOUND_PROXY` and `SS_OUTBOUND_PROXY_PORT` constants. You can use the [`curl_getinfo`](http://php.net/manual/en/function.curl-getinfo.php) function to see what configuration was used for the request.

Some third-party libraries like Guzzle may not automatically configure the proxy, meaning you'll need to ensure the appropriate constants are used when initialising the client:

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
