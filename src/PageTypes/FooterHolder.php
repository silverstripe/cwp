<?php

namespace CWP\CWP\PageTypes;

use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\Forms\FieldList;

/**
 * FooterHolder is intended as an invisible container for footer links and pages.
 * All child pages will be shown within the footer area of the site.
 * Use **RedirectorPage** if you just need a link.
 */

class FooterHolder extends RedirectorPage
{

    private static $description = 'Holder page that displays all child pages as links in the footer';

    private static $singular_name = 'Footer Holder';

    private static $plural_name = 'Footer Holders';

    private static $defaults = [
        'ShowInMenus' => 0,
        'ShowInSearch' => 0,
    ];

    private static $table_name = 'FooterHolder';

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName('RedirectorDescHeader');
            $fields->removeByName('RedirectionType');
            $fields->removeByName('LinkToID');
            $fields->removeByName('ExternalURL');
        });
        return parent::getCMSFields();
    }

    /**
     * Return the link to the first child page.
     */
    public function redirectionLink()
    {
        $childPage = $this->Children()->first();

        if ($childPage) {
            // If we're linking to another redirectorpage then just return the URLSegment, to prevent a cycle of
            // redirector pages from causing an infinite loop.  Instead, they will cause a 30x redirection loop in
            // the browser, but this can be handled sufficiently gracefully by the browser.
            if ($childPage instanceof RedirectorPage) {
                return $childPage->regularLink();
            }
            // For all other pages, just return the link of the page.
            return $childPage->Link();
        }
    }

    public function syncLinkTracking()
    {
        // If we don't have anything to link to, then we have a broken link.
        if (!$this->Children()) {
            $this->HasBrokenLink = true;
        }
    }
}
