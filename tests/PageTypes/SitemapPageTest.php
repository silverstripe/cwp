<?php

namespace CWP\CWP\Tests\PageTypes;

use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\CSSContentParser;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\View\SSViewer;

class SitemapPageTest extends FunctionalTest
{
    protected static $fixture_file = 'SitemapPageTest.yml';

    protected static $use_draft_site = true;

    protected function setUp(): void
    {
        parent::setUp();

        Config::modify()->set(SSViewer::class, 'themes', ['starter', '$default']);
    }

    /**
     * Note: this test depends on the "starter" theme being installed and configured as default
     */
    public function testSitemapShowsNavigationTitleNotNormalTitle()
    {
        $this->logInWithPermission('VIEW_DRAFT_CONTENT');
        $response = $this->get('sitemap?stage=Stage');
        $parser = new CSSContentParser($response->getBody());
        $elements = $parser->getBySelector('.sitemap li.first .sitemap-link');
        $this->assertNotEmpty($elements);
        $this->assertEquals('Top page nav 1', (string) $elements[0]);
    }
}
