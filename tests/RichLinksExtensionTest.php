<?php

class RichLinksExtensionTest extends SapphireTest {

	function testContentLinkInjections() {
		$field = new Text();

		// External links injection.
		$field->setValue('<a href="http://newzealand.govt.nz">New Zealand Government</a>');
		$this->assertEquals(
			$field->RichLinks(),
			'<a class="external" rel="external" href="http://newzealand.govt.nz">New Zealand Government '
			.'<span class="nonvisual-indicator">(external link)</span> </a>',
			'Injects attributes to external link without target.'
		);

		$field->setValue('<a href="http://newzealand.govt.nz" target="_blank">New Zealand Government</a>');
		$this->assertEquals(
			$field->RichLinks(),
			'<a class="external" rel="external" href="http://newzealand.govt.nz" target="_blank">New Zealand Government '
			.'<span class="nonvisual-indicator">(external link)</span> </a>',
			'Injects attributes to external link with target, while keeping the existing attributes.'
		);

		// Check the normal links are not affected.
		$field->setValue('<a href="[sitetree_link,id=1]">Internal</a>');
		$this->assertEquals(
			$field->RichLinks(),
			'<a href="[sitetree_link,id=1]">Internal</a>',
			'Regular link is not modified.'
		);
	}
}

