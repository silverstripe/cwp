title: Custom embeds in the WYSIWYG editor
summary: How to allow custom embeds in the TinyMCE HTML editor.

# Custom embeds in the WYSIWYG editor

This how-to guides developers through the steps necessary to disable default TinyMCE handling
of the `<embed>` and `<object>` tags.

<div class="notice" markdown='1'>
Proceeding with this guide will disable the ability of the CMS to embed `.swf` files through the "Insert Media"
interface button. You will need to provide your own [custom TinyMCE
plugins](https://docs.silverstripe.org/en/3.2/developer_guides/forms/field_types/htmleditorfield) or embed the files directly via HTML
code.
</div>

## Disable the media plugin

CMS uses the TinyMCE media plugin to embed `.swf` files. The side effect of this is that `<embed>` and `<object>` tags
are managed by the plugin which sometimes prevents custom markup to be inserted, or rewrites it with custom names
and attributes.

In your module's `_config.php` (the module's name has to be alphabetically after `cwp` for your `_config.php` statements
not to be overriden, see the notice in the [Rich Text Editing
docs](https://docs.silverstripe.org/en/3.2/developer_guides/forms/field_types/htmleditorfield/)) disable the media plugin for the
default editor installed by the `cwp` module:

	:::php
	HtmlEditorConfig::get('cwp')->disablePlugin('media');

Note the editor configuration we want to amend is "cwp" here, different from the default SilverStripe configuration
called "cms".

You should now be able to embed any `<embed>` or `<object>` using the HTML button in the TinyMCE editor.

## Modifying the whitelist

If you find out some attributes are still being removed by the editor, your can update the whitelist of elements.
Copy the `extended_valid_elements` option from `cwp/_config.php`, and amend it in your own `_config.php` to suit.

	:::php
	HtmlEditorConfig::get('cwp')->setOption('extended_valid_elements', '<your modified whitelist goes here>');
