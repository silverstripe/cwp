<?php

/**
 * Customises the comment form to conform to government usability standards
 *
 * {@see CommentingController}
 */
class CwpCommentingExtension extends Extension {
	public function alterCommentForm(Form $form) {
		$fields = $form->Fields();

		// Set field names and descriptions
		if($nameField = $fields->dataFieldByName('Name')) {
			$nameField
				->setTitle('Name')
				->setDescription('(required)');
		}

		if($emailField = $fields->dataFieldByName('Email')) {
			$emailField
				->setTitle('Email')
				->setDescription('will not be published (required)');
		}

		if($urlField = $fields->dataFieldByName('URL')) {
			$urlField
				->setTitle('Your website (optional)')
				->setAttribute('placeholder','http://');
		}
	}
}
