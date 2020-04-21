# 2.3.3

## Overview

This hotfix release includes an update from CMS Recipe 4.4.0 to 4.4.6, and from UserForms 5.4.1 to 5.4.2. Links to changelogs for each included version of the CMS Recipe can be found below.

- [CMS Recipe 4.4.1](https://docs.silverstripe.org/en/4/changelogs/4.4.1/)
- [CMS Recipe 4.4.2](https://docs.silverstripe.org/en/4/changelogs/4.4.2/)
- [CMS Recipe 4.4.3](https://docs.silverstripe.org/en/4/changelogs/4.4.3/)
- [CMS Recipe 4.4.4](https://docs.silverstripe.org/en/4/changelogs/4.4.4/)
- [CMS Recipe 4.4.5](https://docs.silverstripe.org/en/4/changelogs/4.4.5/)
- [CMS Recipe 4.4.6](https://docs.silverstripe.org/en/4/changelogs/4.4.6/)

Upgrading to Recipe 2.3.3 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with Silverstripe CMS. However, if you would like Silverstripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


## Security considerations

This release includes security fixes. Please see the release announcements for more detailed descriptions of each. We highly encourage upgrading your CWP projects to include these security patches.

 * [CVE-2020-9280](https://www.silverstripe.org/download/security-releases/CVE-2020-9280) - Folders migrated from 3.x may be unsafe to upload to ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * [CVE-2019-19325](https://www.silverstripe.org/download/security-releases/CVE-2019-19325) - XSS through non-scalar FormField attributes (CVSS 0.0 - mitigated on CWP infrastructure level)
 * [CVE-2019-14273](https://www.silverstripe.org/download/security-releases/CVE-2019-14273) - Broken Access control on files ([CVSS 3.5](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:L/I:N/A:N/E:F/RL:O/RC:C))
 * [CVE-2019-12617](https://www.silverstripe.org/download/security-releases/CVE-2019-12617) - Access escalation for CMS users with limited access through permission cache pollution ([CVSS 5.0](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:H/UI:N/S:U/C:L/I:H/A:N))
 * [CVE-2019-12437](https://www.silverstripe.org/download/security-releases/CVE-2019-12437) - Cross Site Request Forgery (CSRF) Protection Bypass in GraphQL ([CVSS 6.8](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:R/S:U/C:N/I:H/A:H))
 * [CVE-2019-12245](https://www.silverstripe.org/download/security-releases/CVE-2019-12245) - Incorrect access control vulnerability in files uploaded to protected folders ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * [CVE-2019-12204](https://www.silverstripe.org/download/security-releases/CVE-2019-12204) - Missing warning on install.php on public webroot can lead to unauthenticated admin access (CVSS 0.0 - mitigated on CWP infrastructure level)
 * [CVE-2019-12203](https://www.silverstripe.org/download/security-releases/CVE-2019-12203) - Session fixation in "change password" form ([CVSS 6.5](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:L/AC:H/PR:N/UI:R/S:U/C:H/I:H/A:L))


## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.3.3@stable",
    "cwp/cwp-recipe-cms": "2.3.3@stable",
    "silverstripe/recipe-blog": "1.3.3@stable",
    "silverstripe/recipe-form-building": "1.3.3@stable",
    "silverstripe/recipe-authoring-tools": "1.3.3@stable",
    "silverstripe/recipe-collaboration": "1.3.3@stable",
    "silverstripe/recipe-reporting-tools": "1.3.3@stable",
    "cwp/cwp-recipe-search": "2.3.3@stable",
    "silverstripe/recipe-services": "1.3.3@stable",
    "silverstripe/subsites": "2.3.1@stable",
    "tractorcow/silverstripe-fluent": "4.2.1@stable",
    "cwp/starter-theme": "3.0.0@stable"
},
"prefer-stable": true
```


## Change Log

### Security

 * 2020-03-31 [3bbad20](https://github.com/silverstripe/silverstripe-userforms/commit/3bbad2044279ade5e5a5d0ae1822bafe479f8a26) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)
 * 2020-02-12 [d515e5e](https://github.com/silverstripe/silverstripe-admin/commit/d515e5eced1787d99d4ca1520e01513c2031a627) XSS through non-scalar FormField attributes (Serge Latyntcev) - See [cve-2019-19325](https://www.silverstripe.org/download/security-releases/cve-2019-19325)
 * 2020-02-03 [ad1b00ec7](https://github.com/silverstripe/silverstripe-framework/commit/ad1b00ec7dc1589a05bfc7f5f8207489797ef714) XSS through non-scalar FormField attributes (Serge Latyntcev) - See [cve-2019-19325](https://www.silverstripe.org/download/security-releases/cve-2019-19325)
 * 2019-09-23 [8b7063a8e](https://github.com/silverstripe/silverstripe-framework/commit/8b7063a8e2773e2bbec3cabf94ed86e11f607071) Fix access escalation for CMS users with limited access through permission cache pollution (Serge Latyntcev) - See [cve-2019-12617](https://www.silverstripe.org/download/security-releases/cve-2019-12617)
 * 2019-09-16 [eccfa9b10](https://github.com/silverstripe/silverstripe-framework/commit/eccfa9b10d246d741de2fa83d502339d45068983) Session fixation in "change password" form (Serge Latyntcev) - See [cve-2019-12203](https://www.silverstripe.org/download/security-releases/cve-2019-12203)
 * 2019-08-20 [f98a59de](https://github.com/silverstripe/silverstripe-cms/commit/f98a59deb58d3c9c739f5b32de16472f6ef4a69c) install.php warning does not account for public dir (Aaron Carlino) - See [cve-2019-12204](https://www.silverstripe.org/download/security-releases/cve-2019-12204)
 * 2019-08-17 [8c7a719](https://github.com/silverstripe/silverstripe-assets/commit/8c7a71992b038f65543a37097b88e6929c23ba8b) Broken access control on files due to session grant (Aaron Carlino) - See [cve-2019-14273](https://www.silverstripe.org/download/security-releases/cve-2019-14273)
 * 2019-06-05 [3c1dd6b](https://github.com/silverstripe/silverstripe-graphql/commit/3c1dd6b839b7c0e2cbc85074bb5840ebded6097c) Cross Site Request Forgery (CSRF) Protection Bypass (Aaron Carlino) - See [cve-2019-12437](https://www.silverstripe.org/download/security-releases/cve-2019-12437)
 * 2019-06-05 [32b727e](https://github.com/silverstripe/silverstripe-graphql/commit/32b727e02dd8d9b907ff0d515d1b9b82737f2b38) Cross Site Request Forgery (CSRF) Protection Bypass in GraphQL (Aaron Carlino) - See [cve-2019-12437](https://www.silverstripe.org/download/security-releases/cve-2019-12437)
 * 2019-05-21 [73e0cc6](https://github.com/silverstripe/silverstripe-assets/commit/73e0cc69dc499c24aa706af9eddd8a2db2ac93e0) Fix incorrect access control vulnerability with unwritten files in protected folders (Robbie Averill) - See [cve-2019-12245](https://www.silverstripe.org/download/security-releases/cve-2019-12245)

### Bugfixes

 * 2019-05-27 [d7c76ec](https://github.com/silverstripe/silverstripe-userforms/commit/d7c76ecf80ef4791403b028b07ab65dba21be79c) Preview email link now handles cases where it's loaded in the browser, requested via AJAX and used in a trait or a page context (#887) (Guy Marriott)
 * 2019-05-20 [f4cd7a3](https://github.com/silverstripe/silverstripe-userforms/commit/f4cd7a3836dc1ec2c462dc0778d1b155ad21faa6) Allowed text length fields now align correctly with each other (#886) (Guy Marriott)
 * 2019-05-17 [483fbc8](https://github.com/silverstripe/silverstripe-userforms/commit/483fbc8499a5735a79cbe42a47419b90b682c129) Preview email link now handles cases where it's loaded in the browser, requested via AJAX and used in a trait or a page context (Robbie Averill)
 * 2019-05-17 [d0e937a](https://github.com/silverstripe/silverstripe-userforms/commit/d0e937a5883e5bf4aecea8442d746264717df76a) Allowed text length fields now align correctly with each other (Robbie Averill)
 * 2019-05-16 [181e0de](https://github.com/silverstripe/silverstripe-userforms/commit/181e0de171f92b01401b1e36319e322e64900941) Multi page userforms now display their step titles, which were previously broken (Robbie Averill)

### Other changes

 * 2019-05-17 [d141c83](https://github.com/silverstripe/silverstripe-userforms/commit/d141c83e0a1eda6686ccfca9c30d2d893c8b860a) Import missing PHPDoc doc blocks, switch intval() for (int) casting (Robbie Averill)
 * 2019-05-09 [5758075](https://github.com/silverstripe/silverstripe-userforms/commit/5758075d42dacb05dba8846d10699b22b55fb525) Update translations (Robbie Averill)
