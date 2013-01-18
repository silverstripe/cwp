# Developer Howto

This howto is intended for internal developers who will be deploying and maintaining the site, as well as customising
the themes and applying minor changes to the codebase.

## Installation

CWP is installed with the Composer PHP package management tool.

To install Composer, visit the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

First of all, check out your project using Git's `git clone` command.
You should receive instructions by email on your repository URL.

Use Composer to install the dependencies

	composer install --dev

This will fetch and install all dependent modules.

You should also have a working [_ss_environment.php file](http://doc.silverstripe.org/framework/en/topics/environment-management)
in the webroot of your development environment. Documentation on
[setting up your environment](http://doc.silverstripe.org/framework/en/topics/environment-management) file can be found
on the public SilverStripe developer documentation.

## Working with the default theme

### Building a theme

CWP initially comes with a clean and simple default theme for you to work with. This has been developed both as a base
for more complex themes to be built on top of and as a reference example for meeting Government standards and
accessibility guidelines.

For more information on how a SilverStripe theme is constructed, see the [Developing Themes](http://doc.silverstripe.org/framework/en/topics/theme-development) page in the SilverStripe documentation.

### Bootstrap template

Information about the bootstrap rows and spans layout system. Link to Bootstrap docs.

### Compass SCSS

CSS files in the "default" theme are compiled from SCSS files.

If you want to work from source it's recommended that you edit the SCSS instead of the CSS directly, and use the Compass
framework to compile the SCSS.

[Installing Compass](http://compass-style.org/install/):

	gem install compass

Compiling SCSS files into CSS in the default theme:

	cd themes/default
	compass watch -e production &

## Working with PHP

CWP comes with a set of page types and preconfigured modules. 

To remove an existing module, edit the `composer.json` file and remove the relevant entry in the `require` array.
Once you've done that, then run this Composer command in project folder:

	composer update

Full instructions can be found in the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

CWP-specific code is located in the `cwp` directory.

Use `mysite/_config.php` to fine-tune your site configuration.
More information is available in the
[configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

## Future upgrades

Directly modifying module files is not recommended.

The best way to work with the site is to put all your modifications in your own theme `themes/default`
and in `mysite`.

If you wish to amend the original page types, use inheritance:

``php
class MyNewsPage extends NewsPage {
	static $hide_ancestor = 'NewsPage';
	// Your custom code here
}

class MyNewsPage_Controller extends NewsPage_Controller {
	// Your custom code here
}
``

You can also use `DataExtension` and `Extension`
described [in further detail](http://doc.silverstripe.org/framework/en/reference/dataextension) on the public
SilverStripe developer documentation.

Because of additional code merging, if modifications are made directly to module files, upgrades will require more
effort and testing.

## Setting the favicon and home screen icon for Apple iOS devices

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

