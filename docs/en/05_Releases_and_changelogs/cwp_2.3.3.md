# 2.3.3

## Overview

This release includes CMS and Framework version 4.4.6.

- [Framework 4.4.6](#https://docs.silverstripe.org/en/4/changelogs/4.4.6/)

Upgrading to Recipe 2.3.3 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


## Security considerations

This release includes  security fixes. Please see the release announcements for more detailed descriptions of each[ but note that the following issues have modified CVSS Environmental scores which take built-in protections from the CWP platform into account]. We highly encourage upgrading your CWP projects to include these security patches nonetheless.


<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2020-03-31 [3bbad20](https://github.com/silverstripe/silverstripe-userforms/commit/3bbad2044279ade5e5a5d0ae1822bafe479f8a26) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)

### Bugfixes

 * 2019-05-27 [d7c76ec](https://github.com/silverstripe/silverstripe-userforms/commit/d7c76ecf80ef4791403b028b07ab65dba21be79c) Preview email link now handles cases where it's loaded in the browser, requested via AJAX and used in a trait or a page context (#887) (Guy Marriott)
 * 2019-05-20 [f4cd7a3](https://github.com/silverstripe/silverstripe-userforms/commit/f4cd7a3836dc1ec2c462dc0778d1b155ad21faa6) Allowed text length fields now align correctly with each other (#886) (Guy Marriott)
 * 2019-05-17 [483fbc8](https://github.com/silverstripe/silverstripe-userforms/commit/483fbc8499a5735a79cbe42a47419b90b682c129) Preview email link now handles cases where it's loaded in the browser, requested via AJAX and used in a trait or a page context (Robbie Averill)
 * 2019-05-17 [d0e937a](https://github.com/silverstripe/silverstripe-userforms/commit/d0e937a5883e5bf4aecea8442d746264717df76a) Allowed text length fields now align correctly with each other (Robbie Averill)
 * 2019-05-16 [181e0de](https://github.com/silverstripe/silverstripe-userforms/commit/181e0de171f92b01401b1e36319e322e64900941) Multi page userforms now display their step titles, which were previously broken (Robbie Averill)

### Other changes

 * 2020-04-09 [f28bb61](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/f28bb610129787c145151b44eb2d9c0bf153c917) Pin the PHP version and mcrypt extension requirements (Serge Latyntcev)
 * 2020-01-22 [10acb2b](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/10acb2b5409ddf6e3dbbedf285efd117592a8626) Include queuedjob tests (Steve Boyd)
 * 2020-01-21 [83f1c3e](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/83f1c3e45fd09a549974dfe02e3e10ff9eab1bfe) Exclude some queuedjobs tests from running (Steve Boyd)
 * 2020-01-16 [1c1fc75](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/1c1fc75e6535d33ba9620096c02edfb305208455) Increase travis memory to 3G (Steve Boyd)
 * 2019-07-29 [1d899f5](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/1d899f5e49d578571cabfe001e5271b17984a3cd) DOCS Correct typo in changelog template (and remove "CMS") (Guy Marriott)
 * 2019-05-17 [d141c83](https://github.com/silverstripe/silverstripe-userforms/commit/d141c83e0a1eda6686ccfca9c30d2d893c8b860a) Import missing PHPDoc doc blocks, switch intval() for (int) casting (Robbie Averill)
 * 2019-05-09 [5758075](https://github.com/silverstripe/silverstripe-userforms/commit/5758075d42dacb05dba8846d10699b22b55fb525) Update translations (Robbie Averill)
<!--- Changes above this line will be automatically regenerated -->
