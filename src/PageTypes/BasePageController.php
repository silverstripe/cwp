<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\ORM\FieldType\DBDatetime;

class BasePageController extends ContentController
{
    /**
     * Provide current year.
     */
    public function CurrentDatetime()
    {
        return DBDatetime::now();
    }

    public function getRSSLink()
    {
    }
}
