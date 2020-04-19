# 2.5.2

## Overview

This hotfix release includes an update from CMS Recipe 4.5.1 to 4.5.2 and from UserForms 5.5.1 to 5.5.2.

- [CMS Recipe 4.5.2](https://docs.silverstripe.org/en/4/changelogs/4.5.2/)


Upgrading to Recipe 2.5.2 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe and the CWP team's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


## Security considerations

This release includes security fixes. Please see the release announcements for more detailed descriptions of each. We highly encourage upgrading your CWP projects to include these security patches.

 * [CVE-2020-9280](https://www.silverstripe.org/download/security-releases/CVE-2020-9280) - Folders migrated from 3.x may be unsafe to upload to ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * Follow up automation for [CVE-2019-12245](https://www.silverstripe.org/download/security-releases/CVE-2019-12245). See [CMS changelogs](https://docs.silverstripe.org/en/4/changelogs/4.5.2/) for more details


## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.5.2@stable",
    "cwp/cwp-recipe-cms": "2.5.2@stable",
    "silverstripe/recipe-blog": "1.5.2@stable",
    "silverstripe/recipe-form-building": "1.5.2@stable",
    "silverstripe/recipe-authoring-tools": "1.5.2@stable",
    "silverstripe/recipe-collaboration": "1.5.2@stable",
    "silverstripe/recipe-reporting-tools": "1.5.2@stable",
    "cwp/cwp-recipe-search": "2.5.2@stable",
    "silverstripe/recipe-services": "1.5.2@stable",
    "silverstripe/subsites": "2.3.3@stable",
    "tractorcow/silverstripe-fluent": "4.4.5@stable",
    "silverstripe/registry": "2.2.1@stable",
    "cwp/starter-theme": "3.0.3@stable"
},
"prefer-stable": true
```


## Change Log

### Security

 * 2020-03-31 [03858e0](https://github.com/silverstripe/silverstripe-userforms/commit/03858e0265a1a8c334f312a8059c9ca88a8d98bd) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)
 * 2020-03-08 [9779e4296](https://github.com/silverstripe/silverstripe-framework/commit/9779e42963031a0fed2ed01fc3b8e470d1114723) Register new sub tasks to fix files affected by CVE-2020-9280 and CVE-2019-12245 (Serge Latyntcev)
 * 2020-03-04 [89e69ad](https://github.com/silverstripe/silverstripe-assets/commit/89e69ad3b06072dc841d081c36063475e39df4f9) Create NormaliseAccessMigrationHelper to fix files affected by CVE-2019-12245 (Maxime Rainville)
<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2020-03-31 [23de5a8](https://github.com/silverstripe/silverstripe-userforms/commit/23de5a85c21c57a5cd9c633c1ac8ede8b02ef805) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)
<!--- Changes above this line will be automatically regenerated -->
