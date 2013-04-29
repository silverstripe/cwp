# Subsites

The subsites module is a method of running two or more sites from the same instance. The following describes how you
can share files across subsites running on your instance to reduce content duplication. Setting up subsites is covered
in the [site administration documentation](../../en/site_administration/subsites). 

## Sharing assets

Assets can be associated with a specific subsite, in which case they will only be available to that subsite. Files can
also be unassociated, in which case they will be treated as a shared asset - anybody who has access to any of the
subsites will be able to use these.

Whenever you upload files to the "Main site" they will be treated as shared asset. Before uploading make sure the
subsite selection dropdown at the top left is set to "Shared files & images".

![Uploading shared files](_images/shared-files-uploading.jpg)

To be able to access the "Shared files & images" you need to have the "All subsites" permission assigned through the
*Security* section.

!["All sites" permission](_images/shared-files-permission.jpg)