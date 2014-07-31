<?php

/**
 * Ensures that the default template is created
 */
class CwpWorkflowDefinitionExtension extends DataExtension {

	public function requireDefaultRecords() {
		// Only proceed if a definition using this template has not been created yet
		$definition = WorkflowDefinition::get()->filter("Template", "Review and Approve")->First();
		if($definition && $definition->exists()) return;

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
