<?php

namespace CWP\CWP\PageTypes;

use PageController;
use SilverStripe\CMS\Model\SiteTree;

class SitemapPageController extends PageController
{
    private static $allowed_actions = [
        'showpage',
    ];

    private static $url_handlers = [
        'page/$ID' => 'showpage',
    ];

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
            return $viewer->renderWith([
                'type' => 'Includes',
                'SitemapNodeChildren'
            ]);
        }

        return $viewer;
    }
}
