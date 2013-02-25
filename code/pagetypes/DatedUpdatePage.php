<?php

class DatedUpdatePage extends Page {

	// Meant as an abstract base class.
	static $hide_ancestor = 'DatedUpdatePage';

	static $defaults = array(
		'ShowInMenus' => false
	);

	static $db = array(
		'Abstract' => 'Text',
		'Date' => 'Datetime',
	);

	/**
	 * Add the default for the Date being the current day.
	 */
	public function populateDefaults() {
		parent::populateDefaults();

		if(!isset($this->Date) || $this->Date === null) {
			$this->Date = SS_Datetime::now()->Format('Y-m-d 09:00:00');
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', $dateTimeField = new DatetimeField('Date'), 'Content');
		$dateTimeField->getDateField()->setConfig('showcalendar', true);

		$fields->addfieldToTab('Root.Main', $abstractField = new TextareaField('Abstract'), 'Content');
		$abstractField->addExtraClass('stacked');
		$abstractField->setAttribute('maxlength', '160');
		$abstractField->setRows(6);

		return $fields;
	}
}

class DatedUpdatePage_Controller extends Page_Controller {

}
