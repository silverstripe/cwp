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

    private static $table_name = 'SitemapPage';

}
