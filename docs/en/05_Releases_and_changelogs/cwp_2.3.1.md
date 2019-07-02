# 2.3.1

## Overview

This release includes CMS and Framework version X.X.X.

- [Framework X.X.X](#)

Upgrading to Recipe 2.3.1 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SiliverStripe CMS. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

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

### Features and Enhancements

 * 2019-05-31 [7194e95](https://github.com/silverstripe/cwp/commit/7194e9501ddf2c32913537d44e989f3ccda1c110) CWP pages now use font icons instead of images (Robbie Averill)

### Bugfixes

 * 2019-06-30 [99b4f7c](https://github.com/silverstripe/silverstripe-hybridsessions/commit/99b4f7c16886803c0af5e0b5862d85ad6dac95f7) DatabaseStore binary safety (Serge Latyntcev)

### Other changes

 * 2019-06-14 [40ad8d1](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/40ad8d1dacb3b2444313b6119cbf1923c2845cc6) DOCS Twig improvements to change log template (Bryn Whyman)
 * 2019-06-14 [829fabe](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/829fabedc74b5a8de18471f31bc4f0444fd75f9d) DOCS new headings for change log template (Bryn Whyman)
 * 2019-06-13 [fe202c6](https://github.com/silverstripe/cwp/commit/fe202c65d973b9fcd092156cd7a10bbf53c02f6c) DOCS update 2.3 changelog to reference 4.4.1 (Bryn Whyman)
 * 2019-05-09 [3fcebd6](https://github.com/silverstripe/silverstripe-hybridsessions/commit/3fcebd6399d18397a59a137856d63cef9170cda7) Update translations (Robbie Averill)
<!--- Changes above this line will be automatically regenerated -->
