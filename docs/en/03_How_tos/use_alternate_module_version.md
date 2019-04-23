title: Use an alternative module version
summary: How to use an alternate module version

# How to use an alternate module version

There may be a scenario where you want to update to a new version of a commercially supported module outside of the regular CWP quarterly release cadence. Examples may include upgrading to a new module version to take advantage of a security patch that is not yet available in CWP, or you have contributed to the upstream repository and would like access to a specific bug fix or new feature.

To do this we can use a composer's *inline alias*. This is a way of specifying that our desired version is satisfying
some other requirement (in this case coming from the recipe).

For example, assuming you want to take advantage of a security patch in a new version of the SilverStripe framework module and your site is currently running a CWP recipe version of `~2.2.0@stable`, your `composer.json` should look like this:

```
...
"require": {
    "cwp/cwp-installer": "2.2.0@stable"
},
...
```

*If you're not using the `cwp/cwp-installer` recipe your `composer.json` may instead reference the `cwp/cwp-core` recipe_*

To update to a new version of SilverStripe core, say version `4.3.1`, you should add an alias to the `require` section of the `composer.json` file, like:

```
"silverstripe/framework": "4.3.1 as 4.3.0"
```

This will satisfy the `"silverstripe/framework": "4.3.0"` requirement embedded in the [cwp-installer](https://github.com/silverstripe/cwp-installer/tree/2.2) or [cwp-core](https://github.com/silverstripe/cwp-core/tree/2.2) recipe that you have installed. You can found out what version you currently have installed by running the following command:

```
composer show
```

Please note that generally you should only do this if you are sure about the impact of switching the module version, and after you have tested it yourself for regressions with other modules

Upgrading to a new version of a commercially supported module before it has been released through a CWP quarterly release means that it won't yet have gone through the standard external code review.

Remove this statement as soon as the patch is included in an official release. We suggest to paste the link to the revision containing the required change into your commit message so it's easy to find out if the customisation can be
removed yet or not.

Reference: [Composer inline aliases](http://getcomposer.org/doc/articles/aliases.md#require-inline-alias)
