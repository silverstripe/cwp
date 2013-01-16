<?php

class BasePage extends SiteTree {

	static $icon = 'cwp/images/icons/sitetree_images/page.png';

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	static $hide_ancestor = 'BasePage';

}

class BasePage_Controller extends ContentController {

}

