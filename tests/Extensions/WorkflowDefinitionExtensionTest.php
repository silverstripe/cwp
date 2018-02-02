<?php

namespace CWP\CWP\Tests\Extensions;

use CWP\CWP\Extensions\CwpWorkflowDefinitionExtension;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\ORM\DB;
use Symbiote\AdvancedWorkflow\DataObjects\WorkflowDefinition;

/**
 * Tests the data extension {@link CWPWorkflowDefinitionExtension}
 */
class WorkflowDefinitionExtensionTest extends FunctionalTest
{

    /**
     * @var Boolean If set to TRUE, this will force a test database to be generated
     * in {@link setUp()}. Note that this flag is overruled by the presence of a
     * {@link $fixture_file}, which always forces a database build.
     */
    protected $usesDatabase = true;

    /**
     * Tests the config option that controls the creation of a default workflow definition
     *
     * @return void
     */
    public function testCreateDefaultWorkflowTest()
    {
        if (!class_exists(WorkflowDefinition::class)) {
            $this->markTestSkipped('This test requires the advancedworkflow module to be installed');
        }

        DB::quiet();

        // test disabling the default workflow definition
        Config::modify()->set(CwpWorkflowDefinitionExtension::class, 'create_default_workflow', false);
        $workflowExtn = Injector::inst()->create(CwpWorkflowDefinitionExtension::class);
        $workflowExtn->requireDefaultRecords();
        $definition = WorkflowDefinition::get()->first();
        $this->assertNull($definition);

        // test enabling the default workflow definition
        Config::modify()->set(CwpWorkflowDefinitionExtension::class, 'create_default_workflow', true);
        $workflowExtn = Injector::inst()->create(CwpWorkflowDefinitionExtension::class);
        $workflowExtn->requireDefaultRecords();
        $definition = WorkflowDefinition::get()->first();
        $this->assertNotNull($definition);
    }
}
