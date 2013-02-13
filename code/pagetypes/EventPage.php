<?php

class EventPage extends Page {

	static $default_parent = 'EventHolder';

	static $can_be_root = false;

	static $icon = 'cwp/images/icons/sitetree_images/event_page.png';

	public $pageIcon =  'images/icons/sitetree_images/event_page.png';

	public static $related_pages_title = 'Related Events';

	static $db = array(
		'Abstract' => 'HTMLText',
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
		$dateTimeField->getDateField()->setConfig('dateformat', Member::currentUser()->getDateFormat());
		$dateTimeField->getTimeField()->setConfig('timeformat', Member::currentUser()->getTimeFormat());

		$fields->addfieldToTab('Root.Main', $abstractField = new HTMLEditorField('Abstract'), 'Content');
		$abstractField->addExtraClass('stacked');
		$abstractField->setRows(15);

		return $fields;
	}
}

class EventPage_Controller extends Page_Controller {

}
