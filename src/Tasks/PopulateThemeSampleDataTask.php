<?php

namespace CWP\CWP\Tasks;

use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\BuildTask;
use SilverStripe\UserForms\Model\EditableFormField\EditableEmailField;
use SilverStripe\UserForms\Model\EditableFormField\EditableFormStep;
use SilverStripe\UserForms\Model\EditableFormField\EditableTextField;
use SilverStripe\UserForms\Model\UserDefinedForm;
use SilverStripe\Versioned\Versioned;

/**
 * Used to populate sample data when installing the starter or Wātea theme
 */
class PopulateThemeSampleDataTask extends BuildTask
{
    protected $title = 'Populate sample data for theme demo';

    protected $description = 'Populates some sample data for showcasing the functionality of the '
        . 'starter and Wātea themes';

    /**
     * A series of method calls to create sample data
     *
     * @param HTTPRequest $request
     */
    public function run($request)
    {
        if (!class_exists(UserDefinedForm::class)) {
            return;
        }
        $this->handleContactForm();
    }

    /**
     * Decide whether to create a contact user defined form, and call it to be be created if so
     *
     * @return $this
     */
    protected function handleContactForm()
    {
        if (!$this->getContactFormExists()) {
            $this->createContactForm();
        }
        return $this;
    }

    /**
     * Determine whether a "contact us" userform exists yet
     *
     * @return bool
     */
    protected function getContactFormExists()
    {
        $exists = false;
        foreach (UserDefinedForm::get()->column('ID') as $formId) {
            $count = Versioned::get_all_versions(UserDefinedForm::class, $formId)
                ->filter('URLSegment', 'contact')
                ->count();

            if ($count >= 1) {
                $exists = true;
                break;
            }
        }
        return $exists;
    }

    /**
     * Create a "contact us" userform. Please note that this form does not have any recipients by default, so
     * no emails will be sent. To add recipients - edit the page in the CMS and add a recipient via the "Recipients"
     * tab.
     *
     * @return $this
     */
    protected function createContactForm()
    {
        $form = UserDefinedForm::create(array(
            'Title' => 'Contact',
            'URLSegment' => 'contact',
            'Content' => '<p>$UserDefinedForm</p>',
            'SubmitButtonText' => 'Submit',
            'ClearButtonText' => 'Clear',
            'OnCompleteMessage' => "<p>Thanks, we've received your submission and will be in touch shortly.</p>",
            'EnableLiveValidation' => true
        ));

        $form->write();

        // Add form fields
        $fields = array(
            EditableFormStep::create([
                'Title' => _t(
                    'SilverStripe\\UserForms\\Model\\EditableFormField\\EditableFormStep.TITLE_FIRST',
                    'First Page'
                )
            ]),
            EditableTextField::create([
                'Title' => 'Name',
                'Required' => true,
                'RightTitle' => 'Please enter your first and last name'
            ]),
            EditableEmailField::create([
                'Title' => Email::class,
                'Required' => true,
                'Placeholder' => 'example@example.com'
            ]),
            EditableTextField::create([
                'Title' => 'Subject'
            ]),
            EditableTextField::create([
                'Title' => 'Message',
                'Required' => true,
                'Rows' => 5
            ])
        );

        foreach ($fields as $field) {
            $field->write();
            $form->Fields()->add($field);
            $field->copyVersionToStage(Versioned::DRAFT, Versioned::LIVE);
        }

        $form->copyVersionToStage(Versioned::DRAFT, Versioned::LIVE);
        $form->flushCache();

        $this->output(' + Created "contact" UserDefinedForm page');

        return $this;
    }

    /**
     * Output a message either to the console or browser
     *
     * @param  string $message
     * @return $this
     */
    protected function output($message)
    {
        if (Director::is_cli()) {
            $message .= PHP_EOL;
        } else {
            $message = sprintf('<p>%s</p>', $message);
        }
        echo $message;

        return $this;
    }
}
