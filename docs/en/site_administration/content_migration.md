# Content Migration

If you have an existing site running then you probably want to keep your existing content. The SilverStripe CMS comes
with modules that can be used to import content from several popular CMSs (Drupal, Wordpress, etc) as well as one that
can import content from a static site.

This task is generally undertaken by developers or an external development agency as it can get quite technical.

Usually some access to the site is required to prepare it to serve content to the SilverStripe importer. For some
projects it can be pulled straight from the live site with no extra work required, for others extra modules will need
to be installed. In this case, it can be easier and more secure to provide your developers with a DVD of the website
code, assets and database which can be set up on a development environment.

After the import has been completed, all the basic page content will be in your SilverStripe site. This will include
any styling information such as header levels, bold or italic text, tables, etc. Images will be imported into
SilverStripe's Files and Images section and linked to, as long as the <img> tag is embedded into the HTML content.

What the import process does not include is the site look-and-feel. So after the import your new site will contain most
of your existing content, but it will not have the same templates, home page, navigation structure, or other visual
content that your old site contained. This is a separate process that must be undertaken by a development agency.

Following is a list of all supported CMSs and anything that you need to know about importing content from a site
running on that system.

## Drupal

Content can be imported from a site running Drupal 5, 6 or 7. There are two methods of importing the site structure, by
taxonomy or by menu:

If you are importing based on taxonomy then you enter the name of the taxonomy to import. The hierarchy of terms will
be imported as a page tree, with any nodes tagged with that term imported as child pages under it.

If you import by menu, the structure of a specified menu is lifted directly in as a page tree. If a node is attached to
a menu item then its content is used as the page's content. If a node is a child of a menu item, then it is imported as
a child of the corresponding page. Importing by menu is not supported in Drupal 5.

Every page is imported as a standard page type. It is possible to import special page types (news, event, blog post,
etc) with extra development time, but by default any extra content that they contain is lost - just the title and main
content is brought across.

Regardless of the method that you use, some work is required to prepare the Drupal site for importing. See the user
docs [here](https://github.com/silverstripe-droptables/silverstripe-drupal-connector/blob/master/README.md).

## WordPress

Both pages and posts can be imported from a WordPress site. It can also migrate comments and linked media from posts.

## Alfresco / CMIS

Pages and files can be imported from Alfreso.

User documentation is available
[here](https://github.com/nyeholt/silverstripe-cmis-connector/blob/master/doc/getting-started.wiki.txt)

## Other

A site running on any other CMS (or even not running on a CMS!) can be imported. This method works by working out the
site structure from the menus and URLs, and reading content from a user-defined place on every page.

User documentation is available
[here](https://github.com/sminnee/silverstripe-staticsiteconnector/blob/master/README.md)