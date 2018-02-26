title: Disabling the default publishing workflow
summary: How to disable the default 'Two-step Workflow' when building your database.

## Disabling the Default Workflow

When rebuilding your database, the default 'Two-step Workflow' is created by default. You need to add a line of code to disable it.

In your `mysite/_config/config.yml` file, add the following:

```yml
CwpWorkflowDefinitionExtension:
    create_default_workflow: false
```
