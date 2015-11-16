<!--
title: Outbound server requests
-->

# Outbound server requests
All requests out to external services must go through the CWP proxy.

This is automatically configured by the cwp-core module and picked up by PHP's curl library.

If you are seeing issues connecting to an external service, double check to make sure you are going through the proxy
(compare against the constants SS_OUTBOUND_PROXY and SS_OUTBOUND_PROXY_PORT).

Because of this proxy, outgoing requests have a different IP than configured for incoming requests to your CWP hostname.

If third party providers require whitelisting of IPs (for example on API requests performed through PHP on a CWP server),
please add the following IP: 202.55.102.136.

### Related documentation
[Making external HTTP requests via the CWP proxy](/guides/core-technical-documentation/common-web-platform-core/en/how-tos/external_http_requests_with_proxy)