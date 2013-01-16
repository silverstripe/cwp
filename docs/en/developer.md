# Developer Howto

This howto is intended for internal developers who will be deploying and maintaining the site, as well as customising the themes and applying minor changes to the codebase.

## Installation

SilverStripe Express is installed with the Composer PHP package management tool.

To install Composer, visit the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md)

First, create a default SilverStripe site with the following command:

	composer create-project silverstripe/installer ./my/website/folder

where "./my/website/folder" is the location of the new site, so "C:/inetpub/wwwroot/mynewsite", "~/Sites/mynewsite", etc.
Then, run the following command in the directory of your new site:

	composer require silverstripe/express:*
 
That will fetch the Express module and all of its dependencies.

If you haven't set up your environment with an _ss_environment.php file (described [here](http://doc.silverstripe.org/framework/en/topics/environment-management) then browse to the site and go through the install process.

Then edit the mysite/_config.php file and change the theme from `simple` to `express`.

## Working with the templates

We recommend creating new templates for each site you build. The `express` theme supplied with the base install is a
good baseline to start from - just duplicate and rename it so you won't overwrite it on upgrade.

### From source

If you want to work from source it's recommended that you edit the SCSS instead of the CSS directly, and use the Compass framework to compile the SCSS. Once you've installed Compass from [http://compass-style.org/install/](http://compass-style.org/install/) (`gem install compass` in terminal) you can start the automatic compilation process by running `compass watch -e production` on the `themes/express` directory.

## Working with PHP

SilverStripe Express comes with a set of page types and preconfigured modules. 

You can remove modules by editing the composer.json file and removing the relevant entry in the "require" array, then running

	composer update

Fuller instructions can be found in the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

SilverStripe Express-specific code is located in the `express` directory.

Use `mysite/_config.php` to fine-tune the site configuration. More information is available in the [configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

## Upgrading an existing site

SilverStripe Express can be used to enhance an existing site:

* Add the express module by one of the two following options:
** Installing with Composer: composer require silverstripe/express *
** Cloning from the [SilverStripe Express Github repository](https://github.com/silverstripe-labs/silverstripe-express)
* run /dev/build?flush=all

This will provide the new page types (ExpressHomePage, NewsPage, NewsHolder, and SitemapPage). You may face integration issues with an existing site search, this could remedied by overriding the results() function in the lowest-level Page class.

SilverStripe Express has no dependencies on the other modules that ship with it (accessibility, documentconverter, iframe, sitetreeimporter, translatable, userforms, versionfeed and versionedfiles) so these maybe omitted if the functionality isn't required.

## Future upgrades

Directly modifying module files is not recommended. The best way to work with the site is to put all your modifications in your own theme (`themes/<yourname>`) and in `mysite`.

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

## Setting the favicon and icon for Apple devices

The favicon.ico is set in the root folder of the project code. A placeholder favicon.ico file already resides there.
To set your new favicon, simply replace this placefolder favicon.ico file with a 16x16 ico file.

Apple devices use a LINK element in the page HTML to define which icons should be used on Apple devices when
someone sets the website as a "Web Clip". The default Page.ss template has already defined some placeholder
icons, which can be replaced. Here is what the HTML looks like:

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="$Themedir/ico/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="$Themedir/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="$Themedir/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="$Themedir/ico/apple-touch-icon-57-precomposed.png">

To change the icons, simply replace the files with the appropriate resolutons in the ico folder of the theme.

More information on [configuring Apple icons on the Apple developer site](http://developer.apple.com/library/ios/#documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html).

## Building a new theme

tbd
(c.f. [Theme docs](https://github.com/silverstripe-labs/silverstripe-express-theme/blob/master/Readme.md) )



