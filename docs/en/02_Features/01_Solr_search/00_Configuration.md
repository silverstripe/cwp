title: Solr Configuration on CWP
summary: How Solr is pre-configured for CWP and what you can alter.

# Solr Configuration for CWP

## Requirements

You must satisfy the following requirements to successfully connect to the shared CWP Solr service:

* If you are starting a new project, best compatibility is achieved by using the [cwp-installer](https://github.com/silverstripe/cwp-installer).
* If it's an existing project, you should include the [cwp/cwp-recipe-cms](https://github.com/silverstripe/cwp-recipe-cms) for the ease of integration. Although we don't recommend it, with extra work you can get it working by only including the [cwp-core](https://github.com/silverstripe/cwp) module.

## Solr Version Support

Your project will be configured automatically by the *cwp-core* module to resemble production infrastructure as much as possible. Currently CWP supports only Solr version 4.

## Limitations

Solr on CWP is a shared service, and it comes with some limitations:

* Production CWP enforces `solrconfig.xml` - customisations are not permitted, and will automatically be removed by the Solr server. The best way to add features to CWP is through the [Operational Review Board](https://www.cwp.govt.nz/about/frequently-asked-questions/).
* Acceptable use policy applies, as described on the introduction page of this guide.

## Where are the CWP Solr related classes and configuration?

### cwp-search module

The module source code is available at [https://github.com/silverstripe/cwp-search](https://github.com/silverstripe/cwp-search).

This module sets up:

 * The default CWP Solr search index
 * The Solr environment configuration (host, port, path, version, indexstore etc.)
 * Uploads your application configuration to Solr running on CWP (apart from the solrconfig.xml file)
 * An extension to File class if document search has been enabled
 * A search form and results page inherited by all other page types
 * Spelling and Synonyms (including setting synonym groups in SiteConfig)
 * Boosting keywords extension to pages
 * Custom routing to the CWP search controller (see _config/routes.yml)
