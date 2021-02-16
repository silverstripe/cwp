# 2.7.1-rc1

## Overview

This release includes [Silverstripe CMS Recipe version 4.7.2](https://docs.silverstripe.org/en/4/changelogs/4.7.2/).


## Release Candidate

This version of CWP is a **release candidate** for an upcoming stable version, and should not be applied to production websites. We encourage developers to test this version in development / testing environments and report any issues they encounter via GitHub.


<!--- Changes below this line will be automatically regenerated -->

## Change Log


### Features and Enhancements


 * cwp/cwp-core (2.7.0 -&gt; 2.7.1-rc1)
    * 2021-01-14 [6c45d74](https://github.com/silverstripe/cwp-core/commit/6c45d74856ba85d784d412623d5d6ffaffddbfe3) Remove title attributes from links (#93) (Mark Anthony Adriano)

 * silverstripe/userforms (5.8.1 -&gt; 5.8.2)
    * 2021-01-17 [e7f51d2](https://github.com/silverstripe/silverstripe-userforms/commit/e7f51d227a37405ab057ba17a7590b84ce7b8e96) Move jQuery include away from CDN (#1019) (Dylan Wagstaff)

    
### Bugfixes


 * silverstripe/userforms (5.8.1 -&gt; 5.8.2)
    * 2021-01-17 [c0a30f1](https://github.com/silverstripe/silverstripe-userforms/commit/c0a30f1b6a3cb76c880b8879bf99b3fe8316e513) unrequire fields when they become dataless (#1016) (Dylan Wagstaff)
    * 2021-01-17 [a427296](https://github.com/silverstripe/silverstripe-userforms/commit/a42729679b602addd828c727e60cf4361cabc316) account for owner class while removing orphans (#1018) (Dylan Wagstaff)

 * silverstripe/sharedraftcontent (2.3.4 -&gt; 2.3.5)
    * 2020-11-10 [42f2912](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/42f2912809a55b3de8498a61493028ea85274754) Quote yml, use shared travis config, use sminnee/phpunit (Steve Boyd)

 * silverstripe/externallinks (2.1.0 -&gt; 2.1.1)
    * 2021-02-03 [b4c210f](https://github.com/silverstripe/silverstripe-externallinks/commit/b4c210f2112c0e05a23e85572a6d6a0b014d5803) Exclude links attached to archived Pages from report (#72) (Garion Herman)

 * silverstripe/versionfeed (2.0.2 -&gt; 2.0.3)
    * 2020-11-09 [5cc58a1](https://github.com/silverstripe/silverstripe-versionfeed/commit/5cc58a1269f3c427d97ae3ea9e91765f24e4d7ef) Quote yml, use shared travis config, sminnee/phpunit (Steve Boyd)

 * silverstripe/mfa (4.2.0 -&gt; 4.2.2)
    * 2021-02-02 [b1f48d5](https://github.com/silverstripe/silverstripe-mfa/commit/b1f48d5ead1ab9f92406fdb34df7ecd70c34dc77) Disable HTTP caching on all relevant MFA API endpoints (Garion Herman)
    * 2021-01-26 [972d840](https://github.com/silverstripe/silverstripe-mfa/commit/972d84053e78fc933a69394488fec595ed2a9ec4) Explicitly disable browser cache on verification response (Steve Boyd)
    * 2021-01-18 [732f6b9](https://github.com/silverstripe/silverstripe-mfa/commit/732f6b98fe6b22c723476a10058fd55243936f9f) PHPUnit test compatibility with PHP8 (#418) (Steve Boyd)

 * silverstripe/totp-authenticator (4.1.0 -&gt; 4.1.1)
    * 2021-01-20 [9b5c4fc](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/9b5c4fc3eecd93f0d92971720bfe60c106ba99cf) Improve authentication layout in IE 11 (Garion Herman)

    
### Documentation


 * cwp/cwp (2.7.0 -&gt; 2.7.1-rc1)
    * 2021-01-12 [9e5faae](https://github.com/silverstripe/cwp/commit/9e5faaef039df8dd79514ca78cbfa9cfd202a7b2) Add notes about default collation change in 2.7.0 (Garion Herman)

    
### Other changes


 * cwp/cwp (2.7.0 -&gt; 2.7.1-rc1)
    * 2020-11-18 [9f2021a](https://github.com/silverstripe/cwp/commit/9f2021aa5da8b0876ad009e293532b2c3135d421) Move translation commits to other changes section (Steve Boyd)

 * silverstripe/elemental-fileblock (2.1.1 -&gt; 2.1.2)
    * 2021-01-02 [03bb0b2](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/03bb0b2fd0f69dd77d5341c996b26040272c6d89) Revert translation (Steve Boyd)

 * silverstripe/elemental-bannerblock (2.2.0 -&gt; 2.2.1)
    * 2021-01-19 [1ccc520](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/1ccc520796356ae15ed12748f0bb638c97910ad3) Require minimum recipe of 4.7.x-dev (Steve Boyd)
    * 2021-01-02 [147d7e5](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/147d7e5d80ec3c44bfc079e60f7288d76e1e1491) Revert translation (Steve Boyd)

    <!--- Changes above this line will be automatically regenerated -->
