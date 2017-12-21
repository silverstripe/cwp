<?php

namespace CWP\CWP\PageTypes;

use PageController;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\Deprecation;

class SitemapPageController extends PageController
{
    private static $allowed_actions = [
        'showpage',
    ];

    private static $url_handlers = [
        'page/$ID' => 'showpage',
    ];

    public function Page($link)
    {
        if ($link instanceof HTTPRequest) {
            Deprecation::notice('2.0', 'Using page() as a url handler is deprecated. Use showpage() action instead');
            return $this->showpage($link);
        }
        return parent::Page($link);
    }

    public function showpage($request)
    {
        $id = (int) $request->param('ID');
        if (!$id) {
            return false;
        }
        $page = SiteTree::get()->byId($id);

        // does the page exist?
        if (!($page && $page->exists())) {
            return $this->httpError(404);
        }

        // can the page be viewed?
        if (!$page->canView()) {
            return $this->httpError(403);
        }

        $viewer = $this->customise([
            'IsAjax' => $request->isAjax(),
            'SelectedPage' => $page,
            'Children' => $page->Children(),
        ]);

        if ($request->isAjax()) {
            return $viewer->renderWith('SitemapNodeChildren');
        }

        return $viewer;
    }
}
