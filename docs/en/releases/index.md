<!--
title: Supported releases and changelogs
pagenumber: 9
-->

# Supported releases and changelogs

The status of the recipe releases is summarised in the table below. Click on the recipe number to access changelogs.

| Recipe version | Description | Release date | Support ends date |
| -------------- | ----------- | ------------ | ----------------- |
| [1.0.2](/releases/cwp-recipe-basic-1.0.2) | Tracks the Framework release 3.1.2 and fixes some module bugs. | 30/01/2014 | current |
| [1.0.1](/releases/cwp-recipe-basic-1.0.1) | First release of the recipe and all related modules. | 12/11/2013 | 30/07/2015 |

# Other supported module releases

Each of the following is a supported module that can be added to a CWP installation but
is not included in the basic recipe.

Each supported module has an associated CWP core version, and is only supported when
that module version is used with the correct CWP core version (or a later CWP core version
of the same patch level).

If you use composer to install these modules, it will automatically select the latest
version that is compatible with your current CWP core version. It will also give an
error if there isn't an appropriate module version for your CWP core version, or if 
you later attempt to upgrade your CWP core version to one where there is no currently 
supported module version.

#### Secure assets

Secure assets adds access restrictions to folders within the "Assets" section of
the CMS that mirrors the access restrictions of pages within the "Pages" section.

To add the latest compatible version to your project, execute 
`composer require cwp/cwp-secureassets:*@stable`

| Module version | Minimum CWP core version | Release date | Support ends date |
| -------------- | ----------- | ------------ | ----------------- |
| 1.0.2 | 1.0.2 | 30/01/2014 | current |
