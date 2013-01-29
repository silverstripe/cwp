<?php
class CustomHtmlEditorFieldToolbar extends Extension {

	public function updateMediaForm($form) {
		Requirements::javascript('cwp/js/CustomHtmlEditorFieldToolbar.js');
	}

}
