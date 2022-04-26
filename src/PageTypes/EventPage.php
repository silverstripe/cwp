<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TimeField;
use SilverStripe\ORM\FieldType\DBDatetime;

class EventPage extends DatedUpdatePage
{
    private static $description = 'Describes an event occurring on a specific date.';

    private static $default_parent = EventHolder::class;

    private static $can_be_root = false;

    private static $icon_class = 'font-icon-p-event';

    private static $singular_name = 'Event Page';

    private static $plural_name = 'Event Pages';

    private static $db = [
        'StartTime' => 'Time',
        'EndTime' => 'Time',
        'Location' => 'Text',
    ];

    private static $table_name = 'EventPage';

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['StartTime'] = _t('CWP\\CWP\\PageTypes\\DateUpdatePage.StartTimeFieldLabel', 'Start Time');
        $labels['EndTime'] = _t('CWP\\CWP\\PageTypes\\DateUpdatePage.EndTimeFieldLabel', 'End Time');
        $labels['Location'] = _t('CWP\\CWP\\PageTypes\\DateUpdatePage.LocationFieldLabel', 'Location');

        return $labels;
    }

    /**
     * Add the default for the Date being the current day.
     */
    public function populateDefaults()
    {
        if (!isset($this->Date) || $this->Date === null) {
            $this->Date = DBDatetime::now()->Format('y-MM-dd');
        }

        if (!isset($this->StartTime) || $this->StartTime === null) {
            $this->StartTime = '09:00:00';
        }

        if (!isset($this->EndTime) || $this->EndTime === null) {
            $this->EndTime = '17:00:00';
        }

        parent::populateDefaults();
    }

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('Date');

            $dateTimeFields = array();

            $dateTimeFields[] = $dateField = DateField::create('Date', 'Date');
            $dateTimeFields[] = $startTimeField = TimeField::create(
                'StartTime',
                $this->fieldLabel('StartTime')
            );
            $dateTimeFields[] = $endTimeField = TimeField::create('EndTime', $this->fieldLabel('EndTime'));

            $fields->addFieldsToTab('Root.Main', [
                $dateTimeField = FieldGroup::create('Date and time', $dateTimeFields),
                $locationField = TextareaField::create('Location', $this->fieldLabel('Location'))
            ], 'Abstract');
            $locationField->setRows(4);
        });
        return parent::getCMSFields();
    }

    public function NiceLocation()
    {
        return nl2br(Convert::raw2xml($this->Location) ?? '', true);
    }
}
