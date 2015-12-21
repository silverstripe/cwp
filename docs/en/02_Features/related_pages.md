title: Related pages
summary: Displaying a taxonomy of related pages.

# Related Pages

For each page, editors can define a list of other related pages and by default these are shown in a list at the bottom of every page. 

In the templates this is all handled by including `RelatedPages.ss`. You can customise this by looping over
the page control `RelatedPages`, this will provide you with a Page object from which you can read `Title`, `Link`, and
any other variable or action defined on the page. This is a snippet from how it is implemented in `RelatedPages.ss`:

	:::html
	<ul>
		<% loop RelatedPages %>
			<li><a href="$Link">$Title</a></li>
		<% end_loop %>
	</ul>

The title defaults to "Related Pages". For any page type you can override this by defining a static variable called
`$related_pages_title`. For example:

	:::php
	class StaffMemberPage extends Page {
		public static $related_pages_title = 'Offices';
		...
	}