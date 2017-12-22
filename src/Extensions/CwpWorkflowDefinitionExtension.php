<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DB;
use Symbiote\AdvancedWorkflow\DataObjects\WorkflowDefinition;

/**
 * Ensures that the default template is created
 */
class CwpWorkflowDefinitionExtension extends DataExtension
{
    /**
     * Create the default 'Two-step Workflow' when this extension is loaded
     *
     * @config
     * @var boolean
     */
    private static $create_default_workflow = true;

    public function requireDefaultRecords()
    {
        if (Config::inst()->get(CwpWorkflowDefinitionExtension::class, 'create_default_workflow')) {
            // Only proceed if a definition using this template has not been created yet
            $definition = WorkflowDefinition::get()->filter("Template", "Review and Approve")->First();
            if ($definition && $definition->exists()) {
                return;
            }

            //generate from the template, which happens after we write the definition
            $definition = WorkflowDefinition::create();
            $definition->Template = "Review and Approve";
            $definition->write();

            //change the title, description, and reminder days
            $definition->update(array(
                'Title' => "Two-step Workflow",
                'Description' => "Content Authors can write content and Content Publishers can approve/reject.",
                'RemindDays' => 3,
            ));
            $definition->write();

            DB::alteration_message("Added default workflow definition to WorkflowDefinition table", "created");
        }
    }
}
