<?php

class EventPage extends Page {

	static $default_parent = 'EventHolder';

	static $can_be_root = false;

	static $icon = 'cwp/images/icons/sitetree_images/event_page.png';

	public $pageIcon =  'images/icons/sitetree_images/event_page.png';

	static $defaults = array(
		'ShowInMenus' => false
	);

	static $db = array(
		'Abstract' => 'Text',
		'Date' => 'Date',
		'StartTime' => 'Time',
		'EndTime' => 'Time',
		'Location' => 'Text'
	);

	/**
	 * Add the default for the Date being the current day.
	 */
	public function populateDefaults() {
		parent::populateDefaults();

		if(!isset($this->Date) || $this->Date === null) {
			$this->Date = SS_Datetime::now()->Format('Y-m-d');
		}

		if(!isset($this->StartTime) || $this->StartTime === null) {
			$this->StartTime = '09:00:00';
		}

		if(!isset($this->EndTime) || $this->EndTime === null) {
			$this->EndTime = '17:00:00';
		}
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$dateTimeFields = array();

		$dateTimeFields[] = $dateField = new DateField('Date', '');
		$dateField->setConfig('showcalendar', true);
		$dateField->setConfig('dateformat', Member::currentUser()->getDateFormat());

		$dateTimeFields[] = $startTimeField = new TimeField('StartTime', '&nbsp;&nbsp;Start Time');
		$dateTimeFields[] = $endTimeField = new TimeField('EndTime');
		// Would like to do this, but the width of the form field doesn't scale based on the time
		// format. OS ticket raised: http://open.silverstripe.org/ticket/8260
		//$startTimeField->setConfig('timeformat', Member::currentUser()->getTimeFormat());
		//$endTimeField->setConfig('timeformat', Member::currentUser()->getTimeFormat());
		$startTimeField->setConfig('timeformat', 'h:ma');
		$endTimeField->setConfig('timeformat', 'h:ma');

		$fields->addfieldToTab('Root.Main', $dateTimeField = new FieldGroup('Date and time', $dateTimeFields), 'Content');

		$fields->addfieldToTab('Root.Main', $locationField = new TextareaField('Location'), 'Content');
		$locationField->setRows(4);

		$fields->addfieldToTab('Root.Main', $abstractField = new TextareaField('Abstract'), 'Content');
		$abstractField->addExtraClass('stacked');
		$abstractField->setAttribute('maxlength', '160');
		$abstractField->setRows(6);

		return $fields;
	}

	public function NiceLocation() {
		return (nl2br(Convert::raw2xml($this->Location), true));
	}
}

class EventPage_Controller extends Page_Controller {

}
