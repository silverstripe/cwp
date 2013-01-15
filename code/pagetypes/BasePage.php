<?php

class BasePage extends SiteTree {

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	static $hide_ancestor = 'BasePage';

}

class BasePage_Controller extends ContentController {

}

