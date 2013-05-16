<?php
class SitemapPageTest extends FunctionalTest {

	protected static $fixture_file = 'SitemapPageTest.yml';

	protected static $use_draft_site = true;

	public function testSitemapShowsNavigationTitleNotNormalTitle() {
		$response = $this->get('sitemap');
		$parser = new CSSContentParser($response->getBody());
		$els = $parser->getBySelector('.sitemap li.first span.title');
		$this->assertEquals('Top page nav 1', (string) $els[0]);
	}

}
