# Setting up your project

[Gitlab Setup](../gitlab/gitlab-setup) described setting up your development environment to work with Gitlab, including
initial project checkout.

Now we'll describe how to setup your project code in that repository.

We use [Composer](http://getcomposer.org) as the package manager for SilverStripe CMS/framework and modules.
[Installing and Upgrading with Composer](http://doc.silverstripe.org/framework/en/installation/composer) describes
how to install Composer in your development environment.

## Duplicating the basic recipe

Gitlab contains some public repositories with code to help you get started. Rather than start from scratch, you can have
a basic website up and running in little time.

First of all, let's change directory into the project repository we setup in [Gitlab Setup](../gitlab/gitlab-setup)

	$ cd /path/to/my/project-repo

Then we create the remote "recipes-basic" from which we will obtain the base code.

	$ git remote add recipes-basic ssh://git@gitlab.cwp.govt.nz:2222/cwp/recipe-basic

We now have a new remote called "recipies-basic". Git has a default remote called "origin" which points to Gitlab so
you push code to that so others can pull it. The remote for "recipes-basic" is the same concept, except it points to
the "recipes-basic" public repository in Gitlab. You can list the remotes as follows:

	$ git remote -v

Now that the remote is setup, we can pull in the "recipes-basic" code. This command will merge the recipe-basic into
your current project files (if you followed [Gitlab setup](../gitlab/gitlab-setup.md) that will be just the `README`
file):

	$ git pull recipes-basic master

Accept the merge message as it is. Project files should now appear in your project directory.

Now, let's pull down the latest versions packages defined in the `composer.json` **require** rules.
Again, from the root of your checked out project (this will take some time):

	$ composer update

At this stage you should be able to run the website on the default theme included in this recipe locally by visiting it
in your browser (assuming that your LAMP stack is properly configured). Go straight to the admin to create pages:
`http://localhost/your-project/admin`.

You might need to configure your admin access credentials in the `_ss_environment.php` file to be able to access the
site (see [environment management](http://doc.silverstripe.org/framework/en/topics/environment-management) docs).

## Customising the project

The point of duplicating the basic recipe is to be able to customise it. Here is a list of first likely customisations.

 * Edit `composer.json`, find the **name** entry and change it so it's in the format of "my-agency/basic" - "cwp"
namespace is reserved for platform-endorsed modules and recipes.
 * Edit `composer.json`, remove the "cwp-themes/default" line from the **require** list - we will be creating our own
theme so we don't need to keep it here as an automatic dependency.
 * Customise the theme (explained further below).
 * Do any other housekeeping as necessary, for example remove the extraneous `README` file.

Let's convert the theme from module to project code, so we can customise it. Remove the version control directory:

	$ rm -fr themes/default/.git

Rename the theme:

	$ mv themes/default themes/my-theme

Edit the `mysite/_config.php` to point to the new theme:

	SSViewer::set_theme('my-theme');

Finally, edit the `composer.json` and remove the `cwp-themes/default` from requirements so it is no longer managed by
composer.

Don't forget to `flush` by visiting `http://localhost/your-project/?flush=1` to get the new template running.

Commit all changed files to your repository so other collaborators can see it. This will include `composer.lock` file
that "freezes" the current version of the modules to the ones you have currently included.

	$ git add -A
	$ git commit -m "Initial project setup"
	$ git push origin master

Now when you jump into Gitlab **Dashboard**, you'll see a commit from yourself "Initial project setup".

## Structure of the project

`mysite` should contain your custom project code, such as page types, PHP files etc.

`themes/default` is the theme folder you'll be doing your template work, adding templates, adjusting CSS, etc.

The rest of the folders in a project are Composer managed. See [Working with modules](../gitlab/working-with-modules) for more
information.

## Opening to collaborators

Collaborators (assuming they have been given permission in Gitlab) can clone the project code you have created at any
time. They can install the same version of modules that you have by invoking:

	$ composer install

They will no longer need to reference the basic recipe nor default theme - all that code has been commited to your
private repository and you can customise it to your liking.

Periodically you will need to update modules to the newest versions by invoking `composer update` and commiting
the resulting `composer.lock` file.

## Including or creating a module in your project

See [Working with modules](../gitlab/working-with-modules)
