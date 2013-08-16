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

When working with CWP code, you will be utilising git version control system, and the repositories will be stored on
Gitlab. First, let's apply two configuration changes that are essential for smooth experience.

# Increase the default post size

A common issue with using our specific installation of Gitlab is the limit to the git post size on the client side
(developer's machine). It will result in a 411 errors showing up when trying to push a significant amount of work to
upstream.

The default post size for git is 1 MB. To increase the value run the below command to increase the limit to 500MB:

	git config http.postBuffer 524288000

# Caching Gitlab passwords

You can avoid having to type the password in every time by using a git credential helper.

The easiest way is to use the in-built cacher:

	git config --global credential.helper cache

You can adjust the timeout period from the default 15 minutes:

	git config credential.helper 'cache --timeout=3600'

See [this stackoverflow
thread](http://stackoverflow.com/questions/5343068/is-there-a-way-to-skip-password-typing-when-using-https-github) for
more information.

This will save you some typing, but not all of it. Another way to approach this is to store the password in a keychain
on your machine using the software built by a company called GitHub (not related to Gitlab). This will allow you to
securely store your password permanently. The software is available directly from
[GitHub](https://help.github.com/articles/set-up-git).

# Where to from here?

A good next step is the common workflow described in the [development tutorials](development-tutorials). It shows how to
set up Git and how to access Gitlab to manage your code repositories on the CWP platform, and will also run your through
some common development scenarios:

* copying an existing recipe
* creating a custom theme based on the default
* building a new module and including it in your project.

<div class="notice" markdown='1'>
CWP Recommendation: two most common issues with interacting with Gitlab is the limit to the size of the data that can be
pushed, and necessity to re-type the password when pushing. First requires a small reconfiguration to your git client, second can
be resolved by using password caches. Both are explained in
</div>

Proceed to the [development tutorials](development-tutorials) now.
