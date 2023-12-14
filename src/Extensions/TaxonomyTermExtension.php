<?php

namespace CWP\CWP\Extensions;

use CWP\CWP\PageTypes\BasePage;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;

/**
 * @method SilverStripe\ORM\ManyManyList<BasePage> Pages()
 */
class TaxonomyTermExtension extends DataExtension
{

    private static $api_access = true;

    private static $belongs_many_many = array(
        'Pages' => BasePage::class
    );

    public function updateCMSFields(FieldList $fields)
    {
        $pagesGridField = $fields->dataFieldByName('Pages');
        if ($pagesGridField) {
            $pagesGridField->getConfig()->removeComponentsByType(GridFieldAddNewButton::class);
        }
    }
}
