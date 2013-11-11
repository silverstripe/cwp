<!--
title: Recipes
pagenumber: 3
-->

# CWP recipe packages

CWP supplies developers with packages for setting up their projects. The [cwp-installer]() package is create from the
original [silverstripe-installer](). It can be used as a base for jump-starting development of a CWP project. This is a
recommended way of creating a CWP project.

The installer comes with a `composer.json` file which defines a single dependency: [cwp-recipe-basic](), a metapackage
which sole purpose is to pull in other dependencies. This metapackage will be from now on referred to as a "recipe", and
is a crucial element of keeping your CWP deployment running. Even if you did not start from the installer, you can
make your project "stable" by including the following in your `composer.json`:

	"require": {
		"cwp/cwp-recipe-basic": "1.0.1",
		...

So if the above dependency can be found in your root `composer.json` file and the version number is pointing to the
latest stable recipe release it can be said that you are running on astable CWP recipe version. If your instance will
experience problems, this will be one of the first things we will check - if you are not running on stable we may not be
able to (easily) help you.

You may add more modules to your project by modifying your base `composer.json`. However these modules will
interact with the recipe so you need to test for regressions as only the base combination of packages is tested in CWP
release process.

# Special cases

There are several situations where it may not be easy to use the recipe. The development team must carefully
consider the best approach as the further the codebase is from the stable recipe, the more issues will have to be
resolved:

* applying security updates may become much harder: instead of simply updating the current recipe version you may have
to manage module versioning by hand
* CWP Team may not be able to help you promptly if your code is heavily customised
* your specific module mix may not be as extensively tested as the recipe
* some platform compatibility code will be missing, meaning some features could break
* your site may break when the infrastructure changes are rolled out - these changes will likely only be tested against
the current stable release.

In case your development team decides to depart from the recipe model, it is recommended to pull in at least the
[cwp](). If even this doesn't work for you, the last resort is including the [cwp-core]() This at least will ensure the
minimal compatibility with the platform infrastructure and will allow us to deliver some subset of fixes and features.

Your development team will need to follow the releases of the recipe and make sure the modules are either updated, or
the issues acknowledged as not posing security or technical risk.

## Recipe releases

We use [semantic versioning](http://semver.org) for SilverStripe Framework and other modules. In CWP metapackages such
as the recipe we may also use the Debian-style patch-dash (e.g. 1.0.1-7) version numbers to produce in-between recipe
releases.

Stable recipe releases will be triggered by the releases of the SilverStripe Framework - for example recipe 1.0.1 maps
to framework 3.1.1 and recipe 1.0.2 will map to framework 3.1.2. However recipes may also be released outside of this
cycle in case some important fixes need to be applied to the modules - these will be numbered as 1.0.1-1, 1.0.1-2 and so
forth.

If we announce a new patch recipe release indicated by patch, or patch-dash version number change (if you are on 1.0.1,
these will be 1.0.1-1, 1.0.1-2, 1.0.2, 1.0.2-1 and so forth) you will need to upgrade, test and deploy your updated
project code as soon as possible. The reason is these will often contain security patches. While such patch releases
will be backwards-compatible and should not break any existing APIs we still recommend at least running a few smoketests
on your UAT environment or dev machine before deploying.

As a rule of thumb you need to remain on the latest patch release version of the recipe to receive all security fixes.

Major and minor recipe releases (if you are on 1.0.1 these will be 1.1.0, 1.2.0, 2.0.0 and so on) could take more time
to apply. One old minor and one old major branch will still receive security patches, so you have more time to do these.
We estimate that on a small site you may need to spend a day upgrading to a new minor version, and a few days upgrading
to a new major version.

CWP team may in some situations hot-patch (possibly in a destructive way) your site or pull an instance down if it is
found to endanger other sites on the CWP. Ultimately, it's a shared responsibility between the CWP Team and the
development teams for sepcific sites to keep the platform secure.

## Recipe contents

To obtain the composition of the latest stable recipe, the esiest way is to head to the
[repository](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/) and look at the composer file and the dependencies
contained there. For example here is the composition of version
[1.0.1](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/blob/1.0.1/composer.json).

To find the location of specific repository, first check in the internal [CWP packages](https://packages.cwp.govt.nz/)
service, then check on Internet's [Packagist](http://packagist.org/).

## Dev recipe

The installer's `composer.json` also provides a single "dev" metapackgage dependency for CWP:

	"require-dev": {
		"cwp/cwp-recipe-basic-dev": "1.0.1-rc1"
		...

[cwp-recipe-basic-dev](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic-dev/) pulls in dev dependencies specific for
development based on the CWP codebase. These packages will NOT be installed on the environments (neither prod, UAT nor
test). You can also elect not to install it by specifying `--no-dev` with your `composer install` or `composer update`
command on your local dev machine.
