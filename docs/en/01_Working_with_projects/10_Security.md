title: Security
summary: Considerations and steps to keep your website secure.

# Security

This section describes security considerations, as well as additional steps that may be taken to further secure a
website.

### API endpoint

By default the SilverStripe API endpoint is exposed publicly, to lock down access to the API endpoint you can add
the following to your `mysite/_config/api.yml` file:

```yaml
CWP\CWP\PageTypes\BasePage:
  api_access: false
```

## User login considerations

### Login auto-completion

By default CMS users are able to save login credentials in their browser password store when logging into a website.
If necessary, this auto-completion may be disabled by setting the `SilverStripe\Security\Security.remember_username`
setting to false.

In your `mysite/_config/config.yml` file, add the following:

```yaml
SilverStripe\Security\Security:
  remember_username: false
```

Note that if a user has already saved their username and/or password prior to changing this value,
it may be necessary to reset their browser auto-complete history before this will take effect.

### User session expiration

After logging in, any user will remain in an active state as long as there is no extended period of inactivity.
In order to reduce the risk that active browser sessions may be exploited, it may be necessary
to reduce the timeout period for each session. By default, active sessions will expire after 24 minutes of inactivity.
This value may be adjusted by setting the `SilverStripe\Control\Session.timeout` value (in units of seconds).

For instance, to set the session timeout to 10 minutes add the following to your `mysite/_config/config.yml` file:

```yaml
SilverStripe\Control\Session:
  timeout: 600
```
Note: Setting this value to zero will instead terminate the session when the user closes their browser window,
but this does not enforce any maximum session duration.

Note: This value adjusts how long a users _browser_ remembers the session. To adjust how long the server remembers
sessions you will have to adjust your `php.ini` configuration setting `session.gc_lifetime`. More information can be
found at [php's session configuration page](http://www.php.net/manual/en/session.configuration.php#ini.session.cookie-lifetime).
A lifetime of 24 minutes matches the default timeout configuration on CWP.

### Saved user logins

Users have the option to check a box during login labeled "Remember me next time?".
If checked, that user will remain logged into the site even after the browser has been closed, and will be
automatically logged in when they come back at a later time, up to a maximum period of 90 days.

If the computer used is not physically secured, it may be necessary to disable this feature to prevent
subsequent users from automatically logging in and impersonating someone else. This is done by setting
the `SilverStripe\Security\Security.autologin_enabled` setting to false.

In your `mysite/_config/config.yml` file, add the following:

```yaml
SilverStripe\Security\Security:
  autologin_enabled: false
```

If the browser is closed, and the session has expired, subsequent attempts to access secured content
will require a username and password.

## File upload restrictions

The `SilverStripe\Assets\File.allowed_extensions` config value specifies the list of all file types allowed to be saved into
the assets folder. By default this includes file types such as html, and in some cases it may represent a
security risk to allow these file types. See the
[OWASP wiki on File Upload](https://www.owasp.org/index.php/Unrestricted_File_Upload) for details.

Individual extensions may be added using this configuration in your `mysite/_config/mimetypes.yml` file:

```yaml
SilverStripe\Assets\File:
  allowed_extesions:
    - xhtml
    - xml
```

Uploaded files have their extension checked against known MIME types in the `HTTP.MimeTypes` config setting.
This basically means the file contents are checked to ensure the extension matches. For example, if you rename an image
`test.jpg` to `test.txt` and attempt to upload it, the file will be rejected.

Please see [technical docs for adding extensions](../how_tos/adding_an_allowed_extension) for more information on
allowing new file extensions and MIME types.

### Front-end authentication

If it's necessary to require secure authentication to certain areas of the front end (such as
password protected forms or information) then there are some configuration changes that must be made.

By default all attempts to access secure pages will redirect the user to an SSL protected domain
specific to that environment (e.g. mystack.cwp.govt.nz). This is in place in order to prevent
users wishing to access the CMS having to log in for each individual domain, as well as the
dependency on each domain having its own SSL certificate.

In the case that the user wishes to access content on the front-end of a specific domain, however,
it's necessary that the user logs into that one, rather than the designated secure login domain.

To disable the redirection add the following to `mysite/_config/security.yml`:

```yaml
---
Name: mysitesecurity
After: '#cwpsslredirectdomain'
---
SilverStripe\Core\Injector\Injector:
  SilverStripe\Control\Middleware\CanonicalURLMiddleware:
    properties:
      ForceSSLDomain: false
```

In this case it is necessary to ensure that an SSL certificate has been purchased and configured
for each domain. If you are unsure, contact the [CWP Service Desk](https://www.cwp.govt.nz/service-desk/).

Alternatively, you can completely disable SSL redirection by setting the 
`CanonicalURLMiddleware.ForceSSL` property to false via Injector configuration (as in the example above),
however any data accessed or submitted by users would be unencrypted.
