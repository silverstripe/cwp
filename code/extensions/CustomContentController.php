<?php

class CustomContentController extends Extension {

	public static $allowed_actions = array();

	function onAfterInit() {
		// Add the combined scripts.
		if (method_exists($this->owner, 'getScriptOverrides')) {
			$scripts = $this->owner->getScriptOverrides();
		} else {
			$themeDir = SSViewer::get_theme_folder();
			$scripts = array(
				"$themeDir/js/lib/jquery.js",
				"$themeDir/js/lib/jquery-ui-1.8.21.custom.js",
				'themes/module_bootstrap/js/bootstrap-transition.js',
				'themes/module_bootstrap/js/bootstrap-scrollspy.js',
				'themes/module_bootstrap/js/bootstrap-collapse.js',
				'themes/module_bootstrap/js/bootstrap-carousel.js',
				"$themeDir/js/general.js",
				"$themeDir/js/express.js",
				"$themeDir/js/forms.js"
			);
			if (method_exists($this->owner, 'getScriptIncludes')) {
				$scripts = array_merge($scripts, $this->owner->getScriptIncludes());
			}
		}
		Requirements::combine_files('scripts.js', $scripts);

		// Add the combined styles.
		if (method_exists($this->owner, 'getStyleOverrides')) {
			$scripts = $this->owner->getStyleOverrides();
		} else {
			$styles = array(
				"$themeDir/css/layout.css",
				"$themeDir/css/form.css",
				"$themeDir/css/typography.css"
			);
			if (method_exists($this->owner, 'getStyleIncludes')) {
				$styles = array_merge($styles, $this->owner->getStyleIncludes());
			}
		}
		Requirements::combine_files('styles.css', $styles);

		// Print styles
		if (method_exists($this->owner, 'getPrintStyleOverrides')) {
			$printStyles = $this->owner->getPrintStyleOverrides();
		} else {
			$printStyles = array("$themeDir/css/print.css");
			if (method_exists($this->owner, 'getPrintStyleIncludes')) {
				$printStyles = array_merge($printStyles, $this->owner->getPrintStyleIncludes());
			}
		}
		foreach ($printStyles as $printStyle) {
			Requirements::css($printStyle, 'print');
		}

		// Extra folder to keep the relative paths consistent when combining.
		Requirements::set_combined_files_folder(ASSETS_DIR . '/_combinedfiles/cwp');
	}

	function getFooter() {
		return FooterHolder::get_one('FooterHolder');
	}

	/* 	Give external links the external class, and affix size and type 
		prefixes to files.
	*/
	function Content() {
		$content = $this->owner->Content;

		// Internal links.
		preg_match_all('/<a.*href="\[file_link,id=([0-9]+)\].*".*>.*<\/a>/U', $content, $matches);

		for ($i = 0; $i < count($matches[0]); $i++){
			$file = DataObject::get_by_id('File', $matches[1][$i]);
			if ($file) {
				$size = $file->getSize();
				$ext = strtoupper($file->getExtension());
				$newLink = $matches[0][$i] . "<span class='fileExt'> [$ext, $size]</span>";
				$content = str_replace($matches[0][$i], $newLink, $content);
			}
		}

		// and now external links
		$pattern = '/<a href=\"(h[^\"]*)\">(.*)<\/a>/iU'; 
		$replacement = '<a href="$1" class="external">$2</a>';
		$content = preg_replace($pattern, $replacement, $content, -1);
		
		return $content;
	}
}
