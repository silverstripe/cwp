<?php
class CwpLoggerManyManyList extends ManyManyList {

	/**
	 * Overload {@link ManyManyList::removeByID()} so we can log
	 * when a Member is removed from a Group.
	 */
	public function removeByID($itemID) {
		parent::removeByID($itemID);

		if($this->getJoinTable() == 'Group_Members') {
			$currentMember = Member::currentUser();
			if(!($currentMember && $currentMember->exists())) return;

			$member = null;
			$group = null;

			// these two cases handle calling remove() on either side of the relation
			if($this->dataClass() == 'Member') {
				$member = Member::get()->byId($itemID);
				$group = Group::get()->byId($this->getForeignID());
			} elseif($this->dataClass() == 'Group') {
				$group = Group::get()->byId($itemID);
				$member = Member::get()->byId($this->getForeignID());
			}

			if(!$group) return;
			if(!$member) return;

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
