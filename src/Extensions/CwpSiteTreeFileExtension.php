<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DataExtension;

class CwpSiteTreeFileExtension extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {
        Requirements::css('cwp/css/fieldDescriptionToggle.css');
        Requirements::javascript('cwp/javascript/fieldDescriptionToggle.js');

        $fields->insertAfter(
            ReadonlyField::create(
                'BackLinkCount',
                _t('AssetTableField.BACKLINKCOUNT', 'Used on:'),
                $this->owner->BackLinkTracking()->Count() . ' ' . _t('AssetTableField.PAGES', 'page(s)')
            )
            ->addExtraClass('cms-description-toggle')
            ->setDescription($this->BackLinkHTMLList()),
            'LastEdited'
        );
    }

    /**
     * Generate an HTML list which provides links to where a file is used.
     *
     * @return String
     */
    public function BackLinkHTMLList()
    {
        $html = '<em>' . _t(
            'SiteTreeFileExtension.BACKLINK_LIST_DESCRIPTION',
            'This list shows all pages where the file has been added through a WYSIWYG editor.'
        ) . '</em>';
        $html .= '<ul>';

        foreach ($this->owner->BackLinkTracking() as $backLink) {
            $listItem = '<li>';

            // Add the page link
            $listItem .= '<a href="' . $backLink->Link() . '" target="_blank">'
                . Convert::raw2xml($backLink->MenuTitle) . '</a> &ndash; ';

            // Add the CMS link
            $listItem .= '<a href="' . $backLink->CMSEditLink() . '">'
                . _t('SiteTreeFileExtension.EDIT', 'Edit') . '</a>';

            $html .= $listItem . '</li>';
        }

        return $html .= '</ul>';
    }
}
