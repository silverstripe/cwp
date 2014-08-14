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

		// Taxonomies
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
			GridField::create(
				'Terms',
				_t('BasePage.Terms','Terms'),
				$this->Terms(),
				$components
			)
		);

		return $fields;
	}

	/**
	 * Provides data for translation navigation.
	 * Collects all site translations, marks the current one, and redirects
	 * to the translated home page if a. there is a translated homepage and b. the 
	 * translation of the specific page is not available.
	 */
	function getAvailableTranslations() {
		
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
				'LangName' => $nativeLangName,
				'Link' => $link,
				'Current' => (Translatable::get_current_locale()==$loc)
			)));
		}

		if ($translations->count()>1) return $translations;
		else return null;
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

	/**
	 * Render the page as PDF using wkhtmltopdf.
	 */
	public function generatePDF() {
		if(!Config::inst()->get('BasePage', 'pdf_export')) return false;

		if(!defined('WKHTMLTOPDF_BINARY')) return user_error('WKHTMLTOPDF_BINARY not defined', E_USER_ERROR);

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

		// Force http protocol on CWP - fetching from localhost without using the proxy, SSL terminates on gateway.
		if (defined('CWP_ENVIRONMENT')) {
			Config::inst()->nest();
			Config::inst()->update('Director', 'alternate_protocol', 'http');
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

		// finally, generate the PDF
		$command = WKHTMLTOPDF_BINARY . ' --outline -B 40pt -L 20pt -R 20pt -T 20pt --encoding utf-8 ' .
			'--orientation Portrait --disable-javascript --quiet --print-media-type ';
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
	public function SearchForm() {
		$searchText =  _t('SearchForm.SEARCH', 'Search');

		if($this->owner->request && $this->owner->request->getVar('Search')) {
			$searchText = $this->owner->request->getVar('Search');
		}

		$fields = new FieldList(
			TextField::create('Search', false, $searchText)
		);
		$actions = new FieldList(
			new FormAction('results', _t('SearchForm.GO', 'Go'))
		);

		$form = new SearchForm($this->owner, 'SearchForm', $fields, $actions);
		$form->setFormAction('search/SearchForm');

		return $form;
	}

	/**
	 * Process and render search results.
	 *
	 * @param array $data The raw request data submitted by user
	 * @param SearchForm $form The form instance that was submitted
	 * @param SS_HTTPRequest $request Request generated for this action
	 */
	public function results($data, $form, $request) {
		$start = isset($data['start']) ? $data['start'] : 0;
		$limit = self::$results_per_page;
		$results = new ArrayList();
		$suggestion = null;
		$keywords = empty($data['Search']) ? '' : $data['Search'];

		if($keywords) {
			$query = new SearchQuery();
			$query->classes = self::$classes_to_search;
			$query->search($keywords);
			$query->exclude('SiteTree_ShowInSearch', 0);

			// Artificially lower the amount of results to prevent too high resource usage.
			// on subsequent canView check loop.
			$query->limit(100);

			try {
				$result = singleton(self::$search_index_class)->search(
					$query,
					$start,
					$limit,
					array(
						'hl' => 'true',
						'spellcheck' => 'true',
						'spellcheck.collate' => 'true'
					)
				);

				$results = $result->Matches;
				$suggestion = $result->Suggestion;
			} catch(Exception $e) {
				SS_Log::log($e, SS_Log::WARN);
			}
		}

		// Clean up the results.
		foreach($results as $result) {
			if(!$result->canView()) $results->remove($result);
		}

		$rssUrl = Controller::join_links(
			$this->Link('SearchForm'),
			'?Search=' . rawurlencode($keywords) . '&format=rss'
		);
		RSSFeed::linkToFeed($rssUrl, 'Search results for "' . $keywords . '"');

		$atomUrl = Controller::join_links(
			$this->Link('SearchForm'),
			'?Search=' . rawurlencode($keywords) . '&format=atom'
		);
		CwpAtomFeed::linkToFeed($atomUrl, 'Search results for "' . $keywords . '"');

		$data = array(
			'PdfLink' => '',
			'Results' => $results,
			'Suggestion' => DBField::create_field('Text', $suggestion),
			'Query' => DBField::create_field('Text', $keywords),
			'Title' => _t('SearchForm.SearchResults', 'Search Results'),
			'RSSLink' => DBField::create_field('Text', $rssUrl),
			'AtomLink' => DBField::create_field('Text', $atomUrl)
		);

		$templates = array('Page_results', 'Page');
		if ($request->getVar('format') == 'rss') {
			array_unshift($templates, 'Page_results_rss');
		}
		if ($request->getVar('format') == 'atom') {
			array_unshift($templates, 'Page_results_atom');
		}

		return $this->owner->customise($data)->renderWith($templates);
	}

	/**
	 * Provide scripts as needed by the *default* theme.
	 * Override this function if you are using a custom theme based on the *default*.
	 */
	protected function getBaseScripts() {
		$themeDir = SSViewer::get_theme_folder();

		return array(
			THIRDPARTY_DIR .'/jquery/jquery.js',
			THIRDPARTY_DIR .'/jquery-ui/jquery-ui.js',
			"$themeDir/js/lib/modernizr.js",
			"$themeDir/js/bootstrap-transition.2.3.1.js",
			'themes/module_bootstrap/js/bootstrap-collapse.js',
			"$themeDir/js/bootstrap-carousel.2.3.1.js",
			"$themeDir/js/general.js",
			"$themeDir/js/express.js",
		);
	}

	/**
	 * Provide stylesheets, as needed by the *default* theme assumed by this recipe.
	 * Override this function if you are using a custom theme based on the *default*.
	 */
	protected function getBaseStyles() {
		$themeDir = SSViewer::get_theme_folder();

		return array(
			'all' => array(
				"$themeDir/css/layout.css",
				"$themeDir/css/typography.css"
			),
			'screen' => array(
				"$themeDir/css/responsive.css"
			),
			'print' => array(
				"$themeDir/css/print.css"
			)
		);
	}

	public function init() {
		parent::init();

		// Include base scripts that are needed on all pages
		Requirements::combine_files('scripts.js', $this->getBaseScripts());

		// Include base styles that are needed on all pages
		$styles = $this->getBaseStyles();

		// Combine by media type.
		Requirements::combine_files('styles.css', $styles['all']);
		Requirements::combine_files('screen.css', $styles['screen'], 'screen');
		Requirements::combine_files('print.css', $styles['print'], 'print');

		// Extra folder to keep the relative paths consistent when combining.
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp-' . SSViewer::current_theme());
	}

	/**
	 * Provide current year.
	 */
	public function CurrentDatetime() {
		return SS_Datetime::now();
	}

}
