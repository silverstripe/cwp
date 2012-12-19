# Webmaster Howto

This howto is intended for staff who will be deploying and maintaining the site, as well as customising the themes and applying minor changes to the codebase.

## Installation

SilverStripe Express is installed with the Composer PHP package management tool.

To install Composer, visit the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md)

First, create a default SilverStripe site with the following command:

	composer create-project silverstripe/installer ./my/website/folder

where "./my/website/folder" is the location of the new site, so "C:/inetpub/wwwroot/mynewsite", "~/Sites/mynewsite", etc.
Then, run the following command in the directory of your new site:

	composer require silverstripe/express *

That will fetch the Express module and all of its dependencies.

If you haven't set up your environment with an _ss_environment.php file (described [here](http://doc.silverstripe.org/framework/en/topics/environment-management) then browse to the site and go through the install process.

Then edit the mysite/_config.php file and change the theme from `simple` to `express`.

## Working with the templates

We recommend creating a new template for each site you build. The `express` template supplied with the base install is a good baseline to start from - you can just copy it to a new folder so you won't overwrite it on upgrade.

### From source

If you want to work from source it's recommended that you edit the SCSS instead of the CSS directly, and use the Compass framework to compile the SCSS. Once you've installed Compass from [http://compass-style.org/install/](http://compass-style.org/install/) you can start the automatic compilation process by running `compass watch -e production` in the `themes/express` directory. This will require that you've got module_bootstrap present in your themes directory (you may not if you've installed from source and omitted it) as the SCSS files in the express theme depend on it.

## Working with the code

SilverStripe Express comes with a set of page types and preconfigured modules. 

You can remove modules by editing the composer.json file and removing the relevant entry in the "require" array, then running

	composer update

Fuller instructions can be found in the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

The SilverStripe Express-specific code are all located in `express` directory.

Use `mysite/_config.php` to fine-tune the site configuration. More information is available in the [configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

## Upgrading an existing site

SilverStripe Express can be used to enhance an existing site:

* Add the express module by one of the two following options:
** Installing with Composer: composer require silverstripe/express *
** Cloning from the [SilverStripe Express Github repository](https://github.com/silverstripe-labs/silverstripe-express)
* run /dev/build?flush=all

This will provide the new page types (ExpressHomePage, NewsPage, NewsHolder, and SitemapPage). You may face integration issues with an existing site search, this could remedied by overriding the results() function in the lowest-level Page class.

SilverStripe Express has no dependencies on the other modules that ship with it (accessibility, documentconverter, iframe, sitetreeimporter, translatable, userforms, versionfeed and versionedfiles) so these maybe omitted if the functionality isn't necessary.

## Future upgrades

It is not recommended to modify directly any module files. The best way to work with the site is to put modifications in your own theme (`themes/<yourname>`) or in `mysite` only.

If you wish to amend the original page types, use inheritance:

```php
class MyNewsPage extends NewsPage {
	static $hide_ancestor = 'NewsPage';
	// Your custom code here
}

class MyNewsPage_Controller extends NewsPage_Controller {
	// Your custom code here
}
```

You can also use `DataExtensions` and `Extensions`, described in further detail in the [documentation](http://doc.silverstripe.org/framework/en/reference/dataextension).

Because of additional code merging, if modifications are made directly to module files, upgrades will require more effort and testing.

## Building a new theme

tbd
