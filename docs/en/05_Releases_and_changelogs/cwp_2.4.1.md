# 2.4.1

## Overview

This hotfix release includes an update from CMS Recipe 4.4.3 to 4.4.6, and from UserForms 5.4.1 to 5.4.2. Links to changelogs for each included version of the CMS Recipe can be found below.

- [CMS Recipe 4.4.4](https://docs.silverstripe.org/en/4/changelogs/4.4.4/)
- [CMS Recipe 4.4.5](https://docs.silverstripe.org/en/4/changelogs/4.4.5/)
- [CMS Recipe 4.4.6](https://docs.silverstripe.org/en/4/changelogs/4.4.6/)

Upgrading to Recipe 2.4.1 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with Silverstripe CMS. However, if you would like Silverstripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


## Security considerations

This release includes security fixes. Please see the release announcements for more detailed descriptions of each. We highly encourage upgrading your CWP projects to include these security patches.

 * [CVE-2020-9280](https://www.silverstripe.org/download/security-releases/CVE-2020-9280) - Folders migrated from 3.x may be unsafe to upload to ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * [CVE-2019-19325](https://www.silverstripe.org/download/security-releases/CVE-2019-19325) - XSS through non-scalar FormField attributes (CVSS 0.0 - mitigated on CWP infrastructure level)
 * [CVE-2019-14273](https://www.silverstripe.org/download/security-releases/CVE-2019-14273) - Broken Access control on files ([CVSS 3.5](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:L/I:N/A:N/E:F/RL:O/RC:C))
 * [CVE-2019-12617](https://www.silverstripe.org/download/security-releases/CVE-2019-12617) - Access escalation for CMS users with limited access through permission cache pollution ([CVSS 5.0](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:H/UI:N/S:U/C:L/I:H/A:N))
 * [CVE-2019-12245](https://www.silverstripe.org/download/security-releases/CVE-2019-12245) - Incorrect access control vulnerability in files uploaded to protected folders ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * [CVE-2019-12204](https://www.silverstripe.org/download/security-releases/CVE-2019-12204) - Missing warning on install.php on public webroot can lead to unauthenticated admin access (CVSS 0.0 - mitigated on CWP infrastructure level)
 * [CVE-2019-12203](https://www.silverstripe.org/download/security-releases/CVE-2019-12203) - Session fixation in "change password" form ([CVSS 6.5](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:L/AC:H/PR:N/UI:R/S:U/C:H/I:H/A:L))


## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-core": "2.4.1@stable",
    "cwp/cwp-recipe-cms": "2.4.1@stable",
    "silverstripe/recipe-blog": "1.4.1@stable",
    "silverstripe/recipe-form-building": "1.4.1@stable",
    "silverstripe/recipe-authoring-tools": "1.4.1@stable",
    "silverstripe/recipe-collaboration": "1.4.1@stable",
    "silverstripe/recipe-reporting-tools": "1.4.1@stable",
    "cwp/cwp-recipe-search": "2.4.1@stable",
    "silverstripe/recipe-services": "1.4.1@stable",
    "silverstripe/subsites": "2.3.2@stable",
    "tractorcow/silverstripe-fluent": "4.4.1@stable",
    "silverstripe/registry": "2.2.1@stable",
    "cwp/starter-theme": "3.0.1@stable"
},
"prefer-stable": true
```


## Change Log

### Security

 * 2020-03-31 [d530d5b](https://github.com/silverstripe/silverstripe-userforms/commit/d530d5b969b3316064cbfc705946f3e31d714a76) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)
 * 2020-02-12 [d515e5e](https://github.com/silverstripe/silverstripe-admin/commit/d515e5eced1787d99d4ca1520e01513c2031a627) XSS through non-scalar FormField attributes (Serge Latyntcev) - See [cve-2019-19325](https://www.silverstripe.org/download/security-releases/cve-2019-19325)
 * 2020-02-03 [ad1b00ec7](https://github.com/silverstripe/silverstripe-framework/commit/ad1b00ec7dc1589a05bfc7f5f8207489797ef714) XSS through non-scalar FormField attributes (Serge Latyntcev) - See [cve-2019-19325](https://www.silverstripe.org/download/security-releases/cve-2019-19325)
 * 2019-09-23 [8b7063a8e](https://github.com/silverstripe/silverstripe-framework/commit/8b7063a8e2773e2bbec3cabf94ed86e11f607071) Fix access escalation for CMS users with limited access through permission cache pollution (Serge Latyntcev) - See [cve-2019-12617](https://www.silverstripe.org/download/security-releases/cve-2019-12617)
 * 2019-09-16 [eccfa9b10](https://github.com/silverstripe/silverstripe-framework/commit/eccfa9b10d246d741de2fa83d502339d45068983) Session fixation in "change password" form (Serge Latyntcev) - See [cve-2019-12203](https://www.silverstripe.org/download/security-releases/cve-2019-12203)
 * 2019-08-20 [f98a59de](https://github.com/silverstripe/silverstripe-cms/commit/f98a59deb58d3c9c739f5b32de16472f6ef4a69c) install.php warning does not account for public dir (Aaron Carlino) - See [cve-2019-12204](https://www.silverstripe.org/download/security-releases/cve-2019-12204)
 * 2019-08-17 [8c7a719](https://github.com/silverstripe/silverstripe-assets/commit/8c7a71992b038f65543a37097b88e6929c23ba8b) Broken access control on files due to session grant (Aaron Carlino) - See [cve-2019-14273](https://www.silverstripe.org/download/security-releases/cve-2019-14273)
 * 2019-05-21 [73e0cc6](https://github.com/silverstripe/silverstripe-assets/commit/73e0cc69dc499c24aa706af9eddd8a2db2ac93e0) Fix incorrect access control vulnerability with unwritten files in protected folders (Robbie Averill) - See [cve-2019-12245](https://www.silverstripe.org/download/security-releases/cve-2019-12245)
