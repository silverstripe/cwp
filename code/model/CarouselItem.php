<?php

class CarouselItem extends DataObject {
	static $db = array(
		'Title' => 'Varchar(255)',
		'Caption' => 'Text',
		'Archived' => 'Boolean' 
	);

	static $has_one = array(
		'Parent' => 'HomePage',
		'Image' => 'Image',
		'Link' => 'SiteTree'
	);

	static $summary_fields = array(
		'ImageThumb' => 'Image',
		'Title' => 'Title',
		'Caption' => 'Text',
		'Link.Title' => 'Link',
		'ArchivedReadable' => 'Current Status' 		
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();	
		$fields->removeByName('Archived');

		$fields->addFieldToTab('Root.Main', $group = new CompositeField(
			$label = new LabelField("LabelArchive","Archive this carousel item?"),
			new CheckboxField('Archived', '')
		));

		$group->addExtraClass("field special");
		$label->addExtraClass("left");

		$fields->removeByName('ParentID');

		$fields->insertBefore(			
		$wrap = new CompositeField(
			$extraLabel = new LabelField('Note', "Note: You will need to create the carousel item before you can add an image")
		), 'Image');

		$wrap->addExtraClass('alignExtraLabel');

		return $fields;
	}

	function ImageThumb(){ 
	   return $this->Image()->SetWidth(50); 
	}

	function ArchivedReadable(){
		if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
		return _t('GridField.Live', 'Live');
	}
}
