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

If you are using the [theme colour picker](https://github.com/silverstripe/cwp-agencyextensions/blob/2.2/docs/en/01_Features/ThemeColors.md)
from the cwp/agency-extensions module, or if you are contributing to the open source theme itself, you may want to
consider using [the provided mixins](https://github.com/silverstripe/cwp-watea-theme/blob/3.0/src/scss/utils/theme-styles.scss)
to allow colours to be configured by the theme colour picker in the CMS.

These mixins work by taking the area name, and which property the variable colour should be applied to, and producing a
set of CSS rules that set the value of the specified property based on the configuration in the CMS. You can find a
current list of configurable areas [here](https://github.com/silverstripe/cwp-watea-theme/blob/3.0/src/scss/utils/theme-styles.scss#L95).

**Example:** you want to use a slightly darker link colour in a specific section of your page, because the section has a
slightly darker background than normal, and the default link colour would not match contrast standards. Instead of
defining the colour explicitly, use a configurability-aware mixin instead:

```diff
.my-area {
  // Make link colours darker to ensure they match contrast standards on a slighty darker background
  a {
-    color: darken($link-color, 5%);
+    @include theme-color("accent", "color", "darken", 5%);
  }
}
```

**Example:** there is a section of the page that you want to have match the background of the configurable footer area,
and you need to set an appropriate text colour. Instead of defining the text colour explicitly as white, which would
work for most but not all configurable colours, you should use a configurability-aware mixin for contrast. This will
ensure that if a CMS user changes the colour that is used in this background, the text colour will be adjusted to match.

```diff
.page-footer__quotes {
  @include theme-color("footer", "background-color");

-  // Make text colour white/light, because the background is usually dark
-  color: $white;
+  // If the footer is changed to a light background in the CMS, this will automatically apply a dark text colour
+  @include theme-contrast-color("footer", "color");
}
```

It's important that you use these theme colour mixins whenever you are defining colours that are used in areas which may
be modified by CMS colour customisations. This will ensure that the colours you define are also changed when their
surrounding context changes - otherwise, you may end up with text that is unreadable in certain configurations.

For more information on customising the colour configuration settings in the CMS, see the
[cwp/agency-extensions documentation](https://github.com/silverstripe/cwp-agencyextensions/blob/2.2/docs/en/01_Features/ThemeColors.md).
