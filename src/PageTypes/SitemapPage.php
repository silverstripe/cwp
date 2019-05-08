<?php

namespace CWP\CWP\PageTypes;

use Page;

class SitemapPage extends Page
{
    private static $description = 'Lists all pages on the site';

    private static $singular_name = 'Sitemap Page';

    private static $plural_name = 'Sitemap Pages';

    private static $table_name = 'SitemapPage';

    private static $icon_class = 'font-icon-sitemap';
}
