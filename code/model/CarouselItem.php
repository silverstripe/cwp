<?php
class CarouselItem extends DataObject {

	private static $db = array(
		'Title' => 'Varchar(255)',
		'Caption' => 'Text',
		'Archived' => 'Boolean',
		'SortOrder' => 'Int'
	);

	private static $has_one = array(
		'Parent' => 'HomePage',
		'Image' => 'Image',
		'Link' => 'SiteTree'
	);

	private static $summary_fields = array(
		'ImageThumb' => 'Image',
		'Title' => 'Title',
		'Caption' => 'Text',
		'Link.Title' => 'Link',
		'ArchivedReadable' => 'Current Status' 		
	);

	private static $searchable_fields = array(
		'Title',
		'Caption'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();	
		$fields->removeByName('Archived');

		$fields->addFieldToTab('Root.Main', $group = new CompositeField(
			$label = new LabelField("LabelArchive","Archive this carousel item?"),
			new CheckboxField('Archived', '')
		));

		$group->addExtraClass("field special");
		$label->addExtraClass("left");

		$fields->removeByName('ParentID');
		$fields->removeByName('SortOrder');

		$fields->replaceField('LinkID', new TreeDropdownField('InternalLinkID', 'Link', 'SiteTree'));

		$fields->insertBefore(			
		$wrap = new CompositeField(
			$extraLabel = new LabelField('Note', "Note: You will need to create the carousel item before you can add an image")
		), 'Image');

		$wrap->addExtraClass('alignExtraLabel');

		return $fields;
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

	public function ImageThumb(){ 
	   return $this->Image()->SetWidth(50); 
	}

	public function ArchivedReadable(){
		if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
		return _t('GridField.Live', 'Live');
	}
}
