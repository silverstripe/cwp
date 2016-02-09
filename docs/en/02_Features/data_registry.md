title: Publish searchable data (registry)
summary: Data management interface to open up data sets stored in your website database to users.

# Publish searchable data (data registry)

The CWP basic recipe includes a module that provides a data management interface to open up data 
sets stored in your website database to users. Users can search, drill down into information and 
download a CSV copy of the data for reuse. 

The SilverStripe CMS module used to provide this feature is the [`silverstripe/registry`](http://addons.silverstripe.org/add-ons/silverstripe/registry/) module. 
 
<div class="notice" markdown='1'>This feature is **not** enabled by default in the CWP recipe and must be enabled by a developer first 
before a CMS user can use it ([See the user documentation](https://userhelp.silverstripe.org/en/3.2/optional_features/online_databases_and_registries/)).</div>

## Enabling the data registry

Sets of data that can be displayed are based on the `DataObject` class. To enable any of your `DataObject` 
subclasses to be exposed via a [Registry Page in the CMS](https://userhelp.silverstripe.org/en/3.2/optional_features/online_databases_and_registries/#adding-a-registry-page) you need to implement an abstract PHP class 
and ensure you implement the required abstract method, `getSearchFields()`. This allows your set of 
data to be shown publicly and defines which fields are visible and can be searched on by users.

See the [Registry module technical documentation](https://github.com/silverstripe-labs/silverstripe-registry/blob/master/docs/en/index.md#defining-the-data) for implementation details and code examples.
