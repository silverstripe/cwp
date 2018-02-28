title: Using module forks
summary: How to use an alternate module version (fork)

# How to use an alternate module version (fork)

There are situations when you'd like to override the module version provided by the recipe's `composer.json`. One good
example is if you contribute to the upstream repository, and you would like to use the fixed version straight away.

To do this we can use a composer's *inline alias*. This is a way of specifying that our desired version is satisfying
some other requirement (in this case coming from the recipe).

For example, if we wanted to use the `dev-master` version of the `silverstripe-advancedworkflow` module, we would add the
following statement into the `require` section of our project `composer.json`:

```
"symbiote/silverstripe-advancedworkflow": "dev-master as 4.0.1"
```

This will satisfy the `"silverstripe/advancedworkflow": "4.0.1"` requirement embedded in the [SilverStripe collaboration recipe](https://github.com/silverstripe/recipe-collaboration).

Please note that generally you should only do this if you are sure about the impact of switching the module version, and
after you have tested it yourself for regressions with other modules.

Remove this statement as soon as the patch is included in an official release. We suggest to paste the link to the
revision containing the required change into your commit message so it's easy to find out if the customisation can be
removed yet or not.

Reference: [Composer inline aliases](http://getcomposer.org/doc/articles/aliases.md#require-inline-alias)
