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

The default theme is built with the Twitter [Bootstrap](http://twitter.github.com/bootstrap/) front-end framework.
Bootstrap helps create grid-based templates that work well across a wide variety of displays, and also offers a lot of
functionality with JavaScript plugins.

From Bootstrap's (GitHub page)[http://twitter.github.com/bootstrap/] you can find links about the basics of the system
and the full documentation.

If you just want to dive in without reading the manual, the most important thing to understand is the
(grid system)[http://twitter.github.com/bootstrap/scaffolding.html#gridSystem]. You can see a very basic implemention
of this in the /themes/default/templates/Layout/Page.ss - a .row including the .span3 sidenav and the .span9 main
content area.

#### Bootstrap in the default theme

The basic page layout uses a span 3 on the left for the navigation and a span 9 for the main content area. There is a
slightly more complex layout in the homepage - the hero unit/carousel is built with a span 4/8 and the
quicklinks/features/news snippets have a 3/4/5 structure.

The carousel on the homepage is built with the
[Bootstrap carousel](http://twitter.github.com/bootstrap/javascript.html#carousel).

The sitemap uses the [Bootstrap collapse](http://twitter.github.com/bootstrap/javascript.html#collapse) module.

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

