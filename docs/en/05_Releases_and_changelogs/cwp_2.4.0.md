# 2.4.0

## New features

The [release announcement](#) includes the note worthy features, but be sure to review the change log for full detail.

### HTTP Strict Transport Security Headers

The [HTTP Strict Transport Security](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security) (HSTS)
headers are an important security mechanism to reduce the chance of man-in-the-middle
attacks, by signaling to browsers that requests to the site should always
be encrypted (via accessing on the `https://` protocol).

CWP environments can always be accessed
via SSL, either through agency-provided certificates, or free certificates
provided through the Let's Encrypt service ([details](https://www.cwp.govt.nz/working-with-cwp/instance-management/ssl-certificates/)).
CWP websites already enforce the `https://` protocol for authenticated requests,
e.g. to `Security/*` and `admin/*`.

Until now, securing your site with HSTS has been a [secure coding](https://docs.silverstripe.org/en/4/developer_guides/security/secure_coding/)
recommendation in SilverStripe. New projects starting with CWP 2.4 will
automatically be configured to send HSTS headers, and redirect all requests to `https://`.

Existing projects can opt-in to this behaviour by copying
the new default configuration into their existing projects:
[app/_config/security.yml](https://github.com/silverstripe/cwp-installer/blob/master/app/_config/security.yml). 

Note: This will only secure requests to SilverStripe.
In order to protect access to static assets,
consider adding HSTS headers to your `.htaccess` file,
and ensure that every environment (incl. local development)
are able to serve your site on the `https://` protocol.

There are other HTTP security headers that you should consider
to increase the security of your site. We recommend that you scan
your site on [securityheaders.com/](https://securityheaders.com/)
and implement additional headers depending on your use case
through `.htaccess` configuration. 

Since SilverStripe is an extensible system, modules added
to your website or CMS might embed resources from other domains
which influence the settings on your particular website.
Common examples are videos embedded from youtube.com,
analytics loaded from google-analytics.com,
or captchas provided through spam protection modules
and loaded e.g. from google.com.

See [Working with Projects: Security](/working_with_projects/security) for more details.