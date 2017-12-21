<?php

namespace CWP\CWP\Search;

use Page;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

/**
 * Dummy page to assist with display of search results
 */
class CwpSearchPage extends Page
{
    private static $hide_ancestor = CwpSearchPage::class;

    public function canViewStage($stage = Versioned::LIVE, $member = null)
    {
        if (Permission::checkMember($member, 'VIEW_DRAFT_CONTENT')) {
            return true;
        }

        return parent::canViewStage($stage, $member);
    }
}
