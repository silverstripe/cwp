<?php
class ExpressHomePage extends Page {

	static $icon = "themes/express/images/icons/sitetree_images/home.png";
	public $pageIcon =  "images/icons/sitetree_images/home.png";

	static $db = array(
		'FeatureOneTitle' => 'Varchar(255)',
		'FeatureOneCategory' => "Enum('comments, group, news', 'comments')",
		'FeatureOneContent' => 'HTMLText',
		'FeatureOneButtonText' => 'Varchar(255)',
		'FeatureTwoTitle' => 'Varchar(255)',
		'FeatureTwoCategory' => "Enum('comments, group, news', 'group')",
		'FeatureTwoContent' => 'HTMLText',
		'FeatureTwoButtonText' => 'Varchar(255)'
	);

	static $has_one = array(
		'LearnMorePage' => 'SiteTree',
		'FeatureOneLink' => 'SiteTree',
		'FeatureTwoLink' => 'SiteTree'
	);

	static $has_many = array(
		'CarouselItems' => 'CarouselItem',
		'Quicklinks' => 'Quicklink'
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();

		// Main Content tab
		$fields->addFieldToTab('Root.Main', new TreeDropdownField('LearnMorePageID', 'Page to link the "Learn More" button to:', 'SiteTree'), 'Metadata');
		// Carousel tab
		$gridField = new GridField(
			'CarouselItems',
			'Carousel',
			$this->CarouselItems()->sort('Archived'),
			GridFieldConfig_RelationEditor::create());
		$gridField->setModelClass('CarouselItem');
		$fields->addFieldToTab('Root.Carousel', $gridField);

		$gridField = new GridField(
			'Quicklinks',
			'Quicklinks',
			$this->Quicklinks(),
			GridFieldConfig_RelationEditor::create());
		$gridField->setModelClass('Quicklink');
		$fields->addFieldToTab('Root.Quicklinks', $gridField);

		$fields->removeByName('Translations');
		$fields->removeByName('Import');

		$fields->addFieldToTab('Root.Features',ToggleCompositeField::create('FeatureOne', _t('SiteTree.FeatureOne', 'Feature One'),
			array(
				new TextField('FeatureOneTitle', 'Title'),
				new DropdownField('FeatureOneCategory', 'Category', singleton('ExpressHomePage')->dbObject('FeatureOneCategory')->enumValues(), '', null, 'none'),
				new HTMLEditorField('FeatureOneContent', 'Content'),
				new TreeDropdownField('FeatureOneLinkID', 'Page to link to', 'SiteTree'),
				new TextField('FeatureOneButtonText', 'Button text')
				)
			)->setHeadingLevel(3)
		);

		$fields->addFieldToTab('Root.Features',ToggleCompositeField::create('FeatureTwo', _t('SiteTree.FeatureTwo', 'Feature Two'),
			array(
				new TextField('FeatureTwoTitle', 'Title'),
				new DropdownField('FeatureTwoCategory', 'Category', singleton('ExpressHomePage')->dbObject('FeatureTwoCategory')->enumValues(), '', null, 'none'),
				new HTMLEditorField('FeatureTwoContent', 'Content'),
				new TreeDropdownField('FeatureTwoLinkID', 'Page to link to', 'SiteTree'),
				new TextField('FeatureTwoButtonText', 'Button text')
				)
			)->setHeadingLevel(3)
		);

		return $fields;
	}

	function getVisibleCarouselItems() {
		return $this->CarouselItems()->filter('Archived', false);
	}
}

class ExpressHomePage_Controller extends Page_Controller {

	/**
	 * @param int $amount The amount of items to provide.
	 */
	public function getNewsItems($amount = 2) {
		$newsHolder = NewsHolder::get_one('NewsHolder');
		if ($newsHolder) {
			$controller = new NewsHolder_Controller($newsHolder);
			return $controller->getNewsItems($amount);
		}
	}

	public function getNews(){
		return DataObject::get_one("NewsHolder");
	}

	/**
	 * Overrides the ContentControllerSearchExtension and adds snippets to results.
	 */
	function results($data, $form, $request) {
		$this->linkToAllSiteRSSFeed();

		$results = $form->getResults();
		$query = $form->getSearchQuery();

		// Add context summaries based on the queries.
		foreach ($results as $result) {
			$contextualTitle = new Text();
			$contextualTitle->setValue($result->MenuTitle ? $result->MenuTitle : $result->Title);
			$result->ContextualTitle = $contextualTitle->ContextSummary(300, $query);

			if (!$result->Content && $result->ClassName=='File') {
				// Fake some content for the files.
				$result->ContextualContent = "A file named \"$result->Name\" ($result->Size).";
			}
			else {
				$result->ContextualContent = $result->obj('Content')->ContextSummary(300, $query);
			}
		}

		$rssLink = HTTP::setGetVar('rss', '1');

		// Render the result.
		$data = array(
			'Results' => $results,
			'Query' => $query,
			'Title' => _t('SearchForm.SearchResults', 'Search Results'),
			'RSSLink' => $rssLink
		);

		// Choose the delivery method - rss or html.
		if(!$this->owner->request->getVar('rss')) {
			// Add RSS feed to normal search.
			RSSFeed::linkToFeed($rssLink, "Search results for query \"$query\".");

			return $this->owner->customise($data)->renderWith(array('Page_results', 'Page'));
		}
		else {
			// De-paginate and reorder. Sort-by-relevancy doesn't make sense in RSS context.
			$fullList = $results->getList()->sort('LastEdited', 'DESC');

			// Get some descriptive strings
			$siteName = SiteConfig::current_site_config()->Title;
			$siteTagline = SiteConfig::current_site_config()->Tagline;
			if ($siteName) {
				$title = "$siteName search results for query \"$query\".";
			}
			else {
				$title = "Search results for query \"$query\".";
			}

			// Generate the feed content.
			$rss = new RSSFeed($fullList, $this->owner->request->getURL(), $title, $siteTagline, "Title", "ContextualContent", null);
			$rss->setTemplate('Page_results_rss');
			return $rss->outputToBrowser();
		}
	}
}