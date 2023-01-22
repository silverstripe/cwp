<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Control\Email\Email;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;

/**
 * Customises the comment form to conform to government usability standards
 *
 * {@see CommentingController}
 */
class CwpCommentingExtension extends Extension
{
    public function alterCommentForm(Form $form)
    {
        $fields = $form->Fields();

        if ($emailField = $fields->dataFieldByName('Email')) {
            $emailField
                ->setTitle(_t(__CLASS__ . '.EMAIL_TITLE', 'Email'))
                ->setDescription(_t(__CLASS__ . '.WILL_NOT_BE_PUBLISHED', 'Will not be published.'));
        }

        if ($urlField = $fields->dataFieldByName('URL')) {
            $urlField
                ->setTitle(_t(__CLASS__ . '.WEBSITE_TITLE', 'Your website (optional)'))
                ->setAttribute('placeholder', 'http://');
        }
    }
}
