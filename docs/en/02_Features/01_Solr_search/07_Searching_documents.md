title: Searching documents in Solr
summary: How to configure Solr indexing and searching of documentation such as Word and PDF.

# Searching within documents

<div class="notice" markdown='1'>This feature requires cwp recipe 1.1.0 or above specifically the [textextraction](https://github.com/silverstripe-labs/silverstripe-textextraction) module</div>

By default all CWP environments have text extraction services configured. These services can be used by user code
to transform text-based documents (such as PDF, MS Word, or rich text) into plain text in a format which can
be readily used as a Solr index data source, or for use by the CWP site itself.

We recommend the use of the following available services:

* Apache Tika 1.7 server can be accessed at http://localhost:9998 (which is defined by SS_TIKA_ENDPOINT for all
  environments). This provides the most effective mechanism for indexing multiple documents in quick succession, and
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


<div class="notice" markdown='1'>If using cwp recipe 1.1.1 or above</div>

	:::php
	<?php
	class MySolrSearchIndex extends CwpSearchIndex {
		public function init() {
			$this->addClass('SiteTree');
			$this->addClass('File');
			$this->addAllFulltextFields();
			$this->addFulltextField('FileContent');
			$this->addFilterField('ShowInSearch');
			parent::init();
		}
	}

<div class="notice" markdown='1'>If using cwp recipe 1.1.0 or below [see the documentation archive](/features/solr_search/#searching-within-documents-2)</div>

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

## Performance Implications and Limitations

While the size of documents can vary from stack to stack, there are reasonable performance limits of
document indexing at various stack sizes.

As a general rule, given that the 100kb limitation for each indexed document is in place, the various maximum
number of documents that can be indexed are included in the "max pages in CMS" as per the 
[stack sizes](https://www.cwp.govt.nz/about/selecting-the-right-instance-for-your-website/)
guide. If the number of files and pages exceeds these limitations it is advisable not to include the File type
in any Solr index.

Another important consideration is the potential for downtime during indexing of content to affect your website.
If indexing a large number of documents it is advisable to upgrade to Medium or Large, as heavily trafficked Small
stacks may suffer from performance degradation during background indexing processes. If indexing documents
on Small it's advisable to do so outside of normal business hours to ensure website performance is unaffected.

As a general rule, you should allocate approximately 0.5 seconds per document indexed, regardless of stack size.
This number may increase or decrease depending on the size and type of each file.

If possible this step should be performed outside of normal busy periods.

Running `dev/tasks/Solr_Reindex` will invoke the following steps, depending on your version of cwp recipe:

### If you are on 1.1.1 or above

* A single queuedjob will be added to the queue, and the `Solr_Reindex` task will immediately exit.
If there are existing reindex jobs on the queue, these will be cancelled, and any in-progress tasks will
be forced to exit.
* In the background, a worker process on the environment will invoke this job, which will first clear any obsolete
data from the search index (such as those with obsolete class names), and then create several batches of updates,
grouped by classname, variant (such as stage or subsite), and batch number. Each of these batches is a queuedjob
itself and will appear in the job queue in the cms "jobs" section.
* As each of these batch jobs is run, first obsolete records that exist in that batch will be cleared from the search
index, after which these records will be reindexed. The batching process ensures that any removed records are also
incrementally deleted from the index.
* Once the queue is complete, all indexed files will be committed to the Solr service and search will be available
again.

### If you are on 1.1.0 or below:

* All existing indexed documents will be cleared from search. These documents will not be searchable until
indexing is complete, and thus any functional dependency on this function must be factored into your workflow.
* All documents in the database will be added to a job queue. This task should only take a few minutes, but during
this time a large amount of system memory will be allocated, and will affect the performance of the environment.
* Once all documents are added to the queue, a background task will run and incrementally add each document to the
Solr service backend. During this time fewer resources are reserved, the environment will be able to respond
normally to requests. 
* Once the queue is complete, all indexed files will be committed to the Solr service and search will be available
again.
