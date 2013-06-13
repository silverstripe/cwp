<?php

/**
 * TODO: describe.
 * TODO: bug when using default admin - always shows the message...
 * Requires Security::login_recording config to be set to true.
 */

class LoginAttemptNotifications_LeftAndMain extends Extension {

	function init() {

		// Exclude default admin.
		$member = Member::currentUser();
		if (!$member || !$member->ID) return;

		$message = null;

		Requirements::javascript('cwp/javascript/LoginAttemptNotifications.js');
		$sessionLastVisited = Session::get('LoginAttemptNotifications.SessionLastVisited');
		if ($sessionLastVisited) {
			// Session already in progress. Show all attempts since the session was last visited.
			
			$meantimeLoginAttempts = LoginAttempt::get()->filter(array(
				'MemberID' => $member->ID,
				'Created:GreaterThan' => $sessionLastVisited
			));

			$attempts = $meantimeLoginAttempts->count();
			if ($attempts) {

				$lastVisitedObj = new SS_Datetime();
				$lastVisitedObj->setValue($sessionLastVisited);
				$elapsed = $lastVisitedObj->TimeDiff();
				$failures = $meantimeLoginAttempts->filter(array('Status' => 'Failure'))->count();
				$IPs = array_unique($meantimeLoginAttempts->column('IP'));

				if ($attempts==1) {

					$statusString = $failures ? "a failed" : "a successful";
					$message = "In the last $elapsed $statusString login attempt to your account was registered. The attempt was made from ${IPs[0]}. ";

				} else {

					if ($failures==$attempts) {
						$statusString = $failures ? "failed" : "successful";
						$message = "In the last $elapsed $attempts $statusString login attempts to your account were registered. ";
					} else {
						$message = "In the last $elapsed $attempts login attempts to your account were registered, of which $failures failed. ";
					}

					$message .= "The attempts were from " . implode(', ', $IPs) . '. ';

					// TODO: add this call to action in a way that doesn't break out of the availabel space. Fix CSS?
					// $message .= "If you suspect somebody else might be trying to access your account, please contact support.";


				}

			}

		} else {

			// New session - show last login attempt.
			// TODO: this currently does NOT surface to the frontend in any way.
			$lastLoginAttempt = LoginAttempt::get()->filter(array(
				'MemberID' => $member->ID
			))->sort('Created DESC')->First();

			if ($lastLoginAttempt) {
				$date = $lastLoginAttempt->Created;
				$message = "Last login attempt to your account was on $lastLoginAttempt->Created from $lastLoginAttempt->IP";
				$message .= $lastLoginAttempt->Status=='Failure' ? " and was successful." : "and has failed.";
			}

		}

		Session::set('LoginAttemptNotifications.SessionLastVisited', SS_Datetime::now()->Format('Y-m-d H:i:s'));

		$this->owner->response->addHeader('X-LoginAttemptNotifications', $message);
	}

}
