# Working with modules

Public (or private) modules are available as separate repositories (projects) within the GitLabs. They can be included
then in any other projects through Composer. For more information about Composer usage with SilverStripe see
[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer).

We assume here that you have your website project already started, based off the basic recipe.

<div class="hint" markdown='1'>
Note: both your main project (the website) and each of the modules have their own repositories. The main project is
special in the sense that it has its own code *and* also pulls in other modules and places them in its root.
</div>

## Creating a new module

Create a new directory named after your intended module in your main project. It should sit alongside the other modules
such as *framework* and *cms* and use it for the module development. This will allow you to work with the module
straight away, without the need to commit to the repository at all.

	$ mkdir foobar
	$ ls -la | grep foobar
	drwxr-xr-x    2 muzdowski  staff       68 20 Feb 09:12 foobar

General documentation on module creation is available here - [Module
Development](http://doc.silverstripe.org/framework/en/topics/module-development). Don't forget to create the
`_config.php` file, even if it only contains the PHP header (`<?php[newline]`). Follow the conventions established by
other modules like the `cms` so it's easier for other developers to work with your code!

You need to set your module up to be importable via composer. For this, create a `composer.json` file in the root of
your module. Here is an example for module that builds on the functionality provided `cwp` main module (hence the
requirement):

	{
		"name": "my-agency/foobar",
		"description": "Short module description",
		"type": "silverstripe-module",
		"require": {
			"composer/installers": "*",
			"silverstripe/cms": ">=3.0",
			"silverstripe/framework": ">=3.0",
			"cwp/cwp": "dev-master",
		}
	}

<div class="notice" markdown='1'>
The first part of the "name" in the `composer.json` file constitutes a namespace - please use the same namespace that
you are using in Gitlabs, to distinguish between the officially supported CWP modules (that reside in the "cwp"
namespace) and private modules.
</div>

After your module is running and tested, you can publish it. Since your module is a self-contained piece of software, it
will constitute a project in itself. From your module directory follow the instructions at [Creating
repositories](../gitlab/creating-repositories). Once the module is pushed upstream (`git push -u origin master`) it
will be available for others to install.

Check out instructions at [Sharing repositories](../gitlab/sharing-repositories) on how to control module access
settings.

## Including a module in your project

To include a new **publicly** available module in your project, such as *silverstripe-blog*, follow the instructions in the
chapter [Adding modules to your
project](http://doc.silverstripe.org/framework/en/installation/composer#adding-modules-to-your-project).

To inlude a CWP-hosted module, you will need to follow the instructions at [Working with
project forks and unreleased
modules](http://doc.silverstripe.org/framework/en/installation/composer#working-with-project-forks-and-unreleased-modules).

So for our *foobar* example module we have just pushed upstream - assuming that you have access to it - add the
following lines to your `composer.json` file in the root directory of your main project.

	"repositories": [
		{
			"type": "vcs",
			"url": "git@gitlab.cwp.govt.nz:my-agency/foobar.git"
		}
	]

This will add the repository to the list of URLs composer checks when updating the project dependencies. Hence you can
now include the following requirement in the same `composer.json`:

	"require": {
		...
		"my-agency/foobar": "*"
	},

Add the module directory name to `.gitignore` - we will rely on the *composer* to update the dependencies so we don't
need to version-control it through the master repository.

Run `composer update` to pull the module in and update all other dependencies as well.

Finally, commit the resulting `composer.lock` file to the repository as well. This serves as a snapshot marker for the
dependencies - other developers will be able to `composer install` exactly the version of the modules you have used in
your project, as well as the correct version will be used for the deployment. Some additional information is available
in the [Deploying projects with
composer](http://doc.silverstripe.org/framework/en/installation/composer#deploying-projects-with-composer).
