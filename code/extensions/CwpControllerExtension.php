<?php
class CwpControllerExtension extends Extension {

	public function onBeforeInit() {
		// redirect some requests to the secure domain
		if(defined('CWP_SECURE_DOMAIN') && @$_SERVER['HTTP_X_FORWARDED_PROTOCOL'] != 'https') {
			Director::forceSSL(array('/^Security/'), CWP_SECURE_DOMAIN);
			// Note 1: the platform always redirects "/admin" to CWP_SECURE_DOMAIN regardless of what you set here
			// Note 2: if you have your own certificate installed, you can use your own domain, just omit the second parameter:
			//   Director::forceSSL(array('/^Security/'));
			//
			// See Director::forceSSL for more information.
		}

		// RestfulService needs to know about the CWP proxy when the site in live mode
		if(Director::isLive()) {
			Config::inst()->update('RestfulService', 'default_curl_options', array(
				CURLOPT_PROXY => 'gateway.cwp.govt.nz',
				CURLOPT_PROXYPORT => 8888
			));
		}
	}

}
