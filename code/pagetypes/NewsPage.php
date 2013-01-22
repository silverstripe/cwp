<?php

class NewsPage extends Page {

	static $default_parent = 'NewsHolderPage';

	static $can_be_root = false;

	static $icon = 'cwp/images/icons/sitetree_images/news.png';

	public $pageIcon =  'images/icons/sitetree_images/news.png';

	static $db = array(
		'Date' => 'SS_Datetime',
		'Abstract' => 'Text',
		'Author' => 'Varchar(255)'
	);

	static $has_one = array(
		'Category' => 'NewsCategory'
	);

	/**
	 * Add the default for the Date being the current day.
	 */
	public function populateDefaults() {
		parent::populateDefaults();

		if(!isset($this->Date) || $this->Date === null) {
			$this->Date = SS_Datetime::now()->Format('Y-m-d H:i:s');
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('Date'), 'Content');
		$dateTimeField->getDateField()->setConfig('showcalendar', true);

		$categories = NewsCategory::get()->sort('Title ASC');
		if ($categories && $categories->exists()) {
			$fields->addFieldToTab('Root.Main', new DropdownField('CategoryID', 'Category', $categories->map()), 'Content');
		}

		$fields->addFieldToTab('Root.Main', new TextareaField('Abstract'), 'Content');

		return $fields;
	}
}

class NewsPage_Controller extends Page_Controller {
	
}
