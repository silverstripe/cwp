# 2.5.2

## Overview

This release includes [Silverstripe CMS version 4.5.2](https://docs.silverstripe.org/en/4/changelogs/4.5.2/).

- [Framework 4.5.2](https://docs.silverstripe.org/en/4/changelogs/4.5.2/)

Upgrading to Recipe 2.6.0 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## New features

The [release announcement](#) includes the note worthy features, but be sure to review the change log for full detail.

## Known issues

* [Known issue](GitHub link)

### Expected test failures

The following PHPUnit test failures are expected and do not represent functional issues in CWP:

* List test failures here

## Security considerations

This release includes security fixes. Please see the release announcements for more detailed descriptions of each[ but note that the following issues have modified CVSS Environmental scores which take built-in protections from the CWP platform into account]. We highly encourage upgrading your CWP projects to include these security patches nonetheless.

* List CVE issue with modified CVSS Environmental score here

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

## Solr ShowInSearch filtering

The latest version of the fulltextsearch module enforces compulsory filtering of ShowInSearch and getShowInSearch() on all requests to and from a Solr server.

Previously, records with ShowInSearch == false were still indexed in the Solr server, though they were later filtered out by most search implementations. However, it was still possible to unintentionally bypass this filtering on a misconfigured search implementation.

Old custom implementations that use $this->addFilterField('ShowInSearch') and $query->addExclude('MyClass_ShowInSearch', 0) are no longer required, though they are still useful in that they do filtering at the solr server rather than in PHP, so they will return more accurate results in terms of total results found and pagination.

It is highly recommended that after upgrading to this version, that you run a Solr_Reindex on your production site to remove any old data where ShowInSearch == false.  Only data where ShowInSearch == true will now be indexed.
