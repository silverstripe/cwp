<?php

namespace CWP\CWP\Model;

use CWP\CWP\PageTypes\BaseHomePage;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\ORM\DataObject;

class Quicklink extends DataObject
{

    private static $db = array(
        'Name' => 'Varchar(255)',
        'ExternalLink' => 'Varchar(255)',
        'SortOrder' => 'Int'
    );

    private static $has_one = array(
        'Parent' => BaseHomePage::class,
        'InternalLink' => SiteTree::class
    );

    private static $summary_fields = array(
        'Name' => 'Name',
        'InternalLink.Title' => 'Internal Link',
        'ExternalLink' => 'External Link'
    );

    private static $table_name = 'Quicklink';

    public function fieldLabels($includerelations = true)
    {
        $labels = parent::fieldLabels($includerelations);
        $labels['Name'] = _t('Quicklink.NameLabel', 'Name');
        $labels['ExternalLink'] = _t('Quicklink.ExternalLinkLabel', 'External Link');
        $labels['SortOrder'] = _t('Quicklink.SortOrderLabel', 'Sort Order');
        $labels['ParentID'] = _t('Quicklink.ParentRelationLabel', 'Parent');
        $labels['InternalLinkID'] = _t('Quicklink.InternalLinkLabel', 'Internal Link');

        return $labels;
    }

    public function getLink()
    {
        if ($this->ExternalLink) {
            $url = parse_url($this->ExternalLink);

            // if no scheme set in the link, default to http
            if (!isset($url['scheme'])) {
                return 'http://' . $this->ExternalLink;
            }

            return $this->ExternalLink;
        } elseif ($this->InternalLinkID) {
            return $this->InternalLink()->Link();
        }
    }

    public function canCreate($member = null)
    {
        return $this->Parent()->canCreate($member);
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
                        _t('Quicklink.Note', '<div class="message good notice">Note:  If you specify an External Link, the Internal Link will be ignored.</div>')
                    )
                )
            )
        ));
        $fields->insertBefore(
            LiteralField::create(
                'Note',
                _t(
                    'Quicklink.Note2',
                    '<p>Use this to specify a link to a page either on this site (Internal Link) or another site (External Link).</p>'
                )
            ),
            'Name'
        );

        return $fields;
    }
}
