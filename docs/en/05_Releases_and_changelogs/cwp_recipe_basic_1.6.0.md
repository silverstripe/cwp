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

## Details of security issues

This release includes fixes for the following minor security issues:

 * [SS-2017-002](https://www.silverstripe.org/download/security-releases/ss-2017-002) **Member disclosure in login form:** There is a user ID enumeration vulnerability in our brute force error messages. Users that don't exist in will never get a locked out message, users that do exist, will get a locked out message. This means an attacker can infer or confirm user details that exist in the member table. This issue has been resolved by ensuring that login attempt logging and lockout process works equivalently for non-existent users as it does for existant users.
 * [SS-2017-003](https://www.silverstripe.org/download/security-releases/ss-2017-003) **XSS in redirector page:** RedirectorPage will allow users to specify a non-url malicious script as the redirection path without validation. Users which follow this url may allow this script to execute within their browser.
 * [SS-2017-004](https://www.silverstripe.org/download/security-releases/ss-2017-004) **XSS in page history comparison:** Authenticated user with page edit permission can craft HTML, which when rendered in a page history comparison can execute client scripts.

No user action is necessary to receive these security fixes. Upgrading to the latest recipe will automatically apply these fixes.

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

#### SSViewer Theme
One potential issue you may encounter is that your `Security` login page is not styled. To ensure this doesn't happen, please check your `config.yml` and ensure that you have specified the theme your `SSViewer` uses like this: 

```yaml
SSViewer:
  theme: 'my_custom_theme_name'
```

#### Customised `getBaseStyles` and `getBaseScripts`
In previous versions of the recipe, you may have followed the **"Adding JS and CSS files" [instructions](https://www.cwp.govt.nz/developer-docs/en/1.5/working_with_projects/customising_the_default_theme#adding-js-and-css-files-2)**. If you have overriden the `getBaseStyles` and/or `getBaseScripts` methods in `Page_Controller` (which inherits from `BasePage_Controller`), you will need to make a few more adjustments. 

`BasePage_Controller` no longer has the methods `getBaseStyles` and `getBaseScripts`. Meaning, overriding them in `Page_Controller` will no longer give you the results you might expect. Instead, you will have to create an extension for `BasePage_Controller` so you can hook your custom Styles and Scripts back in. 

##### Step 1: Create and Apply a BasePageControllerExtension

Let's start with creating our Extension. You could name it `BasePageControllerExtension` for example. It should look something like this: 

```php
class BasePageControllerExtension extends Extension 
{ 
   ... 
}
```
And it can live in `mysite/code/extensions/BasePageControllerExtension.php`. 
Now you need to apply it to your `BasePage_Controller`. In your `config.yml`, you will need to add: 


```yaml
BasePage_Controller:
  extensions:
    - BasePageControllerExtension
``` 

You're now all set up for Steps 2 and 3. Let's get to it!

##### Step 2: From `getBaseScripts` to `updateBaseScripts`

If you have overriden `getBaseScripts`, you will need to add the `updateBaseScripts` method to your `BasePageControllerExtension`. There are **two** ways this is likely to go for you depending on how you have overridden `getBaseScripts` and if you have (or have not) made use of the `parent::getBaseScripts()` method: 

###### 1. `Page_Controller` has the method `getBaseScripts` and it makes use of `parent::getBaseScripts()` like this: 

```php
public function getBaseScripts() 
{
    $scripts = parent::getBaseScripts();

    $themeDir = SSViewer::get_theme_folder();
    array_push($scripts, "$themeDir/js/my.js");

    return $scripts;
}
```

In 1.6.0, you will need to remove the above method from `Page_Controller` and then add the following method to the `BasePageControllerExtension`: 

```php
public function updateBaseScripts(&$scripts)
{
    $themeDir = SSViewer::get_theme_folder();

    $scripts = array_merge($scripts, array(
        "$themeDir/js/my.js"
    ));
}
```

###### 2. `Page_Controller` has the method `getBaseScripts` and it does not make use of `parent::getBaseScripts()` like this: 

```php
public function getBaseScripts()
{
    $themeDir = SSViewer::get_theme_folder();

    return array(
    	"$themeDir/js/my.js"
    );
}
```

Again, you will need to remove the above method from `Page_Controller` and then add the following method to the `BasePageControllerExtension`: 

```php
public function updateBaseScripts(&$scripts)
{
    $themeDir = SSViewer::get_theme_folder();

    $scripts = array_merge($scripts, array(
        "$themeDir/js/my.js"
    ));
}
```

And finally, you have to disable the default theme scripts in your `config.yml`:

```yaml
DefaultThemeExtension:
  disable_default_scripts: true
```

##### Step 3: From `getBaseStyles` to `updateBaseStyles`

If you have overriden `getBaseStyles`, you will need to add the `updateBaseStyles` method to your `BasePageControllerExtension`. There are **two** ways this is likely to go for you depending on how you have overridden `getBaseStyles` and if you have (or have not) made use of the `parent::getBaseStyles()` method: 

###### 1. `Page_Controller` has the method `getBaseStyles` and it makes use of `parent:: getBaseStyles()` like this: 

```php
public function getBaseStyles()
{
    $styles = parent::getBaseStyles();

    $themeDir = SSViewer::get_theme_folder();
    $styles['all'][] = "$themeDir/css/my.css"

    return $styles;
}
```

In 1.6.0, you will need to remove the above method from `Page_Controller` and then add the following method to the `BasePageControllerExtension`: 

```php
public function updateBaseStyles(&$styles)
{
    $themeDir = SSViewer::get_theme_folder();

    $styles['all'] = array_merge($styles['all'], array(
        "$themeDir/css/my.css"
    ));
}
```

###### 2. `Page_Controller` has the method `getBaseStyles ` and it does not make use of `parent:: getBaseStyles()` like this: 

```php
public function getBaseStyles()
{
    $themeDir = SSViewer::get_theme_folder();

    return array(
    	"all" => "$themeDir/css/my.css"
    );
}
```

Again, you will need to remove the above method from `Page_Controller` and then add the following method to the `BasePageControllerExtension`: 

```php
public function updateBaseStyles(&$styles)
{
    $themeDir = SSViewer::get_theme_folder();

    $styles['all'] = array_merge($styles['all'], array(
        "$themeDir/css/my.css"
    ));
}
```

And finally, you have to disable the default theme scripts in your `config.yml`:

```yaml
DefaultThemeExtension:
  disable_default_styles: true
```

#### Theme migration conclusion
That's it! You should be all ready to go! We do understand this is a bit of a tricky update, so if you have any questions, do not hesitate to submit a [Support Request](https://www.cwp.govt.nz/service-desk/requests/?target=set_project.php%3Fproject_id%3D33%3B4%26redirect_bug%3D1) with any questions or suggestions you might have. Happy to discuss! 
 

## Accepted failing tests

In recipe 1.6.0 these module unit tests cause external errors, but do not represent legitimate issues.

#### silverstripe/framework

 * UploadFieldTest.testAllowedExtensions — Behaviour intentionally altered by the MimeValidator module
 * UploadFieldTest.testSelect — Behaviour altered by SelectUploadField intentionally
 * UploadTest.testUploadTarGzFileTwiceAppendsNumber — This test is now expected
   to fail as the new MimeValidator module will no longer allow random content to
   be uploaded with a mismatched mime and file extension. The original test is
   attempting to upload a bunch of text as a gzip file.

#### silverstripe/queuedjobs

 * QueuedJobsTest.testImmediateQueuedJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).
 * QueuedJobsTest.testStartJob - Test self-aborts when detecting lack of available system
   resources (inconclusive).

#### silverstripe/translatable

 * TranslatableSearchFormTest.testPublishedPagesMatchedByTitleInDefaultLanguage - Test failure
   affected by global state. See https://github.com/silverstripe/silverstripe-translatable/issues/223
 * TranslatableSiteConfigTest.testCanEditTranslatedRootPages - Test failure affected by global state.
   See https://github.com/silverstripe/silverstripe-translatable/issues/224

#### silverstripe/userforms

 * UserDefinedFormControllerTest.testValidation - Test failure affected by global state (starter theme template overrides).
 * UserDefinedFormControllerTest.testRenderingIntoFormTemplate - Test failure affected by global state.
 * UserDefinedFormControllerTest.testRenderingIntoTemplateWithSubstringReplacement - Test failure affected by global state.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2017-05-24 [41270fcf](https://github.com/silverstripe/silverstripe-cms/commit/41270fcf9980c4be2529d2750c717675548eb617) Only allow HTTP(S) links for external redirector pages (Daniel Hensby) - See [ss-2017-003](http://www.silverstripe.org/download/security-releases/ss-2017-003)
 * 2017-05-09 [447ce0f84](https://github.com/silverstripe/silverstripe-framework/commit/447ce0f84f880c2bc969a89e4be528c53caeabe0) Lock out users who dont exist in the DB (Daniel Hensby) - See [ss-2017-002](http://www.silverstripe.org/download/security-releases/ss-2017-002)
 * 2017-05-09 [61cf72c0](https://github.com/silverstripe/silverstripe-cms/commit/61cf72c08dafddef416d73f943ccd45e70c5d43d) Unescaped fields in CMSPageHistroyController::compare() (Daniel Hensby) - See [ss-2017-004](http://www.silverstripe.org/download/security-releases/ss-2017-004)

### API Changes

 * 2017-04-28 [457a8a7](https://github.com/silverstripe/silverstripe-userforms/commit/457a8a75571808726c4506a8b6131e728ff699dd) Moving placeholder variable to EditableFormField (#581) (3Dgoo)
 * 2017-03-07 [c7107d2](https://gitlab.cwp.govt.nz/cwp/cwp/commit/c7107d21a89a5fb8bc70c12c9cba603d3418392c) Add ability to disable page utilities for a page (Robbie Averill)
 * 2017-03-07 [f4ea811](https://gitlab.cwp.govt.nz/cwp/cwp/commit/f4ea81115914758ac473d6efdc63f418963f5ea6) Move most user controllable custom SiteConfig settings to agency-extensions module (Robbie Averill)
 * 2017-03-06 [f484290](https://gitlab.cwp.govt.nz/cwp/cwp/commit/f48429067ef699f90f3e0ac1fe3052e6c44b8d67) Add getSelectedLanguage method to BasePage, rename BasePageTests so they run (Robbie Averill)
 * 2017-03-05 [f1b99b6fa](https://github.com/silverstripe/silverstripe-framework/commit/f1b99b6fa78f209ac493047f3ece55f7c9231efa) Enable theming of GroupedDropdownField (Damian Mooyman)
 * 2017-03-03 [b254897](https://gitlab.cwp.govt.nz/cwp/cwp/commit/b254897fd6ca7e9da5c19acd0d80facc85baab38) Remove carousel, deprecate BasePage methods for default theme. Carousel has moved to agency-extensions. (Robbie Averill)
 * 2017-03-02 [b09c0f3](https://gitlab.cwp.govt.nz/cwp/cwp/commit/b09c0f3f89cf88ab9ee5657edb4da834794baccd) Add BuildTask to populate sample data, starting with a contact user form (Robbie Averill)
 * 2017-01-23 [3583f1f79](https://github.com/silverstripe/silverstripe-framework/commit/3583f1f79ecff159d5586feb8ea4bd940126c132) Convert::raw2json can be passed an optional bitmask of JSON constants as options (Robbie Averill)

### Features and Enhancements

 * 2017-04-27 [a94f0e3](https://github.com/silverstripe/silverstripe-userforms/commit/a94f0e35aa9da788efc2c55a95da34888ee2c90e) Implemented and/or display rules for UserForms (Franco Springveldt)
 * 2017-04-20 [7983a7f](https://github.com/silverstripe/silverstripe-userforms/commit/7983a7f1192925b7126a1e2e28378f531b087271) added an extension point to UserDefinedForm.finished (Juan van den Anker)
 * 2017-04-12 [1a651880](https://github.com/silverstripe/silverstripe-cms/commit/1a6518803b6907ccf22922bca9ff4040200623ec) Make page urls bookmarkable (Damian Mooyman)
 * 2017-04-03 [40bf94532](https://github.com/silverstripe/silverstripe-framework/commit/40bf94532278d29bd58ebe161870cfe0784d8a7e) PHP 7 compatibility (Loz Calver)
 * 2017-01-13 [88f90bfc7](https://github.com/silverstripe/silverstripe-framework/commit/88f90bfc796755a6243dc99b780a922984065644) Merge pull request #6499 from SilbinaryWolf/feat-decoratorsetlist (Damian Mooyman)
 * 2016-12-13 [d0bf02d](https://github.com/silverstripe/silverstripe-userforms/commit/d0bf02d25f0f4e3d44e9c6582683404ecf91cfc4) Add autocomplete to EditableTextField (Elliot Goode)
 * 2016-12-13 [52cad6ce9](https://github.com/silverstripe/silverstripe-framework/commit/52cad6ce992378297fa49998d87a9de76bec8ecb) Added ImagickBackend::crop() for compatibility with GDBackend (UndefinedOffset)
 * 2016-12-05 [b4ba606ff](https://github.com/silverstripe/silverstripe-framework/commit/b4ba606ff2c8e77f484acc023fd324a2bcae6a8a) HTMLEditorField default alignment setting (Damian Mooyman)
 * 2016-12-02 [24dc3428d](https://github.com/silverstripe/silverstripe-framework/commit/24dc3428d9aa0830a1ab8a606ba67817e89a6263) HTMLEditorField default alignment setting (Jonathon Menz)
 * 2016-11-16 [6e10acf](https://github.com/silverstripe/silverstripe-userforms/commit/6e10acf6cd61954bdfda4fe5936beb369a5fce1a) setEmptyString option on EditableDropdown (Nic Horstmeier)
 * 2016-10-31 [776d2fbc6](https://github.com/silverstripe/silverstripe-framework/commit/776d2fbc66e2356fdf938fd9d4f8f01fd894dd7e) Allow setting of unlimited row counts on GridFieldPaginator (Daniel Hensby)

### Bugfixes

 * 2017-06-01 [d353aba](https://gitlab.cwp.govt.nz/cwp/cwp-installer/commit/d353abab3bbe08159dddb3a297acd981244ba0d8) Update changelog prefix number. 04 is now performance guides. (Robbie Averill)
 * 2017-05-30 [51164768](https://github.com/silverstripe/silverstripe-cms/commit/51164768751de4e2c7c931d21f5635714df7bf34) Issue where CMS SiteTree can result in infinite recursion if parent and child relation is swapped (Daniel Hensby)
 * 2017-05-28 [16a74bc8a](https://github.com/silverstripe/silverstripe-framework/commit/16a74bc8a9fdee7cfb4f6f24493c271f90a76341) DataDifferencer needs to expliclty cast HTMLText values (Daniel Hensby)
 * 2017-05-24 [e86306c](https://github.com/silverstripe/silverstripe-userforms/commit/e86306c7bf12a3b17cb698e3559fc176444ef463) incorrect calculation of MAX_FILE_SIZE (#600) (Reece Alexander)
 * 2017-05-24 [ca1e2ab](https://github.com/silverstripe/silverstripe-userforms/commit/ca1e2abd833001d40bc2a32b55914e6670416601) Remove empty column in display logic GridField for form field (Sacha Judd)
 * 2017-05-22 [7c3edd4](https://github.com/silverstripe/silverstripe-userforms/commit/7c3edd4d5119fd6ff1634a74d087a5b995b0ea4a) Hide and show form fields by toggling the "hide" class instead of jQuery methods (Robbie Averill)
 * 2017-05-17 [11f43c2](https://github.com/silverstripe/silverstripe-userforms/commit/11f43c27dc56f0e592ad63ea15fab951d5be61bb) Make EditableLiteralField extensible, have its own template, honour visibility rules (Robbie Averill)
 * 2017-05-11 [33cc3a1](https://github.com/silverstripe/silverstripe-versionfeed/commit/33cc3a13e893e6a970b8a72f25774cd60778ee6d) Ensure that version feeds are enabled by default in tests (Robbie Averill)
 * 2017-05-11 [fc309d0](https://gitlab.cwp.govt.nz/cwp/cwp/commit/fc309d0982f24f170cc2fe86a76a483e126e6d68) SitemapTest referencing default theme, changed to use starter (Robbie Averill)
 * 2017-05-08 [14540729](https://github.com/silverstripe/silverstripe-cms/commit/14540729caa30dd2e782e4fd52afe518dc156ed8) Use framework 3.5 to test cms 3.5 (Sam Minnee)
 * 2017-05-03 [2d138b0ef](https://github.com/silverstripe/silverstripe-framework/commit/2d138b0ef06bd93958cc0678a0afa95560648fb9) class name reference consistency (Gregory Smirnov)
 * 2017-05-02 [2187c160b](https://github.com/silverstripe/silverstripe-framework/commit/2187c160b936620621fe746a1ffe36af568b21ff) ing pagination api doc typo (3Dgoo)
 * 2017-04-28 [a511e3511](https://github.com/silverstripe/silverstripe-framework/commit/a511e3511cace405dab7589a3406a0858cb6edf2) #6855: Mangled JS in Requirements, escaping replacement values prior to passing to preg_replace(). (Patrick Nelson)
 * 2017-04-26 [1ff6f3f1](https://github.com/silverstripe/silverstripe-cms/commit/1ff6f3f1b047a1d27b3d60217dc262e8a1c9f54c) ing doArchive (John Milmine)
 * 2017-04-26 [000a5f72](https://github.com/silverstripe/silverstripe-cms/commit/000a5f7209065aceae14801244a08d3ed186e752) Fix page history / settings forms (Damian Mooyman)
 * 2017-04-24 [1d36f354e](https://github.com/silverstripe/silverstripe-framework/commit/1d36f354e8349616c7b39fcade859fbcf0f9c362) Create Image_Cached with Injector. (Gregory Smirnov)
 * 2017-04-21 [7e777532](https://github.com/silverstripe/silverstripe-cms/commit/7e77753274421c79bac85c5b0c9a35728ce3e3aa) intl test (Daniel Hensby)
 * 2017-04-07 [41eddfcc](https://github.com/silverstripe/silverstripe-cms/commit/41eddfcc8efad2ef90c2f8063a32e4fd0d1656be) ing cms page history controller to use new page id param (Tim Kung)
 * 2017-04-07 [55eb7ebdc](https://github.com/silverstripe/silverstripe-framework/commit/55eb7ebdcc9ba767f978dff510614bbd2e0c309d) Do not insert requirements more than once in includeInHTML (Robbie Averill)
 * 2017-04-05 [85d5dd3](https://github.com/silverstripe/silverstripe-securityreport/commit/85d5dd328ab506772de4a16e52b91f2c8190cbc7) array to string conversion error (Rob Ingram)
 * 2017-04-05 [a7920b1f9](https://github.com/silverstripe/silverstripe-framework/commit/a7920b1f9866b6eb5f4bad9de84eef84b88673ad) regression from #6668 - ModelAdmin form widths (Loz Calver)
 * 2017-04-05 [197bc53c4](https://github.com/silverstripe/silverstripe-framework/commit/197bc53c4963898d2c10621ca6d6031fdb14fe85) Add transparency percent argument to Image::generatePad to ensure transparency works from ::Pad (Robbie Averill)
 * 2017-04-05 [80e89673](https://github.com/silverstripe/silverstripe-cms/commit/80e89673082cd32dfb5937a4364c646792bef61c) Fix VirtualPage::init() content-modification check. (Sam Minnee)
 * 2017-04-04 [2ddb6168](https://github.com/silverstripe/silverstripe-cms/commit/2ddb616829d497a464ca78e6e61a2ec07450530b) Correct case of CopyContentFrom method (Daniel Hensby)
 * 2017-04-04 [ec15c713](https://github.com/silverstripe/silverstripe-cms/commit/ec15c713420dd2ee5d5c9792af489a74db9653f6) Add __isset to VirtualPage for PHP7 support. (Daniel Hensby)
 * 2017-04-04 [ae0fe75fb](https://github.com/silverstripe/silverstripe-framework/commit/ae0fe75fba35918735656ea82cab2e7584b27f07) non-numeric warnings in GDBackend/ImagickBackend (Loz Calver)
 * 2017-04-04 [f101697f8](https://github.com/silverstripe/silverstripe-framework/commit/f101697f8ef5dac427c7c3b65c457f5c6c1ab090) File::ini2bytes() in PHP 7 (Loz Calver)
 * 2017-04-04 [e22cd4db0](https://github.com/silverstripe/silverstripe-framework/commit/e22cd4db00f2afb69b7c7f6572c109e627776dbe) TabSet attempting to access undeclared property (Loz Calver)
 * 2017-04-04 [f083a06f3](https://github.com/silverstripe/silverstripe-framework/commit/f083a06f3f97c34079a7d37692f2968df24fe8ff) Fix ViewableData::__isset() for getXXX() getters. (Sam Minnee)
 * 2017-04-03 [e5f51b14](https://github.com/silverstripe/silverstripe-reports/commit/e5f51b14a347099ae5a67110e56179b0140e871c) Relax PHP version requirement. (Sam Minnee)
 * 2017-04-03 [454646c4d](https://github.com/silverstripe/silverstripe-framework/commit/454646c4dfda323a66e42ed46797fdad4a12d176) invalid closure param in ShortcodeParserTest (Loz Calver)
 * 2017-04-03 [82f62c818](https://github.com/silverstripe/silverstripe-framework/commit/82f62c818430314f3607c2ad87776740ccfccefb) illegal string offset in spyc component (Loz Calver)
 * 2017-04-02 [bf39169](https://github.com/silverstripe/silverstripe-userforms/commit/bf391697fabb5444fec31de752c807afb6ff8646) casting bug with email previews (#549) (Loz Calver)
 * 2017-03-23 [b3d37880e](https://github.com/silverstripe/silverstripe-framework/commit/b3d37880e910ff925323ea039dff0235ad3aa3f2) many_many_extraFields breaks _SortColumn0 ordering (fixes #6730) (Loz Calver)
 * 2017-03-16 [4d83481](https://gitlab.cwp.govt.nz/cwp/cwp/commit/4d83481e1c779b4000ec4cf268ab6cadb6922bd9) Remove double (required) label, add translations to the text (Robbie Averill)
 * 2017-03-16 [dc85ba9](https://gitlab.cwp.govt.nz/cwp/cwp/commit/dc85ba9da3b7e064470a339f68c3b93a5e4bbc1b) Ensure "cwp" module Page CMS fields are added before extension hooks are run (Robbie Averill)
 * 2017-03-15 [5a22f6f](https://github.com/silverstripe/silverstripe-comments/commit/5a22f6faa5265e493e643fe2b0a00b1b260c573a) Improve delete reply confirmation message (Robbie Averill)
 * 2017-03-14 [cd0aee9](https://gitlab.cwp.govt.nz/cwp/cwp-core/commit/cd0aee9ace21ed57eec2a11ca0ef6d2f547bbd2a) CWPT-475: Remove extra spaces in external links around nonvisual-indicator span, breaks ::after (Robbie Averill)
 * 2017-03-12 [cc749d3a1](https://github.com/silverstripe/silverstripe-framework/commit/cc749d3a19d36fbc44ec668aab66252333e4bcf5) Give DatetimeField its own template (which is extensible) (Robbie Averill)
 * 2017-03-10 [c349ae9](https://github.com/silverstripe/silverstripe-userforms/commit/c349ae980e587bd27dcc0296ddc118715e7378df) Use non-destructive pubilshing for editable options (Damian Mooyman)
 * 2017-03-08 [bbaf427](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/bbaf4276af015e2f32d63256f1401bd3e7123faa) Fix delete / unpublish (Damian Mooyman)
 * 2017-03-06 [a428d0c](https://gitlab.cwp.govt.nz/cwp/cwp/commit/a428d0c7942c7beeceaf3cb9cb2b1ff166c47a5b) DateRangeForm construction and script inclusion order (Damian Mooyman)
 * 2017-03-03 [37a1c3a](https://gitlab.cwp.govt.nz/cwp/cwp/commit/37a1c3a0b98d1e0d976c4f0d1b0bb344625bab93) Add localisation to FilterDescription terms (Robbie Averill)
 * 2017-03-02 [707fb30](https://gitlab.cwp.govt.nz/cwp/cwp/commit/707fb306d9ebdf94400387ba60e38ffc7449f574) twitter Bootstrap links (Brett Tasker)
 * 2017-02-21 [f647b1c](https://github.com/silverstripe-australia/silverstripe-multivaluefield/commit/f647b1c8897b7e0662817855f365087ba59fc8ad) , check whether sortable exists before trying to use it. (Nathan Glasl)
 * 2017-02-15 [e3eb082](https://github.com/silverstripe-australia/silverstripe-advancedworkflow/commit/e3eb082d622957bb3fcc183c45752cb038769f1a) (WorkflowPublishTargetJob) Use draft stage (Marcus Nyeholt)
 * 2017-02-15 [30725916d](https://github.com/silverstripe/silverstripe-framework/commit/30725916dbb0ffc66b77f26c069a86581636ae55) Array to string conversion message after CSV export (#6622) (Juan van den Anker)
 * 2017-02-14 [7122e1fde](https://github.com/silverstripe/silverstripe-framework/commit/7122e1fde79bdb9aad3c8714a6ce02b7ecedd735) Comments ignored by classmanifest (#6619) (Daniel Hensby)
 * 2017-02-14 [bb000ca](https://github.com/silverstripe/silverstripe-userforms/commit/bb000ca893c4a98038becf9a51ad2ed9041b22f5) Change delete() to deleteFromStage() for EditableMultipleOptionField::doPublish(). This fixes the issue where options were being removed from the draft table instead of the Live table, effectively deleting them from the CMS (#545) (Danae)
 * 2017-02-09 [6e2797ffc](https://github.com/silverstripe/silverstripe-framework/commit/6e2797ffc0e9632b60acc5a66e52aeb44f0e2b78) es for using dblib PDO driver. (Andrew O'Neil)
 * 2017-02-08 [c25c443d9](https://github.com/silverstripe/silverstripe-framework/commit/c25c443d95fc305fb3545b1393b7da85923dcf8b) Fix minor mysql 5.7 warning in SQLQueryTest (#6608) (Damian Mooyman)
 * 2017-01-30 [8c27891](https://github.com/silverstripe/silverstripe-userforms/commit/8c27891600455ddaea0493ca496c76dddfae13b0) for #185 and #194 (#539) (torleif)
 * 2017-01-18 [72b6fb49b](https://github.com/silverstripe/silverstripe-framework/commit/72b6fb49b698bc3a51c8f6b32d2bf08213729493) bug: In addOrderBy method, _SortColumn will only keep the last one if there are more than 1 multi-word columns (Shawn)
 * 2017-01-15 [4f9800e](https://github.com/silverstripe/silverstripe-userforms/commit/4f9800e190d5c0cf7f1bb5bcca67acc4e816c15c) Travis builds broken with external code coverage (Robbie Averill)
 * 2016-12-13 [1743ed1](https://github.com/silverstripe/silverstripe-userforms/commit/1743ed155603a2eb322ce1f7e72928d4e1ff0365) Fix issue with UserFormsCheckboxSetField (Damian Mooyman)
 * 2016-12-13 [63f096f](https://gitlab.cwp.govt.nz/cwp/cwp-core/commit/63f096f5eaa7c8db5c777c75e0b2a9cc5aec47e8) Stop the default SolrSearchIndex from using addAllFulltextFields() (Matt Peel)
 * 2016-12-08 [dc530c0](https://github.com/silverstripe/silverstripe-userforms/commit/dc530c0381bd5007e52c765352580d159175e418) es #529 (torleif)
 * 2016-11-30 [cbdb7d4](https://github.com/silverstripe-australia/silverstripe-gridfieldextensions/commit/cbdb7d472941bd87c7397d9f6d4f778dd53bddc7) Prevent duplicate HTML IDs when adding new records inline (Loz Calver)
 * 2016-11-28 [1732269](https://gitlab.cwp.govt.nz/cwp/cwp/commit/1732269010f58066f0916422bada1790a5b59e85) upgrading notes for auditor module (Damian Mooyman)
 * 2016-11-20 [aa171f8](https://github.com/silverstripe/silverstripe-userforms/commit/aa171f8e4534c7d4e908b3229b4896071631a07f) Enable Shortcode parsing for the Content in EditableLiteralField (Damian Mooyman)
 * 2016-10-26 [22ad39e5a](https://github.com/silverstripe/silverstripe-framework/commit/22ad39e5aea301fa932894d444191dd6ef6389af) Fix SSViewerTest in PHP7 (Sam Minnee)
 * 2016-10-16 [86f1778](https://github.com/silverstripe-australia/silverstripe-gridfieldextensions/commit/86f17785116334cf6d62b3f2614a92431ce1ee2b) (GridFieldAddNewMultiClass): Fix bug where class doesn't exist. (ie. ClassInfo says the class exists, but PHP itself doesn't, since ClassInfo is based on parsed tokens) (Jake Bentvelzen)
 * 2016-10-12 [d722881](https://github.com/silverstripe-australia/silverstripe-gridfieldextensions/commit/d72288125a524fc7734c8d23be49828ebe55dd98) Swap DataList code to SS_List (Marcus Nyeholt)
 * 2015-08-28 [f224849cc](https://github.com/silverstripe/silverstripe-framework/commit/f224849cc6c93024ed305a6ca82df8fd08c8df80) Don’t use SplFixedArray in PHP 7. (Sam Minnee)
 * 2015-08-27 [cca7e9697](https://github.com/silverstripe/silverstripe-framework/commit/cca7e9697cd8b8523d52492cd686e06995d94f91) Correct PHP4-style constructors in SimpleTest. (Sam Minnee)
