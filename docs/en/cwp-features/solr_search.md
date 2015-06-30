# Solr search

CWP provides a hosted Solr service to index and search the content of your site. To ensure stability of your instance
this service lives outside of your environments. The recipe pulls in the *silverstripe/fulltextsearch* module and
provides configuration to make sure it works out of the box.

The recipe comes bundled with a `CwpSolr` class which allows convenient configuration of Solr by specifying the desired
version string via the configuration system. To customise the desired version of Solr you can for example modify the
`mysite/_config/config.yml` file (don't forget to flush the cache):

	CwpSolr:
	  options:
	    version: 'your-chosen-version'

Note that if you started from a recent *cwp-installer* you might already have this configuration present in which case
it's enough to just change it.

## Acceptable Use Policy

Please note that in order to ensure adequate sharing of resources on Solr the maximum size of each indexed item
is limited to 100kb of data. If you are indexing file content, please note that files with text content exceeding
this limit will not be fully indexed, although content within this range will still be searchable.

## Configuring Solr for CWP

1.0.x branch of the recipe defaults to the 'legacy' mode which exists only for backwards compatibility. We recommend to
change it at the first opportunity to one of the proxied versions:

* (preferred) 4.x branch of Solr: use 'cwp-4'
* (buggy) 3.x branch: use 'cwp-3'

If you are setting up your project using cwp-installer (1.0.2 or later) it will override the 'legacy' setting for you
and pick the 4.x proxied version instead ('cwp-4') - see `mysite/_config/config.yml`.

## Configuring and running Solr locally

One way to develop with Solr locally is to require `silverstripe/fulltextsearch-localsolr` package as your dev
dependency in your top-level `composer.json` file. Note that this could cause Travis or any other automated buildtools
to try to include this package in their builds, thus considerably extending the build time.

You can choose to require one of the available versions of the package: `4.*@dev` or `3.*@dev`. Check the
[add-ons website](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) to see the up-to-date
list of branches.

Another possibility is that you are still using the old *silverstripe-fulltextsearch* package which bundles the Solr
binary.

### Configuring

You need to make sure the site configuration reflects your setup. The following options can be used:

* (preferred) 4.x branch of Solr, via local package: use 'local-4'
* (buggy) 3.x branch of Solr, via local package: use 'local-3'
* old *silverstripe-fulltextsearch* module: use 'legacy'

These options can be configured conditionally to trigger only on dev environments. Here is one of the possible
arrangements that will detect the existence of `CWP_ENVIRONMENT` define (which should only be available on the
CWP environments):

	---
	Except:
	constantdefined: CWP_ENVIRONMENT
	---
	CwpSolr:
	  options:
	    version: 'local-4'

This will ensure that 'local-4' will be used on local environments.

### Running

To start the local server instance (if you are using the *silverstripe/fulltextsearch-localsolr* package), from your
website root do:

	$ cd fulltextsearch-localsolr
	$ ./start.sh

The screen should start filling with server messages.

Now you can create the configuration files in another terminal. Run the following from your website root:

	$ framework/sake dev/tasks/Solr_Configure

And finally, reindex the pages on your website (this could take some time):

	$ framework/sake dev/tasks/Solr_Reindex

You should be able to search your site now.

## Adding DataObject classes to Solr search

If you create a class that extends `DataObject` (and not `Page`) then it won't be automatically added to the search
index. You'll have to make some changes to add it in.

So, let's take an example of `StaffMember`:

	:::php
	<?php
	class StaffMember extends DataObject {
		private static $db = array(
			'Name' => 'Varchar(255)',
			'Abstract' => 'Text',
			'PhoneNumber' => 'Varchar(50)'
		);
		
		public function Link($action = 'show') {
			return Controller::join_links('my-controller', $action, $this->ID);
		}
		
		public function getShowInSearch() {
			return 1;
		}
	}

This `DataObject` class has the minimum code necessary to allow it to be viewed in the site search.

`Link()` will return a URL for where a user goes to view the data in more detail in the search results.
`Name` will be used as the result title, and `Abstract` the summary of the staff member which will show under the
search result title.
`getShowInSearch` is required to get the record to show in search, since all results are filtered by `ShowInSearch`.

So with that, let's create a new class called `MySolrSearchIndex`:

	:::php
	<?php
	class MySolrSearchIndex extends SolrIndex {
		
		public function init() {
			$this->addClass('SiteTree');
			$this->addClass('StaffMember');
			
			$this->addAllFulltextFields();
			$this->addFilterField('ShowInSearch');
		}
		
	}

This is a copy/paste of the existing configuration but with the addition of `StaffMember`.

Once you've created the above classes and run `flush=1`, access `dev/tasks/Solr_configure` and `dev/tasks/Solr_reindex`
to tell Solr about the new index you've just created. This will add `StaffMember` and the text fields it has to the
index.

Now in your `mysite/_config.php` file, add the following:

	:::php
	Page_Controller::$search_index_class = 'MySolrSearchIndex';
	Page_Controller::$classes_to_search[] = array(
		'class' => 'StaffMember'
	);

Now when you search on the site, `StaffMember` results will show alongside normal `Page` results.

## Boosting results

In cases where certain documents should appear higher in search results for specific terms, boosting can be used to
promote certain keywords on a per document basis.

In order to add this functionality to pages you can use the `CwpSearchBoostExtension` in your config. The default
`search_boost` option can also be customised from the default 2.


	SiteTree:
	  search_boost: 1.5
	  extensions:
		- CwpSearchBoostExtension


Ensure that you are using either the default SolrSearchIndex, or are otherwise providing a boost value to that field.


	:::php
	public function init() {
		$this->addClass('SiteTree');
		$this->addAllFulltextFields();
		$this->addFilterField('ShowInSearch');
		$this->setFieldBoosting('SiteTree_SearchBoost', SiteTree::config()->search_boost);
	}


Within the CMS, you can now provide a list of boost terms for each page.

![boost cms](_images/boost_fields.png)

## Searching within documents

By default all CWP instances have text extraction services configured. These services can be used by user code
to transform text-based documents (such as PDF, MS Word, or rich text) into plain text in a format which can
be readily used as a Solr index data source, or for use by the CWP site itself.

We recommend the use of the following available services:

* Apache Tika 1.7 server can be accessed at http://localhost:9998 (which is defined by SS_TIKA_ENDPOINT for all
  instances). This provides the most effective mechanism for indexing multiple documents in quick succession, and
  supports a wide range of file formats.
* pdf2text is also available for PDF document extraction if Apache Tika does not provide the required output
  for these files.

The CWP supported [text extraction module](https://github.com/silverstripe-labs/silverstripe-textextraction) is
available to provide an interface to these services. In order to add this to a site include the following configuration:

In composer.json


	"require": {
		"silverstripe/textextraction": "~2.0.0@stable"
	}


In mysite/_config.php


	:::php
	Page_Controller::$search_index_class = 'MySolrSearchIndex';
	Page_Controller::$classes_to_search[] = array(
		'class' => 'File',
		'includeSubclasses' => true
	);


In MySolrSearchIndex.php


	:::php
	<?php
	class MySolrSearchIndex extends SolrIndex {
		
		public function init() {
			$this->addClass('SiteTree');
			$this->addClass('File');
			
			$this->addAllFulltextFields();
			$this->addFulltextField('FileContent');
			$this->addFilterField('ShowInSearch');
		}
		
	}

Ensure that your site's Solr index is configured by running `dev/tasks/Solr_configure` and `dev/tasks/Solr_reindex`
as above. Once indexing has completed, searching using the default search functionality should show all files
with content matching the specified search term.

### Performance Implications and Limitations

While the size of documents can vary from instance to instance, there are reasonable performance limits of
document indexing at various instance sizes.

As a general rule, given that the 100kb limitation for each indexed document is in place, the various maximum
number of documents that can be indexed are included in the "max pages in CMS" as per the 
[instance sizes](https://www.cwp.govt.nz/about/selecting-the-attributes-of-the-common-web-platform-instance-for-your-websites/)
guide. If the number of files and pages exceeds these limitations it is advisable not to include the File type
in any Solr index.

Another important consideration is the potential for downtime during indexing of content to affect your website.
If indexing a large number of documents it is advisable to upgrade to Medium or Large, as heavily trafficked Small
instances may suffer from performance degradation during background indexing processes. If indexing documents
on Small it's advisable to do so outside of normal business hours to ensure website performance is unaffected.

Running `dev/tasks/Solr_Reindex` will invoke the following steps:

* All existing indexed documents will be cleared from search. These documents will not be searchable until
indexing is complete, and thus any functional dependency on this function must be factored into your workflow.
* All documents in the database will be added to a job queue. This task should only take a few minutes, but during
this time a large amount of system memory will be allocated, and will affect the performance of the instance.
* Once all documents are added to the queue, a background task will run and incrementally add each document to the
Solr service backend. During this time fewer resources are reserved, the instance will be able to respond
normally to requests. 
* Once the queue is complete, all indexed files will be committed to the Solr service and search will be available
again.

As a general rule, you should allocate approximately 0.5 seconds per document indexed, regardless of instance size.
This number may increase or decrease depending on the size and type of each file.

If possible this step should be performed outside of normal busy periods.
