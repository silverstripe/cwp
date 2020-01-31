title: Creating forms in the CMS
summary: How to use the Userforms module to create forms via the CMS

# Userforms

<div class="alert alert-info" markdown='1'>This feature allows authors with CMS permissions to create forms which process and store submission data. It is the responsibility of the Site Owner to ensure processes and safeguards are in place to perform these actions securely. Links to more information are provided below.</div>

Userforms allows a CMS user to create and edit an email submission form without needing to know any code. You have the ability to add [fields](https://github.com/silverstripe/silverstripe-userforms/blob/master/docs/en/userguide/field-types.md), save [form submissions](https://github.com/silverstripe/silverstripe-userforms/blob/master/docs/en/userguide/form-submissions.md) which can then be viewed and exported via the CMS and set up automated emails once a submission takes place.

As a developer you can extend existing fields to create your own fields which are added by a user and also prefill form fields by passing values via the url (e.g. http://yoursite.com/formpage?EditableField1=MyValue).

For more information about the userforms module and to read some starting tips and keeping the submissions you receive secure, go to the [user documentation](https://userhelp.silverstripe.org/en/optional_features/forms/).

If you have further questions on ensuring your submission data stays secure, please [get in touch with the CWP Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

# Setup

The userforms module is already included as part of the cwp default installation. To set up a form in the CMS visit the [user documentation](https://userhelp.silverstripe.org/en/optional_features/forms/creating-and-editing-forms).

# Technical

The [GitHub repository](https://github.com/silverstripe/silverstripe-userforms/blob/5/docs/en/index.md) provides in-depth information for Developers. Be sure to also check the extra configuration options and [security](https://github.com/silverstripe/silverstripe-userforms/blob/5/docs/en/installation.md#file-uploads-and-security) notes.
