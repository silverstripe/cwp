# Solr search

## Configuring Solr locally

Page search in CWP is done using an external Solr server, with the help of the *fulltextsearch* module. The default
configuration allows developers to set up their machines quickly - it uses the "file" mode for communicating with the
Solr server.

To start the local server instance, from your website root do:

	$ cd fulltextsearch/thirdparty/solr/server
	$ java -jar start.jar

The screen should start filling with server messages.

Now you can create the configuration files in another terminal. Run the following from your website root:

	$ framework/sake dev/tasks/Solr_configure

And finally, reindex the pages on your website (this could take some time):

	$ framework/sake dev/tasks/Solr_reindex

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
			$this->addClass('BasePage');
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

### WebDAV mode

If you wish to run the Solr through WebDAV (as we do on the live instances), you have to obtain the configuration
parameters and then use the following configuration constants in your `_ss_environment.php`:

	:::php
	define('SOLR_SERVER', '<url>');
	define('SOLR_PORT', '<port>');
	define('SOLR_PATH', '<path>');
	define('SOLR_MODE', 'webdav');
	define('SOLR_INDEXSTORE_PATH', '<webdav_indexstore_path>');
	define('SOLR_REMOTEPATH', '<webdav_indexstore_remote_path>');

For further information about these options see the top of the `Solr.php` file in *fulltextsearch* module.