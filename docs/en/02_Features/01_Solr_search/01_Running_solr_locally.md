title: Running Solr search locally
summary: Running a development version of Solr search locally to test your search functionality.

# Running Solr search locally

One way to develop with Solr locally is to require [`silverstripe/fulltextsearch-localsolr`](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) package as your dev
dependency in your top-level `composer.json` file. 

When selecting versions, make sure you use the version supported by CWP: `4.*@dev`.

Older versions of *silverstripe-fulltextsearch* module used to bundle the Solr binary. You should check the version of this module before proceeding with this guide.

## Differences to CWP

Please read through the [Limitations and Acceptable Use Policy](00_Configuration.md#limitations-and-acceptable-use-policy)
of running Solr in the CWP infrastructure. 

Most importantly, CWP infrastructure enforces `solrconfig.xml` to ensure stability of the shared service.
While you can customise this file on your local development environment, these customisations will automatically be removed by the CWP Solr server, and the file restored to a version very similar to the default supplied by *fulltextsearch* module.

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
