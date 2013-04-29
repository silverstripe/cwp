# Rich links

The CWP module comes with an extension that allows developers to augment the links with Web Goverment Standards
compliant attributes and markup.

The following abilities are included:

 * Adding a `class="external"` and a `rel="external"` attributes to external links.
 * Inserting file type and file size into file download links.

## Usage

To use the feature, explicitly invoke the parser function within the template.

	:::html
	$Content.RichLinks

You can also chain it with other functions to achieve more complex outputs.

	:::html
	$Content.RichLinks.LimitWordCountXML(10)

Note: this parser might not work as expected on fields not edited with *HtmlEditorField*, as it relies on the content
being provided in this specific format.

## Code

The capability is built as a simple extension to `DBField`. It is applied in `cwp/_config.php`:

	:::php
	DBField::add_extension('RichLinksExtension');

It provides all fields with a `RichLinks` function.

