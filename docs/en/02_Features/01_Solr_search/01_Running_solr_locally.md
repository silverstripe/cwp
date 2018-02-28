title: Running Solr search locally
summary: Running a development version of Solr search locally to test your search functionality.

# Running Solr search locally

One way to develop with Solr locally is to require [`silverstripe/fulltextsearch-localsolr`](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) package as your dev
dependency in your top-level `composer.json` file. 

When selecting versions, make sure you use the version supported by CWP: `4.*@dev`.

<div class="alert alert-info" markdown='1'>
Older versions of *silverstripe-fulltextsearch* module used to bundle the Solr binary. You should check the version of this module before proceeding with this guide.
</div>

## Differences to CWP

### solrconfig.xml

CWP infrastructure enforces `solrconfig.xml` to ensure stability of the shared service.

While you can customise this file on your local development environment, these customisations will automatically be removed by the CWP Solr server, and the file restored to a version very similar to the default supplied by *fulltextsearch* module.

### Auto-commits

CWP Solr server ignores all commit requests originating from the client, and instead relies on auto-commits to update indexes. This preserves stability for all users of the shared service.

This will manifest as index updates taking a minute or two to appear in the search results, while on local development environment they are immediate.

## Configuring

If you have configured your project as described in the Configuration section of this guide, there is no need for any additional setup.

## Running

To start the local server instance (if you are using the *silverstripe/fulltextsearch-localsolr* package), from your
website root do:

```
cd fulltextsearch-localsolr
./start.sh
```

The screen should start filling with server messages.

Now you can create the configuration files in another terminal. Run the following from your website root:

```
$ vendor/bin/sake dev/tasks/Solr_Configure verbose=1
```

And finally, reindex the pages on your website (this could take some time):

```
vendor/bin/sake dev/tasks/Solr_Reindex verbose=1
```

You should be able to search your site now.

## Debugging locally via the web interface

You can visit `http://localhost:8983/solr`, which will show you a list
to the admin interfaces of all available indices.
There you can search the contents of the index via the native SOLR web interface.

It is possible to manually replicate the data automatically sent 
to Solr when saving/publishing in SilverStripe, 
which is useful when debugging front-end queries.

```
java -Durl=http://localhost:8983/solr/MyIndex/update/ -Dtype=text/xml -jar post.jar silverstripe-solr-test.xml
```

## Considerations

Adding this module can cause automated buildtools (e.g. Travis CI) to try to include this package in their builds, thus considerably extending the build time.
