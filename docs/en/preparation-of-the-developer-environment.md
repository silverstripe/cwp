<!--
title: Preparation of the developer's environment
pagenumber: 1
-->

# Preparation of the developer's environment

Successful development of a Platform website relies on the ability to use the provided services and tools and build upon
them to provide the custom functionality where needed. A description of the high-level [technical
architecture](https://www.cwp.govt.nz/features/technical-information-about-the-platform/) is available on this website.

CWP projects are installed using the Composer PHP package management tool. For general information about Composer, visit
the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

<div class="notice" markdown='1'>
CWP Recommendation: to ensure your code works smoothly with the platform, start from the basic recipe.
</div>

To start developing a new CWP site we strongly recommend starting from the [basic
recipe](https://gitlab.cwp.govt.nz/cwp/recipe-basic).  Basic recipe contains the `composer.json` file that pulls in
supported dependencies. You can then change the module list to your liking and assuming that you keep the `cwp` module
and the changes you've made are respecting the available SilverStripe API's, the code should run smoothly when deployed
to the UAT.

<div class="notice" markdown='1'>
CWP Recommendation: to ensure security of the platform make sure your code can be upgraded - maintain your modules using
composer.
</div>

We recommend maintaining all your modules using Composer. This will allow you to easily share the code with other
agencies and enable easier upgrades. If you decide to remove the `composer.json` file and instead commit the modules
into the project code, we may not be able to support you because we will have to assume the modules have been
customised.

A good next step is the common workflow described in the [development tutorials](development-tutorials). It shows how to
set up Git and how to access Gitlab to manage your code repositories on the CWP platform, and will also run your through
some common development scenarios:

* copying an existing recipe
* creating a custom theme based on the default
* building a new module and including it in your project.

Proceed to the [development tutorials](development-tutorials) now.

