title: External HTTP requests with proxy
summary: How to access external  

# External HTTP requests with proxy


All CWP environments are positioned behind a proxy. All requests out to external services must go through this proxy.

By default, we configure the PHP environment with `http_proxy` and `https_proxy` variables which will be automatically
picked up by curl. This means both `RestfulService` and any curl requests made by upstream modules should work out of
the box.

If you are seeing issues connecting to an external service, double check to make sure you are going through the proxy
(compare against the constants SS_OUTBOUND_PROXY and SS_OUTBOUND_PROXY_PORT).

Because of this proxy, outgoing requests have a different IP than configured for incoming requests to your CWP hostname.

If third party providers require whitelisting of IPs (for example on API requests performed through PHP on a CWP server),
please add the following IP addresses: 202.55.102.136 and 202.55.96.178.

You can look up the implementation details in the `CwpInitialisationFilter` in the `cwp-core` module.

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

In some situations you might want to disable the proxy. You can do it by customising curl configuration per request:

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
