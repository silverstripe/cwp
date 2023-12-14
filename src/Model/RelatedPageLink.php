<?php

namespace CWP\CWP\Model;

use CWP\CWP\PageTypes\BasePage;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

/**
 * @method BasePage BasePage()
 * @method BasePage Child()
 */
class RelatedPageLink extends DataObject
{
    private static $table_name = 'BasePage_RelatedPages';

    private static $extensions = [
        Versioned::class,
    ];

    private static $db = [
        'SortOrder' => 'Int',
    ];

    /**
     * For backwards compatibility these must match a traditional 'many_many' definition.
     * This was BasePage.RelatedPages => BasePage
     * ManyMany relations are normally joined by ${DefiningClass}ID && ${RelatedClass}ID
     * excepting in the case where ${DefiningClass} === ${RelatedClass}
     * Then the 'related class' column changes from ${RelatedClass}ID to "ChildID".
     *
     * {@see SilverStripe\ORM\DataObjectSchema->parseManyManyComponent()}
     *
     * @var array
     * @config
     */
    private static $has_one = [
        'BasePage' => BasePage::class,
        'Child' => BasePage::class,
    ];
}
