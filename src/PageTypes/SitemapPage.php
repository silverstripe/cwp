<?php

namespace CWP\CWP\PageTypes;

use Page;




use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\Deprecation;
use SilverStripe\CMS\Model\SiteTree;
use PageController;


class SitemapPage extends Page {

	private static $description = 'Lists all pages on the site';

	private static $singular_name = 'Sitemap Page';

	private static $plural_name = 'Sitemap Pages';

}
class SitemapPage_Controller extends PageController {

	private static $allowed_actions = array(
		'showpage',
	);

	private static $url_handlers = array(
		'page/$ID' => 'showpage',
	);

	public function Page($link) {
		if($link instanceof HTTPRequest) {
			Deprecation::notice('2.0', 'Using page() as a url handler is deprecated. Use showpage() action instead');
			return $this->showpage($link);
		}
		return parent::Page($link);
	}

	public function showpage($request) {
		$id = (int) $request->param('ID');
		if(!$id) {
			return false;
		}
		$page = SiteTree::get()->byId($id);

		// does the page exist?
		if(!($page && $page->exists())) {
			return $this->httpError(404);
		}

		// can the page be viewed?
		if(!$page->canView()) {
			return $this->httpError(403);
		}

		$viewer = $this->customise(array(
			'IsAjax' => $request->isAjax(),
			'SelectedPage' => $page,
			'Children' => $page->Children()
		));

		if($request->isAjax()) {
			return $viewer->renderWith('SitemapNodeChildren');
		} else {
			return $viewer;
		}
	}

}
