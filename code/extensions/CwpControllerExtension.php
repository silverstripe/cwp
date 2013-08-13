<?php
class CwpControllerExtension extends Extension implements PermissionProvider {

	public function onBeforeInit() {
		// redirect some requests to the secure domain
		if(defined('CWP_SECURE_DOMAIN') && !Director::is_https()) {
			Director::forceSSL(array('/^Security/', '/^api/'), CWP_SECURE_DOMAIN);
			// Note 1: the platform always redirects "/admin" to CWP_SECURE_DOMAIN regardless of what you set here
			// Note 2: if you have your own certificate installed, you can use your own domain, just omit the second parameter:
			//   Director::forceSSL(array('/^Security/', '/^api/'));
			//
			// See Director::forceSSL for more information.
		}

		// if there's a proxy setting in the environment, configure RestfulService to use it
		if(defined('SS_OUTBOUND_PROXY')) {
			Config::inst()->update('RestfulService', 'default_curl_options', array(
				CURLOPT_PROXY => SS_OUTBOUND_PROXY,
				CURLOPT_PROXYPORT => SS_OUTBOUND_PROXY_PORT
			));
		}

		// We turn on Basic Auth in testing mode, _except_ that we allow access to the change password
		// form for administrators
		if(Director::isTest()) {
			$allowWithoutAuth = false;

			// Allow whitelisting IPs for bypassing the basic auth.
			if (defined('CWP_IP_BYPASS_BASICAUTH')) {
				$remote = $_SERVER['REMOTE_ADDR'];
				$bypass = explode(',', CWP_IP_BYPASS_BASICAUTH);
				if (in_array($remote, $bypass)) {
					$allowWithoutAuth = true;
				}
			}

			// First, see if we can get a member to act on, either from a changepassword token or the session
			if (isset($_REQUEST['m']) && isset($_REQUEST['t'])) {
				$member = Member::get()->filter('ID', (int)$_REQUEST['m'])->First();
				if (!$member->validateAutoLoginToken($_REQUEST['t'])) $member = null;
			}
			else if (Session::get('AutoLoginHash')) {
				$member = Member::member_from_autologinhash(Session::get('AutoLoginHash'));
			}
			else {
				$member = Member::currentUser();
			}

			// Then, if they have the right permissions, check the allowed URLs
			if ($member && Permission::checkMember($member, 'ACCESS_UAT_SERVER')) {
				$allowed = array(
					'/^Security\/changepassword/',
					'/^Security\/ChangePasswordForm/'
				);

				$relativeURL = Director::makeRelative(Director::absoluteURL($_SERVER['REQUEST_URI']));

				foreach($allowed as $pattern) {
					$allowWithoutAuth = $allowWithoutAuth || preg_match($pattern, $relativeURL);
				}
			}

			// Finally if they weren't allowed to bypass Basic Auth, trigger it
			if (!$allowWithoutAuth) {
				BasicAuth::requireLogin("Please log in with your CMS credentials", 'ACCESS_UAT_SERVER', true);
			}
		}
	}

	function providePermissions() {
		return array(
			'ACCESS_UAT_SERVER' => 'Allow users to use their accounts to access the UAT server'
		);
	}

}
