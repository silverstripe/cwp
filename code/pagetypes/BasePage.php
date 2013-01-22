<?php
/**
 * **BasePage** is the foundation which can be used for constructing your own pages.
 * By default it is hidden from the CMS - we rely on developers creating their own
 * `Page` class in the `mysite/code` which will extend from the **BasePage**.
 */

class BasePage extends SiteTree {

	static $icon = 'cwp/images/icons/sitetree_images/page.png';

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	static $hide_ancestor = 'BasePage';

	/**
	 * Parse the content to augment links with extra attributes and meta information.
	 */
	function Content() {
		$content = $this->getField('Content');

		// Attach sizes to external links.
		preg_match_all('/<a.*href="\[file_link,id=([0-9]+)\].*".*>.*<\/a>/U', $content, $matches);

		for ($i = 0; $i < count($matches[0]); $i++){
			$file = DataObject::get_by_id('File', $matches[1][$i]);
			if ($file) {
				$size = $file->getSize();
				$ext = strtoupper($file->getExtension());
				$newLink = substr($matches[0][$i], 0, strlen($matches[0][$i]) - 4) . "<span class='fileExt'> [$ext, $size]</span></a>";
				$content = str_replace($matches[0][$i], $newLink, $content);
			}
		}

		// Inject class into the external links.
		$pattern = '/<a href=\"(h[^\"]*)\">(.*)<\/a>/iU';
		$replacement = '<a href="$1" class="external" rel="external">$2</a>';
		$content = preg_replace($pattern, $replacement, $content, -1);

		return $content;
	}

	/**
	 * Get the footer holder.
	 */
	function getFooter() {
		return FooterHolder::get_one('FooterHolder');
	}
}

class BasePage_Controller extends ContentController {

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

