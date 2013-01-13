<?php

class Quicklink extends DataObject {
	static $db = array(
		'Name' => 'Varchar(255)',
		'ExternalLink' => 'Varchar(255)'
	);

	static $has_one = array(
		'Parent' => 'ExpressHomePage',
		'InternalLink' => 'SiteTree'
	);

	static $summary_fields = array(
		'Name' => 'Name',
		'InternalLink.Title' => 'Internal Link',
		'ExternalLink' => 'External Link'
	);

	function getLink() {
		if ($this->ExternalLink) {
			return $this->ExternalLink;
		} elseif ($this->InternalLinkID) {
			return $this->InternalLink()->Link();
		}
	}

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->removeByName('ParentID');

		$externalLinkField = $fields->fieldByName('Root.Main.ExternalLink');
		$internalLinkField = $fields->fieldByName('Root.Main.InternalLinkID');
		$fields->removeByName('ExternalLink');
		$fields->removeByName('InternalLinkID');
		$internalLinkField->addExtraClass('noBorder');
		$externalLinkField->addExtraClass('noBorder');

		$fields->addFieldToTab('Root.Main',CompositeField::create(
			array(
				$internalLinkField,
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
