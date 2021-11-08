<?php

namespace CWP\CWP\Tests\Tasks;

use CWP\CWP\Tasks\PopulateThemeSampleDataTask;
use SilverStripe\UserForms\Model\UserDefinedForm;
use SilverStripe\Dev\BuildTask;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\SapphireTest;

class PopulateThemeSampleDataTaskTest extends SapphireTest
{
    protected $usesDatabase = true;

    /**
     * Ensure that the "contact" user form is only created once
     */
    public function testOnlyCreateContactFormOnce()
    {
        if (!class_exists(UserDefinedForm::class)) {
            $this->markTestSkipped('This test requires the userforms module to be installed');
        }

        $createdMessage = 'Created "contact" UserDefinedForm';

        $task = new PopulateThemeSampleDataTask;

        // Run the task
        $this->assertStringContainsString($createdMessage, $this->bufferedTask($task));

        // Run a second time
        $this->assertStringNotContainsString($createdMessage, $this->bufferedTask($task));

        // Change the page name
        $form = UserDefinedForm::get()->filter('URLSegment', 'contact')->first();
        $form->URLSegment = 'testing';
        $form->write();

        // Ensure the old version is still detected in draft, so not recreated
        $this->assertStringNotContainsString($createdMessage, $this->bufferedTask($task));

        // Delete the page, then ensure it's recreated again (DataObject::delete will remove staged versions)
        $form->delete();
        $this->assertStringContainsString($createdMessage, $this->bufferedTask($task));
    }

    /**
     * Run a BuildTask while buffering its output, and return the result
     *
     * @param  BuildTask $task
     * @return string
     */
    protected function bufferedTask(BuildTask $task)
    {
        ob_start();
        $task->run(new HTTPRequest('GET', '/'));
        return ob_get_clean();
    }
}
