<?php

class EventPage extends Page {

	static $default_parent = 'EventHolder';

	static $can_be_root = false;

	static $icon = 'cwp/images/icons/sitetree_images/event_page.png';

	public $pageIcon =  'images/icons/sitetree_images/event_page.png';

	static $db = array(
		'Date' => 'SS_Datetime',
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

		return $fields;
	}
}

class EventPage_Controller extends Page_Controller {

}