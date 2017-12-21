<?php

namespace CWP\CWP\PageTypes;




use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;



class NewsPage extends DatedUpdatePage {

	private static $description = 'Describes an item of news';

	private static $default_parent = 'NewsHolderPage';

	private static $can_be_root = false;

	private static $icon = 'cwp/images/icons/sitetree_images/news.png';

	private static $singular_name = 'News Page';

	private static $plural_name = 'News Pages';

	private static $db = array(
		'Author' => 'Varchar(255)'
	);

	private static $has_one = array(
		'FeaturedImage' => Image::class
	);

    private static $table_name = 'NewsPage';

	public $pageIcon =  'images/icons/sitetree_images/news.png';

	public function fieldLabels($includerelations = true) {
		$labels = parent::fieldLabels($includerelations);
		$labels['Author'] = _t('DateUpdatePage.AuthorFieldLabel', 'Author');
		$labels['FeaturedImageID'] = _t('DateUpdatePage.FeaturedImageFieldLabel', 'Featured Image');

		return $labels;
	}

	public function getCMSFields() {
		$this->beforeUpdateCMSFields(function (FieldList $fields) {
			$fields->addFieldToTab(
				'Root.Main',
				TextField::create('Author', $this->fieldLabel('Author')),
				'Abstract'
			);

			$fields->addFieldToTab(
				'Root.Main',
				UploadField::create('FeaturedImage', $this->fieldLabel('FeaturedImageID')),
				'Abstract'
			);
		});
		return parent::getCMSFields();
	}
}
