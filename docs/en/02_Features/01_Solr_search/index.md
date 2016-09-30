title: Solr search
summary: Setting up and customising search functionality.

# Solr search

## Overview

CWP provides a hosted Solr service to index and search the content of your site. To ensure stability of your instance
this service lives outside of your environments. The recipe pulls in the [*silverstripe/fulltextsearch*](https://github.com/silverstripe-labs/silverstripe-fulltextsearch) module and
provides configuration to make sure it works out of the box.

## Acceptable Use Policy

To ensure adequate sharing of resources on Solr the maximum size of each indexed item is limited to 100kb of data.

If you are indexing file content, files with text content exceeding
this limit will not be fully indexed. Content within this range will still be searchable.

## Working with Solr

[CHILDREN]