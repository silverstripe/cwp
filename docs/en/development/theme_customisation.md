# Customising the default theme

## Introduction

CWP provides a *default* theme for you to work with. This has been developed both as a base for more complex themes to
be built on top of and as a reference example for meeting Government standards and accessibility guidelines.

For more information on how a SilverStripe theme is constructed, see the [Developing
Themes](http://doc.silverstripe.org/framework/en/topics/theme-development) page in the SilverStripe documentation.

When customising the theme, you can choose to work either with the powerful SCSS framework (as explained below), or to
use the CSS stylesheets directly. In the latter case we recommend you to remove the SCSS files to make it clear they are
not used.

## Bootstrap

The *default* theme is built on top of a fork of the Twitter [Bootstrap](http://twitter.github.com/bootstrap/)
front-end framework.

Twitter Bootstrap is a free collection of tools for creating websites and web applications. It contains HTML and
CSS-based design templates for typography, forms, buttons, charts, navigation and other interface components, as well
as optional JavaScript extensions. Bootstrap was originally written in Less, but has been ported to SCSS. This theme
uses the SCSS port of Bootstrap.

From Bootstrap's [GitHub page](http://twitter.github.com/bootstrap/) you can find links about the basics of the system
and the full documentation.

The *basic* recipe pulls in Bootstrap as a module into `themes/module_bootstrap`.

### Bootstrap in the *default* theme

If you just want to dive in without reading the manual, the most important thing to understand is the [grid
system](http://twitter.github.com/bootstrap/scaffolding.html#gridSystem). In a nutshell, `.row` is a full-width
container that can contain 12 columns. Elements define the number of columns they take up by using `.span*` classes:
`.span3` takes up three columns, `.span5` takes up five columns, etc. Take a look at the simple example in 
`/themes/default/templates/Layout/Page.ss` and see how the sidenav and content sit beside each other.

The basic page layout uses a `.span3` on the left for the navigation and a `.span9` for the main content area. There is
a slightly more complex layout in the homepage - the hero unit/carousel is built with a `.span4`/`.span8` and the
quicklinks/features/news snippets have a `.span3`/`.span4`/`.span5` structure.

The carousel on the homepage is built with the
[Bootstrap carousel](http://twitter.github.com/bootstrap/javascript.html#carousel).

The sitemap uses the [Bootstrap collapse](http://twitter.github.com/bootstrap/javascript.html#collapse) module.

## SCSS/SASS

CSS files in the *default* theme are compiled from SCSS files using Compass.

Compass is an open-source CSS Authoring Framework. To keep things simple, we have only made minor use of the Compass
framework (to allow gradients in IE9). However, if you wish to use more of the features provided by Compass, just import
the libraries you are interested in at the top of the relevant `.scss` files.

More information on Compass can be found here: http://compass-style.org/ .

Sass (Syntactically Awesome Stylesheets) is a preprocessed stylesheet language, compiling to CSS. Sass adds nested
rules, variables, mixins, selector inheritance, functions and other such useful things to CSS3. SCSS is a syntax of
Sass based on CSS syntax.

For more information on how to use SCSS, and full API documentation see: http://sass-lang.com/ .

Compass is distributed in the form of Ruby gems. You may need to install them on your system:

	gem install sass
	gem install compass

See [Installing Compass](http://compass-style.org/install/) for more information.

When working with `.scss` files you can use Compass to automatically poll for the changes and generate `.css` on the fly
with:

	cd themes/default
	compass watch -e production &

## Adding JS and CSS files

The *cwp* module is configured to combine all scripts and css where possible. This is accomplished in `BasePage::init`.
Files to be combined are obtained by calling `BasePage::getBaseScripts` and `BasePage::getBaseStyles`.

It is likely that you will want to customise the list of required CSS or JS files. Since the `Page` class inherits from
the `BasePage`, you can simply override the getters. Here is an example for CSS to be included without any @media
attribute:

	:::php
	public function getBaseStyles() {
		$styles = parent::getBaseStyles();
	
		$themeDir = SSViewer::get_theme_folder();
		array_push($styles['all'], "$themeDir/css/my.css");
	
		return $styles;
	}

Print and screen styles need to go into `$styles['print']` and `$styles['screen']` respectively, and they will be
included as such.

Here is an example of adjusting the list of JS files to be combined. We use `array_push` to have our custom script
loaded last:

	:::php
	public function getBaseScripts() {
		$scripts = parent::getBaseScripts();
	
		$themeDir = SSViewer::get_theme_folder();
		array_push($scripts, "$themeDir/js/my.js");
	
		return $scripts;
	}