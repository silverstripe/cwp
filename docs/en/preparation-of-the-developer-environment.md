<!--
title: Preparation of the developer's environment
pagenumber: 1
-->

# Preparation of the developer's environment

First start with [Gitlab](gitlab) documentation which describes setting up Git and accessing Gitlab to manage your code
repositories on the CWP platform.

CWP is installed with the Composer PHP package management tool. To learn about the Composer, visit the
[SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

First of all, check out your project using Git's `git clone` command. If you have forked the *basic* recipe, the project
will come with a `composer.json` file that lists all the required dependencies. You will be able to install them with:

	$ composer install --dev

You will also need an `_ss_environment.php` file in or above the webroot of your development environment. Documentation
on [setting up your environment](http://doc.silverstripe.org/framework/en/topics/environment-management) file can be
found in the SilverStripe documentation.

Once you have that set up, you will be able to browse to your site and it will construct the database and default pages
automatically.

You're ready to start developing now. You won't be able to commit any changes made to the modules unless you fork them
and update the composer.json - this is heavily discouraged as it will make upgrades to new versions of the modules
(including security patches) much more difficult. You should restrict your changes to just the mysite folder and a
custom theme.
