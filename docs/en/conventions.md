# Documentation conventions

## Voice

Use direct and informal voice. I.e. use "You can set up" instead of "To set up", "X can be set up", or "agency can set
up". Also use "isn't" instead of "is not", "I'm" instead of "I am".

## User docs

### Basics

Page types are highlighted as follows: **News Holder**, and written as they appear in the *Add page* screen.

Any names that appear in the CMS as they are presented are written as: *Page name*. This includes area names, field 
names, buttons and so on.

For example links, use "http://newzealand.govt.nz/".

### CMS areas

For the purpose of documentation, CMS is a collection of "areas", each one mapping to distinct URL.

Large areas of the CMS that can be navigated through the CMS menu on the left are called "sections". For example: 
*Pages* section, *Files* section and so on.

CMS areas that are used like modal dialogs or wizards are called "screens". E.g. *Add page* screen.

Sub-areas within specific sections that are accessible via tabbed navigation are called "subsections". E.g. *Content*
subsection in *Page* section. The tabs under subsections are called, as you'd expect, "tabs". E.g. *Main Content* tab in
*Content* subsection.

Note: the *Pages* section opens up in the *Edit Tree* screen before a page has been selected. It's assumed that
subsections of this section refer to the areas presented when a page has been selected from the tree.

CMS areas that are self-contained and often provide extra capabilities are called "panels". E.g. tree panel in the
*Pages* section, or *Filter* panel in *Files* section.

### Area paths

This is a method of pointing out a CMS area in a very concise way. It is assumed the reader has a general knowledge
about the CMS navigation here.

A "path" is given as *Pages / Main Content / Content / URL Segment*. The default composition of such path is: "section /
subsection / tab / field". 

If the tab is not available, the last element provided could become a field instead, as in *Pages / Settings / Page
type*. The screens could also be included in the paths, as in *Pages / Add new* or *Pages / Edit tree*.

A degree of flexibility in area paths is assumed.

## Dev docs

### Basics

For any code snippets and file paths use fixed-width typeface: `mysite/_config` or `_ss_environment.php`.

Command line examples should also use fixed-width typeface. Prefix the root commands with a `#`:

	# gem install compass

Prefix user-level commands with a `$`:

	$ composer install

References to specific concepts and names within CWP should be highlighted as well: *basic* recipe, *default* theme.

### Todos

Mark the things to do with leading "TODO", so we can find things to fix later easily.
