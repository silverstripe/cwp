<?php
/**
 * **BasePage** is the foundation which can be used for constructing your own pages.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `Page` class in the `mysite/code` which will extend from the **BasePage**.
 */

class BasePage extends SiteTree {

	public static $icon = 'cwp/images/icons/sitetree_images/page.png';

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	public static $hide_ancestor = 'BasePage';

	public static $pdf_export_enabled = false;

	public static $generated_pdf_path = 'assets/_generated_pdfs';

	static $api_access = array(
		'view' => array('Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription', 'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID'),
		'edit' => array('Locale', 'URLSegment', 'Title', 'MenuTitle', 'Content', 'MetaDescription', 'ExtraMenu', 'Sort', 'Version', 'ParentID', 'ID')
	);

	public static $related_pages_title = 'Related pages';

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	static $many_many = array(
		'Terms' => 'TaxonomyTerm',
		'RelatedPages' => 'BasePage'
	);

	public static $many_many_extraFields = array(
		'RelatedPages' => array(
			'SortOrder' => 'Int'
		)
	);

	public static $plural_name = 'Base Pages';

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

		$folderPath = self::$generated_pdf_path;
		if($folderPath[0] != '/') $folderPath = BASE_PATH . '/' . $folderPath;

		return sprintf('%s/%s.pdf', $folderPath, $baseName);
	}

	/**
	 * Build pdf link for template.
	 */
	public function PdfLink() {
		if(!self::$pdf_export_enabled) return false;

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
	 */
	public function doUnpublish() {
		if(!parent::doUnpublish()) return;

		$filepath = $this->getPdfFilename();
		if(file_exists($filepath)) {
			unlink($filepath);
		}
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
			'Title' => 'Title',
			'ClassName' => 'Page Type'
		));

		$fields->addFieldToTab(
			'Root.RelatedPages',
			new GridField(
				'RelatedPages',
				'Related pages',
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
			'Name' => 'Term',
			'TaxonomyName' => 'Taxonomy'
		));

		$fields->addFieldToTab(
			'Root.Tags',
			new GridField(
				'Terms',
				'Terms',
				$this->Terms(),
				$components
			)
		);

		return $fields;
	}

}

class BasePage_Controller extends ContentController {

	public static $allowed_actions = array(
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
		if(!BasePage::$pdf_export_enabled) return false;

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
		if(!BasePage::$pdf_export_enabled) return false;

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

		$bodyViewer = $this->getViewer('pdf');

		// write the output of this page to HTML, ready for conversion to PDF
		file_put_contents($bodyFile, $bodyViewer->process($this));

		// get the viewer for the current template with _pdffooter
		$footerViewer = $this->getViewer('pdffooter');

		// write the output of the footer template to HTML, ready for conversion to PDF
		file_put_contents($footerFile, $footerViewer->process($this));

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
			new TextField('Search', false, $searchText)
		);
		$actions = new FieldList(
			new FormAction('results', _t('SearchForm.GO', 'Go'))
		);

		$form = new SearchForm($this->owner, 'SearchForm', $fields, $actions);

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
		$keywords = $form->getSearchQuery();

		if($keywords) {
			$query = new SearchQuery();
			$query->classes = self::$classes_to_search;
			$query->search($keywords);

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

		foreach($results as $result) {
			if(!$result->ShowInSearch) $results->remove($result);
		}

		$data = array(
			'PdfLink' => '',
			'Results' => $results,
			'Suggestion' => $suggestion,
			'Query' => $form->getSearchQuery(),
			'Title' => _t('SearchForm.SearchResults', 'Search Results')
		);

		return $this->owner->customise($data)->renderWith(array('Page_results', 'Page'));
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
			'themes/module_bootstrap/js/bootstrap-transition.js',
			'themes/module_bootstrap/js/bootstrap-collapse.js',
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
				"$themeDir/css/form.css",
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
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp');
	}

	/**
	 * Provide current year.
	 */
	public function CurrentDatetime() {
		return SS_Datetime::now();
	}

}
