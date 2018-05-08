title: Pre-configuration of CWP recipe codebase
summary: Sets out what has been pre-configured in the SilverStripe core and modules when using the CWP recipe.
introduction: The CWP recipe codebase includes two modules that pre-configure your SilverStripe CMS website in order to operate correctly on the CWP infrastructure. Developers should be aware where these settings originate and what can or can't be customised to ensure websites function correctly on CWP.  

# Pre-configuration of CWP recipe codebase

The default SilverStripe CMS codebase used on the CWP infrastructure is referred to as the ["CWP CMS recipe"](/working_with_projects/recipes_and_supported_modules).
When starting a new CWP project based on the [`cwp/cwp-installer`](/00_Getting_started.md) custom SilverStripe CMS installer for CWP, a
selection of pre-configured modules are included (we've done the work for you as you would usually have to configure
these modules yourself) and provide a set of standardised features for Government agencies. Some of this
configuration is mandatory in order for your website to operate correctly on the CWP servers, while others
are able to be altered depending on your project needs.

Modules and configuration are added on the top of the SilverStripe CMS core through the use of the [Composer](https://docs.silverstripe.org/en/4/getting_started/composer/)
PHP package management tool. By including the [`cwp/cwp-recipe-cms`](https://github.com/silverstripe/cwp-recipe-cms/blob/master/composer.json) module in your projects `composer.json`
file, the modules that make up the "recipe" are then added to the project.

This includes two CWP specific modules and some default SilverStripe CMS project code (in the `mysite` directory)
that use the [Configuration API](https://docs.silverstripe.org/en/4/developer_guides/configuration/configuration/)
and PHP code to manage the majority of the CWP pre-configuration:

  * [cwp/cwp-core](https://github.com/silverstripe/cwp-core) (\*mandatory, must be included) - Pre-configures Solr configuration and indexing, logging, environment checks and
  other shared service configuration.
  * [cwp/cwp](https://github.com/silverstripe/cwp) (\*optional, but recommended) - Includes many of the custom features for CWP (new page types etc)
  and pre-configures search results (optional boosting and synonyms) and several recipe included modules.
  * [mysite/_config/config.yml](https://github.com/silverstripe/recipe-core/blob/1.1/mysite/_config/mysite.yml) (\*mandatory, but part of your project and customisable) - The `cwp/cwp-installer` includes some
  pre-configured options that you may customise (the defaults will work with CWP out of the box).
  * [mysite/_config/blog.yml](https://github.com/silverstripe/recipe-blog/blob/master/mysite/_config/blog.yml) (\*optional, if using blogging feature on CWP) - Pre-configures a set of blogging features when using 
  the optional "blogging recipe" (see [Blogging developer docs](blog_recipe)).
