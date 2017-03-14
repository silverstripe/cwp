<?php
/**
 * **BasePage** is the foundation which can be used for constructing your own pages.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `Page` class in the `mysite/code` which will extend from the **BasePage**.
 */

class BasePage extends SiteTree {

	private static $icon = 'cwp/images/icons/sitetree_images/page.png';

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	private static $hide_ancestor = 'BasePage';

	private static $pdf_export = false;
	
	/*
	*Domain to generate PDF's from, DOES not include protocol
	*i.e. google.com not http://google.com
	*/
	private static $pdf_base_url = "";

	/**
	 * Allow custom overriding of the path to the WKHTMLTOPDF binary, in cases
	 * where multiple versions of the binary are available to choose from. This
	 * should be the full path to the binary (e.g. /usr/local/bin/wkhtmltopdf)
	 * @see BasePage_Controller::generatePDF();
	 */
	private static $wkhtmltopdf_binary = null;

	private static $generated_pdf_path = 'assets/_generated_pdfs';

	private static $api_access = array(
		'view' => array('Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription', 'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID'),
		'edit' => array('Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription', 'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID')
	);

	public static $related_pages_title = 'Related pages';

	private static $many_many = array(
		'Terms' => 'TaxonomyTerm',
		'RelatedPages' => 'BasePage'
	);

	private static $many_many_extraFields = array(
		'RelatedPages' => array(
			'SortOrder' => 'Int'
		)
	);

	private static $plural_name = 'Base Pages';

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	/**
	 * Get the footer holder.
	 */
	public function getFooter() {
		return FooterHolder::get_one('FooterHolder');
	}

	/**
	 * Return the full filename of the pdf file, including path & extension
	 */
	public function getPdfFilename() {
		$baseName = sprintf('%s-%s', $this->URLSegment, $this->ID);

		$folderPath = Config::inst()->get('BasePage', 'generated_pdf_path');
		if($folderPath[0] != '/') $folderPath = BASE_PATH . '/' . $folderPath;

		return sprintf('%s/%s.pdf', $folderPath, $baseName);
	}

	/**
	 * Build pdf link for template.
	 */
	public function PdfLink() {
		if(!Config::inst()->get('BasePage', 'pdf_export')) return false;

		$path = $this->getPdfFilename();

		if((Versioned::current_stage() == 'Live') && file_exists($path)) {
			return Director::baseURL() . preg_replace('#^/#', '', Director::makeRelative($path));
		} else {
			return $this->Link('downloadpdf');
		}
	}

	public function RelatedPages() {
		return $this->getManyManyComponents('RelatedPages')->sort('SortOrder');
	}

	public function RelatedPagesTitle() {
		return $this->stat('related_pages_title');
	}

	/**
	 * Remove linked pdf when publishing the page,
	 * as it would be out of date.
	 */
	public function onAfterPublish(&$original) {
		$filepath = $this->getPdfFilename();
		if(file_exists($filepath)) {
			unlink($filepath);
		}
	}

	/**
	 * Remove linked pdf when unpublishing the page,
	 * so it's no longer valid.
	 *
	 * @return boolean
	 */
	public function doUnpublish() {
		if(!parent::doUnpublish()) return false;

		$filepath = $this->getPdfFilename();
		if(file_exists($filepath)) {
			unlink($filepath);
		}

		return true;
	}

	/**
	 * @todo Remove once CWP moves to 3.3 core (which includes this in SiteTree)
	 * @return self
	 */
	public function doRestoreToStage() {
		$this->invokeWithExtensions('onBeforeRestoreToStage', $this);
		$result = parent::doRestoreToStage();
		$this->invokeWithExtensions('onAfterRestoreToStage', $this);

		return $result;
	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		// Related Pages
		$components = GridFieldConfig_RelationEditor::create();
		$components->removeComponentsByType('GridFieldAddNewButton');
		$components->removeComponentsByType('GridFieldEditButton');
		$components->removeComponentsByType('GridFieldFilterHeader');
		$components->addComponent(new GridFieldSortableRows('SortOrder'));

		$dataColumns = $components->getComponentByType('GridFieldDataColumns');
		$dataColumns->setDisplayFields(array(
			'Title' => _t('BasePage.ColumnTitle', 'Title'),
			'ClassName' => _t('BasePage.ColumnPageType', 'Page Type')
		));

		$fields->findOrMakeTab(
			'Root.RelatedPages',
			_t('BasePage.RelatedPages','Related pages')
		);
		$fields->addFieldToTab(
			'Root.RelatedPages',
			GridField::create(
				'RelatedPages',
				_t('BasePage.RelatedPages','Related pages'),
				$this->RelatedPages(),
				$components
			)
		);

		// Taxonomies - Unless they have their own 'Tags' field (such as in Blog, etc)
		if(!$this->has_many('Tags') && !$this->many_many('Tags')) {
			$components = GridFieldConfig_RelationEditor::create();
			$components->removeComponentsByType('GridFieldAddNewButton');
			$components->removeComponentsByType('GridFieldEditButton');

			$autoCompleter = $components->getComponentByType('GridFieldAddExistingAutocompleter');
			$autoCompleter->setResultsFormat('$Name ($TaxonomyName)');

			$dataColumns = $components->getComponentByType('GridFieldDataColumns');
			$dataColumns->setDisplayFields(array(
				'Name' => _t('BasePage.Term','Term'),
				'TaxonomyName' => _t('BasePage.Taxonomy','Taxonomy')
			));

			$fields->findOrMakeTab('Root.Tags', _t('BasePage.TagsTabTitle', 'Tags'));
			$fields->addFieldToTab(
				'Root.Tags',
				TreeMultiselectField::create(
					'Terms',
					_t('BasePage.Terms','Terms'),
					'TaxonomyTerm'
				)->setDescription(_t('BasePage.TermsDescription', 'Click to search for additional terms'))
			);
		}

		return $fields;
	}

	/**
	 * Provides data for translation navigation.
	 * Collects all site translations, marks the current one, and redirects
	 * to the translated home page if a. there is a translated homepage and b. the
	 * translation of the specific page is not available.
	 */
	public function getAvailableTranslations() {

		if(!class_exists('Translatable')){
			return false;
		}

		$translations = new ArrayList();
		$globalTranslations = Translatable::get_existing_content_languages();

		foreach ($globalTranslations as $loc=>$langName) {

			// Find out the language name in native language.
			$nativeLangName = i18n::get_language_name($loc, true);
			if (!$nativeLangName) {
				$nativeLangName = i18n::get_language_name(i18n::get_lang_from_locale($loc), true);
			}
			if (!$nativeLangName) {
				// Fall back to the locale name.
				$nativeLangName = $langName;
			}

			// Eliminate the part in brackets (e.g. [mandarin])
			$nativeLangName = preg_replace('/ *[\(\[].*$/', '', $nativeLangName);

			// Find out the link to the translated page.
			$link = null;
			$page = $this->getTranslation($loc);
			if ($page) {
				$link = $page->Link();
			}
			if (!$link) {
				// Fall back to the home page
				$link = Translatable::get_homepage_link_by_locale($loc);
			}
			if (!$link) {
				continue;
			}

			// Assemble the table for the switcher.
			$translations->push(new ArrayData(array(
				'Locale' => i18n::convert_rfc1766($loc),
				'LangName' => $nativeLangName,
				'Link' => $link,
				'Current' => (Translatable::get_current_locale()==$loc)
			)));
		}

		if ($translations->count()>1) return $translations;
		else return null;
	}

	/**
     * Returns the native language name for the selected locale/language, empty string if Translatable is not available
     *
     * @return string
     */
    public function getSelectedLanguage()
    {
        if (!class_exists('Translatable')) {
            return '';
        }

        $language = explode('_', Translatable::get_current_locale());
        $languageCode = array_shift($language);
        $nativeName = i18n::get_language_name($languageCode, true);

        return $nativeName;
    }

	/**
	 * Decide whether the current configured theme is the "default" CWP theme
	 *
	 * @return bool
	 */
	public function getIsDefaultTheme()
	{
		if (class_exists('SiteConfig') && ($config = SiteConfig::current_site_config()) && $config->Theme) {
			$theme = $config->Theme;
		} elseif (Config::inst()->get('SSViewer', 'theme_enabled') && Config::inst()->get('SSViewer', 'theme')) {
			$theme = Config::inst()->get('SSViewer', 'theme');
		} else {
			$theme = false;
		}
		return $theme === 'default';
	}
}

class BasePage_Controller extends ContentController {

	private static $allowed_actions = array(
		'downloadpdf',
		'SearchForm',
		'results'
	);

	/**
	 * How many search results should be shown per-page?
	 * @var int
	 */
	public static $results_per_page = 10;

	public static $search_index_class = 'SolrSearchIndex';
	
	/**
	 * If spelling suggestions for searches are given, enable
	 * suggested searches to be followed immediately
	 *
	 * @config
	 * @var bool
	 */
	private static $search_follow_suggestions = true;

	/**
	 * Which classes should be queried when searching?
	 * @var array
	 */
	public static $classes_to_search = array(
		array(
			'class' => 'Page',
			'includeSubclasses' => true
		)
	);

	/**
	 * Serve the page rendered as PDF.
	 */
	public function downloadpdf() {
		if(!Config::inst()->get('BasePage', 'pdf_export')) return false;

		// We only allow producing live pdf. There is no way to secure the draft files.
		Versioned::reading_stage('Live');

		$path = $this->dataRecord->getPdfFilename();
		if(!file_exists($path)) {
			$this->generatePDF();
		}

		return SS_HTTPRequest::send_file(file_get_contents($path), basename($path), 'application/pdf');
	}

	/*
	* This will return either pdf_base_url from YML, CWP_SECURE_DOMAIN
	* from _ss_environment, or blank. In that order of importance.
	*/
	public function getPDFBaseURL() {
		//if base url YML is defined in YML, use that
		if(Config::inst()->get('BasePage', 'pdf_base_url')){
			$pdf_base_url = Config::inst()->get('BasePage', 'pdf_base_url').'/';
		//otherwise, if we are CWP use the secure domain
		} elseif (defined('CWP_SECURE_DOMAIN')){
			$pdf_base_url = CWP_SECURE_DOMAIN.'/';
		//or if neither, leave blank
		} else {
			$pdf_base_url = '';
		}
		return $pdf_base_url;
	}

	/*
	* Don't use the proxy if the pdf domain is the CWP secure domain
	* Or if we aren't on a CWP server
	*/
	public function getPDFProxy($pdf_base_url) {
		if (!defined('CWP_SECURE_DOMAIN') || $pdf_base_url == CWP_SECURE_DOMAIN.'/') {
 		 	$proxy = '';
		} else {
			$proxy = ' --proxy ' . SS_OUTBOUND_PROXY . ':' . SS_OUTBOUND_PROXY_PORT;
		}
		return $proxy;
	}

	/**
	 * Render the page as PDF using wkhtmltopdf.
	 */
	public function generatePDF() {
		if(!Config::inst()->get('BasePage', 'pdf_export')) return false;

		$binaryPath = Config::inst()->get('BasePage', 'wkhtmltopdf_binary');
		if(!$binaryPath || !is_executable($binaryPath)) {
			if(defined('WKHTMLTOPDF_BINARY') && is_executable(WKHTMLTOPDF_BINARY)) {
				$binaryPath = WKHTMLTOPDF_BINARY;
			}
		}

		if(!$binaryPath) {
			user_error('Neither WKHTMLTOPDF_BINARY nor BasePage.wkhtmltopdf_binary are defined', E_USER_ERROR);
		}

		if(Versioned::get_reading_mode() == 'Stage.Stage') {
			user_error('Generating PDFs on draft is not supported', E_USER_ERROR);
		}

		set_time_limit(60);

		// prepare the paths
		$pdfFile = $this->dataRecord->getPdfFilename();
		$bodyFile = str_replace('.pdf', '_pdf.html', $pdfFile);
		$footerFile = str_replace('.pdf', '_pdffooter.html', $pdfFile);

		// make sure the work directory exists
		if(!file_exists(dirname($pdfFile))) Filesystem::makeFolder(dirname($pdfFile));
	
		//decide the domain to use in generation
		$pdf_base_url = $this->getPDFBaseURL();

		// Force http protocol on CWP - fetching from localhost without using the proxy, SSL terminates on gateway.
		if (defined('CWP_ENVIRONMENT')) {
			Config::inst()->nest();
			Config::inst()->update('Director', 'alternate_protocol', 'http');
			//only set alternate protocol if CWP_SECURE_DOMAIN is defined OR pdf_base_url is
			if($pdf_base_url){
				Config::inst()->update('Director', 'alternate_base_url', 'http://'.$pdf_base_url);
			}
		}

		$bodyViewer = $this->getViewer('pdf');

		// write the output of this page to HTML, ready for conversion to PDF
		file_put_contents($bodyFile, $bodyViewer->process($this));

		// get the viewer for the current template with _pdffooter
		$footerViewer = $this->getViewer('pdffooter');

		// write the output of the footer template to HTML, ready for conversion to PDF
		file_put_contents($footerFile, $footerViewer->process($this));

		if (defined('CWP_ENVIRONMENT')) {
			Config::inst()->unnest();
		}

		//decide what the proxy should look like
		$proxy = $this->getPDFProxy($pdf_base_url);

		// finally, generate the PDF
		$command = WKHTMLTOPDF_BINARY . $proxy . ' --outline -B 40pt -L 20pt -R 20pt -T 20pt --encoding utf-8 --orientation Portrait --disable-javascript --quiet --print-media-type ';
		$retVal = 0;
		$output = array();
		exec($command . " --footer-html \"$footerFile\" \"$bodyFile\" \"$pdfFile\" &> /dev/stdout", $output, $return_val);

		// remove temporary file
		unlink($bodyFile);
		unlink($footerFile);

		// output any errors
		if($return_val != 0) {
			user_error('wkhtmltopdf failed: ' . implode("\n", $output), E_USER_ERROR);
		}

		// serve the generated file
		return SS_HTTPRequest::send_file(file_get_contents($pdfFile), basename($pdfFile), 'application/pdf');
	}

	/**
	 * Site search form
	 */
	public function SearchForm()
	{
			$searchText = $this->getRequest()->getVar('Search');

		$fields = new FieldList(
			TextField::create('Search', false, $searchText)
		);
		$actions = new FieldList(
			new FormAction('results', _t('SearchForm.GO', 'Go'))
		);

		$form = SearchForm::create($this, 'SearchForm', $fields, $actions);
		$form->setFormAction('search/SearchForm');

		return $form;
	}

	/**
	 * Get search form with _header suffix
	 *
	 * @return SearchForm
	 */
	public function HeaderSearchForm()
	{
		return $this->SearchForm()->setTemplate('SearchForm_header');
	}

	/**
	 * Process and render search results.
	 *
	 * @param array $data The raw request data submitted by user
	 * @param SearchForm $form The form instance that was submitted
	 * @param SS_HTTPRequest $request Request generated for this action
	 * @return HTMLText
	 */
	public function results($data, $form, $request) {
		// Check parameters for terms, pagination, and if we should follow suggestions
		$keywords = empty($data['Search']) ? '' : $data['Search'];
		$start = isset($data['start']) ? $data['start'] : 0;
		$suggestions = isset($data['suggestions'])
			? $data['suggestions']
			: $this->config()->search_follow_suggestions;
		
		$results = CwpSearchEngine::create()
			->search(
				$keywords,
				$this->getClassesToSearch(),
				$this->getSearchIndex(),
				$this->getSearchPageSize(),
				$start,
				$suggestions
			);

		// Customise content with these results
		$properties = array(
			'MetaTitle' => _t('CWP_Search.MetaTitle', 'Search {keywords}', array('keywords' => $keywords)),
			'NoSearchResults' => _t('CWP_Search.NoResult', 'Sorry, your search query did not return any results.'),
			'EmptySearch' => _t('CWP_Search.EmptySearch', 'Search field empty, please enter your search query.'),
			'PdfLink' => '',
			'Title' => _t('SearchForm.SearchResults', 'Search Results'),
		);
		$this->extend('updateSearchResults', $results, $properties);

		// Customise page
		$response = $this->customise($properties);
		if($results) {
			$response = $response
				->customise($results)
				->customise(array( 'Results' => $results->getResults() ));
		}
		
		// Render
		$templates = $this->getResultsTemplate($request);
		return $response->renderWith($templates);
	}
	
	/**
	 * Select the template to render search results with
	 * 
	 * @param SS_HTTPRequest $request
	 * @return array
	 */
	protected function getResultsTemplate($request) {
		$templates = array('Page_results', 'Page');
		if ($request->getVar('format') == 'rss') {
			array_unshift($templates, 'Page_results_rss');
		}
		if ($request->getVar('format') == 'atom') {
			array_unshift($templates, 'Page_results_atom');
		}
		return $templates;
	}

	/**
	 * Provide scripts as needed by the *default* theme.
	 * Override this function if you are using a custom theme based on the *default*.
	 *
	 * @deprecated 1.6..2.0 Use "starter" theme instead
	 */
	public function getBaseScripts() {
		$scripts = array();
		$this->extend('updateBaseScripts', $scripts);
		return $scripts;
	}

	/**
	 * Provide stylesheets, as needed by the *default* theme assumed by this recipe.
	 * Override this function if you are using a custom theme based on the *default*.
	 *
	 * @deprecated 1.6..2.0 Use "starter" theme instead
	 */
	public function getBaseStyles() {
		$styles = array();
		$this->extend('updateBaseStyles', $styles);
		return $styles;
	}

	/**
	 * Provide current year.
	 */
	public function CurrentDatetime() {
		return SS_Datetime::now();
	}

	public function getRSSLink() {
	}

	/**
	 * Get the search index registered for this application
	 *
	 * @return CwpSearchIndex
	 */
	protected function getSearchIndex()
	{
		// Will be a service name in 2.0 and returned via injector
		/** @var CwpSearchIndex $index */
		$index = null;
		if (self::$search_index_class) {
			$index = Object::singleton(self::$search_index_class);
		}
		return $index;
	}

	/**
	 * Gets the list of configured classes to search
	 *
	 * @return array
	 */
	protected function getClassesToSearch()
	{
		// Will be private static config in 2.0
		return self::$classes_to_search;
	}

	/**
	 * Get page size for search
	 *
	 * @return int
	 */
	protected function getSearchPageSize()
	{
		// Will be private static config in 2.0
		return self::$results_per_page;
	}
}
