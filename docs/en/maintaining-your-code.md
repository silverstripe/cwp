<!--
title: Maintaining your code
pagenumber: 4
-->

# Maintaining your code

Let's step through best practices in building your CWP site that will yield the most maintanable codebase.

## Starting off with recipe-basic

We recommend to start your development by copying the stable `recipe-basic` (one of the tagged versions). This already
sets up a reasonable structure to your site that will make future maintenance easier.

More details can be found in [recipe documentation](recipes).

## Using cwp module

Starting with recipe-basic will also imply you use `cwp/cwp` module on your site. This is where the updates will be
made available, as well as where the compatibility code and features are placed. It will make it much easier to get
the changes we make during the development of the Platform if you use this module.

More details on the dangers of not including this module can be found in [recipe documentation](recipes).

## Maintaining modules using Composer

It's crucial that you don't modify the module code in place, nor commit this code into your site's repository.
Modules are meant to be reusable between multiple agencies, so if there is a problem with a module, submit a pull
request to the open source community (or file a bug report with the Service Desk if you think it's a problem
with CWP modules).

This makes it easy to maintain the site by switching module versions at desired moments so this doesn't happen randomly.
Deploynaut (our deployment tool) will never modify the module versions listed in `composer.lock`, so it's up to the
site developer to choose right versions via `composer.json`, and to run `composer update` in the right moments.

To find out what are the best versions of modules to use, look up the composer.lock file in the `recipe-basic`. We will
also send notifications to Technical Staff each time we make a new release of this recipe, to let you know that it's a
good moment to update, and what should be updated.

<div class="hint" markdown='1'>
Each `basic-recipe` point release will be tagged with a patchlevel version (e.g. 1.0.0-1) and could contain security
fixes, so it's important to update your site as soon as possible.
</div>

You can also create private modules in GitLab for even better modularity. See [working with
modules](development-tutorials/working-with-modules) for more information on module creation, inclusion and sharing.

## Security patches

As mentioned above, we will send out notifications on security releases to Technical Staff. It is expected that the
site development team will update relevant modules as soon as possible to prevent breaches.

CWP team may in some situations hot-patch (possibly in a destructive way) or pull down your site if it is found to
endanger other sites in the ecosystem. Ultimately, it's a shared responsibility to keep the platform secure, with
some responsibility placed in the hands of the site developers.

If you went down the path of not including `cwp` module, you have to be extra cautious in keeping your code patched
and up to date. This is because you will not get security updates normally distributed through this module.

See [infrastructural considerations](infrastructural-considerations) and [recipes documentation](recipes) for details
regarding recipe versioning, foundational module inclusion and some other hints.
