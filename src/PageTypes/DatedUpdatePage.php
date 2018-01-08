<?php

namespace CWP\CWP\PageTypes;

use Page;
use SilverStripe\Forms\DatetimeField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\FieldType\DBDatetime;

class DatedUpdatePage extends Page
{
    /**
     * Meant as an abstract base class.
     *
     * {@inheritDoc}
     */
    private static $hide_ancestor = DatedUpdatePage::class;

    private static $singular_name = 'Dated Update Page';

    private static $plural_name = 'Dated Update Pages';

    private static $table_name = 'DatedUpdatePage';

    private static $defaults = [
        'ShowInMenus' => false,
    ];

    private static $db = [
        'Abstract' => 'Text',
        'Date' => 'Datetime',
    ];

    /**
     * Add the default for the Date being the current day.
     */
    public function populateDefaults()
    {
        parent::populateDefaults();

        if (!isset($this->Date) || $this->Date === null) {
            $this->Date = DBDatetime::now()->Format('y-MM-dd 09:00:00');
        }
    }

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Date'] = _t(__CLASS__ . '.DateLabel', 'Date');
        $labels['Abstract'] = _t(__CLASS__ . '.AbstractTextFieldLabel', 'Abstract');

        return $labels;
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldToTab(
                'Root.Main',
                $dateTimeField = DatetimeField::create('Date', $this->fieldLabel('Date')),
                'Content'
            );

            $fields->addfieldToTab(
                'Root.Main',
                $abstractField = TextareaField::create('Abstract', $this->fieldLabel('Abstract')),
                'Content'
            );
            $abstractField->setAttribute('maxlength', '160');
            $abstractField->setRightTitle(_t(
                __CLASS__ . '.AbstractDesc',
                'The abstract is used as a summary on the listing pages. It is limited to 160 characters.'
            ));
            $abstractField->setRows(6);
        });
        return parent::getCMSFields();
    }
}
