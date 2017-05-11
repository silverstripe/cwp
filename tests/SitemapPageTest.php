<?php
class SitemapPageTest extends FunctionalTest {

	protected static $fixture_file = 'SitemapPageTest.yml';

	protected static $use_draft_site = true;

	/**
	 * Note: this test depends on the "starter" theme being installed and configured as default
	 */
	public function testSitemapShowsNavigationTitleNotNormalTitle() {
		$response = $this->get('sitemap');
		$parser = new CSSContentParser($response->getBody());
		$elements = $parser->getBySelector('.sitemap li.first .sitemap-link');
		$this->assertNotEmpty($elements);
		$this->assertEquals('Top page nav 1', (string) $elements[0]);
	}
}
