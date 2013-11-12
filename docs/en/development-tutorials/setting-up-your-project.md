<!--
title: Setting up your project
pagenumber: 3
-->

# Setting up your project

[Gitlab Setup](../development-tutorials/gitlab-setup) described setting up your development environment to work with
Gitlab, including initial project checkout.

Now we'll describe how to setup a new project code in that repository.

We use [Composer](http://getcomposer.org) as the package manager for SilverStripe CMS/framework and modules.
[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer) describes
how to install Composer in your development environment.

## Repository already provided

If you are starting with an empty repository or if you have been following the "Gitlab setup" tutorial, skip to "Empty
repository" section. Also skip to that section, if you want to learn how the repository provided to you was actually
created.


Otherwise you can clone the repo using the address provided to you:

	git clone https://gitlab.cwp.govt.nz/my-agency/my-project.git my-project

Then run composer install on it to get all the required modules pulled in:

	composer install

You can skip straight to "Accessing the site" now.

## Empty repository - copying installer

The preferred way to set up your repository from scratch is to use the
[cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer/) module. This is in fact how we set the repository up for
you if that's what has been requested in the Service Desk.

First, let's create new project using composer.

	composer create-project cwp/cwp-installer cwp-installer --repository-url="https://packages.cwp.govt.nz"
	# Note: Repond Y to the question about ".git" removal - we don't need the installer history, nor the remotes.

You should already be able to access the site! However we still need to push your project into your existing repository.
Commit all files first:

	git init
	git add -A
	git commit -m "Create project from cwp-installer"

Now configure your remote:

	git remote add origin https://gitlab.cwp.govt.nz/you/your-repo.git

Finally forcibly-push the master branch into your repository. We need to do so because in the previous tutorial we have
already made one commit and we no longer need it. This is accomplished by using a plus sign in front of the branch:

	git push origin +master

If your repository was empty i.e. if you skipped directly into this tutorial, simply push into the master branch:

	git push origin master

Your team should now be able to commence the development.

## Accessing the site

At this stage you should be able to run the website on the default theme included in this recipe locally by visiting it
in your browser (assuming that your LAMP stack is properly configured).

<div class="hint" markdown='1'>
You might need to configure your admin access credentials in the `_ss_environment.php` file to be able to access the
site (see [environment management](http://doc.silverstripe.org/framework/en/topics/environment-management) docs).
</div>

## Customising the project

You have now a private repository that you can modify. Here is a list of likely initial customisations:

 * Editing the name of the project in the root `composer.json` - find the **name** entry and change it so it's in the
format of "my-agency/basic" - "cwp" namespace is reserved for platform-endorsed modules and recipes.
 * Customising the `mysite/_config.php` to configure your project.
 * Customise the theme (explained further below).
 * Adding more modules (see [Working with modules](../development-tutorials/working-with-modules)).
 * Do any other housekeeping as necessary, for example remove the extraneous `README` file.

Let's convert the theme from module to project code so we can modify it. Remove the version control directory:

	$ rm -fr themes/default/.git

Rename the theme:

	$ mv themes/default themes/my-theme

Edit the `mysite/_config.php` to point to the new theme:

	SSViewer::set_theme('my-theme');

Finally, remove the "cwp-themes/default" line from the **require** list of `composer.json`. This will prevent composer
from re-adding the *default* theme to your project.

<div class="notice" markdown='1'>
Don't forget to `flush` by visiting `http://localhost/your-project/?flush=1` to get the new template running!
</div>

Commit all changed files to your repository so other collaborators can see it. This will include `composer.lock` file
that "freezes" the current version of the modules to the ones you have currently included.

	$ git add -A
	$ git commit -m "Add custom theme."
	$ git push origin master

Now when you go into Gitlab **Dashboard**, you'll see a commit from yourself "Add custom theme."

## Structure of the project

`mysite` should contain your custom project code, such as page types, PHP files etc.

`themes/my-theme` is the theme folder you'll be doing your template work, adding templates, adjusting CSS, etc.

The rest of the folders in a project are Composer managed. See [working with modules](../development-tutorials/working-with-modules)
for more information.

## Opening to collaborators

Collaborators (assuming they have been given permission in Gitlab) can clone the project code you have created at any
time. They can install the same version of modules that you have by invoking:

	$ composer install

They will no longer need to reference the basic recipe nor default theme - all that code has been commited to your
private repository and you can customise it to your liking.

Periodically you will need to update modules to the newest versions by invoking `composer update` and commiting
the resulting `composer.lock` file.

## Where to next?

* [Including or creating a module in your project](../development-tutorials/working-with-modules)
* [Recipe documentation, with versioning explanation](../recipes)
* [Maintaining your code](../maintaining-your-code)
