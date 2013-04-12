<?php
class CwpLogger extends SiteTreeExtension {

	const PRIORITY = 6;

	/**
	 * Log successful login attempts.
	 */
	public function memberLoggedIn() {
		$this->log(sprintf(
			'%s successfully logged in',
			$this->owner->Email ?: $this->owner->Title
		));
	}

	/**
	 * Log failed login attempts.
	 */
	public function authenticationFailed($data) {
		$this->log(sprintf(
			'Failed login attempt using email "%s"',
			$data['Email']
		));
	}

	/**
	 * Log permission failures (where the status is set after init of page)
	 */
	public function onAfterInit() {
		$statusCode = $this->owner->getResponse()->getStatusCode();

		if(substr($statusCode, 0, 1) == '4') {
			$this->logPermissionDenied($statusCode, Member::currentUser());
		}
	}

	protected function logPermissionDenied($statusCode, $member) {
		$this->log(sprintf(
			'HTTP code %s - %s denied access to %s',
			$statusCode,
			$member->Email ?: $member->Title,
			$_SERVER['REQUEST_URI']
		));
	}

	/**
	 * Log successful logout.
	 */
	public function memberLoggedOut() {
		$this->log(sprintf(
			'%s successfully logged out',
			$this->owner->Email ?: $this->owner->Title
		));
	}

	/**
	 * Log created records.
	 */
	public function onBeforeWrite() {
		if(!$this->owner->exists()) {
			$currentMember = Member::currentUser();
			if(!($currentMember && $currentMember->exists())) return false;

			$this->log(sprintf(
				'%s created %s (no ID yet) (Name: "%s")',
				$currentMember->Email ?: $currentMember->Title,
				get_class($this->owner),
				$this->owner->Title
			));
		}
	}

	/**
	 * Log save of data. Summarises the user who saved the extended record
	 * along with which fields were changed.
	 */
	public function onAfterWrite() {
		$currentMember = Member::currentUser();
		$changedFields = array_keys($this->owner->getChangedFields(true));
		if(!$changedFields || !($currentMember && $currentMember->exists())) return false;


		// don't log saved pages, we'll log publishing though onAfterPublish
		if($this->owner instanceof SiteTree) return false;

		// don't log member being saved when logging in, it's just noise
		if($this->owner instanceof Member && preg_match('/Security/', @$_SERVER['HTTP_REFERER'])) return false;

		$this->log(sprintf(
			'%s saved %s ID %s (Name: "%s") (changed fields: "%s")',
			$currentMember->Email ?: $currentMember->Title,
			get_class($this->owner),
			$this->owner->ID,
			$this->owner->Title,
			implode('","', $changedFields)
		));
	}

	/**
	 * Log publish of pages
	 */
	public function onAfterPublish(&$original) {
		$currentMember = Member::currentUser();
		if(!($currentMember && $currentMember->exists())) return false;

		$this->log(sprintf(
			'%s published %s ID %s (Name: "%s")',
			$currentMember->Email ?: $currentMember->Title,
			get_class($this->owner),
			$this->owner->ID,
			$this->owner->Title
		));
	}

	/**
	 * Log deletion of record.
	 */
	public function onAfterDelete() {
		$currentMember = Member::currentUser();
		if(!($currentMember && $currentMember->exists())) return false;

		$this->log(sprintf(
			'%s deleted %s ID %s (Name: "%s")',
			$currentMember->Email ?: $currentMember->Title,
			get_class($this->owner),
			$this->owner->ID,
			$this->owner->Title
		));
	}

	/**
	 * Log the message, {@link CwpLoggerFormatter} will format the log line entry
	 * with IP address and date before writing to the log file.
	 */
	protected function log($message) {
		if(isset($_SERVER['HTTP_REFERER'])) $message .= sprintf(' (Referer: %s)', $_SERVER['HTTP_REFERER']);
		SS_Log::log($message, self::PRIORITY);
	}

}

