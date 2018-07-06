title: Running Solr search locally
summary: Running a development version of Solr search locally to test your search functionality.

# Running Solr search locally

One way to develop with Solr locally is to require [`silverstripe/fulltextsearch-localsolr`](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) package as your dev
dependency in your top-level `composer.json` file. 

When selecting versions, make sure you use the version supported by CWP: `4.*@dev`.

<div class="alert alert-info" markdown='1'>
Older versions of *silverstripe-fulltextsearch* module used to bundle the Solr binary. You should check the version of this module before proceeding with this guide.
</div>

Alternatively you can use the quickstart installer that ships with the latest version of the fulltextsearch module. The 
quickstart script will install a Solr service on your local machine and set up your `_config.php` to allow you to get
started with minimal intervention.

You can execute the quick start script by running `vendor/bin/fulltextsearch_quickstart` in your project root.

## Differences on CWP

Please read through the [Limitations and Acceptable Use Policy](configuration#limitations)
of running Solr in the CWP infrastructure. 

Most importantly, CWP infrastructure does not permit customisations to `solrconfig.xml`, this is to ensure stability of the shared service.
While you can customise this file on your local development environment, these customisations will be ignored by the CWP Solr server, and the file restored to a version very similar to the default supplied by *fulltextsearch* module.

## Configuring

If you have configured your project as described in the Configuration section of this guide, there is no need for any additional setup.

## Running

### With localsolr

To start the local server instance from your run the following commands

```
cd fulltextsearch-localsolr
./start.sh
```

The screen should start filling with server messages. You will need to open another terminal to run any other commands.

### With quickstart script

The quickstart script will install a full Solr service that will be running (and starts on system boot as well). You 
won't need to do anything else after running the quickstart script.

## Setting up the Solr index

Now you can create the configuration files. Run the following from your website root:

```
$ vendor/bin/sake dev/tasks/Solr_Configure verbose=1
```

And finally, reindex the pages on your website (this could take some time):

```
vendor/bin/sake dev/tasks/Solr_Reindex verbose=1
```

You should be able to search your site now.

## Debugging locally via the web interface

You can visit `http://localhost:8983/solr`, which will show you a list of the admin interfaces of all available indices.
There you can search the contents of the index via the native SOLR web interface.
