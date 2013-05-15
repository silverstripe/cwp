<?php
class TaxonomyTermExtension extends DataExtension {

	private static $api_access = true;

	private static $belongs_many_many = array(
		'Pages' => 'BasePage'
	);

}
