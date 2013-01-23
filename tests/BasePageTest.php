<?php

class BasePageTest extends SapphireTest {

	function testContentLinkInjections() {
		// External links injection.
		$basePage = new BasePage();
		$basePage->Content = '<a href="http://newzealand.govt.nz">New Zealand Government</a>';
		$this->assertEquals(
			$basePage->Content(),
			'<a class="external" rel="external" href="http://newzealand.govt.nz">New Zealand Government</a>',
			'Injects attributes to external link without target.'
		);

		$basePage->Content = '<a href="http://newzealand.govt.nz" target="_blank">New Zealand Government</a>';
		$this->assertEquals(
			$basePage->Content(),
			'<a class="external" rel="external" href="http://newzealand.govt.nz" target="_blank">New Zealand Government</a>',
			'Injects attributes to external link with target, while keeping the existing attributes.'
		);

		// Check the normal links are not affected.
		$basePage->Content = '<a href="[sitetree_link,id=1]">Internal</a>';
		$this->assertEquals(
			$basePage->Content(),
			'<a href="[sitetree_link,id=1]">Internal</a>',
			'Regular link is not modified.'
		);
	}
}

