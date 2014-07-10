# Last modified date on pages

On all pages of a CWP site, there is some text in the footer of the page. e.g. "Last modified: 1st April 2014".

If you are using the default theme, the `Footer.ss` template will include `LastEdited.ss`. It uses the `$LastEdited`
template variable for this date.

If you're viewing the draft version of a page (e.g. preview of page while editing in the CMS),
the "Last modified" date will be the date the draft was last saved.

If viewing the published page as a website visitor, it'll be the last edited date of the published page.
If you're using workflow on your site and the page was scheduled to be published at a later date, the "Last modified"
date will become the date the page is published on that scheduled date.

