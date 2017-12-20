<?php

namespace CWP\CWP\PageTypes;

use Page;





use CWP\CWP\PageTypes\DatedUpdatePage;
use SilverStripe\ORM\FieldType\DBDatetime;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\TextareaField;
use PageController;


class DatedUpdatePage extends Page {

	// Meant as an abstract base class.
	private static $hide_ancestor = DatedUpdatePage::class;

	private static $singular_name = 'Dated Update Page';

	private static $plural_name = 'Dated Update Pages';

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
			$this->Date = DBDatetime::now()->Format('Y-m-d 09:00:00');
		}
	}

	public function fieldLabels($includerelations = true) {
		$labels = parent::fieldLabels($includerelations);
		$labels[DBDate::class] = _t('DateUpdatePage.DateLabel', DBDate::class);
		$labels['Abstract'] = _t('DateUpdatePage.AbstractTextFieldLabel', 'Abstract');

		return $labels;
	}

	public function getCMSFields() {
		$this->beforeUpdateCMSFields(function (FieldList $fields) {
			$fields->addFieldToTab(
				'Root.Main',
				$dateTimeField = DatetimeField::create(DBDate::class, $this->fieldLabel(DBDate::class)),
				'Content'
			);
			$dateTimeField->getDateField()->setConfig('showcalendar', true);

			$fields->addfieldToTab(
				'Root.Main',
				$abstractField = TextareaField::create('Abstract', $this->fieldLabel('Abstract')),
				'Content'
			);
			$abstractField->setAttribute('maxlength', '160');
			$abstractField->setRightTitle(
				_t('DateUpdatePage.AbstractDesc','The abstract is used as a summary on the listing pages. It is limited to 160 characters.')
			);
			$abstractField->setRows(6);
		});
		return parent::getCMSFields();
	}
}

class DatedUpdatePage_Controller extends PageController {
}
