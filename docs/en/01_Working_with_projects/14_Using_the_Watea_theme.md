title: Using the Wātea theme
summary: Describes how to use the CWP Wātea theme
introduction: Describes how to use the CWP Wātea theme

# Using the Wātea theme

The [Wātea theme](https://github.com/silverstripe/cwp-watea-theme) can be installed on top of the
[Starter theme](https://github.com/silverstripe/cwp-starter-theme) (see 
[cascading themes](https://docs.silverstripe.org/en/4/developer_guides/templates/themes)) to provide a more visually
appealing start to a CWP website.

## Installation

Install this theme module with Composer:

```
composer require cwp/watea-theme
```

This will also install the `cwp/starter-theme` dependency, which is the foundation for this theme, and the
`cwp/agency-extensions` module which provides additional functionality to the CMS for agency-style SilverStripe
websites.

## Getting started

This theme is designed to augment the base functionality and framework provided by the
[CWP Starter theme](https://github.com/silverstripe/cwp-starter-theme). As such,
[all of the documentation for the CWP Starter theme](customising_the_starter_theme) is relevant to this theme as well.
We suggest you familiarise yourself with this documentation.

As a general rule, the CWP Team have endeavoured to constrain changes for this theme to CSS and Javascript wherever 
possible, as opposed to modifying and duplicating the templates. As a cascading theme, all templates in this theme will 
be applied over the top (with priority) of the CWP Starter theme.

If you need to modify template markup from the SilverStripe framework, other modules, or even the Starter theme, you can
copy them into the "watea" theme directory and modify them there.

## Development

<div class="alert alert-info" markdown='1'>
Please familiarise yourself with [Customising the starter theme](customising_the_starter_theme), as all documentation
there is relevant for this theme as well.
</div>

### Setup

For development you will need Node.js and `yarn` installed. Please see the
[Customising the starter theme](customising_the_starter_theme) article for more information.

Next, you need to install the required npm packages. You will need to do this both in the CWP Starter theme and in the
"watea" theme, as this theme imports components from the "starter" theme during Sass building. Ensure you have
changed each theme's directory first:

```
cd themes/starter
yarn install
cd ../watea
yarn install
```

### Backend changes

This theme and the base-theme also come with the
[`cwp/agency-extensions` module](https://github.com/silverstripe/cwp-agencyextensions) which helps us to clean up some
parts of the CMS, rename some settings fields and provide a little bit of extra functionality to help the Wātea theme
work.

If you need to extend or modify these changes at all, you can control the theme's extensions with YAML configuration,
or create your own extensions in your `app` code.

### Compiling assets

Similarly to the CWP Starter theme, you can compile assets using yarn commands:

```
yarn build   # Produces unminified (development) distributable files in dist/
yarn package # Produces minified (production) distributable files in dist/
```

Or to "watch" for changes in real time as you develop (faster):

```
yarn watch  # Compiles as "build", then watches for changes and recompiles as necessary
```
<div class="alert alert-info" markdown='1'>
Please note: This theme's compiled Javascript assets are only relevant to this theme, and should be applied on top
of the CWP Starter theme's assets. Ensure that you include them in the correct order.
</div>

For CSS, this theme contains _a fully compiled_ set of styles for both themes. You should only include this theme's
CSS (not the CWP Starter theme).

To be able to "yarn build" in the Wātea theme, you will also be required to have run `yarn install` in the CWP
Starter theme.

For example:

```
# File: templates/Page.ss - in the <head>
<% require themedCss('dist/css/main.css') %>

# File: templates/Page.ss - near the bottom of the <body>
<% require javascript('themes/starter/dist/js/main.js') %>
<% require javascript('themes/watea/dist/js/main.js') %>
```

### Linting

Every now and then (e.g. before you commit) you should run a quick linter check over your Javascript and SASS source
code:

```
yarn lint-js
yarn lint-sass
```

For information on the rules and configuration around these linters, please see the
[CWP Starter theme](customising_the_starter_theme) documentation regarding "working with standards".

### Using mixins for configurable theme colours

If you are using the cwp/agency-extension
