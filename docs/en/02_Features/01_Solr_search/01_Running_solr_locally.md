title: Running Solr search locally
summary: Running a development version of Solr search locally to test your search functionality.

# Running Solr search locally

One way to develop with Solr locally is to require [`silverstripe/fulltextsearch-localsolr`](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) package as your dev
dependency in your top-level `composer.json` file. 

You can choose to require one of the available versions of the Solr: `4.*@dev` or `3.*@dev` that you may be using on CWP. 

Check the [add-ons website](http://addons.silverstripe.org/add-ons/silverstripe/fulltextsearch-localsolr) to see the up-to-date
list of branches.

<div class="notice" markdown='1'>
Older versions of *silverstripe-fulltextsearch* module used to bundle the Solr binary. You should check the version of this module before proceeding with this guide.
</div>

### Configuring

You need to make sure the site configuration reflects your setup. The following options can be used:

* (preferred) 4.x branch of Solr, via local package: use 'local-4'
* (buggy) 3.x branch of Solr, via local package: use 'local-3'
* old *silverstripe-fulltextsearch* module: use 'legacy'

These options can be configured conditionally to trigger only on dev environments. Here is one of the possible
arrangements that will detect the existence of `CWP_ENVIRONMENT` define (which should only be available on the
CWP environments). 

In your `mysite/_config.yml` file:

```
	---
    Only:
      constantdefined: CWP_ENVIRONMENT
    ---
    CwpSolr:
      options:
        version: 'cwp-4'
    ---
    Except:
      constantdefined: CWP_ENVIRONMENT
    ---
    CwpSolr:
      options:
        version: 'local-4'
```

This will ensure that 'local-4' will be used on local environments, except when it detects CWP_ENVIRONMENT 
(in which case it will use the live site configuration).

### Running

To start the local server instance (if you are using the *silverstripe/fulltextsearch-localsolr* package), from your
website root do:

	$ cd fulltextsearch-localsolr
	$ ./start.sh

The screen should start filling with server messages.

Now you can create the configuration files in another terminal. Run the following from your website root:

	$ framework/sake dev/tasks/Solr_Configure "verbose=1"

And finally, reindex the pages on your website (this could take some time):

	$ framework/sake dev/tasks/Solr_Reindex "verbose=1"

You should be able to search your site now.

## Debugging locally via the web interface

You can visit `http://localhost:8983/solr`, which will show you a list
to the admin interfaces of all available indices.
There you can search the contents of the index via the native SOLR web interface.

It is possible to manually replicate the data automatically sent 
to Solr when saving/publishing in SilverStripe, 
which is useful when debugging front-end queries, 
see `thirdparty/fulltextsearch/server/silverstripe-solr-test.xml`.


	java -Durl=http://localhost:8983/solr/MyIndex/update/ -Dtype=text/xml -jar post.jar silverstripe-solr-test.xml

## Considerations

Adding this module can cause automated buildtools (e.g. Travis CI) to try to include this package in their builds, thus considerably extending the build time.
