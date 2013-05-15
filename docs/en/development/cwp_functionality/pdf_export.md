# HTML to PDF export

CWP provides some tools out of the box for generating downloadable PDF versions of pages.

[wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) is being used to generate the PDF, it is a command line utility
using WebKit to render the HTML into PDF format.

## How it works

A special `$PdfLink` variable is provided to the templates, which if applied as the value of an `href` value to an
anchor in the template, will provide users with a way to download the a PDF version of the current page.

When the user requests a PDF of the page, the page is exported as HTML by SilverStripe and then passed along to
`wkhtmltopdf` which generates a PDF of the HTML. The PDF is then stored in `assets/_generated_pdfs` and subsequent
requests for that PDF are served directly from the assets.

Whenever a CMS user publishes or unpublishes a page, the cached PDF file stored for that page in
`assets/_generated_pdfs` is deleted. This means that the user is either forced to download a newly generated PDF, or in
the case of a page being removed from the site via unpublishing, the cached PDF file is no longer available to download.

The PDF is treated as a print view of the page, so any CSS that applies to the "print" media is applied, just like what
a user would see when print previewing a page in their browser. This can be removed so the PDF shows as a normal page
by removing the `--print-media-type` parameter to `wkhtmltopdf`.

## Limitations

Draft content cannot be exported to PDF, due to the fact that generated PDF files are publicly accessible by anyone
viewing the website, there are no permission checks when accessing files directly in the browser.

## Installation

<div class="notice" markdown='1'>
The CWP test and production servers you'll be deploying your site to already have `wkhtmltopdf` installed.
These instructions are only necessary if you want to develop or use the PDF export functionality in your local
development environment. Skip to "Enabling PDF export ..." below if you simply want to enable the PDF export
functionality.

The instructions below assume you're on a Debian or Ubuntu Linux environment.
There is a Mac OS X download, and there may be a Windows binary for `wkhtmltopdf` but they have not been tested.
</div>

* [Download wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/downloads/list) for your system type:

	wget http://wkhtmltopdf.googlecode.com/files/wkhtmltopdf-0.9.9-static-amd64.tar.bz2

* Install it into `/usr/local/bin` so that it can be accessed on the path:

	tar -jxvf wkhtmltopdf-0.9.9-static-amd64.tar.bz2
	mv wkhtmltopdf-amd64 /usr/local/bin/wkhtmltopdf

* Test it works:

	wkhtmltopdf -V

* Update your `_ss_environment.php` file to point your site to the binary:

	define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf');

* Install extra Microsoft fonts, such as Arial:

	apt-get install ttf-mscorefonts-installer ttf-liberation

If you're on Debian "squeeze" you might need to add `contrib` to the `squeeze` sources in `/etc/apt/sources.list` if
the above command cannot find `ttf-mscorefonts-installer`.

Note the [licensing information](http://www.microsoft.com/typography/RedistributionFAQ.mspx) provided by Microsoft.
This means those fonts such as Arial can be embedded in the PDF document, provided they are for "Print and preview"
only.

## Enabling PDF export functionality

Export to PDF functionality is disabled by default. You need to add a line of code to enable it.

In your `mysite/_config/config.yml` file, add the following:

	:::yml
	BasePage:
	  pdf_export: 1

Note the yml files do not accept tabs, only spaces.

Now you can use `$PdfLink` in your templates which gives you a link to generate the page as a PDF.
Note that a default "Export PDF" link is provided near the "Print" link at the bottom of the default template.

## Overriding the template for PDFs

`BasePage_Controller` has an action called `downloadpdf()` which is called when you need to generate or send an existing
generated PDF to the browser. `$PdfLink` is the template variable which uses this to send the PDF to the user's browser.

By default, the PDF is rendered by the standard SilverStripe template system and templates are chosen in the same way
the user would see them in their browser. That means if you have a specific page type and template, then that template
will be rendered using the same template when exporting the page to PDF.

You can override the template specifically for the PDF by creating a new template in your theme and suffix it
with `_pdf` in the file name. For example, to override the generic `Page` template and add something that only
shows in the exported PDF, you would create a file called `Page_pdf.ss` in your theme's template/Layout
folder.

To customise the footer of the PDF, you can modify the `Page_pdffooter.ss` template in your theme.

## Customising parameters to wkhtmltopdf

Sometimes you'll need to override the default parameters to `wkhtmltopdf` to customise the PDF export, such as change
the way the table of contents will display.

`BasePage_Controller` contains a method called `generatePDF()` is responsible for exporting the currently viewed page
into an HTML file, then passing it along to the `wkhtmltopdf` binary for conversion into a PDF file.

You can overload `generatePDF()` into your `Page_Controller` class (in `Page.php`) by copying the method across and
changing the code to suit. The newly overloaded method will be used instead of the one provided out of the box in
`BasePage.php`

[More detailed documentation](http://madalgo.au.dk/~jakobt/wkhtmltoxdoc/wkhtmltopdf-0.9.9-doc.html)
is available describing the different parameters you can use with `wkhtmltopdf`.

## Scheduled tasks

Each night, `CleanupGeneratedPdfDailyTask` is run which removes all files found within the generated PDFs folder
`assets/_generated_pdfs`. The code for this can be found in the `cwp` module within the `tasks` directory.

This task can be run from the browser on demand by accessing `dev/tasks/CleanupGeneratedPdfBuildTask`.
One example of where this is useful might be directly after deploying new templates to the site, so the cached
PDF files can be regenerated with the new templates.
