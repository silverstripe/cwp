title: Upgrading
summary: Guidance on upgrading your website for new CWP recipe releases. 

# Upgrading

Assuming that you have followed the approach outlined in the tutorials, upgrading to new patch and sub-patch versions
of the recipe shouldn't take long time. See [recipes and supported modules](recipes_and_supported_modules) documentation to learn more about how recipe
versioning is structured.

**Note:** For specific information regarding upgrading to CWP 2, please
[see the changelog](../releases_and_changelogs/cwp_recipe_basic_2.0.0).

## Point upgrades

To get the newest point (or micro) release of the recipe, just run:

	composer update

This will update the recipe to the new version, and pull in all the new dependencies. A new `composer.lock` file will
be generated. Once you are satisfied the site is running as expected, commit both files:

	git commit composer.* -m "Upgrading the recipe to latest point release"

After you have pushed this commit back to your remote repository you can deploy the change.

## Minor and major upgrades

These will likely take more time as the APIs may change between minor and major releases. For small sites it's possible
for minor upgrade to take a day of work, and major upgrades could take several days.

To upgrade your code, open the root `composer.json` file (the one that was supplied with the installer). Find the
lines that reference `cwp-recipe-basic` and `cwp-recipe-basic-dev` and change the referenced versions.

For example, assuming that you are currently on version `~1.0.1@stable`, if you wish to upgrade to 1.4.1 you will need to
modify your `composer.json` file to explicitly specify the new release branch, here `~1.4.1`:

	...
	"require": {
		"cwp/cwp-recipe-basic": "~1.4.1"
	},
	"require-dev": {
		"cwp/cwp-recipe-basic-dev": "~1.4.1"
	},
	...

You now need to pull in new dependencies and commit the lock file:

	composer update
	git commit composer.* -m "Upgrading to recipe 1.4.1"

Push this commit to your remote repository, and you will be able to deploy to UAT.

## Cherrypicking the upgrades

If you like to only upgrade the recipe modules, you can cherry pick what is upgraded using this syntax:

	composer update cwp/cwp-recipe-basic cwp/cwp-recipe-basic-dev

This will update only the two specified metapackage modules without touching anything else. You still need to commit
resulting `composer.lock`.

## Upgrading from the deprecated recipe-basic approach

Projects using the old-style forks of `recipe-basic` will need to be migrated to the new style of managing dependencies.
The `recipe-basic` module has now been deprecated and should not be used. This migration will need to be done just once
and will greatly improve the way you can keep the project up to date with the most recent security patches.

You will know you need to migrate your project if you see the following configuration in your root `composer.json`:

	"require": {
		"php": ">=5.3.2",
		"cwp/cwp": "*",
		... long list of CWP dependencies follow here ...
		"my-agency/my-dependency": "*"
	},

This long list of dependencies should no longer be pulled in directly. Here is how to fix this for the future.

<div class="alert alert-info" markdown='1'>
If you have customised the original project based on recipe-basic by removing/changing versions of modules you will
notice this migration will force you to pull these back via the new cwp-recipe-basic metapackage. This is intended -
the only code supported by the CWP Team is the mix of modules present in the latest stable release of the
`cwp/cwp-recipe-basic` module.
</div>

First, identify the list of modules which you have added to the project. In the above example this is represented as
`my-agency/my-dependency` - these need to be kept. All the remaining original dependencies must be stripped off
and replaced with a single mention of the `cwp/cwp-recipe-core`. The result should look like follows:

	"require": {
		"cwp/cwp-recipe-core": "~2.0.0@stable",
		"my-agency/my-dependency": "*"
	},

Note that you need to retain references to your private modules in the "repositories" section. Here is an example outcome:

	"repositories": [
		{
			"type": "vcs",
			"url": "https://gitlab.cwp.govt.nz/my-agency/my-module.git",
			"private": "true"
		}
	],

After you have finished cleaning up your `composer.json` file, you need to run:

	composer update

This will make sure you get the latest stable module versions. You also need to make sure all the external modules
have been added to your `.gitignore` file to prevent them from being inadvertently committed. Just add the module names
at the end of the file:

	...
	cwp-recipe-basic-dev/
	cwp-recipe-basic/

Test the site on your dev machine and commit the resulting `composer.lock` file if all works well. Then deploy to UAT.

For your reference, here is a concise example of a correct `composer.json` file on a real project, with default theme
excluded (as the project already provides its own theme):

	{
		"name": "<real-agency>/<real-project>",
		"require": {
			"cwp/cwp-recipe-core": "~2.0.0@stable",
		},
		"config": {
			"process-timeout": 900
		},
		"minimum-stability": "dev"
	}

Links:

* [CWP releases and changelogs](/releases_and_changelogs)
* [old, unsupported composer.json](https://github.com/silverstripe/cwp-recipe-basic/blob/1.0.1/composer.json) from
deprecated `cwp/recipe-basic` module
* [new, recommended composer.json](https://github.com/silverstripe/cwp-installer/blob/master/composer.json) from the new
`cwp/cwp-installer` package (this package is useful for jump-starting your projects)
