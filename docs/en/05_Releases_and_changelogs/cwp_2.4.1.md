# 2.4.1

## Overview

This release includes CMS and Framework version X.X.X.

- [Framework X.X.X](#)

Upgrading to Recipe 2.4.1 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## New features

The [release announcement](#) includes the note worthy features, but be sure to review the change log for full detail.


## Known issues


### Expected test failures

The following PHPUnit test failures are expected and do not represent functional issues in CWP:


## Security considerations

This release includes  security fixes. Please see the release announcements for more detailed descriptions of each[ but note that the following issues have modified CVSS Environmental scores which take built-in protections from the CWP platform into account]. We highly encourage upgrading your CWP projects to include these security patches nonetheless.


## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
...
```


...

<!--- Changes below this line will be automatically regenerated -->



## Change Log

### Security

 * 2020-03-31 [3bbad20](https://github.com/silverstripe/silverstripe-userforms/commit/3bbad2044279ade5e5a5d0ae1822bafe479f8a26) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)

### Other changes

 * 2020-04-14 [7772488](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/77724882dcad85a4f7737816b7993b83d7c0f6cb) Update PHP to 7.1 (Serge Latyntcev)
 * 2020-04-09 [c1a6925](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/c1a6925a99d7f125b8cf4fc7312c7a8b3aabb226) Pin the PHP version and mcrypt extension requirements (Serge Latyntcev)
 * 2020-02-16 [ba5ae2d](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/ba5ae2d0024ce3ae203a25981780f30b609b2080) Add explicit ext-mcrypt requirement (Serge Latyntcev)


<!--- Changes above this line will be automatically regenerated -->
