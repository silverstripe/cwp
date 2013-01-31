# Developer Howto

This how-to guides the Development Agency programmer through the general concepts applicable to the CWP platform.

## Recipes

The CWP platform comes with template projects that contain all the elements of the basic site. For the purpose of this
how-to we will be using a *basic* recipe. These recipes can be copied ("forked") to quickly create your own project.

## Forking a project

TODO

## Preparing developer's environment

Once you have your project set up, you can install it on your development machine.

CWP is installed with the Composer PHP package management tool. To learn about the Composer, visit the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

First of all, check out your project using Git's `git clone` command. If you have forked the *basic* recipe, the project
will come with a `composer.json` file that lists all the required dependencies. You will be able to install them with:

	$ composer install --dev

You should also have a working `_ss_environment.php` file in or above the webroot of your development environment.
Documentation on [setting up your environment](framework/en/topics/environment-management)
file can be found in the SilverStripe documentation.

## Starting out with SilverStripe

The best way to start with SilverStripe is to read through
[tutorials](http://doc.silverstripe.org/framework/en/tutorials) found in the SilverStripe documentation.

These tutorials will guide you through basic concepts of the CMS, and how to extend the default functionality creating
new page types, additional fields and more.

## Working with the *default* theme

### Introduction

CWP provides a *default* theme for you to work with. This has been developed both as a base for more complex themes to
be built on top of and as a reference example for meeting Government standards and accessibility guidelines.

For more information on how a SilverStripe theme is constructed, see the [Developing
Themes](http://doc.silverstripe.org/framework/en/topics/theme-development) page in the SilverStripe documentation.

When customising the theme, you can choose to work either with the powerful SCSS framework (as explained below), or to
use the CSS stylesheets directly. In the latter case we recommend you to remove the SCSS files to make it clear they are
not used.

### Bootstrap

The *default* theme is built on top of a fork of the Twitter [Bootstrap](http://twitter.github.com/bootstrap/)
front-end framework.

Twitter Bootstrap is a free collection of tools for creating websites and web applications. It contains HTML and
CSS-based design templates for typography, forms, buttons, charts, navigation and other interface components, as well
as optional JavaScript extensions. Bootstrap was originally written in Less, but has been ported to SCSS. This theme
uses the SCSS port of Bootstrap.

From Bootstrap's [GitHub page](http://twitter.github.com/bootstrap/) you can find links about the basics of the system
and the full documentation.

The *basic* recipe pulls in Bootstrap as a module into `themes/module_bootstrap`.

#### Bootstrap in the *default* theme

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

### SCSS/SASS

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

## Working with PHP

CWP *basic* recipe comes with a set of page types and preconfigured modules. 

With Composer you can easily adjust the modules that are included in the project. Full instructions can be found in the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer#advanced-usage).

For site-specific SilverStripe installation, fine tune your configuration with `mysite/_config.php`. More information is
available in the [configuration reference](http://doc.silverstripe.org/framework/en/topics/configuration).

In the *basic* recipe you can find the CWP-specific code in the *cwp* module already included.

## Customising your project

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

TODO: mention how to request changes to platform modules.

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
		public static $db = array(
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

## HTML to PDF export

CWP provides some tools out of the box for generating downloadable PDF versions of pages.

[wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) is being used to generate the PDF, it is a command line utility
using WebKit to render the HTML into PDF format.

### How it works

A special `$PdfLink` variable is provided to the templates, which if applied as the value of an `href` value to an
anchor in the template, will provide users with a way to download the a PDF version of the current page.

The first time the PDF is generated, a cached copy is stored into `assets/_generated_pdfs` which means subsequent users
will download the cached copy instead.

Whenever a CMS user publishes or unpublishes a page, the cached PDF file stored for that page in
`assets/_generated_pdfs` is deleted. This means that the user is either forced to download a newly generated PDF, or in
the case of a page being removed from the site via unpublishing, the cached PDF file is no longer available to download.

The PDF is treated as a print view of the page, so any CSS that applies to the "print" media is applied, just like what
a user would see when print previewing a page in their browser. This can be removed so the PDF shows as a normal page
by removing the `--print-media-type` parameter to `wkhtmltopdf`.

### Limitations

Draft content cannot be exported to PDF, due to the fact that generated PDF files are publically accessible by anyone
viewing the website, there are no permission checks when accessing files directly in the browser.

### Installing wkhtmltopdf in your development environment

<div class="notice" markdown='1'>
The CWP test and production servers you'll be deploying your site to already have `wkhtmltopdf` installed.
These instructions are only necessary if you want to develop or use the PDF export functionality in your local
development environment.

The instructions below assume you're on a Debian or Ubuntu Linux environment.
There is a Mac OS X download, and there may be a Windows binary for `wkhtmltopdf` but they have not been tested.
</div>

 1. [Download wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/downloads/list) for your system type:

	wget http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.9.9-static-amd64.tar.bz2

 2. Install it into `/usr/local/bin` so that it can be accessed on the path:

	tar -jxvf wkhtmltopdf-0.9.9-static-amd64.tar.bz2
	mv wkhtmltopdf-amd64 /usr/local/bin/wkhtmltopdf

 3. Test it works:

	wkhtmltopdf -V

 4. Update your `_ss_environment.php` file to point your site to the binary:

	define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf');

 5. Install extra Microsoft fonts, such as Arial:

	apt-get install ttf-mscorefonts-installer

Note the [licensing information](http://www.microsoft.com/typography/RedistributionFAQ.mspx) provided by Microsoft.
This means those fonts such as Arial can be embedded in the PDF document, provided they are for "Print and preview"
only.

### Enabling PDF export functionality

Export to PDF functionality is disabled by default. You need to add a line of code to enable it.

In your `mysite/_config.php` file, add the following:

	BasePage::$pdf_export_enabled = true;

Now you can use `$PdfLink` in your templates which gives you a link to generate the page as a PDF.
Note that a default "Export PDF" link is provided near the "Print" link at the bottom of the default template.

### Overriding the template for PDFs

`BasePage_Controller` has an action called `downloadpdf()` which is called when you need to generate or send an existing
generated PDF to the browser. `$PdfLink` is the template variable which uses this to send the PDF to the user's browser.

By default, the PDF is rendered the standard SilverStripe template system and templates are chosen the same way the
user would see them in their browser. That means if you have a specific page type and template, then that template will
be rendered using the same template when exporting the page to PDF.

You can override the template specifically for the PDF by creating a new template in your theme and suffix it
with `_pdf` in the file name. For example, to override the generic `Page` template and add something that only
shows in the exported PDF, you would create a file called `Page_pdf.ss` in your theme's template/Layout
folder.

To customise the footer of the PDF, you can modify the `Page_pdffooter.ss` template in your theme.

### Customising parameters to wkhtmltopdf

Sometimes you'll need to override the default parameters to `wkhtmltopdf` to customise the PDF export, such as change
the way the table of contents will display.

`BasePage_Controller` contains a method called `generatePDF()` is responsible for exporting the currently viewed page
into an HTML file, then passing it along to the `wkhtmltopdf` binary for conversion into a PDF file.

You can overload `generatePDF()` into your `Page_Controller` class (in `Page.php`) by copying the method across and
changing the code to suit. The newly overloaded method will be used instead of the one provided out of the box in
`BasePage.php`

[More detailed documentation](http://madalgo.au.dk/~jakobt/wkhtmltoxdoc/wkhtmltopdf-0.9.9-doc.html)
is available describing the different parameters you can use with `wkhtmltopdf`.

### Scheduled tasks

Each night, `CleanupGeneratedPdfDailyTask` is run which removes all files found within the generated PDFs folder
`assets/_generated_pdfs`. The code for this can be found in the `cwp` module within the `tasks` directory.

This task can be run from the browser on demand by accessing `dev/tasks/CleanupGeneratedPdfBuildTask`.
One example of where this is useful might be directly after deploying new templates to the site, so the cached
PDF files can be regenerated with the new templates.
