title: Customising the default theme
summary: Development information for working with themes

# Customising the default theme

## Introduction

CWP provides a *default* theme for you to work with. This has been developed both as a base for more complex themes to
be built on top of and as a reference example for meeting Government standards and accessibility guidelines.

For more information on how a SilverStripe theme is constructed, see the [Developing
Themes](https://docs.silverstripe.org/en/3.2/developer_guides/templates/themes/) page in the SilverStripe documentation.

When customising the theme, you can choose to work either with the powerful SCSS framework (as explained below), or to
use the CSS stylesheets directly. In the latter case we recommend you to remove the SCSS files to make it clear they are
not used.

## Getting Started

The default theme that comes with the basic site is cloned from the default CWP theme in Gitlab, so you are not able to
make changes to it directly. There are two recommended ways of creating your own theme:

### Forking the theme

This will give you a copy of the default theme repository that you can edit and can share with others.

1.  Browse to the [default theme](https://gitlab.cwp.govt.nz/cwp-themes/default) in Gitlab.
1.  Click on the *Fork* button in the top right. This will make a copy of the theme in your Gitlab profile.
1.  Your forked repository has inherited the default theme's public access. To disable this, go to the settings page
(*Settings / Edit*) of your repository in Gitlab, uncheck *Public Access*, and click *Save*.
1.  In your theme's `composer.json` file and change the `"name"` parameter to `"my-agency/<theme-name-here>"`.
1.  In your project's `composer.json` replace `"cwp-themes/default"` with with the name you added in the previous step.
1.  In the same `composer.json` file replace the `"https://gitlab.cwp.govt.nz/cwp-themes/default.git"` with your
private repository address to the `repositories` array, See below for sample.
1.  Edit the `mysite/_config/config.yml` file and change the theme from `default` to your theme's name.
1.  Run `composer update`.

#### Example composer.json files

Your theme's composer.json file should look something like this:

	{
		"name": "my-agency/my-new-theme",
			"description": "My New Theme",
			"type": "silverstripe-theme",
			"require": {
				"composer/installers": "*",
				"silverstripe/cms": ">=3.0",
				"silverstripe/framework": ">=3.0",
				"cwp/cwp": "1.0.1",
				"silverstripe-themes/module_bootstrap": "dev-ssexpress"
			},
			"extra": {
				"branch-alias": {
					"dev-master": "1.2.x-dev"
				}
			}
	}

Your project's composer.json file should look something like this:

	{
		"name": "cwp/cwp-installer",
		"description": "CWP Project Template",
		"require": {
			"cwp/cwp-recipe-basic": "1.0.1",
			"my-agency/my-new-theme": "dev-master"
		},
		"require-dev": {
			"cwp/cwp-recipe-basic-dev": "1.0.1"
		},
		"config": {
			"process-timeout": 900
		},
		"repositories": [
			{
				"type": "composer",
				"url": "https://packages.cwp.govt.nz/"
			},
			{
				"type": "vcs",
				"url": "https://gitlab.cwp.govt.nz/my-agency/my-new-theme.git",
				"private": "true"
			}
		],
		"minimum-stability": "dev"
	}

That will have you set up with your own copy of the theme in the folder */themes/my-new-theme*. You can also share your
theme with others by adding them as team members to your project, or even making the repository public.

Note the `"private": "true"` switch for your custom theme - this switch is needed to be able to deploy non-public,
gitlab hosted modules. See [Working with modules](working_with_modules) for more information on this features.

### Committing a theme to your project repository

This is a more straightforward process but not as flexible - you won't be able to share the theme with anyone that you
also don't want to have access to your site's code as well.

 1.  Edit your project's `.gitignore` file and remove the `themes/` line.
 2.  Remove the `/themes/default/.git` directory and the `/themes/default/.gitignore` file.
 3.  Rename the default folder to your projects name (it should be all lower case and preferably one word).
 4.  Add the `.gitignore` file and the `themes` folder to your git project and push it back to the repository.
 5.  Remove the "cwp-themes/default" line from the **require** list of `composer.json`. This will prevent composer from re-adding the *default* theme to your project.
 6.  Edit `mysite/_config/config.yml` and alter the `SSViewer: theme` setting to the name of your new theme.

<div class="notice" markdown='1'>
Don't forget to `flush` by visiting `http://localhost/your-project/?flush=1` to get the new template running!
</div>

Commit all changed files to your repository so other collaborators can see it. This will include `composer.lock` file
that "freezes" the current version of the modules to the ones you have currently included.

	$ git add --all
	$ git commit -m "Add custom theme."
	$ git push origin master

Now when you go into Gitlab, you'll see a commit from yourself "Add custom theme."

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
