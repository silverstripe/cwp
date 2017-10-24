title: Recipes and supported modules
summary: Information about the default CWP codebase referred to as the CWP Recipe.

# CWP recipe

CWP supplies developers with a default set of packages for setting up their SilverStripe CMS projects. 
The [cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer) package is create from the original
[silverstripe-installer](https://github.com/silverstripe/silverstripe-installer). It can be used as a base for
jump-starting development of a CWP project. This is a recommended way of creating a CWP project.

The installer comes with a `composer.json` file which defines a single dependency:
[cwp-recipe-basic](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic), a metapackage which sole purpose is to pull in
a set of commercially supported SilverStripe CMS modules and supported dependencies that make up the feature set of a default CWP ready website. 

This 'metapackage' will be from now on referred to as a "recipe", and is a crucial element of keeping your CWP deployment running. 

Even if you did not start from the installer, you can make your project "stable" by
including the following in your `composer.json`:

	"require": {
		"cwp/cwp-recipe-basic": "~1.0.1@stable",
		...

So if the above dependency can be found in your root `composer.json` file it can be said that you are running on a
stable CWP recipe version. If you request CWP Team to help this will be one of the first things that will be checked
- if you are not running on a stable CWP recipe, we may not be able to easily help you.

You may add more modules to your project by modifying your base `composer.json`. However these modules will
interact with the recipe so you need to test for regressions as only the base combination of packages is tested in CWP
release process.

## Can I remove the basic recipe?

We strongly recommend using the basic recipe dependency for your projects. 

The reasons include:

* reused code makes maintenance simple - it's easier to apply security updates
* Service Desk might not be able to help you if you are on a heavily customised code
* custom code is usually less stable than the one that's frequently used
* advertised CWP features may not work
* your site may break when the infrastructure changes are rolled out - these changes will only be tested against
the official releases.

If after careful consideration your development team decides to depart from the recipe model, it is recommended to pull
in at least the [cwp](https://gitlab.cwp.govt.nz/cwp/cwp). If even this doesn't work for you, the last resort is
including the [cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core) This at least will ensure the minimal compatibility
with the platform infrastructure and will allow us to deliver some subset of fixes and features.

Your development team will need to follow the releases of the recipe on their own and make sure the modules are either
updated, or the issues acknowledged as not posing security or technical risk.

## Recipe releases

We use [semantic versioning](http://semver.org) for SilverStripe Framework. In CWP recipes we use major, minor and point
releases. From time to time the fourth level - micro (1.2.3.4) - might be used if more granularity is needed.

Stable recipe releases will be triggered by the releases of the SilverStripe Framework - for example recipe 1.0.1 maps
to framework 3.1.1 and recipe 1.0.2 will map to framework 3.1.2. Recipes may also be released outside of this cycle in
case some important fixes need to be applied to the modules (such as security releases) - these will be numbered with
micro versions (1.0.1.1, 1.0.1.2 and so forth).

If we announce a new point/micro recipe release (e.g. if you are on 1.0.1, these will be 1.0.1.1, 1.0.1.2, 1.0.2,
1.0.2.1 and so forth) you will need to upgrade, test and deploy your updated project code within a relatively short
timeframe which will be specified on the release notification. While such point/micro releases will be
backwards-compatible and should not break any existing APIs we still recommend at least running a few smoketests on your
UAT environment or dev machine before deploying.

As a rule of thumb you need to remain on the latest point/minor release version of the recipe to receive all security
fixes.

Major and minor recipe releases (if you are on 1.0.1 these will be 1.1.0, 1.2.0, 2.0.0 and so on) could take more time
to apply. One old minor and one old major branch will still receive security patches, so you have more time to do these.
We estimate that on a small site you may need to spend a day upgrading to a new minor version, and a few days or more
upgrading to a new major version.

CWP Team may in some situations hot-patch (possibly in a destructive way) your site or pull an environment down if it is
found to endanger other sites on the CWP infrastructure. The timeframe in which this could happen will be specified on the release
notification.

See [upgrading guide](upgrading) for instructions.

## Recipe contents

To obtain the composition of the latest stable recipe, the easiest way is to head to the
[repository](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/) and look at the composer file and the dependencies
contained there. 

For example here is the composition of version [1.0.1](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/blob/1.0.1/composer.json).

To find the location of specific repository, first check in the internal [CWP packages](https://packages.cwp.govt.nz/)
service, then check on Internet's [Packagist](http://packagist.org/).

## Dev recipe

The installer's `composer.json` also provides a single "dev" metapackgage dependency for CWP:

	"require-dev": {
		"cwp/cwp-recipe-basic-dev": "~1.0.1@stable"
		...

[cwp-recipe-basic-dev](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic-dev/) pulls in dev dependencies specific for
development based on the CWP codebase. These packages will NOT be installed on the environments (neither prod, UAT nor
test). You can also elect not to install it by specifying `--no-dev` with your `composer install` or `composer update`
command on your local dev machine.
