# 2.5.2

## Overview

This release includes [Silverstripe CMS version 4.5.2](https://docs.silverstripe.org/en/4/changelogs/4.5.2/).

- [Framework 4.5.1](https://docs.silverstripe.org/en/4/changelogs/4.5.2/)

Upgrading to Recipe 2.5.2 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## Solr ShowInSearch filtering

The latest version of the fulltextsearch module enforces compulsory filtering of ShowInSearch and getShowInSearch() on all requests to and from a Solr server.

Previously, records with ShowInSearch == false were still indexed in the Solr server, though they were later filtered out by most search implementations. However, it was still possible to unintentionally bypass this filtering on a misconfigured search implementation.

Old custom implementations that use $this->addFilterField('ShowInSearch') and $query->addExclude('MyClass_ShowInSearch', 0) are no longer required, though there's no harm in keeping them either.

It is highly recommended that after upgrading to this version, that you run a Solr_Reindex on your production site to remove any old data where ShowInSearch == false.  Only data where ShowInSearch == true will now be indexed.
