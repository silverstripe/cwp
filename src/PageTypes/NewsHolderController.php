<?php

namespace CWP\CWP\PageTypes;

use CWP\Core\Feed\CwpAtomFeed;
use SilverStripe\Control\RSS\RSSFeed;

class NewsHolderController extends DatedUpdateHolderController
{
    private static $allowed_actions = [
        'rss',
        'atom',
    ];

    public function rss()
    {
        $rss = RSSFeed::create(
            $this->Updates()->sort('Created DESC')->limit(20),
            $this->Link('rss'),
            $this->getSubscriptionTitle()
        );
        $rss->setTemplate('CWP\\CWP\\PageTypes\\NewsHolder_rss');
        return $rss->outputToBrowser();
    }

    public function atom()
    {
        $atom = CwpAtomFeed::create(
            $this->Updates()->sort('Created DESC')->limit(20),
            $this->Link('atom'),
            $this->getSubscriptionTitle()
        );
        $atom->setTemplate('CWP\\CWP\\PageTypes\\NewsHolder_atom');
        return $atom->outputToBrowser();
    }
}
