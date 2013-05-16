<?php
class SitemapPage extends Page {

	private static $description = 'Lists all pages on the site';

}
class SitemapPage_Controller extends Page_Controller {

	private static $allowed_actions = array(
		'page'
	);

	public function page($request) {
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
