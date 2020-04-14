# 2.5.2

## Overview

This hotfix release includes CMS and Framework version updates up to 4.5.2 and UserForms 5.5.2

- [CMS 4.5.2](https://docs.silverstripe.org/en/4/changelogs/4.5.2/)


Upgrading to Recipe 2.5.2 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with the Silverstripe CMS. However, if you would like Silverstripe and the CWP team's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


## Security considerations

This release includes  security fixes. Please see the release announcements for more detailed descriptions of each[ but note that the following issues have modified CVSS Environmental scores which take built-in protections from the CWP platform into account]. We highly encourage upgrading your CWP projects to include these security patches nonetheless.

 * [CVE-2020-9280](https://www.silverstripe.org/download/security-releases/CVE-2020-9280) - Folders migrated from 3.x may be unsafe to upload to ([CVSS 5.9](https://nvd.nist.gov/vuln-metrics/cvss/v3-calculator?vector=AV:N/AC:H/PR:N/UI:N/S:U/C:H/I:N/A:N&version=3.1))
 * Follow up automation for [CVE-2019-12245](https://www.silverstripe.org/download/security-releases/CVE-2019-12245). See [CMS changelogs](https://docs.silverstripe.org/en/4/changelogs/4.5.2/) for more details


## Change Log

### Security

 * 2020-03-31 [03858e0](https://github.com/silverstripe/silverstripe-userforms/commit/03858e0265a1a8c334f312a8059c9ca88a8d98bd) Task for shifting UserForm uploads into correct folders (Serge Latyntcev) - See [cve-2020-9280](https://www.silverstripe.org/download/security-releases/cve-2020-9280)
 * 2020-03-08 [9779e4296](https://github.com/silverstripe/silverstripe-framework/commit/9779e42963031a0fed2ed01fc3b8e470d1114723) Register new sub tasks to fix files affected by CVE-2020-9280 and CVE-2019-12245 (Serge Latyntcev)
 * 2020-03-04 [89e69ad](https://github.com/silverstripe/silverstripe-assets/commit/89e69ad3b06072dc841d081c36063475e39df4f9) Create NormaliseAccessMigrationHelper to fix files affected by CVE-2019-12245 (Maxime Rainville)
<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2020-03-08 [9779e4296](https://github.com/silverstripe/silverstripe-framework/commit/9779e42963031a0fed2ed01fc3b8e470d1114723) Register new sub tasks to fix files affected by CVE-2020-9280 and CVE-2019-12245 (Serge Latyntcev)
 * 2020-03-04 [89e69ad](https://github.com/silverstripe/silverstripe-assets/commit/89e69ad3b06072dc841d081c36063475e39df4f9) Create NormaliseAccessMigrationHelper to fix files affected by CVE-2019-12245 (Maxime Rainville)
 * 2020-02-27 [92e64a7](https://github.com/silverstripe/silverstripe-graphql/commit/92e64a7109eb265c5b34e83b67e392c763fd2de3) Fix behat set up (Maxime Rainville)
 * 2020-02-26 [aceefd3](https://github.com/silverstripe/silverstripe-graphql/commit/aceefd3af06d4e8f39354ad17f0d433857384448) Increment asset-admin travis build target (Maxime Rainville)
 * 2020-02-24 [f447db4](https://github.com/silverstripe/silverstripe-graphql/commit/f447db469bb91e5ca1ac9f83b37a57e48ed399a1) Add asset-admin test to travis build (Maxime Rainville)

### Other changes

 * 2020-04-13 [921b1cd](https://github.com/silverstripe/recipe-cms/commit/921b1cd7250fab6f924b47401c981c0554444a47) Update development dependencies (Maxime Rainville)
 * 2020-04-13 [00b0147](https://github.com/silverstripe/recipe-core/commit/00b014795d147ff96e5b5b0d97994abe44cb2f90) Update development dependencies (Maxime Rainville)
 * 2020-04-08 [bee37b7](https://github.com/silverstripe/silverstripe-graphql/commit/bee37b7d742a57fcfb7fe90782d1f9d16f07962e) MINOR: add result to onAfterMiddlware hook (#258) (Aaron Carlino)
 * 2020-03-28 [052ce6916](https://github.com/silverstripe/silverstripe-framework/commit/052ce6916cc72e57c6d9c8f86b02598f9af169a2) DOC Explain how to use the new file migation sub tasks in the 4.4.6/4.5.2 changelogs (Maxime Rainville)
 * 2020-03-08 [c4709b6](https://github.com/silverstripe/silverstripe-assets/commit/c4709b6c6af840ea618b36d8ffe76f1ed48a21b3) CVE-2020-9280 Add FolderMigrationHelper (Serge Latyntcev)
 * 2020-02-26 [be772fb](https://github.com/silverstripe/silverstripe-graphql/commit/be772fbcf253412ee26a72492041c30f0c5b9162) Add sminnee/phpunit-mock-objects to fix PHP 7.4 compat (Garion Herman)
 * 2020-02-26 [a0489df](https://github.com/silverstripe/silverstripe-graphql/commit/a0489df0c35f18698956c7a0a98cda7f3077e0ff) Update Travis config to include PHP 7.4 build, upgrade to Xenial (Garion Herman)
<!--- Changes above this line will be automatically regenerated -->