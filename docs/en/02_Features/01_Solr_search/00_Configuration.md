title: Solr Configuration on CWP
summary: How Solr is pre-configured for CWP and what you can alter.

# Solr Configuration for CWP

## Requirements

You must satisfy the following requirements to successfully connect to the shared CWP Solr service:

* If you are starting a new project, best compatibility is achieved by using the [cwp-installer](https://github.com/silverstripe/cwp-installer).
* If it's an existing project, you should include the [cwp/cwp-recipe-cms](https://github.com/silverstripe/cwp-recipe-cms) for the ease of integration. Although we don't recommend it, with extra work you can get it working by only including the [cwp-core](https://github.com/silverstripe/cwp) module.

## Solr Version Support

Your project will be configured automatically by the *cwp-core* module to resemble production infrastructure as much as possible. Currently CWP supports only Solr version 4.

## Limitations and Acceptable Use Policy {#limitations}

Solr on CWP is a shared service, and it comes with some limitations:

* CWP's Solr server enforces `solrconfig.xml` - customisations are not permitted, and will automatically be removed by the Solr server. The best way to add features to CWP is through the [Operational Review Board](https://www.cwp.govt.nz/about/frequently-asked-questions/).
* CWP's Solr server ignores all search index commit requests,
  and instead relies on auto-commits to update indexes.
  This preserves stability for all users of the shared service.
  This will manifest as index updates taking a minute or two to appear in the search results,
  while on local development environment they are immediate.
* To ensure adequate sharing of resources on Solr the maximum size of each indexed item is limited to 100kb of data.
* If you are indexing file content, files with text content exceeding
  this limit will not be fully indexed. Content within this range will still be searchable.

## Source Code

The base `silverstripe/fulltextsearch` module source code is available at 
[https://github.com/silverstripe/silverstripe-fulltextsearch](github.com/silverstripe/silverstripe-fulltextsearch)

## CWP Integration

The base `silverstripe/fulltextsearch` module is tightly integrated into the CWP recipe
through the `cwp/cwp-recipe-search` module, available at [https://github.com/silverstripe/cwp-search](github.com/silverstripe/cwp-search).
It is bundled with the [CWP installer](https://github.com/silverstripe/cwp-installer),
so you usually don't have to install anything extra.

This module sets up:

 * The default CWP Solr search index
 * The Solr environment configuration (host, port, path, version, indexstore etc.)
 * Uploads your application configuration to Solr running on CWP (apart from the solrconfig.xml file)
 * An extension to File class if document search has been enabled
 * A search form and results page inherited by all other page types
 * Spelling and Synonyms (including setting synonym groups in SiteConfig)
 * Boosting keywords extension to pages
 * Custom routing to the CWP search controller (see _config/routes.yml)
