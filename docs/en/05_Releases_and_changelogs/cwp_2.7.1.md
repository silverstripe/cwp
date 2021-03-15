# 2.7.1

## Overview

This release includes the following Silverstripe CMS Recipe releases:
- [Silverstripe CMS Recipe version 4.7.1](https://docs.silverstripe.org/en/4/changelogs/4.7.1/)
- [Silverstripe CMS Recipe version 4.7.2](https://docs.silverstripe.org/en/4/changelogs/4.7.2/)
- [Silverstripe CMS Recipe version 4.7.3](https://docs.silverstripe.org/en/4/changelogs/4.7.3/)


Upgrading to Recipe 2.7.1 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe and the CWP team's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## Security considerations

This release includes security fixes. Please see the release announcements for more detailed
descriptions of each but note that the following issues may have modified CVSS Environmental
scores which take built-in protections from the CWP platform into account. We highly encourage upgrading CWP projects to include latest security patches nonetheless.

We have provided a high-level severity rating of the vulnerabilities below based on the CVSS score, however please note this could vary based on the specifics of each project. You can [read the severity rating definitions in the Silverstripe CMS release process](https://docs.silverstripe.org/en/4/contributing/release_process/#severity-rating).

 * [CVE-2021-27938 XSS in CreateQueuedJobTask](https://www.silverstripe.org/download/security-releases/cve-2021-27938)
 Severity: [7.1](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:R/S:U/C:H/I:H/A:L/E:P/RL:O/RC:C&version=3.1)

## Notable bugfixes

### Elemental Popover bugs
A series of bugs affected the Elemental popover used to add blocks to an elemental area. Fixes have been developed to control the width of the popover and make sure only one popover is open at a time.

### Toast notifications initialisation
In some context, the CMS would try to display a toast notification prior to being initialised. This would crash the CMS UI.

### Systematically disable HTTP caching on all MFA request
In some context, the login screen would cache the MFA challenge, preventing the user from entering their MFA code.

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.7.1@stable",
    "cwp/cwp-recipe-cms": "2.7.1@stable",
    "silverstripe/recipe-blog": "1.7.1@stable",
    "silverstripe/recipe-form-building": "1.7.1@stable",
    "silverstripe/recipe-authoring-tools": "1.7.1@stable",
    "silverstripe/recipe-collaboration": "1.7.1@stable",
    "silverstripe/recipe-reporting-tools": "1.7.1@stable",
    "cwp/cwp-recipe-search": "2.7.1@stable",
    "silverstripe/recipe-services": "1.7.1@stable",
    "tractorcow/silverstripe-fluent": "4.5.1@stable",
    "silverstripe/registry": "2.2.1@stable",
    "cwp/starter-theme": "3.1.0@stable"
},
"prefer-stable": true
```

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

  * symbiote/silverstripe-queuedjobs (4.6.2 -&gt; 4.6.4)
     * 2021-01-04 [4c8aa39](https://github.com/symbiote/silverstripe-queuedjobs/commit/4c8aa393cbda9d316d0b8851be44bcb1be4c2cc1) [CVE-2021-27938] Prevent echoing request variable (Steve Boyd)

### Features and Enhancements


 * cwp/cwp-core (2.7.0 -&gt; 2.7.1)
    * 2021-01-14 [6c45d74](https://github.com/silverstripe/cwp-core/commit/6c45d74856ba85d784d412623d5d6ffaffddbfe3) Remove title attributes from links (#93) (Mark Anthony Adriano)

 * silverstripe/userforms (5.8.1 -&gt; 5.8.3)
    * 2021-03-04 [b3ee7f4](https://github.com/silverstripe/silverstripe-userforms/commit/b3ee7f4e34589a0e3e597ce3901e1e60af26cd8b) Use yarn and webpack to upgrade jquery (Steve Boyd)
    * 2021-01-17 [e7f51d2](https://github.com/silverstripe/silverstripe-userforms/commit/e7f51d227a37405ab057ba17a7590b84ce7b8e96) Move jQuery include away from CDN (#1019) (Dylan Wagstaff)


### Bugfixes


 * silverstripe/userforms (5.8.1 -&gt; 5.8.3)
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


 * cwp/cwp (2.7.0 -&gt; 2.7.1)
    * 2021-01-12 [9e5faae](https://github.com/silverstripe/cwp/commit/9e5faaef039df8dd79514ca78cbfa9cfd202a7b2) Add notes about default collation change in 2.7.0 (Garion Herman)


### Other changes


 * cwp/cwp (2.7.0 -&gt; 2.7.1)
    * 2020-11-18 [9f2021a](https://github.com/silverstripe/cwp/commit/9f2021aa5da8b0876ad009e293532b2c3135d421) Move translation commits to other changes section (Steve Boyd)

 * silverstripe/elemental-fileblock (2.1.1 -&gt; 2.1.2)
    * 2021-01-02 [03bb0b2](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/03bb0b2fd0f69dd77d5341c996b26040272c6d89) Revert translation (Steve Boyd)

 * silverstripe/elemental-bannerblock (2.2.0 -&gt; 2.2.1)
    * 2021-01-19 [1ccc520](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/1ccc520796356ae15ed12748f0bb638c97910ad3) Require minimum recipe of 4.7.x-dev (Steve Boyd)
    * 2021-01-02 [147d7e5](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/147d7e5d80ec3c44bfc079e60f7288d76e1e1491) Revert translation (Steve Boyd)



<!--- Changes above this line will be automatically regenerated -->
