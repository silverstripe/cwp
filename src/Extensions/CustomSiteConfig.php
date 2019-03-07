<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBField;

/**
 * Adds new global settings.
 */
class CustomSiteConfig extends DataExtension
{
    private static $db = array(
        'GACode' => 'Varchar(16)',
        'FacebookURL' => 'Varchar(256)', // multitude of ways to link to Facebook accounts, best to leave it open.
        'TwitterUsername' => 'Varchar(16)', // max length of Twitter username 15
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root.Main',
            $gaCode = TextField::create(
                'GACode',
                _t(__CLASS__ . '.GaField', 'Google Analytics account')
            )
        );

        $gaCode->setDescription(
            DBField::create_field('HTMLFragment', _t(
                __CLASS__ . '.GaFieldDesc',
                'Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)'
            ))
        );

        $fields->findOrMakeTab('Root.SocialMedia', _t(__CLASS__ . '.SocialMediaTab', 'Social Media'));

        $fields->addFieldToTab(
            'Root.SocialMedia',
            $facebookURL = TextField::create(
                'FacebookURL',
                _t(__CLASS__ . '.FbField', 'Facebook UID or username')
            )
        );
        $facebookURL->setDescription(
            DBField::create_field('HTMLFragment', _t(
                __CLASS__ . '.FbFieldDesc',
                'Facebook link (everything after the "http://facebook.com/", eg http://facebook.com/'
                . '<strong>username</strong> or http://facebook.com/<strong>pages/108510539573</strong>)'
            ))
        );

        $fields->addFieldToTab(
            'Root.SocialMedia',
            $twitterUsername = TextField::create(
                'TwitterUsername',
                _t(__CLASS__ . '.TwitterField', 'Twitter username')
            )
        );
        $twitterUsername->setDescription(
            DBField::create_field('HTMLFragment', _t(
                __CLASS__ . '.TwitterFieldDesc',
                'Twitter username (eg, http://twitter.com/<strong>username</strong>)'
            ))
        );
    }
}
