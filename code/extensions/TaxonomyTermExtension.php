<?php

class TaxonomyTermExtension extends DataExtension {
	public static $belongs_many_many = array(
		'Pages' => 'SiteTree'
	);
}