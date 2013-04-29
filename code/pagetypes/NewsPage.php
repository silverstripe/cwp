<?php

class NewsPage extends DatedUpdatePage {

	private static $description = 'Describes an item of news';

	static $default_parent = 'NewsHolderPage';

	static $can_be_root = false;

	static $icon = 'cwp/images/icons/sitetree_images/news.png';

	public $pageIcon =  'images/icons/sitetree_images/news.png';

	static $db = array(
		'Author' => 'Varchar(255)'
	);

	static $has_one = array(
		'FeaturedImage' => 'Image'
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Main', new TextField('Author'), 'Abstract');

		$fields->addFieldToTab('Root.Main', new UploadField('FeaturedImage'), 'Abstract');

		return $fields;
	}
}

class NewsPage_Controller extends DatedUpdatePage_Controller {
	
}
