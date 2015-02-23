<?php
/**
 * **BaseHomePage** is the basic home page.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `HomePage` class in the `mysite/code` which will extend from the **BaseHomePage**.
 */

class BaseHomePage extends Page {

	private static $icon = 'cwp/images/icons/sitetree_images/home.png';

	private static $hide_ancestor = 'BaseHomePage';

	private static $singular_name = 'Home Page';

	private static $plural_name = 'Home Pages';

	private static $db = array(
		'FeatureOneTitle' => 'Varchar(255)',
		'FeatureOneCategory' => "Enum('bell,comments,film,flag,globe,group,list,phone,rss,time,user','comments')",
		'FeatureOneContent' => 'HTMLText',
		'FeatureOneButtonText' => 'Varchar(255)',
		'FeatureTwoTitle' => 'Varchar(255)',
		'FeatureTwoCategory' => "Enum('bell,comments,film,flag,globe,group,list,phone,rss,time,user','comments')",
		'FeatureTwoContent' => 'HTMLText',
		'FeatureTwoButtonText' => 'Varchar(255)'
	);

	private static $has_one = array(
		'LearnMorePage' => 'SiteTree',
		'FeatureOneLink' => 'SiteTree',
		'FeatureTwoLink' => 'SiteTree'
	);

	private static $has_many = array(
		'CarouselItems' => 'CarouselItem',
		'Quicklinks' => 'Quicklink.Parent'
	);

	public $pageIcon = 'images/icons/sitetree_images/home.png';

	public function CarouselItems() {
		return $this->getComponents('CarouselItems')->sort('SortOrder');
	}

	public function Quicklinks() {
		return $this->getComponents('Quicklinks')->sort('SortOrder');
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		// Main Content tab
		$fields->addFieldToTab(
			'Root.Main', 
			TreeDropdownField::create(
				'LearnMorePageID', 
				_t('BaseHomePage.LearnMoreLink','Page to link the "Learn More" button to:'), 
				'SiteTree'
			), 
			'Metadata'
		);
		
		// Carousel tab
		$gridField = GridField::create(
			'CarouselItems',
			'Carousel',
			$this->CarouselItems(),
			GridFieldConfig_RelationEditor::create()
		);
		$gridConfig = $gridField->getConfig();
		$gridConfig->getComponentByType('GridFieldAddNewButton')->setButtonName(
			_t('BaseHomePage.AddNewButton','Add new')
		);
		$gridConfig->removeComponentsByType('GridFieldAddExistingAutocompleter');
		$gridConfig->removeComponentsByType('GridFieldDeleteAction');
		$gridConfig->addComponent(new GridFieldDeleteAction());
		$gridConfig->addComponent(new GridFieldSortableRows('SortOrder'));
		$gridField->setModelClass('CarouselItem');

		$fields->addFieldToTab('Root.Carousel', $gridField);

		$gridField = GridField::create(
			'Quicklinks',
			'Quicklinks',
			$this->Quicklinks(),
			GridFieldConfig_RelationEditor::create()
		);
		$gridConfig = $gridField->getConfig();
		$gridConfig->getComponentByType('GridFieldAddNewButton')->setButtonName(
			_t('BaseHomePage.AddNewButton','Add new')
		);
		$gridConfig->removeComponentsByType('GridFieldAddExistingAutocompleter');
		$gridConfig->removeComponentsByType('GridFieldDeleteAction');
		$gridConfig->addComponent(new GridFieldDeleteAction());
		$gridConfig->addComponent(new GridFieldSortableRows('SortOrder'));
		$gridField->setModelClass('Quicklink');

		$fields->addFieldToTab('Root.Quicklinks', $gridField);

		$fields->removeByName('Import');

		$fields->addFieldToTab(
			'Root.Features', 
			ToggleCompositeField::create('FeatureOne', _t('SiteTree.FeatureOne', 'Feature One'),
			array(
				TextField::create('FeatureOneTitle', _t('BaseHomePage.Title','Title')),
				$dropdownField = DropdownField::create(
					'FeatureOneCategory', 
					_t('BaseHomePage.FeatureCategoryDropdown','Category icon'), 
					singleton('BaseHomePage')->dbObject('FeatureOneCategory')->enumValues()
				),
				TreeDropdownField::create(
					'FeatureOneLinkID', 
					_t('BaseHomePage.FeatureLink','Page to link to'), 
					'SiteTree'
				),
				HTMLEditorField::create(
					'FeatureOneContent', 
					_t('BaseHomePage.FeatureContentFieldLabel','Content')
				),
				TextField::create(
					'FeatureOneButtonText', 
					_t('BaseHomePage.FeatureButtonText','Button text')
				)
				)
			)->setHeadingLevel(3)
		);
		$dropdownField->setEmptyString('none');

		$fields->addFieldToTab('Root.Features', ToggleCompositeField::create('FeatureTwo', _t('SiteTree.FeatureTwo', 'Feature Two'),
			array(
				TextField::create('FeatureTwoTitle', _t('BaseHomePage.Title','Title')),
				$dropdownField = DropdownField::create(
					'FeatureTwoCategory', 
					_t('BaseHomePage.FeatureCategoryDropdown','Category icon'),
					singleton('BaseHomePage')->dbObject('FeatureTwoCategory')->enumValues()
				),
				TreeDropdownField::create(
					'FeatureTwoLinkID', 
					_t('BaseHomePage.FeatureLink','Page to link to'), 
					'SiteTree'
				),
				HTMLEditorField::create(
					'FeatureTwoContent', 
					_t('BaseHomePage.FeatureContentFieldLabel','Content')
				),
				TextField::create(
					'FeatureTwoButtonText', 
					_t('BaseHomePage.FeatureButtonText','Button text')
				)
			)
			)->setHeadingLevel(3)
		);
		$dropdownField->setEmptyString('none');

		return $fields;
	}

	public function getVisibleCarouselItems() {
		return $this->CarouselItems()->filter('Archived', false);
	}
}

class BaseHomePage_Controller extends Page_Controller {

	public function getNewsPage() {
		return NewsHolder::get_one('NewsHolder');
	}

	/**
	 * @param int $amount The amount of items to provide.
	 */
	public function getNewsItems($amount = 2) {
		$newsHolder = $this->getNewsPage();
		if ($newsHolder) {
			$controller = new NewsHolder_Controller($newsHolder);
			return $controller->Updates()->limit($amount);
		}
	}
}
