<?php
class CustomHtmlEditorFieldToolbar extends Extension {

	public function updateMediaForm($form) {
		Requirements::add_i18n_javascript('cwp/javascript/lang');
		Requirements::javascript('cwp/javascript/CustomHtmlEditorFieldToolbar.js');
	}

}
