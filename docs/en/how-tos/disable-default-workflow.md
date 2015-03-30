# Workflow

For each page, editors can define a workflow to control the publishing of new content or changes to existing content through an approval process.
This works by limiting access to certain parts of the workflow to certain users, using the standard SilverStripe CMS Security admin.

## Disabling the Default Workflow

When rebuilding your database, the default 'Two-step Workflow' is created by default. You need to add a line of code to disable it.

In your `mysite/_config/config.yml` file, add the following:

	:::yml
	CwpWorkflowDefinitionExtension:
  		create_default_workflow: false