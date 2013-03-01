<?php

class TaxonomyTermExtension extends DataExtension {
	public static $api_access = true;

	public static $belongs_many_many = array(
		'Pages' => 'BasePage'
	);
}