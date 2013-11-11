<!--
title: Upgrading
pagenumber: 8
-->

# Upgrading

Assuming that you have followed the approach outlined in the tutorials, upgrading to new patch and sub-patch versions
of the recipe shouldn't take long time. See [recipes documentation](../../recipes) to learn more about how recipe
versioning is structured.

## Patch and sub-patch upgrades

To get the newest patch or sub-patch release of the recipe, just run:

	composer update

This will update the recipe to the new version, and pull in all the new dependencies. A new `composer.lock` file will
be generated. Once you are satisfied the site is running as expected, commit both files:

	git commit composer.* -m "Upgrading the recipe to latest patchlevel."

After you have pushed this commit back to your remote repository you can deploy the change.

## Minor and major upgrades

These will likely take more time as the APIs may change between minor and major releases. For small sites it's possible
for minor upgrade to take a day of work, and major upgrades could take several days.

To upgrade your code, open the root `composer.json` file (the one that was supplied with the installer). Find the
lines that reference `cwp-recipe-basic` and `cwp-recipe-basic-dev` and change the referenced versions. For example if
you wish to upgrade to version 1.1.0, modify it as follows:

	...
	"require": {
		"cwp/cwp-recipe-basic": "~1.1.0@stable"
	},
	"require-dev": {
		"cwp/cwp-recipe-basic-dev": "~1.1.0@stable"
	},
	...

You now need to pull in new dependencies and commit the lock file:

	composer update
	git commit composer.* -m "Upgrading to recipe 1.1.0"

Push this commit to your remote repository, and you will be able to deploy to UAT.

# Cherrypicking the upgrades

If you like to only upgrade the recipe modules, you can cherry pick what is upgraded using this syntax:

	composer update cwp/cwp-recipe-basic cwp/cwp-recipe-basic-dev

This will update only the two specified metapackage modules without touching anything else. You still need to commit
resulting `composer.lock`.
