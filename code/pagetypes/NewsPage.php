<?php

class NewsPage extends DatedUpdatePage {

	private static $description = 'Describes an item of news';

	private static $default_parent = 'NewsHolderPage';

	private static $can_be_root = false;

	private static $icon = 'cwp/images/icons/sitetree_images/news.png';

	private static $db = array(
		'Author' => 'Varchar(255)'
	);

	private static $has_one = array(
		'FeaturedImage' => 'Image'
	);

	public $pageIcon =  'images/icons/sitetree_images/news.png';

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField('Author'), 'Abstract');

		$fields->addFieldToTab('Root.Main', new UploadField('FeaturedImage'), 'Abstract');

		return $fields;
	}
}

class NewsPage_Controller extends DatedUpdatePage_Controller {
	
}
