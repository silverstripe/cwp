title: Maintaining your code
summary: Best practices for keeping your codebase up to date

# Maintaining your code

Let's step through best practices in building your CWP site that will yield the most maintainable codebase.

## Starting off with the recipe

We recommend to start your development by installing via the [cwp-installer](https://github.com/silverstripe/cwp-installer) using Composer.

This already sets up a reasonable structure to your site that will make future maintenance easier.

See [Setting up your project](setting_up_your_project).

## Using the CWP modules

Starting with the installer will also imply you use `cwp/cwp` and `cwp/cwp-core` modules on your site.
This is where the updates to dependencies and essential code required for running your website on CWP infrastructure will be
made available. It will make it much easier to keep your SilverStripe CMS up to date and take advantage of new feature if you use these modules as the basic of your website.

See [Recipes and supported modules](recipes_and_supported_modules) for more details.

## Maintaining modules using Composer

It's recommended that you don't modify third party module code in place, nor commit the code into your site's repository. Simply allow the `composer install` command to deploy the versions of your modules that are listed in the `composer.lock` file instead - this keeps your project code small and relevant.

Modules are meant to be reusable between multiple agencies, so if there is a problem with a supported module included with CWP, submit a pull request to that module's github repository so the fix can be included in future releases. If you are unable to find a fix to make a pull request, you can log an issue instead of a pull request in a similar manner.

This makes it easy to maintain the site by switching module versions at desired moments so this doesn't happen randomly.
Dashboard (our deployment tool) will never modify the module versions listed in `composer.lock`, so it's up to the
site developer to choose right versions via `composer.json`, and to run `composer update` at the right moments. Ensure you test updated modules thoroughly before deploying a new `composer.lock` file.

You can also create private modules in GitLab for even better modularity. See [working with modules](working_with_modules)
for more information on module creation, inclusion and sharing.

## Security patches

From time to time we will include security patches in some CWP recipes. When this occurs, we will release a new patch
version of the latest supported quarterly recipe release (e.g. 1.7.3 for recipe 1.7). Patches for older CWP recipes
will be available on demand via the Service Desk.

You need to keep your codebase's dependencies updated with respect to the patch or sub-patch releases of the recipe to
receive immediate security patches.

This is relatively easy - if your `composer.json` is configured as in the installer, it should be as easy as running
`composer update`, doing a smoke test and pushing to the upstream Git remote. See the [Upgrading](upgrading) guide for instructions.

See [Recipes and supported modules](recipes_and_supported_modules) for more information on versioning and on how to keep your stacks secure.

See [infrastructural considerations](infrastructural_considerations) for hints on how to keep your stacks stable.
