<?php
class CwpLoggerManyManyList extends ManyManyList {

	/**
	 * Overload {@link ManyManyList::removeByID()} so we can log
	 * when a Member is removed from a Group.
	 */
	public function removeByID($itemID) {
		parent::removeByID($itemID);

		$currentMember = Member::currentUser();
		if(!($currentMember && $currentMember->exists())) return;

		$class = $this->dataClass();
		$data = $class::get()->byId($itemID);
		if(!$data) return;

		$joinTable = $this->getJoinTable();

		if($joinTable == 'Group_Members') {
			$group = Group::get()->byId($itemID);
			$member = Member::get()->byId($this->getForeignID());

			CwpLogger::log(sprintf(
				'"%s" (ID: %s) removed Member "%s" (ID: %s) from Group "%s" (ID: %s)',
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
