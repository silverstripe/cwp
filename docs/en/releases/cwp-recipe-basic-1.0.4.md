# CWP Basic Recipe 1.0.4

## Overview

This release tracks the Framework release 3.1.6 and fixes some module bugs. The highlights are:

 * Addition of five new modules:
   [external links checker](https://github.com/silverstripe-labs/silverstripe-externallinks),
   [mime validator](https://github.com/silverstripe-labs/silverstripe-mimevalidator),
   [select upload](https://github.com/silverstripe-labs/silverstripe-selectupload),
   [spell check](https://github.com/silverstripe-labs/silverstripe-spellcheck), and
   [hybrid sessions](https://github.com/silverstripe-labs/silverstripe-hybridsessions)
 * Several fixes to usability issues with
   [advanced workflow module](https://github.com/silverstripe-australia/advancedworkflow).
 * Additional support for [active disaster recovery](https://www.cwp.govt.nz/about/selecting-the-attributes-of-the-common-web-platform-instance-for-your-websites/#disaster-recovery-options)
   server configurations, with functionality provided by the hybrid sessions module to
   allow for transportable user session data.
 * Support for atom syndication format.
 * Additional CMS reports.
 * Spellchecking available in en_NZ and mi_NZ locales.
 * Improved and extended documentation.

Please see the changelogs for these following releases for the list of core changes since recipe 1.0.3

 * [framework 3.1.6-rc1](http://doc.silverstripe.org/framework/en/3.1/changelogs/rc/3.1.6-rc1)
 * [framework 3.1.6-rc2](http://doc.silverstripe.org/framework/en/3.1/changelogs/rc/3.1.6-rc2)
 * [framework 3.1.6-rc3](http://doc.silverstripe.org/framework/en/3.1/changelogs/rc/3.1.6-rc3)

## Details

### Bugfixes

 * [CWPBUG-123] - TreeMultiSelectField reports console error in advancedworkflow
 * [CWPBUG-163]/[PLAT-106] - Page filtering - different results in tree and filter view
 * [CWPBUG-165] - Addition of "Delete Workflow" CMS Permission for advancedworkflow module
 * [CWPBUG-166] - Users unable to select GridField "edit" icon in advancedworkflow module
 * [CWPBUG-167] - Draft content entered into a workflow does not show in "Pending Items" in advancedworkflow module
 * [CWPBUG-168] - Cannot change embargo date when one is already scheduled in advancedworkflow module
 * [CWPBUG-172] - tinymce config in cwp-core allows `<img>` with onmouseover attribute
 * [CWPBUG-176] - Security: XSS vulnerability in Iframe page
 * [CWPBUG-177] - Ensure that past dates for embargo / expiry are handled elegantly (advanced workflow)
 * [CWPBUG-178] - Page filters are not working as expected
 * [CWPBUG-179] - Security: XSS can be injected in the group edit view (subsites)
 * [PLAT-104] - Embargo dates have issues if they pass while workflow is still being actioned
 * [PLAT-128] - Publish time - Not able to choose "Now"
 * [PLAT-138] - Removal of redundant Folder-subsite permission not used in Subsites

#### Features and documentation

 * [CWPBUG-159] - Additional CMS report for number of CMS pages
 * [CWPBUG-180] - Changing to a more granular permission model (advanced workflow)
 * [PLAT-53] - CMS content editors can see the most recently used folder again for subsequent uploads.
 * [PLAT-59] - CMS content reviewers can see when external links are broken
 * [PLAT-60] - Userform editors can choose where file uploads in a userform go
 * [PLAT-61] - CMS content editors can add links to anchors on other pages
 * [PLAT-62] - CMS content editors can spell check their content
 * [PLAT-63] - CMS content editors can only see some page types & templates for some sub-sites
 * [PLAT-64] - CMS content editors can see 2-step workflow available as default
 * [PLAT-65] - ATOM formatted feeds are available for configured sites
 * [PLAT-100] - More documentation on subsite architecture
