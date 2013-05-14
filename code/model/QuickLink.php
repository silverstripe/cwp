<?php

class Quicklink extends DataObject {
	private static $db = array(
		'Name' => 'Varchar(255)',
		'ExternalLink' => 'Varchar(255)',
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Parent' => 'BaseHomePage',
		'InternalLink' => 'SiteTree'
	);

	private static $summary_fields = array(
		'Name' => 'Name',
		'InternalLink.Title' => 'Internal Link',
		'ExternalLink' => 'External Link'
	);

	public function getLink() {
		if ($this->ExternalLink) {
			$url = parse_url($this->ExternalLink);

			// if no scheme set in the link, default to http
			if(!isset($url['scheme'])) {
				return 'http://' . $this->ExternalLink;
			}

			return $this->ExternalLink;
		} elseif ($this->InternalLinkID) {
			return $this->InternalLink()->Link();
		}
	}

	public function canCreate($member = null) {
		return $this->Parent()->canCreate($member);
	}

	public function canEdit($member = null) {
		return $this->Parent()->canEdit($member);
	}

	public function canDelete($member = null) {
		return $this->Parent()->canDelete($member);
	}

	public function canView($member = null) {
		return $this->Parent()->canView($member);
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('ParentID');

		$externalLinkField = $fields->fieldByName('Root.Main.ExternalLink');

		$fields->removeByName('ExternalLink');
		$fields->removeByName('InternalLinkID');
		$fields->removeByName('SortOrder');
		$externalLinkField->addExtraClass('noBorder');

		$fields->addFieldToTab('Root.Main',CompositeField::create(
			array(
				new TreeDropdownField('InternalLinkID', 'Internal Link', 'SiteTree'),
				$externalLinkField,
				$wrap = new CompositeField(
					$extraLabel = new LiteralField('NoteOverride', '<div class="message good notice">Note:  If you specify an External Link, the Internal Link will be ignored.</div>')
				)
			)
		));
		$fields->insertBefore(new LiteralField('Note', '<p>Use this to specify a link to a page either on this site (Internal Link) or another site (External Link).</p>'), 'Name');

		return $fields;
	}
}
