# Setting up your project

[Gitlab Setup](../gitlab/gitlab-setup) described setting up your development environment to work with Gitlab.

Now that we've got a project and a code repository ready to go, let's setup some useful code to start with.

SilverStripe uses [Composer](http://getcomposer.org) as a package manager for the SilverStripe software and its
modules.

[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer) in the
SilverStripe documentation describes how to install Composer.

## Getting basic code into your project

In CWP we have a concept of a project recipe. It's much like how you'd think a recipe is, where you have ingredients
that are combined to form a complete project. In this case, the ingredients are packages defined in `composer.json`
that Composer uses when you run `composer update`. This will be explained in more detail as we walk through the process.

This assumes you've been given a project that has no code. Except for maybe a README file.

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

Custom code should be added and committed to the `mysite` directory, such as page types, PHP files etc.

`themes/default` is the theme folder you'll be doing your template work, adding templates, adjusting CSS, etc.

## Including or creating a module in your project

See [Working with modules](../gitlab/working-with-modules)
