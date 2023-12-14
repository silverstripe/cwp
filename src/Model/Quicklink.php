<?php

namespace CWP\CWP\Model;

use CWP\CWP\PageTypes\BaseHomePage;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;

/**
 * @method SiteTree InternalLink()
 * @method BaseHomePage Parent()
 */
class Quicklink extends DataObject
{
    private static $db = [
        'Name' => 'Varchar(255)',
        'ExternalLink' => 'Varchar(255)',
        'SortOrder' => 'Int',
    ];

    private static $has_one = [
        'Parent' => BaseHomePage::class,
        'InternalLink' => SiteTree::class,
    ];

    private static $summary_fields = [
        'Name' => 'Name',
        'InternalLink.Title' => 'Internal Link',
        'ExternalLink' => 'External Link',
    ];

    private static $table_name = 'Quicklink';

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Name'] = _t(__CLASS__ . '.NameLabel', 'Name');
        $labels['ExternalLink'] = _t(__CLASS__ . '.ExternalLinkLabel', 'External Link');
        $labels['SortOrder'] = _t(__CLASS__ . '.SortOrderLabel', 'Sort Order');
        $labels['ParentID'] = _t(__CLASS__ . '.ParentRelationLabel', 'Parent');
        $labels['InternalLinkID'] = _t(__CLASS__ . '.InternalLinkLabel', 'Internal Link');

        return $labels;
    }

    public function getLink()
    {
        if ($this->ExternalLink) {
            $url = parse_url($this->ExternalLink ?? '');

            // if no scheme set in the link, default to http
            if (!isset($url['scheme'])) {
                return 'http://' . $this->ExternalLink;
            }

            return $this->ExternalLink;
        }

        if ($this->InternalLinkID) {
            return $this->InternalLink()->Link();
        }
    }

    public function canCreate($member = null, $context = [])
    {
        // Creating quick links should not be the same permission level as creating parent pages for them, they're
        // essentially content in the context of the page, so use the edit permission instead.
        return $this->canEdit($member);
    }

    public function canEdit($member = null)
    {
        return $this->Parent()->canEdit($member);
    }

    public function canDelete($member = null)
    {
        return $this->Parent()->canDelete($member);
    }

    public function canView($member = null)
    {
        return $this->Parent()->canView($member);
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('ParentID');

        $externalLinkField = $fields->fieldByName('Root.Main.ExternalLink');

        $fields->removeByName('ExternalLink');
        $fields->removeByName('InternalLinkID');
        $fields->removeByName('SortOrder');
        $externalLinkField->addExtraClass('noBorder');

        $fields->addFieldToTab('Root.Main', CompositeField::create(
            array(
                TreeDropdownField::create(
                    'InternalLinkID',
                    $this->fieldLabel('InternalLinkID'),
                    SiteTree::class
                ),
                $externalLinkField,
                $wrap = CompositeField::create(
                    $extraLabel = LiteralField::create(
                        'NoteOverride',
                        sprintf('<div class="message good notice">%s</div>', _t(
                            __CLASS__ . '.Note',
                            'Note: If you specify an External Link, the Internal Link will be ignored.'
                        ))
                    )
                )
            )
        ));
        $fields->insertBefore(
            'Name',
            LiteralField::create(
                'Note',
                sprintf('<p>%s</p>', _t(
                    __CLASS__ . '.Note2',
                    'Use this to specify a link to a page either on this site '
                        . '(Internal Link) or another site (External Link).'
                ))
            )
        );

        return $fields;
    }
}
