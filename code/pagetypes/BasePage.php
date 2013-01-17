<?php

class BasePage extends SiteTree {

	static $icon = 'cwp/images/icons/sitetree_images/page.png';

	public $pageIcon = 'images/icons/sitetree_images/page.png';

	// Hide this page type from the CMS. hide_ancestor is slightly misnamed, should really be just "hide"
	static $hide_ancestor = 'BasePage';

	/**
	 * Give external links the external class, and affix size and type prefixes to files.
	 */
	function Content() {
		$content = parent::Content();

		// Internal links.
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

		// and now external links
		$pattern = '/<a href=\"(h[^\"]*)\">(.*)<\/a>/iU';
		$replacement = '<a href="$1" class="external">$2</a>';
		$content = preg_replace($pattern, $replacement, $content, -1);

		return $content;
	}

	/**
	 * Get the footer page
	 */
	function getFooter() {
		return FooterHolder::get_one('FooterHolder');
	}
}

class BasePage_Controller extends ContentController {

	function init() {
		parent::init();

		// Add the combined scripts.
		if (method_exists($this, 'getScriptOverrides')) {
			$scripts = $this->getScriptOverrides();
		} else {
			$themeDir = SSViewer::get_theme_folder();
			$scripts = array(
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
			if (method_exists($this, 'getScriptIncludes')) {
				$scripts = array_merge($scripts, $this->getScriptIncludes());
			}
		}
		Requirements::combine_files('scripts.js', $scripts);

		// Add the combined styles.
		if (method_exists($this, 'getStyleOverrides')) {
			$scripts = $this->getStyleOverrides();
		} else {
			$styles = array(
				"$themeDir/css/layout.css",
				"$themeDir/css/form.css",
				"$themeDir/css/typography.css"
			);
			if (method_exists($this, 'getStyleIncludes')) {
				$styles = array_merge($styles, $this->getStyleIncludes());
			}
		}
		Requirements::combine_files('styles.css', $styles);

		// Print styles
		if (method_exists($this, 'getPrintStyleOverrides')) {
			$printStyles = $this->getPrintStyleOverrides();
		} else {
			$printStyles = array("$themeDir/css/print.css");
			if (method_exists($this, 'getPrintStyleIncludes')) {
				$printStyles = array_merge($printStyles, $this->getPrintStyleIncludes());
			}
		}
		foreach ($printStyles as $printStyle) {
			Requirements::css($printStyle, 'print');
		}

		// Extra folder to keep the relative paths consistent when combining.
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp');
	}
}

