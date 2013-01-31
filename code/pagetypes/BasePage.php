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

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	static $many_many = array(
		'Terms' => 'TaxonomyTerm'
	);

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

		$tagField = new TagField('Terms', null, null, 'SiteTree', 'Name');
		$tagField->setSeparator(',');
		$tagField->createNewTags = false;
		$fields->addFieldToTab('Root.Tags', $tagField);

		return $fields;
	}

}

class BasePage_Controller extends ContentController {

	public static $allowed_actions = array(
		'pdf',
		'downloadpdf'
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
			'themes/module_bootstrap/js/bootstrap-scrollspy.js',
			'themes/module_bootstrap/js/bootstrap-collapse.js',
			'themes/module_bootstrap/js/bootstrap-carousel.js',
			"$themeDir/js/general.js",
			"$themeDir/js/express.js",
			"$themeDir/js/forms.js"
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

		// By media type - first, everything that's global
		Requirements::combine_files('styles.css', $styles['all']);

		// then everything that's screen only
		foreach ($styles['screen'] as $style) {
			Requirements::css($style, 'screen');
		}

		// then everything that's print only
		foreach ($styles['print'] as $style) {
			Requirements::css($style, 'print');
		}

		// Extra folder to keep the relative paths consistent when combining.
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp');
	}

}

