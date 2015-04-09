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
		$fields->dataFieldByName('Name')
			->setTitle('Name')
			->setDescription('(required)');
		$fields
			->dataFieldByName('Email')
			->setTitle('Email')
			->setDescription('will not be published (required)');
		$fields
			->dataFieldByName('URL')
			->setTitle('Your website (optional)')
			->setAttribute('placeholder','http://');
	}
}
