# Setting up your project

[Gitlab Setup](../gitlab/gitlab-setup) described setting up your development environment to work with Gitlab.

Now we'll describe how to setup your project code in that repository.

We use [Composer](http://getcomposer.org) as the package manager for SilverStripe CMS/framework and modules.
[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer) describes
how to install Composer in your development environment.

## Starting with some useful project code

Gitlab contains some public repositories with code to help you get started. Rather than start from scratch, you can have
a basic website up and running in little time.

This assumes you've set up an empty project in Gitlab earlier.

First of all, let's change directory into the project repository we setup in [Gitlab Setup](../gitlab/gitlab-setup)

	cd /path/to/my/project-repo

Then we create the remote "recipes-basic" from which we will obtain the base code.

	git remote add recipes-basic ssh://git@gitlab.cwp.govt.nz:2222/cwp/recipe-basic

We now have a new remote called "recipies-basic". Git has a default remote called "origin" which points to Gitlab so
you push code to that so others can pull it. The remote for "recipes-basic" is the same concept, except it points to
the "recipes-basic" public repository in Gitlab.

Now that the remote is setup, we can pull the "recipes-basic" code:

	git pull recipes-basic master

A lot of files should now appear in your project directory.

 * Edit `composer.json`, find the **name** entry and change it so it's in the format of "my-agency/basic" - "cwp"
namespace is reserved for platform-endorsed modules and recipes.
 * Edit `composer.json`, remove the "cwp-themes/default" line from the **require** list - we will be creating our own
theme.
 * Edit the `.gitignore` file and remove the "themes/" line - so we can commit our theme to the repository.

We're removing the theme references so that Composer doesn't try to download the theme as a package, we'll need
it to be added to the project directly, so that theme customisations are possible!

Let's clone the theme directly to the project so we have a template to work off.

	mkdir themes
	git clone ssh://git@gitlab.cwp.govt.nz:2222/cwp-themes/default.git my-theme

We don't need the theme to be a stand-alone module, so let's allow the main repository to take over the versioning of
this directory.

	cd default
	rm -fr .git

Finally, commit all changed files.

	git commit -a "Initial project setup"
	git push origin master

Now when you jump into Gitlab **Dashboard**, you'll see a commit from yourself "Initial project setup".

Now, let's pull down the latest versions packages defined in the `composer.json` **require** rules.
Again, from the root of your checked out project:

	composer update

This downloads the SilverStripe CMS/framework and all the modules defined in the **require** rules.

Now, if anyone ever needs to setup their development environment to work on your project, they would `git checkout` your
repository and run `composer install`. This gives them the complete project code.

## Structure of the project

`mysite` should contain your custom project code, such as page types, PHP files etc.

`themes/default` is the theme folder you'll be doing your template work, adding templates, adjusting CSS, etc.

The rest of the folders in a project are Composer managed. See [Working with modules](../gitlab/working-with-modules) for more
information.

## Including or creating a module in your project

See [Working with modules](../gitlab/working-with-modules)
