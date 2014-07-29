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
		$fields = new FieldList(
			// Set title
			TextField::create('Title', 'Title', null, 255),

			// Caption
			TextareaField::create('Caption', 'Caption'),

			// Image
			UploadField::create('Image', 'Image')
				->setAllowedFileCategories('image'),

			// Linked page id
			TreeDropdownField::create('LinkID', _t('CwpCarousel.LinkField', 'Link'), 'SiteTree'),

			// Can archive option
			CompositeField::create(
				LabelField::create(
					"LabelArchive",
					_t('CwpCarousel.ArchivedField',"Archive this carousel item?")
				)->addExtraClass("left"),
				CheckboxField::create('Archived', '')
			)->addExtraClass("field special")
		);
		$this->extend('updateCMSFields', $fields);

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
