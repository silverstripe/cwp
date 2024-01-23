<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\ORM\FieldType\DBDatetime;

/**
 * @template T of BasePage
 * @extends ContentController<T>
 */
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
