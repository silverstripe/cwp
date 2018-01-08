<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;

class CwpSiteTreeExtension extends DataExtension
{
    private static $db = array(
        'ShowPageUtilities' => 'Boolean(1)'
    );

    private static $defaults = array(
        'ShowPageUtilities' => true
    );

    /**
     * Modify the settings for a SiteTree
     *
     * {@inheritDoc}
     *
     * @param FieldList $fields
     */
    public function updateSettingsFields(FieldList $fields)
    {
        $helpText = _t(
            __CLASS__ . '.SHOW_PAGE_UTILITIES_HELP',
            'You can disable page utilities (print, share, etc) for this page'
        );

        $fields->addFieldsToTab(
            'Root.Settings',
            array(
                LiteralField::create('PageUtilitiesHelp', $helpText),
                CheckboxField::create('ShowPageUtilities', $this->owner->fieldLabel('ShowPageUtilities'))
            )
        );
    }

    public function updateFieldLabels(&$labels)
    {
        $labels['ShowPageUtilities'] = _t(__CLASS__ . '.SHOW_PAGE_UTILITIES', 'Show page utilities?');
    }
}
