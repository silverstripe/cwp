<?php

namespace CWP\CWP\Extensions;


use CWP\CWP\PageTypes\BasePage;
use SilverStripe\ORM\DataExtension;


class TaxonomyTermExtension extends DataExtension {

	private static $api_access = true;

	private static $belongs_many_many = array(
		'Pages' => BasePage::class
	);

}
