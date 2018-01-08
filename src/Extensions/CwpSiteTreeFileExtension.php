<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Core\Convert;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\Requirements;

class CwpSiteTreeFileExtension extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {
        Requirements::css('cwp/cwp:css/fieldDescriptionToggle.css');
        Requirements::javascript('cwp/cwp:javascript/fieldDescriptionToggle.js');

        $fields->insertAfter(
            'LastEdited',
            ReadonlyField::create(
                'BackLinkCount',
                _t('SilverStripe\\CMS\\Model\\SiteTreeFileExtension.BACKLINKCOUNT', 'Used on:'),
                $this->owner->BackLinkTracking()->Count() . ' '
                    . _t('SilverStripe\\CMS\\Model\\SiteTreeFileExtension.PAGES', 'page(s)')
            )
            ->addExtraClass('cms-description-toggle')
            ->setDescription($this->BackLinkHTMLList())
        );
    }

    /**
     * Generate an HTML list which provides links to where a file is used.
     *
     * @return string
     */
    public function BackLinkHTMLList()
    {
        $html = '<em>' . _t(
            __CLASS__ . '.BACKLINK_LIST_DESCRIPTION',
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
                . _t(__CLASS__ . '.EDIT', 'Edit') . '</a>';

            $html .= $listItem . '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
