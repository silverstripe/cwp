# 2.0.2

This release includes SilverStripe 4.1.5, which contains a critical security fix for CVE-2019-5715 (SS-2018-021). See the [related blog post](https://www.silverstripe.org/download/security-releases/cve-2019-5715) for details.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-07-18 [e2af1cf](https://github.com/silverstripe/cwp-installer/commit/e2af1cfdee33be8e8a4e89fd099c7d9d12d4cb6b) Disabling use of serialise fallback in MultiValueField for new installations (Guy Marriott) - See [ss-2018-017](https://www.silverstripe.org/download/security-releases/ss-2018-017)
  * 2018-12-18 [95505db7d](https://github.com/silverstripe/silverstripe-framework/commit/95505db7d666a75f249f65cb1af74dca01d39add) Fix potential SQL vulnerability in non-scalar value hyrdation (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)

### Features and Enhancements

 * 2018-04-18 [3561466](https://github.com/silverstripe/recipe-core/commit/3561466e5ea479ee5602451d9fe2240a952ed56a) Provide default IIS rewriting rules with recipe (Damian Mooyman)
  * 2018-11-27 [a8f4f23c6](https://github.com/silverstripe/silverstripe-framework/commit/a8f4f23c660474e965b510ba1bb04bf7a145d5b0) Add visibility updates to `upgrade.yml`. (bergice)

### Bugfixes

* 2019-01-31 [cda9eef](https://github.com/silverstripe/silverstripe-assets/commit/cda9eef992b70fd46377be6d4459260d31ea2215) Fix for issue #212 (Joe Madden)
* 2019-01-29 [f918dcd36](https://github.com/silverstripe/silverstripe-framework/commit/f918dcd36a177adb8abee751d27a809f25a0afab) Escape wildcard characters when matching database name in databaseExists (Guy Marriott)
* 2019-01-28 [dc9d1b9cc](https://github.com/silverstripe/silverstripe-framework/commit/dc9d1b9cc0d3b14929fe2675282980a2750fb4cf) GridFieldPrintButton no longer assumes that children of GridField would implement their own print template (Robbie Averill)
* 2019-01-25 [0797ab7](https://github.com/silverstripe/silverstripe-asset-admin/commit/0797ab7762a4a64f2dc89c754a6bb04216b96fe1) Fix GraphQL FolderTypeCreator::resolveChildrenConnection on PostgreSQL (#901) (Serge Latyntcev)
* 2019-01-24 [d530bc2fb](https://github.com/silverstripe/silverstripe-framework/commit/d530bc2fb6c8c290f1f75f39bc4ec898cc326cf1) fix user feedback when jquery could not be loaded (Benedikt Seidl)
* 2019-01-13 [5c3b95ac](https://github.com/silverstripe/silverstripe-cms/commit/5c3b95ac8977f77e7d95d4da6333ca12b5ef465f) Multibyte URL routing (Ingo Schommer)
* 2019-01-11 [2cb49ea](https://github.com/silverstripe/silverstripe-versioned/commit/2cb49ea79d6babb80289f170dc6102c82f5b0d69) [Warning] on count() with PHP &gt;= 7.2 (Lukas)
* 2018-12-12 [0491ca03c](https://github.com/silverstripe/silverstripe-framework/commit/0491ca03cfcbd81690c54cc00f6234675978ef39) prevent death on urls with querystrings & anchors (mikeyc7m)
 * 2018-11-27 [142f31a](https://github.com/silverstripe/recipe-blog/commit/142f31a37bdc26243b9fce6a1149e4b8f7230423) Update path to global composer bin in Travis builds (Robbie Averill)
 * 2018-11-27 [a7dad10](https://github.com/silverstripe/recipe-blog/commit/a7dad1080c758c1d947e73e44a8fa8a3a87c5e64) Updated YML config now references correct commentnotifications template (Massey Isa'ako)
 * 2018-10-28 [17604a5](https://github.com/silverstripe/silverstripe-externallinks/commit/17604a5b42515b5f00b218c146c6810ba396281c) Replace Convert JSON methods with json_* methods, deprecated from SilverStripe 4.4 (Robbie Averill)
 * 2018-08-24 [61a63f3](https://github.com/silverstripe/silverstripe-externallinks/commit/61a63f36d91a96adb4268df40bf76346d395a218) Update plural name of BrokenExternalPageTrackStatus (Raissa North)
 * 2018-08-16 [ae9538f](https://github.com/silverstripe/cwp-core/commit/ae9538f227f66f49c0b3f44063a4f2567f015704) SilverStripe debug logs and higher are now routed correctly to syslog (Graylog) (Robbie Averill)
 * 2018-07-14 [a0e0bed](https://github.com/silverstripe/recipe-core/commit/a0e0bed7e7fe83b98264563efdeffa82d0d01d04) Use Injector to create PasswordValidators (Daniel Hensby)
 * 2018-06-18 [0b69b49](https://github.com/silverstripe/cwp-recipe-cms/commit/0b69b498337e777f6d494bef438822378bc0d8b3) Add proxy configuration for embedded cURL requests (Robbie Averill)
 * 2018-06-17 [a6aa171](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/a6aa1714d6c9e7f34eb31095e76a149bd0097522) Replace recipe-cms requirement with CMS module (Robbie Averill)
 * 2018-06-12 [73cccf9](https://github.com/silverstripe/cwp-installer/commit/73cccf9eb62f8481452ab85e2b684936e3a5ead2) Removing syntax error in config file (Guy)
 * 2018-05-29 [a6f9595](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/a6f95957a0dad3ca0e4ddef28a7d21230835744c) Correct assertion order and remove default pages from Subsite creation (Robbie Averill)
 * 2018-05-28 [d23faff](https://github.com/silverstripe/cwp-core/commit/d23faffae90c754358ed75ee94d889659ff28630) Correct assertion order in CwpStatsReportTest (Robbie Averill)
 * 2018-05-28 [34eb6ed](https://github.com/silverstripe/silverstripe-securityreport/commit/34eb6ed01b068034dd6b0a6b150be880ad805c30) Remove "Login Attempts" tab from Member CMS fields (Robbie Averill)
 * 2018-04-20 [9e6fa08](https://github.com/silverstripe/silverstripe-securityreport/commit/9e6fa085a1d9602eaa55a3689796d511c3ec7fd3) revert removal of 'last logged in' column (Dylan Wagstaff)
 * 2018-04-13 [478e5dc](https://github.com/silverstripe/recipe-cms/commit/478e5dc84021d45e9abc06747ab81e98d8062b89) Fix invalid htaccess (Damian Mooyman)
