# Setting up your project

[Gitlab Setup](../gitlab/gitlab-setup) described setting up your development environment to work with Gitlab.

Now we'll describe how to setup your project code in that repository.

We use [Composer](http://getcomposer.org) as the package manager for SilverStripe CMS/framework and modules.
[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer) describes
how to install Composer in your development environment.

## Starting with some useful project code

Gitlab contains some public repositories with code to help you get started. Rather than start from scratch, you can have
a basic website up and running in little time.

This assumes you've been given a project that has no code in it. Except for maybe a README file.

First of all, let's change directory into the project repository we setup in [Gitlab Setup](../gitlab/gitlab-setup)

	cd /path/to/my/project-repo

Then we create the remote "recipes-basic":

	git remote add recipes-basic ssh://git@gitlab.cwp.govt.nz:2222/cwp/recipe-basic

We now have a new remote called "recipies-basic". Git has a default remote called "origin" which points to Gitlab so
you push code to that so others can pull it. The remote for "recipes-basic" is the same concept, except it points to
the "recipes-basic" public repository in Gitlab.

Now that the remote is setup, we can pull the "recipes-basic" code:

	git pull recipes-basic master

A bunch of code should now reside in the directory you're in.

 * Edit `composer.json`, find the **name** entry and change it so it's in the format of "my-agency/basic"
 * Edit `composer.json`, remove the "cwp-themes/default" line from the **require** list
 * Edit the `.gitignore` file and remove the "themes/" line

We're removing the theme references so that Composer doesn't try to download the theme as a package, we'll need
it to be added to the project directly, so that theme customisations are possible!

Let's add the theme directly to the project:

	mkdir themes
	git clone ssh://git@gitlab.cwp.govt.nz:2222/cwp-themes/default.git default
	cd ..
	git add themes

Let's push this code to Gitlab:

	git commit -a "Initial project setup"
	git push origin master

Now when you jump into Gitlab **Dashboard**, you'll see a commit from yourself "Initial project setup".

Now, let's pull down the packages defined in the `composer.json` **require** rules.
Again, from the root of your checked out project:

	composer install

This downloads the SilverStripe CMS/framework and all the modules defined in the **require** rules.

Now, if anyone ever needs to setup their development environment, they would `git checkout` your repository and
run `composer install`. This gives them the complete project code.

## Structure of the project

`mysite` should contain your custom project code, such as page types, PHP files etc.

`themes/default` is the theme folder you'll be doing your template work, adding templates, adjusting CSS, etc.

The rest of the folders in a project are Composer managed. See [Working with modules](../gitlab/working-with-modules) for more
information.

## Including or creating a module in your project

See [Working with modules](../gitlab/working-with-modules)
