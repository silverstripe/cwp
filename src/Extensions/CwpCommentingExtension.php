<?php

namespace CWP\CWP\Extensions;



use SilverStripe\Forms\Form;
use SilverStripe\Control\Email\Email;
use SilverStripe\Core\Extension;



/**
 * Customises the comment form to conform to government usability standards
 *
 * {@see CommentingController}
 */
class CwpCommentingExtension extends Extension {
	public function alterCommentForm(Form $form) {
		$fields = $form->Fields();


		if ($emailField = $fields->dataFieldByName(Email::class)) {
			$emailField
				->setTitle(_t('CwpCommentingExtension.EMAIL_TITLE', Email::class))
				->setDescription(_t('CwpCommentingExtension.WILL_NOT_BE_PUBLISHED', 'Will not be published.'));
		}

		if ($urlField = $fields->dataFieldByName('URL')) {
			$urlField
				->setTitle(_t('CwpCommentingExtension.WEBSITE_TITLE', 'Your website (optional)'))
				->setAttribute('placeholder', 'http://');
		}
	}
}
