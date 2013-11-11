<!--
title: Upgrading
pagenumber: 8
-->

# Upgrading

Assuming that you have followed the approach outlined in the tutorials, upgrading to new patch and patch-dash versions
of the recipe shouldn't take long time. See [recipes documentation](../recipes) to learn more about how recipe
versioning is structured.

To upgrade your code, open the root `composer.json` file (the one that was supplied with the installer). Find the
lines that reference `cwp-recipe-basic` and `cwp-recipe-basic-dev` and change the referenced versions. For example if
you wish to upgrade to version 1.0.2, modify it as follows:

	...
	"require": {
		"cwp/cwp-recipe-basic": "1.0.2"
	},
	"require-dev": {
		"cwp/cwp-recipe-basic-dev": "1.0.2"
	},
	...

Then run:

	composer update

This will update the recipe to the new version, and pull in all the new dependencies. A new `composer.lock` file will
be generated. Once you are satisfied the site is running as expected, commit both files:

	git commit composer.* -m "Upgrading to recipe 1.0.2"

After you have pushed this commit back upstream as normal you can deploy the change.
