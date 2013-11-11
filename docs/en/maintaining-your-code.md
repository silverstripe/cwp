<!--
title: Maintaining your code
pagenumber: 4
-->

# Maintaining your code

Let's step through best practices in building your CWP site that will yield the most maintanable codebase.

## Starting off with the recipe

We recommend to start your development by copying the stable
[cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer/). This already sets up a reasonable structure to your site
that will make future maintenance easier.

More details can be found in [recipe documentation](recipes).

## Using cwp module

Starting with the installer will also imply you use `cwp/cwp` module on your site. This is where the updates will be
made available, as well as where the compatibility code and features are placed. It will make it much easier to get
the changes we make during the development of the Platform if you use this module.

More details on the risks of not including this module can be found in [recipe documentation](recipes).

## Maintaining modules using Composer

It's crucial that you don't modify the module code in place, nor commit this code into your site's repository.
Modules are meant to be reusable between multiple agencies, so if there is a problem with a module, submit a pull
request to the open source community (or file a bug report with the Service Desk if you think it's a problem
with CWP modules).

This makes it easy to maintain the site by switching module versions at desired moments so this doesn't happen randomly.
Deploynaut (our deployment tool) will never modify the module versions listed in `composer.lock`, so it's up to the
site developer to choose right versions via `composer.json`, and to run `composer update` in the right moments.

You can also create private modules in GitLab for even better modularity. See [working with
modules](development-tutorials/working-with-modules) for more information on module creation, inclusion and sharing.

## Security patches

You need to keep your codebase's dependencies updated with respect to the patch or sub-patch releases of the recipe to
receive immediate security patches.

This is relatively easy - if your `composer.json` is configured as in the installer, it should be as easy as running
`composer update`, doing a smoketest and pushing to the upstream. See [recipe upgrade
tutorial](development-tutorials/upgrading) for instructions.

See [recipes documentation](recipes) for more information on versioning and on how to keep your instace secure.

See [infrastructural considerations](infrastructural-considerations) for hints on how to keep your instance stable.
