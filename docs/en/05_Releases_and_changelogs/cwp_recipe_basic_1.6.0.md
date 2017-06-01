# CWP Recipe 1.6.0 (unreleased)

## Overview

This upgrade includes CMS and Framework version 3.6.0 which includes bugfixes and
some feature and API enhancements.

 * [framework 3.6.0](https://docs.silverstripe.org/en/3/changelogs/3.6.0)

Upgrade to Recipe 1.6.0 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

The following functionality has been moved from `cwp/cwp` to the [`cwp/agency-extensions`](https://gitlab.cwp.govt.nz/cwp/agency-extensions) module. Please install this module for continued use.

* Carousel functionality and associated translations
* Functionality for adding `Requirements` for the `cwp-themes/default` theme
* Most user-configurable SiteConfig settings (e.g. logo uploads) and associated translations

## Upgrading Instructions

If you require any of the functionality that has been moved to the `cwp/agency-extensions` module, please add it to your Composer requirements:

```
composer require cwp/agency-extensions
```

### Using cwp-themes/default

If you're upgrading from a project that uses the `cwp-themes/default` theme, or has a theme that was based on this theme
in the past, you may need to install the agency-extensions module (instructions above) to reinstate some functionality
such as combined scripts and styles, hero/carousel etc.

If you have renamed the "default" theme to something else, you will need to add your custom theme name to a configuration
array of "default themes". Without doing so your pages may render with no CSS or Javascript. This can be defined either
in YAML or PHP (in `mysite/_config.php`).

**YAML: mysite/\_config/config.yml**

```yaml
CwpThemeHelper:
  default_themes:
  	- my_custom_theme_name
```

**PHP: mysite/\_config.php**

```php
<?php

Config::inst()->update('CwpThemeHelper', 'default_themes', array('my_custom_theme_name'));
```

## Change Log

TBC
