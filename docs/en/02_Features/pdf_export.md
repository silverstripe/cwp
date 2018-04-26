title: PDF export of website pages
summary: Generating downloadable PDF versions of website pages.
introduction: CWP provides some tools for generating downloadable PDF versions of website pages.

# HTML to PDF export

[wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) is being used to generate the PDF, it is a command line utility
using WebKit to render the HTML into PDF format.

You will also need to ensure you have the [cwp/cwp-pdfexport](https://github.com/silverstripe/cwp-pdfexport) module
installed for this functionality to be enabled.

## How it works

A special `$PdfLink` variable is provided to the templates, which if applied as the value of an `href` value to an
anchor in the template, will provide users with a way to download the a PDF version of the current page.

This variable is commented out by default in the CWP Starter and Wātea themes. You can re-enable it by uncommenting these lines in `PageUtilities.ss`.

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

Draft content can't be exported to PDF, due to the fact that generated PDF files are publicly accessible by anyone
viewing the website, there are no permission checks when accessing files directly in the browser.

## Installation

The CWP test and production servers you'll be deploying your site to already have `wkhtmltopdf` installed.
These instructions are only necessary if you want to develop or use the PDF export functionality in your local
development environment. Skip to [Enabling PDF export ...](#enabling-pdf-export-functionality) below if you simply want to enable the PDF export
functionality.

The instructions below assume you're on a Debian or Ubuntu Linux environment.
There is a Mac OS X download, and there may be a Windows binary for `wkhtmltopdf` but they have not been tested.

* [Download wkhtmltopdf](https://wkhtmltopdf.org/downloads.html) for your system type:

  ```
  wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.1.1/wkhtmltox-0.12.1.1.tar.bz2
  ```

* Install it into `/usr/local/bin` so that it can be accessed on the path:

  ```
  tar -jxvf wkhtmltox-0.12.1.1.tar.bz2
  mv wkhtmltopdf-amd64 /usr/local/bin/wkhtmltopdf
  ```

* Test it works:

  ```
  wkhtmltopdf -V
  ```

* Update your `.env` file to point your site to the binary:

  ```
  WKHTMLTOPDF_BINARY="/usr/local/bin/wkhtmltopdf"
  ```

* Install extra Microsoft fonts, such as Arial:

  ```
  apt-get install ttf-mscorefonts-installer ttf-liberation
  ```

If you're on Debian "squeeze" you might need to add `contrib` to the `squeeze` sources in `/etc/apt/sources.list` if
the above command can't find `ttf-mscorefonts-installer`.

Note the [licensing information](https://docs.microsoft.com/en-us/typography/fonts/font-faq) provided by Microsoft.
This means those fonts such as Arial can be embedded in the PDF document, provided they are for "Print and preview"
only.

## Enabling PDF export functionality

Export to PDF functionality is disabled by default. You need to add a line of code to enable it.

In your `mysite/_config/config.yml` file, add the following:

```yaml
CWP\CWP\PageTypes\BasePage:
  pdf_export: 1
```

Note the yml files don't accept tabs, only spaces. You'll also have to call `flush=1` to have the new YML configuration
take effect.

Now you can use `$PdfLink` in your templates which gives you a link to generate the page as a PDF.
Note that a default "Export PDF" link is provided near the "Print" link at the bottom of the default template.

From recipe 1.4.1 onwards, if you would like to generate the PDF using a specific domain, you can set this in `mysite/_config/config.yml`. Please see the following example for how to do this, you can not add a protocol or any trailing slashes, for example, http://google.com/ will not work but google.com will.

```yaml
CWP\CWP\PageTypes\BasePage:
  pdf_export: 1
  pdf_base_url: 'example.com'
```

## Overriding the template for PDFs

`BasePageController` has an action called `downloadpdf()` applied via the `PdfExportControllerExtension` class, 
which is called when you need to generate or send an existing generated PDF to the browser. `$PdfLink` is the
template variable which uses this to send the PDF to the user's browser.

By default, the PDF is rendered by the standard SilverStripe template system and templates are chosen in the same way
the user would see them in their browser. That means if you have a specific page type and template, then that template
will be rendered using the same template when exporting the page to PDF.

You can override the template specifically for the PDF by creating a new template in your theme and suffix it
with `_pdf` in the file name. For example, to override the generic `Page` template and add something that only
shows in the exported PDF, you would create a file called `Page_pdf.ss` in your theme's template/Layout
folder.

To customise the footer of the PDF, you can modify the `Page_pdffooter.ss` template in your theme.

## Defining the version of wkhtmltopdf to use

We currently provide two versions of wkhtmltopdf for CWP customers to use.

The version that is used by default is version 0.9.6, and is an older, stable version that doesn't support as many
features, but has been tested to work well with the default CWP templates.

Some CWP customers have requested an updated version, and so we have also installed version 0.12.1.1. In order to use
this updated version, you must define the binary to use.

Since CWP Recipe release 1.0.4, the only configuration that is needed is an addition to your YAML configuration:

```yaml
CWP\CWP\PageTypes\BasePage:
  wkhtmltopdf_binary: '/usr/local/bin/wkhtmltopdf_12'
```

## Customising parameters to wkhtmltopdf

Sometimes you'll need to override the default parameters to `wkhtmltopdf` to customise the PDF export, such as change
the way the table of contents will display.

`BasePageController` has a method applied to it by `PdfExportControllerExtension` called `generatePDF()`, which is 
responsible for exporting the currently viewed page into an HTML file, then passing it along to the `wkhtmltopdf`
binary for conversion into a PDF file.

You can overload `generatePDF()` into your `PageController` class (in `PageController.php`) by copying the method across
and changing the code to suit. The newly overloaded method will be used instead of the one provided out of the box in
`BasePage.php`

[More detailed documentation](http://madalgo.au.dk/~jakobt/wkhtmltoxdoc/wkhtmltopdf-0.9.9-doc.html)
is available describing the different parameters you can use with `wkhtmltopdf`.

## Clean up tasks

If you require the generated PDFs to be cleaned up on a regular basis, you can use the `CleanupGeneratedPdfDailyTask`
scheduled task (requires the [crontask module](https://github.com/silverstripe/silverstripe-crontask)), which will
run by default at midnight every night.

The task is disabled by default, so you will need to enable it with YAML configuration. You can also change the
schedule that the task will run on (default is every night at midnight):

```yaml
# Example: run the task at 4am every Sunday morning
CWP\PDFExport\Tasks\CleanupGeneratedPdfDailyTask:
  enabled: true
  schedule: '0 4 * * 7'
```

This task can be run from the browser on demand by accessing `dev/tasks/CleanupGeneratedPdfBuildTask`.
One example of where this is useful might be directly after deploying new templates to the site, so the cached
PDF files can be regenerated with the new templates.
