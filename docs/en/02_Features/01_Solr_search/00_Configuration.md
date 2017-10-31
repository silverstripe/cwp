title: Solr Configuration on CWP
summary: How Solr is pre-configured for CWP and what you can alter.

# Solr Configuration on CWP

## Requirements

You must satisfy the following requirements to successfully connect to the shared CWP Solr service:

* If you are starting a new project, best compatibility is achieved by using the [cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer/).
* If it's an existing project, you should include the [cwp-recipe-basic](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic) for the ease of integration. Although we don't recommend it, with extra work you can get it working by only including the [cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core/) module.
* You must ensure `CwpSolr` is configured to use 'cwp-4' or higher (on CWP).

## Selecting Solr version

<div class="notice" markdown='1'>
As of 28/09/2016 'legacy' and 'cwp-3' versions are not supported on CWP anymore.
</div>

If you are setting up your project using [cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer) (1.0.2 or later) it will [pre-configure](https://gitlab.cwp.govt.nz/cwp/cwp-installer/blob/1.4.1/mysite/_config/config.yml#L19) your project to use Solr 4 when on CWP and local Solr when on your dev machine. You can skip this section altogether.

On CWP Solr is configured through the `CwpSolr` class. It's recommended to use the [Configuration API](https://docs.silverstripe.org/en/3.2/developer_guides/configuration/configuration/) to set the specific options.

To customise the desired version of Solr you can for example modify the
`mysite/_config/solr.yml` file (don't forget to flush the cache):

	---
	Only:
	  constantdefined: CWP_ENVIRONMENT
	---
	CwpSolr:
	  options:
	    version: 'cwp-4'
	---
	Except:
	  constantdefined: CWP_ENVIRONMENT
	---
	CwpSolr:
	  options:
	    version: 'local-4'

The supported options are:
 
 * 'cwp-4': uses secured 4.x Solr service available on CWP
 * 'local-4': used for development using [silverstripe-localsolr](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) package, 4.x branch

## Where are the CWP Solr related classes and configuration?

### cwp-core module

The module source code is available at [https://gitlab.cwp.govt.nz/cwp/cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core).

This module sets up:

 * The default CWP Solr search index
 * The Solr environment configuration (host, port, path, version, indexstore etc)
 * Uploads your application configuration to Solr running on CWP
 * An extension to File class if document search has been enabled

### cwp module

The module source code is available at [https://gitlab.cwp.govt.nz/cwp/cwp](https://gitlab.cwp.govt.nz/cwp/cwp).

This module sets up:

 * A search form and results page inheristed by all other page types
 * Spelling and Synonyms (including setting synonym groups in SiteConfig)
 * Boosting keywords extension to pages
 * Custom routing to the CWP search controller (see _config/routes.yml)
