title: Customising the default functionality
summary: Development information for developing your own custom project features.

# Customising the default functionality

You should have started your project from the CWP installer or included the desired recipe modules with your project for the maximum level of
compatibility with the platform.

For custom development work for your website the best source of technical information for SilverStripe CMS development is the [Official SilverStripe CMS developer documentation](https://docs.silverstripe.org/en/4/).

With Composer you can easily add to the modules that are included in the project. Full instructions can be found in the
[Official SilverStripe CMS documentation](https://docs.silverstripe.org/en/4/getting_started/composer/#advanced-usage).

For site-specific SilverStripe installation, fine tune your configuration with `mysite/_config` YAML files and
`mysite/_config.php` PHP configuration. More information is available in the [configuration
reference](https://docs.silverstripe.org/en/4/developer_guides/configuration/configuration/). Make sure to preserve the database and
environment configuration code, otherwise your deployment may not work (e.g. the database connection will not work).

The best way to work with your site is to commit all your modifications to your own theme and/or in the `mysite` directory.

Avoid changing modules directly. Instead, SilverStripe CMS's architecture allows safe customisation through:

* [Modules](https://addons.silverstripe.org/)
* [Class inheritance](https://docs.silverstripe.org/en/4/developer_guides/model/data_model_and_orm/#subclasses)
* [SilverStripe DataExtensions](https://docs.silverstripe.org/en/4/developer_guides/extending/extensions/)
* [Dependency injection](https://docs.silverstripe.org/en/4/developer_guides/extending/injector/)

To gain deeper understanding on how the SilverStripe Framework can be used to develop custom solutions, we recommend
going through the [SilverStripe CMS online lessons](https://www.silverstripe.org/learn/lessons/v4/) and searching through
the [Official SilverStripe CMS development documentation](https://docs.silverstripe.org/en/4).

Directly modifying module files is not recommended because it makes future upgrades harder. You will also have a harder time getting support from the community.

The preferred way to modify modules is to submit pull requests to the module maintainer and make sure the changes are
propagated to the master repository. This ensures upgradability and moreover ensures that all valuable changes are
given back to the community and the platform's users.

## Adding an additional text area or WYSIWYG editor field

Taking an example, if we want to add an additional *Abstract* field (which is intended to contain a summary of the page)
and have it apply to *all* page types, then your code might look something like this:

`Page.php` page type definition:

```php
// File: mysite/code/Page.php
<?php

use CWP\CWP\PageTypes\BasePage;

class Page extends BasePage 
{
	// ...
	private static $db = [
		'Abstract' => 'HTMLText'
	];

	public function getCMSFields() 
	{
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Main', $abstractField = HtmlEditorField::create('Abstract'), 'Content');
		$abstractField->setRows(8); // limit the height of the editor
		return $fields;
	}
	...
}
```

`Page.ss` template:

	:::html
	...
	$Abstract.RichLinks
	...

Because all page types extend from `Page`, this will apply the editor field to *all* page types that extend from
`Page`. If you only want your new editor field on a specific page type, you'd apply the above `$db` and
`getCMSFields()` code to a specific page type class instead, or by using a DataExtension applied to a specific page type class with YAML configuration.

If you want your field to be a plain text area field instead, simply replace `HTMLText` with `Text` and
`HtmlEditorField` with `TextareaField`.

The "RichLinks" part of the template variable provides additional processing to the links in the content.
[See more on the rich links functionality](../02_Features/rich_links.md).

## Customising the WYSIWYG editor

The TinyMCE editor is the default WYSIWYG editor used with all *Content* fields in the CMS. SilverStripe Framework
allows developers to configure it through the `HtmlEditorField` wrapper.

The details are documented in SilverStripe documentation at [Rich-Text Editing (WYSIWYG)
documentation](https://docs.silverstripe.org/en/4/developer_guides/forms/field_types/htmleditorfield/).

TinyMCE options are documented at [Configuration Reference](https://www.tinymce.com/docs/configure/).

## Configuring the WYSIWYG spellchecker

Editor bundled with CWP uses the inbuilt browser spellcheck capability that is included with newer browsers. Follow
below links to find out more details about the usage:

* [Firefox](http://support.mozilla.org/en-US/kb/how-do-i-use-firefox-spell-checker)
* [IE10](https://answers.microsoft.com/en-us/ie/forum/ie11-iewindows_10/spelling-correction-and-checking-in-internet/a1321c59-3623-49a2-8fce-388ecc2cb057?auth=1)

Note that although there is currently a way to change the spellchecker with TinyMCE by modifying the framework code,
this is not recommended. It would require forking the Framework which will result in a code that's harder to maintain.
