tdb: update this to reference Composer instead of Phing

# Contributor Howto

This document is intended for developers who wish to contribute code back to the source of SilverStripe Express.

## Cloning the repository for development

Prerequisites: `phing`, `Pear::VersionControl_Git` (see below)

We work on `ssexpress` branch on all modules and the root repo, so we can switch the versions all across the board easily.

### With write access to silverstripe-droptables

* Clone the repository: `git clone git@github.com:silverstripe-droptables/silverstripe-installer.git`
* Make sure you are on correct branch: `git checkout ssexpress`
* Load all modules in writeable mode: `phing update_modules` (they default to ssexpress branch as well)

### Without write access to silverstripe-droptables

* Fork the root repo and all module repos (check dependent-modules.default for full list)
* Clone your fork, checkout ssexpress branch
* Amend the dependent-modules to point to your own forks, commit the change
* Load all modules in writeable mode: `phing update_modules` (make sure they are pointing to ssexpress branches)

From here you can submit pull requests from your forks as normal.

## Updating your codebase

* Execute `phing update_modules`
* Run `git pull --rebase` on the root of the project to update the main project

## New release

We release the package as a tar.gz archive, while tagging all the related modules.

* Tag the release: `phing tag -Dtagname ssexpress-0.1.0 -DincludeBaseDir yes`, say yes to push the tags to origin
* Create the archive: `phing archive -Dversion ssexpress-0.1.0 -Darchivedest releases -Darchivename ssexpress-0.1.0 -Darchivetype tar.gz`

## Re-releasing

To get a tar.gz file for an old release, do:

* Checkout the release tag: `phing checkout -Dtagname ssexpress-0.1.0 -DincludeBaseDir yes`
* Create the archive `phing archive -Dversion ssexpress-0.1.0 -Darchivedest releases -Darchivename ssexpress-0.1.0 -Darchivetype tar.gz`
* Checkout the latest version again: `phing checkout -Dtagname ssexpress -DincludeBaseDir yes`

## Adding modules

Modules within SS Express source are handled via phing. To add modules:

* (if the ssexpress branch does not exist) Clone the module manually, and switch to `ssexpress` branch.
* Add the module to `dependent-modules` - remember to check them out to ssexpress branch
* Run `phing update_modules`
* Copy `dependent-modules` into `dependent-modules.default`
* Commit the result, which should include modifications to aforementioned files and `.gitignore`

## Working with the code

The webmaster's perspective needs to be taken into consideration. When you add new features, ask yourself if it will be easy for a webmaster to deploy it, remove it or modify it? The easier it is, the simpler the future maintenance of the site will be.

For this reason it is preferred to keep all the SilverStripe Express-related code in the `express` directory, only making modifications to `mysite` when necessary.

## Prerequisites

`Phing`:

* `sudo pear channel-discover pear.phing.info`
* `sudo pear install --alldeps phing/phing`

`VersionControl Git`:

* `sudo pear install VersionControl_Git-0.4.4`
