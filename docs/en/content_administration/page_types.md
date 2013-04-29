# CWP page types

Your SilverStripe site comes with a wide variety of different page types that you can use:

![The list of page types](_images/page-types.jpg)

This page describes each page type, how to use it, and extra information you need to know to get the most out of
it.

## Page

This is the standard content page, used for all pages that have no other requirements. Note that it comes with extra
features such as being able to add related pages and tags from a taxonomy.

## Error Page

This is a special page that is only shown to users when they have encountered the specific error that the page is set
up to respond do. Your site comes with the two standard errors pages already created for you - one for "Page not found"
(404 error) and one for "Server error" (500 error).

When you create an **ErrorPage** you set the error code in the *Error code* dropdown. You can find a fuller explanation
of HTTP error codes at [Wikipedia](http://en.wikipedia.org/wiki/List_of_HTTP_status_codes).

## Event Holder

This page is used to display all of its child event pages in a useful manner, with pagination and filtering options.
This is the only page that can have **EventPages** as child pages. For more information see the
[News and Events](news_and_events) section.

## Event Page

This page is used to describe an event. It can only be created underneath a **EventHolder** page. For more information
see the [News and Events](news_and_events) section.

## Footer Holder

This page displays all of its child pages as links in the footer. By default they are not shown in the main navigation.
Note that this functionality only exists in the default theme, this may not work in a custom theme.

## Home Page

This is usually the first page that people will see when they visit your site. It contains a carousel in which you can
feature parts of your site, a list of quicklinks, two feature sections and a news summary panel.

### Carousel

The carousel is made up of one or more carousel items. These can be viewed and edited in the *Carousel* tab. Each
carousel item contains the following:

 * *Title*: This is displayed at the top of the caption. If there is no caption, it is not shown.
 * *Caption*: This is shown overlapping the bottom of the image.
 * *Image*: The actual image that appears in the carousel.
 * *Link*: If this is set, clicking on the carousel when it is showing this item will take the user to the specified
page. You can unset the link by clicking on the small 'x' besides the dropdown arrow.

### Quicklinks

Quicklinks are a set of pages that are linked to from the homepage. In the default theme they are shown in the bottom
left of the main content area. To add quicklinks, got to the *Quicklinks* tab when editing the homepage. Click on the
*Add Quicklink* button. You will see the following fields:

 * *Name*: The text that will appear in the list.
 * *Internal Link*: A page within your site that the link will point to.
 * *External Link*: An external URL that the link will point to.

As each quicklink can have only one link, if the external link is set it will be used regardless of whether or not the
internal link is specified.

### Feature sections

The features are two panels in the middle of the bottom of the main content area. You can edit them in the *Features*
tab of the home page. Each has the following fields:

 * *Title*: The title that appears at the top of the feature.
 * *Category*: The icon that appears at the top of the feature. A developer can add more options if desired.
 * *Content*: The actual content that is displayed in the feature panel.
 * *Page to link to*: If this is set, a button is shown at the bottom of of the panel linking to this page.
 * *Button text*: The text to display on the button, if it is shown.

### News summary

In the default theme the home page displays the two latest news items on the homepage.

## IFrame Page

An iframe page type is bundled for easy embedding of external resources. It has the following settings:

* *URL*: this is a resource URL to be included into the page. If you want the height autosetting to work, the supplied
URL needs to be either relative, or at least match the name of your site's domain.
* *Auto height*: the client browser will attempt to set the height of the iframe automatically to match the height of
the target content. This does not mean that the iframe will resize dynamically to respond to content changes.
* *Auto width*: the client browser will fill the available horizontal space. This is not tied in any way to the iframe
content.
* *Fixed height*: explicit size, used also as a fallback if autosetting fails.
* *Fixed width*: explicit size.

In addition, three content areas are supplied:

* Content above the iframe
* Content below the iframe
* Alternate content: used if the client browser does not support iframes, or refuses to handle them.

<div class="notice" markdown='1'>
*Caveats:* When setting the sizes, check under different browsers if everything fits correctly. Also, the autosetting
is one-off only. The scrollbars will appear if the content of the iframed page changes dynamically, for example when
expanding menus or showing other animations. The recommended approach is to disable automatic height.
</div>

## News Holder

This page is used to display all of its child news pages in a useful manner, with pagination and filtering options.
This is the only page that can have **NewsPages** as child pages. For more information see the
[News and Events](news_and_events) section.

## News Page

This page is used to describe a news item. It can only be created underneath a **NewsHolder** page. For more
information see the [News and Events](news_and_events) section.

## Redirector Page

When a user visits this page they are redirected to either a page on your site or an external site. It is often used in
menus when you want one page to be in two relevant places in the menu structure, such as sitting underneath a
*FooterHolder*.

When you create a new page of this type you will see the radio button that lets you choose between *A page on your
website* and *Another website*, and the dropdown to select the page or the text field to type in the external URL.

## Registry Page

This page is used to allow your site users to browse a large set of data in an easy manner. For more information refer
to the [registry module](../../../registry/en) documentation.

## Sitemap Page

In the default theme this page displays a list of all pages on your site. It requires no customisation.

## Subsites Virtual Page

This is just like a *VirtualPage* (see below), but can also display content from a page on another subsite.

## User Defined Form

This page type displays a custom form that websites visitors can fill out and submit. It can email the submissions to
a nominated recipient and stores them all in a database.

You can view more detailed information in the
[forms documentation](http://userhelp.silverstripe.org/for-website-content-editors/forms/).

## Virtual Page

This page type is similar to a *RedirectorPage* and is used to duplicate content from another page. Instead of
linking to the other page like the *RedirectorPage* page, the *VirtualPage* displays the content from the linked page.