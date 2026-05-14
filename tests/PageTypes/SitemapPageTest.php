<?php

namespace CWP\CWP\Tests\PageTypes;

use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\CSSContentParser;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\SessionManager\Models\LoginSession;
use SilverStripe\View\SSViewer;

class SitemapPageTest extends FunctionalTest
{
    protected static $fixture_file = 'SitemapPageTest.yml';

    protected static $use_draft_site = true;

    protected function setUp(): void
    {
        parent::setUp();

        // Disable IP anonymization to avoid TypeError when session-manager passes a null IP
        // (from a CLI test request) to IpUtils::anonymize() in PHP 8.3+ / newer symfony versions
        Config::modify()->set(LoginSession::class, 'anonymize_ip', false);
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
