# Developer Howto

This how-to guides the Development Agency programmer through the general concepts applicable to the CWP platform.

## Recipes

The CWP platform comes with template projects that contain all the elements of the basic site. For the purpose of this
how-to we will be using a *basic* recipe. These recipes can be copied ("forked") to quickly create your own project.

## Forking a project

TODO

## Preparing developer's environment

Once you have your project set up, you can install it on your development machine.

CWP is installed with the Composer PHP package management tool. To learn about the Composer, visit the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

First of all, check out your project using Git's `git clone` command. If you have forked the *basic* recipe, the project
will come with a `composer.json` file that lists all the required dependencies. You will be able to install them with:

	$ composer install --dev

You should also have a working in or above the webroot of your development environment. Documentation on [setting up
your environment](http://doc.silverstripe.org/framework/en/topics/environment-management) file can be found on the
public SilverStripe developer documentation.

## Working with the *default* theme

### Building a theme

CWP provides a *default* theme for you to work with. This has been developed both as a base for more complex themes to
be built on top of and as a reference example for meeting Government standards and accessibility guidelines.

For more information on how a SilverStripe theme is constructed, see the [Developing
Themes](http://doc.silverstripe.org/framework/en/topics/theme-development) page in the SilverStripe documentation.

When customising the theme, you can choose to work either with the powerful SCSS framework (as explained below), or to
use the CSS stylesheets directly. In the latter case we recommend you to remove the SCSS files to make it clear they are
not used.

### Bootstrap

The *default* theme is built on top of a fork of the Twitter [Bootstrap](http://twitter.github.com/bootstrap/) front-end
framework.

Twitter Bootstrap is a free collection of tools for creating websites and web applications. It contains HTML and
CSS-based design templates for typography, forms, buttons, charts, navigation and other interface components, as well
as optional JavaScript extensions. Bootstrap was originally written in Less, but has been ported to SCSS. This theme
uses the SCSS port of Bootstrap.

From Bootstrap's [GitHub page](http://twitter.github.com/bootstrap/) you can find links about the basics of the system
and the full documentation.

The *basic* recipe pulls in Bootstrap as a module into `themes/module_bootstrap`.

#### Bootstrap in the *default* theme

If you just want to dive in without reading the manual, the most important thing to understand is the [grid
system](http://twitter.github.com/bootstrap/scaffolding.html#gridSystem). You can see a very basic implemention of this
in the `/themes/default/templates/Layout/Page.ss` - a `.row` including the `.span3` sidenav and the `.span9` main
content area.

The basic page layout uses a `.span3` on the left for the navigation and a `.span9` for the main content area. There is
a slightly more complex layout in the homepage - the hero unit/carousel is built with a `.span4`/`.span8` and the
quicklinks/features/news snippets have a 3/4/5 structure.

The carousel on the homepage is built with the
[Bootstrap carousel](http://twitter.github.com/bootstrap/javascript.html#carousel).

The sitemap uses the [Bootstrap collapse](http://twitter.github.com/bootstrap/javascript.html#collapse) module.

### SCSS/SASS

CSS files in the *default* theme are compiled from SCSS files using Compass.

Compass is an open-source CSS Authoring Framework. To keep things simple, we have only made minor use of the compass
framework (to allow gradients in IE9). However, if you wish to use more of the features provided by compass, just import
the libraries you are interested in at the top of the relevant `.scss` files.

More information on Compass can be found here: http://compass-style.org/ .

Sass (Syntactically Awesome Stylesheets) is a preprocessed stylesheet language, compiling to CSS. Sass adds nested
rules, variables, mixins, selector inheritance, functions and other such useful things to CSS3. SCSS is a syntax of
Sass based on CSS syntax.

For more information on how to use SCSS, and full API documentation see: http://sass-lang.com/ .

Compass is distributed in the form of ruby gems. You may need to install them on your system:

	# gem install sass
	# gem install compass

See [Installing Compass](http://compass-style.org/install/) for more information.

When working with `.scss` files you can use Compass to automatically poll for the changes and generate `.css` on the fly
with:

	$ cd themes/default
	$ compass watch -e production &

## Working with PHP

CWP *basic* recipe comes with a set of page types and preconfigured modules. 

With Composer you can easily adjust the modules that are included in the project. Full instructions can be found in the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

For site-specific SilverStripe installation, fine tune your configuration with `mysite/_config.php`. More information is
available in the [configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

In the *basic* recipe you can find the CWP-specific code in the *cwp* module already included.

## Customising your project

The best way to work with your site is to put all your modifications in your own theme and in the `mysite` directory.

Avoid changing modules directly. SilverStripe's architecture allows safe customisation through:

* Composer & new modules (*cwp* module can be removed or forked, other modules can be added)
* [Class inheritance](http://doc.silverstripe.org/framework/en/tutorials/2-extending-a-basic-site)
* [SilverStripe DataExtensions](http://doc.silverstripe.org/framework/en/reference/dataextension)

To gain deeper understanding on how the SilverStripe Framework can be used to develop custom solutions, we recommend
going through the [SilverStripe tutorials](http://doc.silverstripe.org/framework/en/3.1/tutorials) and searching through
the [SilverStripe documentation](http://doc.silverstripe.org/framework/en/3.1/).

Directly modifying module files is not recommended because it makes future upgrades harder (or in some cases impossible).
You will also have a harder time getting support from the community. 

The preferred way to modify modules is to submit pull-requests to the module maintainer and make sure the changes are
propagated to the master repository. This ensures upgrade-ability and moreover ensures that all valuable changes are
given back to the community and the platform's users.

TODO: mention how to request changes to platform modules.
