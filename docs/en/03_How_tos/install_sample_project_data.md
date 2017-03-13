title: Install sample project data
summary: How to install sample project data

# Introduction

When first starting with a CWP project you may find it useful to install some sample data. The `cwp/cwp` module come with a task you can run which will install some pre-defined sample data such as page content and a "contact us" [userform](https://github.com/silverstripe/silverstripe-userforms).

## Running the task

You can run the task either from your browser, or from the command line.

From a browser:

```
http://yoursite.dev/dev/tasks/PopulateThemeSampleDataTask
```

From the command line:
```
php framework/cli-script.php dev/tasks/PopulateThemeSampleDataTask
```

Take a look at the task's source code to see what it creates.

## The "framework-test" module

An option for testing a number of features (including form fields, sample member data, etc) of the SilverStripe CMS in your theme and/or with the modules you've installed is to use the [silverstripe/frameworktest](https://github.com/silverstripe/silverstripe-frameworktest) module. This can be installed with Composer:

```
composer require silverstripe/frameworktest
```

Please see the module's documentation (linked above) for information on how to configure and use it.
