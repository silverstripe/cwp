title: Security
summary: Considerations and steps to keep your website secure.

# Security

This section describes security considerations, as well as additional steps that may be taken to further secure a
website.

### API endpoint

By default the SilverStripe API endpoint is exposed publicly, to lock down access to the API endpoint you can add `Config::inst()->remove('BasePage', 'api_access');Config::inst()->remove('BasePage', 'api_access');` to your `_config.php` file.

## User login considerations

### Login auto-completion

By default CMS users are able to save login credentials in their browser password store when logging into a website.
If necessary, this auto-completion may be disabled by setting the `Security.remember_username` setting to false.

In your `mysite/_config/config.yml` file, add the following:

	:::yml
	Security:
	  remember_username: false

Note that if a user has already saved their username and/or password prior to changing this value,
it may be necessary to reset their browser auto-complete history before this will take effect.

### User session expiration

After logging in, any user will remain in an active state as long as there is no extended period of inactivity.
In order to reduce the risk that active browser sessions may be exploited, it may be necessary
to reduce the timeout period for each session. By default, active sessions will expire after 1 hour of inactivity.
This value may be reduced by setting the `Session.timeout` value (in units of seconds) to a shorter interval.

For instance, to set the session timeout to 10 minutes add the following to your `mysite/_config/config.yml` file:

	:::yml
	Session:
	  timeout: 600

Note: Setting this value to zero will instead terminate the session when the user closes their browser window,
but this does not enforce any maximum session duration.

More information can be found at [php's session configuration page](http://www.php.net/manual/en/session.configuration.php#ini.session.cookie-lifetime)

### Saved user logins

Users have the option to check a box during login labeled "Remember me next time?".
If checked, that user will remain logged into the site even after the browser has been closed, and will be
automatically logged in when they come back at a later time, up to a maximum period of 90 days.

If the computer used is not physically secured, it may be necessary to disable this feature to prevent
subsequent users from automatically logging in and impersonating someone else. This is done by setting
the `Security.autologin_enabled` setting to false.

In your `mysite/_config/config.yml` file, add the following:

	:::yml
	Security:
	  autologin_enabled: false

If the browser is closed, and the session has expired, subsequent attempts to access secured content
will require a username and password.

## File upload restrictions

The `File.allowed_extensions` config value specifies the list of all file types allowed to be saved into
the assets folder. By default this includes file types such as html, and in some cases it may represent a
security risk to allow these file types. See the
[OWASP wiki on File Upload](https://www.owasp.org/index.php/Unrestricted_File_Upload) for details.

Individual extensions may be removed using this code in your `mysite/_config.php` file

	:::php
	// Remove html, htm, xhtml, and xml extensions from File.allowed_extensions
	$extensions = array_diff(File::config()->allowed_extensions, array('html', 'htm', 'xhtml', 'xml'));
	Config::inst()->remove('File', 'allowed_extensions'); // Prevents config from merging the old array
	Config::inst()->update('File', 'allowed_extensions', $extensions);

Uploaded files have their extension checked against known MIME types in the `HTTP.MimeTypes` config setting.
This basically means the file contents are checked to ensure the extension matches. For example, if you rename an image
`test.jpg` to `test.txt` and attempt to upload it, the file will be rejected.

Please see [technical docs for adding extensions](how-tos/adding_an_allowed_extension) for more information on
allowing new file extensions and MIME types.

### Front-end authentication

If it's necessary to require secure authentication to certain areas of the front end (such as
password protected forms or information) then there are some configuration changes that must be made.

By default all attempts to access secure pages will redirect the user to an SSL protected domain
specific to that instance (e.g. myinstance.cwp.govt.nz). This is in place in order to prevent
users wishing to access the CMS having to log in for each individual domain, as well as the
dependency on each domain having its own SSL certificate.

In the case that the user wishes to access content on the front-end of a specific domain, however,
it's necessary that the user logs into that one, rather than the designated secure login domain.

To disable the redirection add the following to `mysite/_config/config.yml`:

	:::yml
	CwpControllerExtension:
	  ssl_redirection_force_domain: false


In this case it is necessary to ensure that an SSL certificate has been purchased and configured
for each domain. If you are unsure, contact the [Service Desk](https://www.cwp.govt.nz/service-desk/).

Alternatively, you can completely disable SSL redirection by setting the 
`CwpControllerExtension.ssl_redirection_enabled` config to false instead, however any data
accessed or submitted by users would be unencrypted.
