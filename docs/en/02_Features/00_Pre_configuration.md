title: Pre-configuration of CWP recipe codebase
summary: Sets out what has been pre-configured in the SilverStripe core and modules when using the CWP recipe.
introduction: The CWP recipe codebase includes two modules that pre-configure your SilverStripe CMS website in order to operate correctly on the CWP infrastructure. Developers should be aware where these settings originate and what can or cannot be customised to ensure websites function correctly on CWP.  

# Pre-configuration of CWP recipe codebase

The default SilverStripe CMS codebase used on the CWP infrastructure is referred to as the ["basic recipe"](recipes_and_supported_modules). 
When starting a new CWP project based on the [`cwp/cwp-installer`](/getting_started) custom SilverStripe CMS installer for CWP, a 
selection of pre-configured modules are included (we've done the work for you as you would usually have to configure 
these modules yourself) and provide a set of standardised features for Government agencies. Some of this 
configuration is mandatory in order for your website to operate correctly on the CWP servers, while others 
are able to be altered depending on your project needs.

Modules and configuration are added on the top of the SilverStripe CMS core through the use of the [Composer](https://docs.silverstripe.org/en/3.2/getting_started/composer/) 
PHP package management tool. By including the [`cwp/cwp-recipe-basic`](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/blob/master/composer.json) module in your projects `composer.json` 
file, the modules that make up the "recipe" are then added to the project. 

This includes two CWP specific modules and some default SilverStripe CMS project code (in the `mysite` directory) 
that use the [Configuration API](https://docs.silverstripe.org/en/3.2/developer_guides/configuration/configuration/) 
and PHP code to manage the majority of the CWP pre-configuration:

  * [cwp/cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core) (*mandatory, must be included) - Pre-configures Solr configuration and indexing, logging, environment checks and 
  other shared service configuration. 
  * [cwp/cwp](https://gitlab.cwp.govt.nz/cwp/cwp) (*optional, but recommended) - Includes many of the custom features for CWP (new page types etc) 
  and pre-configures search results (optional boosting and synonyms) and several recipe included modules. 
  * [mysite/_config/config.yml](https://gitlab.cwp.govt.nz/cwp/cwp-installer/blob/1.2.0/mysite/_config/config.yml) (*mandatory, but part of your project and customisable) - The `cwp/cwp-installer` includes some 
  pre-configured options that you may customise (the defaults will work with CWP out of the box).
  * [mysite/_config/blog.yml](https://gitlab.cwp.govt.nz/cwp/cwp-installer/blob/1.2.0/mysite/_config/blog.yml) (*optional, if using blogging feature on CWP) - Pre-configures a set of blogging features whn using 
  the optional "blogging recipe" (see [Blogging developer docs](blogging)).



