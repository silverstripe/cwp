title: Solr Configuration on CWP
summary: How Solr is pre-configured for CWP and what you can alter.

# Solr Configuration on CWP

<div class="notice" markdown='1'>
As of 28/09/2016 'legacy' and 'cwp-3' versions are not supported on CWP anymore.
</div>

The cwp-core module comes bundled with a `CwpSolr` class which allows convenient configuration of Solr by specifying the desired
version string via SilverStripe's [Configuration API](https://docs.silverstripe.org/en/3.2/developer_guides/configuration/configuration/). 

If you are setting up your project using [cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer) (1.0.2 or later) it will pre-configure to use Solr 4.x on the CWP infrastructure (cwp-4) - see `mysite/_config/config.yml`.

To customise the desired version of Solr you can for example modify the
`mysite/_config/config.yml` file (don't forget to flush the cache):

	CwpSolr:
	  options:
	    version: 'your-chosen-version'

The available options are:
 
 * 'legacy': legacy mode for backwards-compatibility. Do not use unless strictly necessary, will be removed.
 * 'cwp-4': preferred version, uses secured 4.x Solr service available on CWP
 * 'cwp-3': uses secured 3.x service available on CWP (buggy)
 * 'local-4': this can be use for development using silverstripe-localsolr package, 4.x branch
 * 'local-3': as above, but for Solr 3.x

<div class="notice" markdown='1'>
1.0.x branches of the recipe default to the 'legacy' mode which exists only for backwards compatibility. 
We recommend to change it at the first opportunity to 'cwp-4'.
</div>

## Where are the CWP Solr related classes and configuration?

### cwp-core module

The module source code is available at[https://gitlab.cwp.govt.nz/cwp/cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core).

This module sets up:

 * The default CWP Solr search index
 * The Solr environment configuration (host, port, path, version, indexstore etc)
 * Uploads your application configuration to Solr running on CWP
 * An extension to File class if document search has been enabled

### cwp module

The module source code is available at[https://gitlab.cwp.govt.nz/cwp/cwp](https://gitlab.cwp.govt.nz/cwp/cwp).

This module sets up:

 * A search form and results page inheristed by all other page types
 * Spelling and Synonyms (including setting synonym groups in SiteConfig)
 * Boosting keywords extension to pages
 * Custom routing to the CWP search controller (see _config/routes.yml)




 
 
 

