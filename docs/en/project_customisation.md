# Working with the default functionality

CWP *basic* recipe comes with a set of page types and preconfigured modules. 

With Composer you can easily adjust the modules that are included in the project. Full instructions can be found in the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

For site-specific SilverStripe installation, fine tune your configuration with `mysite/_config.php`. More information is
available in the [configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

In the *basic* recipe you can find the CWP-specific code in the *cwp* module already included.

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

## Adding an additional text area or WYSIWYG editor field

[Tutorial 2](http://doc.silverstripe.org/framework/en/tutorials/2-extending-a-basic-site) contains a section
[Adding date and author fields](http://doc.silverstripe.org/framework/en/tutorials/2-extending-a-basic-site#adding-date-and-author-fields)
describing how to add additional fields to a page type. An editor could then add content to those fields as he would
with the default *Content* field.

Taking an example, if we want to add an additional *Abstract* field (which is intended to contain a summary of the page)
and have it apply to *all* page types, then your code might look something like this:

`Page.php` page type definition:

	:::php
	<?php
	class Page extends BasePage {
		...
		private static $db = array(
			'Abstract' => 'HTMLText'
		);
		
		public function getCMSFields() {
			$fields = parent::getCMSFields();
			$fields->addFieldToTab('Root.Main', $abstractField = new HtmlEditorField('Abstract'), 'Content');
			$abstractField->setRows(8); // limit the height of the editor
			return $fields;
		}
		...
	}

`Page.ss` template:

	:::html
	...
	$Abstract.RichLinks
	...

Because all page types extend from **Page**, this will apply the editor field to *all* page types that extend from
**Page**. If you only want your new editor field on a specific page type, you'd apply the above `$db` and
`getCMSFields()` code to a specific page type class instead.

If you want your field to be a plain-text area field instead, simply replace `HTMLText` with `Text` and
`HtmlEditorField` with `TextareaField`.

<div class="notice" markdown='1'>
The "RichLinks" part of the template variable provides additional processing to the links in the content.
[See more on the rich links functionality](reference/rich-links).
</div>

## Customising the WYSIWYG editor

The TinyMCE editor is the default WYSIWYG editor used with all *Content* fields in the CMS. SilverStripe Framework
allows developers to configure it through the `HtmlEditorField` wrapper.

The details are documented in SilverStripe documentation at [Rich-Text Editing (WYSIWYG)
documentation](http://doc.silverstripe.org/framework/en/trunk/topics/rich-text-editing).

TinyMCE options are documented at [Configuration Reference](http://www.tinymce.com/wiki.php/Configuration).

## Configuring the WYSIWYG spellchecker

TinyMCE bundled with SilverStripe uses Google for the spellchecker out of the box.

Note that the spellchecker doesn't distinguish between English US and English UK. This means that the spellchecker
will not detect "color" or "colour" as misspelled.

If you wish to configure this in a different way, such as use a different spellchecker altogether,
[TinyMCE spellchecker docs](http://www.tinymce.com/wiki.php/Plugin:spellchecker) provides information on how to
change this.

Note that there is no way to configure the spellchecker with TinyMCE without modifying the framework code.
This means you will need to fork the framework Git repository, change the `composer.json` in your project to the new
fork repository URL, and then run `compass update` on project environments that need the new framework code.