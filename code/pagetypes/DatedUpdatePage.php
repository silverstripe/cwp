<?php
class DatedUpdatePage extends Page {

	// Meant as an abstract base class.
	private static $hide_ancestor = 'DatedUpdatePage';

	private static $defaults = array(
		'ShowInMenus' => false
	);

	private static $db = array(
		'Abstract' => 'Text',
		'Date' => 'Datetime'
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

	public function fieldLabels($includerelations = true) {
		$labels = parent::fieldLabels($includerelations);
		$labels['Date'] = _t('DateUpdatePage.DateLabel', 'Date');
		$labels['Abstract'] = _t('DateUpdatePage.AbstractTextFieldLabel', 'Abstract');

		return $labels;
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab(
			'Root.Main', 
			$dateTimeField = new DatetimeField('Date', $this->fieldLabel('Date')), 
			'Content'
		);
		$dateTimeField->getDateField()->setConfig('showcalendar', true);

		$fields->addfieldToTab(
			'Root.Main', 
			$abstractField = new TextareaField('Abstract', $this->fieldLabel('Abstract')), 
			'Content'
		);
		$abstractField->setAttribute('maxlength', '160');
		$abstractField->setRightTitle(
			_t('DateUpdatePage.AbstractDesc','The abstract is used as a summary on the listing pages. It is limited to 160 characters.')
		);
		$abstractField->setRows(6);

		return $fields;
	}
}

class DatedUpdatePage_Controller extends Page_Controller {
}
