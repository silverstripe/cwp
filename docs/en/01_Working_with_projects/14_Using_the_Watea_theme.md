title: Using the Wātea theme
summary: Describes how to use the CWP Wātea theme
introduction: Describes how to use the CWP Wātea theme

# Using the Wātea theme

[The Wātea theme](https://gitlab.cwp.govt.nz/cwp/watea-theme) is a more "designed" [subtheme](https://docs.silverstripe.org/en/3/developer_guides/templates/themes) which can be installed over the top of the [Starter theme](customising_the_starter_theme) to provide a more visually appealing starter project.

## Installation

Install this theme module with Composer:

```
composer require cwp/watea-theme
```

This will also install the following dependencies:

* `cwp/starter-theme`: The foundation for this subtheme
* `cwp/agency-extensions`: Provides additional functionality to the CMS for agency-style SilverStripe websites

## Getting started

This theme is designed to augment the base functionality and framework provided by the [Starter theme](https://gitlab.cwp.govt.nz/cwp/starter-theme). As such, [all of the documentation for the Starter theme](customising_the_starter_theme) is relevant to this theme as well. We suggest you familiarise yourself with this documentation.

As a general rule, CWP Team have endeavoured to constrain changes for this subtheme to CSS and Javascript wherever possible, as opposed to modifying and duplicating the templates. As a subtheme, all templates in this theme will be applied over the top (with priority) of the Starter theme, and will be available to the SilverStripe template manifest under the "starter" theme name. You will not see the Wātea theme in theme selectors, etc.

If you need to modify template markup from the SilverStripe framework, other modules or even the Starter theme, you can copy them into the "starter_watea" subtheme directory and modify them there.

## Development

<div class="notice" markdown='1'>
Please familiarise yourself with [Customising the starter theme](customising_the_starter_theme), as all documentation there is relevant for this subtheme as well.
</div>

### Setup

For development you will need Node and NPM installed. Please see the [Customising the starter theme](customising_the_starter_theme) article for more information.

Next, you need to install the required NPM packages. You will need to do this both in the "starter" theme and in the "starter_watea" subtheme, as this subtheme imports components from the "starter" theme during Sass building. Ensure you have changed each theme's directory first:

```
cd themes/starter
npm install
cd ../starter_watea
npm install
```

### Backend changes

This theme and the base-theme also come with the [`cwp/agency-extensions` module](https://gitlab.cwp.govt.nz/cwp/agency-extensions) which helps us to clean up some parts of the CMS, rename some settings fields and provide a little bit of extra functionality to help the Wātea theme work.

If you need to extend or modify these changes at all, you can control the theme's extensions with YAML configuration, or create your own extensions in your `mysite` code.

### Compiling assets

Similarly to the Starter theme, you can compile assets using NPM commands:

```
npm run build   # Produces unminified (development) distributable files in dist/
npm run package # Produces minified (production) distributable files in dist/
```

Or to "watch" for changes in real time as you develop (faster):

```
npm run watch  # Compiles as "build", then watches for changes and recompiles as necessary
```

**Please note:** This subtheme's compiled Javascript assets are only relevant to this theme, and should be applied on top of the Starter theme's assets. Ensure that you include them in the correct order.

For CSS, this theme contains _a fully compiled_ set of styles for both themes. You should only include this theme's CSS (not the Starter theme).

To be able to "npm run build" in the Wātea theme, you will also be required to have run "npm install" in the Starter theme.

For example:

```
# File: templates/Page.ss - in the <head>
<link rel="stylesheet" href="$ThemeDir(watea)/dist/css/main.css">

# File: templates/Page.ss - near the bottom of the <body>
<script src="{$ThemeDir}/dist/js/main.js"></script>
<script src="$ThemeDir(watea)/dist/js/main.js"></script>
```

### Linting

Every now and then (e.g. before you commit) you should run a quick linter check over your Javascript and SASS source code:

```
npm run lint-js
npm run lint-sass
```

For information on the rules and configuration around these linters, please see the [Starter theme](customising_the_starter_theme) documentation regarding "working with standards".
