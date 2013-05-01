<?php
class CwpLogger extends SiteTreeExtension {

	const PRIORITY = 6;

	public static function bind_manipulation_capture() {
		global $databaseConfig;

		$current = DB::getConn();
		if (!$current || @$current->isManipulationLoggingCapture) return; // If not yet set, or its already captured, just return

		$type = get_class($current);;
		$file = TEMP_FOLDER . "/.cache.CLC.$type";
		$dbClass = 'CwpLoggerManipulateCapture_' . $type;

		if (!is_file($file)) {
			file_put_contents($file, "<?php
				class $dbClass extends $type {
					public \$isManipulationLoggingCapture = true;

					function manipulate(\$manipulation) {
						CwpLogger::handle_manipulation(\$manipulation);
						\$res = parent::manipulate(\$manipulation);
						return \$res;
					}
				}
			");
		}

		require_once($file);

		$captured = new $dbClass($databaseConfig);
		// The connection might have had it's name changed (like if we're currently in a test)
		$captured->selectDatabase($current->currentDatabase());
		DB::setConn($captured);
	}

	public static function handle_manipulation($manipulation) {
		$currentMember = Member::currentUser();
		if(!($currentMember && $currentMember->exists())) return false;

		foreach($manipulation as $table => $details) {
			// logging writes to specific tables (just not when logging in, as it's noise)
			if(in_array($table, array('Member', 'Group', 'SiteTree_Live')) && !preg_match('/Security/', @$_SERVER['REQUEST_URI'])) {
				if($table == 'SiteTree_Live') {
					$data = SiteTree::get()->byId($details['id']);
				} else {
					$data = $table::get()->byId($details['id']);
				}

				if(!$data) continue;

				if($table == 'SiteTree_Live') {
					$actionText = 'published a page';
				} else {
					$actionText = 'modified ' . $table;
				}

				self::log(sprintf(
					'"%s" (ID: %s) %s (ID: %s, ClassName: %s, Title: "%s")',
					$currentMember->Email ?: $currentMember->Title,
					$currentMember->ID,
					$actionText,
					$details['id'],
					$data->ClassName,
					$data->Title
				));
			}

			// logging adding members to a group
			if($table == 'Group_Members') {
				$member = Member::get()->byId($details['fields']['MemberID']);
				$group = Group::get()->byId($details['fields']['GroupID']);

				// if the user isn't already in the group, log they've been added
				if(!DB::query(sprintf(
					'SELECT "ID" FROM "Group_Members" WHERE "GroupID" = %s AND "MemberID" = %s',
					$details['fields']['GroupID'],
					$details['fields']['MemberID']
				))->value()) {
					self::log(sprintf(
						'"%s" (ID: %s) added "%s" (ID: %s) to Group "%s" (ID: %s)',
						$currentMember->Email ?: $currentMember->Title,
						$currentMember->ID,
						$member->Email ?: $member->Title,
						$member->ID,
						$group->Title,
						$group->ID
					));
				}
			}
		}
	}

	/**
	 * Log the message, {@link CwpLoggerFormatter} will format the log line entry
	 * with IP address and date before writing to the log file.
	 */
	protected static function log($message) {
		if(isset($_SERVER['HTTP_REFERER'])) $message .= sprintf(' (Referer: %s)', $_SERVER['HTTP_REFERER']);
		SS_Log::log($message, self::PRIORITY);
	}

	/**
	 * Log successful login attempts.
	 */
	public function memberLoggedIn() {
		self::log(sprintf(
			'"%s" (ID: %s) successfully logged in',
			$this->owner->Email ?: $this->owner->Title,
			$this->owner->ID
		));
	}

	/**
	 * Log failed login attempts.
	 */
	public function authenticationFailed($data) {
		self::log(sprintf(
			'Failed login attempt using email "%s"',
			$data['Email']
		));
	}

	public function onBeforeInit() {
		self::bind_manipulation_capture();
	}

	/**
	 * Log permission failures (where the status is set after init of page)
	 */
	public function onAfterInit() {
		$currentMember = Member::currentUser();
		if(!($currentMember && $currentMember->exists())) return false;

		$statusCode = $this->owner->getResponse()->getStatusCode();

		if(substr($statusCode, 0, 1) == '4') {
			$this->logPermissionDenied($statusCode, $currentMember);
		}
	}

	protected function logPermissionDenied($statusCode, $member) {
		self::log(sprintf(
			'HTTP code %s - "%s" (ID: %s) denied access to %s',
			$statusCode,
			$member->Email ?: $member->Title,
			$member->ID,
			$_SERVER['REQUEST_URI']
		));
	}

	/**
	 * Log successful logout.
	 */
	public function memberLoggedOut() {
		self::log(sprintf(
			'"%s" (ID: %s) successfully logged out',
			$this->owner->Email ?: $this->owner->Title,
			$this->owner->ID
		));
	}

}

