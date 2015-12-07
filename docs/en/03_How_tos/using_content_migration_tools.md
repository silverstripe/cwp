title: Using content migration tools
summary: How to use the available content mogration tools for SilverStripe CMS.

# Using content migration tools

The Common Web Platform provides migration tools to assist with migrating data and content from other platforms. Currently the tools support:

* HTML-based spidering and scraping of a website.
* Connecting directly to a website running the Drupal content management system.

The migration tools are extendable and can be adapted to connect with other software systems not currently supported. 

The tools migrate the written content of pages, and not functionality (e.g. payment forms) nor the templates which provide the appearance of a website. You can use the default templates provided by the platform, or manually tailor these should you wish.

HTML

* See [https://github.com/sminnee/silverstripe-staticsiteconnector/blob/master/README.md](https://github.com/sminnee/silverstripe-staticsiteconnector/blob/master/README.md)

Drupal

* See [http://www.silverstripe.org/drupal-connector-module/](http://www.silverstripe.org/drupal-connector-module/) and  [https://github.com/silverstripe-droptables/silverstripe-drupal-connector](https://github.com/silverstripe-droptables/silverstripe-drupal-connector)

A screenshot of the HTML importer is shown here:

![screenshot of HTML importer](/_images/html-importer-screenshot.jpg)

You can also commission SilverStripe for assistance in migrating websites, for example to tailor the migration tool to support a legacy system you use, or to re-implement features from your old website on the Common Web Platform.
