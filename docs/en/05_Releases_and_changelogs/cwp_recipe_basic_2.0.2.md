# 2.0.2

This release includes SilverStripe 4.1.5, which contains a critical security fix for CVE-2019-5715 (SS-2018-021). See the [related blog post](https://www.silverstripe.org/download/security-releases/cve-2019-5715) for details.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-07-18 [e2af1cf](https://github.com/silverstripe/cwp-installer/commit/e2af1cfdee33be8e8a4e89fd099c7d9d12d4cb6b) Disabling use of serialise fallback in MultiValueField for new installations (Guy Marriott) - See [ss-2018-017](https://www.silverstripe.org/download/security-releases/ss-2018-017)
 * 2018-12-18 [fd90cf6ce](https://github.com/silverstripe/silverstripe-framework/commit/fd90cf6ceb346142eee6ba620599ab36c2d18cbb) Fix potential SQL vulnerability in non-scalar value hyrdation (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/cve-2019-5715)

### Features and Enhancements

 * 2018-04-18 [3561466](https://github.com/silverstripe/recipe-core/commit/3561466e5ea479ee5602451d9fe2240a952ed56a) Provide default IIS rewriting rules with recipe (Damian Mooyman)

### Bugfixes

* 2019-01-31 [cda9eef](https://github.com/silverstripe/silverstripe-assets/commit/cda9eef992b70fd46377be6d4459260d31ea2215) Fix for issue #212 (Joe Madden)
* 2019-01-25 [0797ab7](https://github.com/silverstripe/silverstripe-asset-admin/commit/0797ab7762a4a64f2dc89c754a6bb04216b96fe1) Fix GraphQL FolderTypeCreator::resolveChildrenConnection on PostgreSQL (#901) (Serge Latyntcev)
* 2019-01-13 [5c3b95ac](https://github.com/silverstripe/silverstripe-cms/commit/5c3b95ac8977f77e7d95d4da6333ca12b5ef465f) Multibyte URL routing (Ingo Schommer)
* 2019-01-11 [2cb49ea](https://github.com/silverstripe/silverstripe-versioned/commit/2cb49ea79d6babb80289f170dc6102c82f5b0d69) [Warning] on count() with PHP &gt;= 7.2 (Lukas)
* 2018-12-18 [3d841a4](https://github.com/silverstripe/silverstripe-installer/commit/3d841a409c43752a8192afea5ebc48327e2ac3d3) / Behat tests (Serge Latyntcev)
* 2018-12-13 [c4a0d5f0](https://github.com/silverstripe/silverstripe-cms/commit/c4a0d5f0831f0f27022905700a0ffb86cc56aceb) Publish button text merge regression (Aaron Carlino)
 * 2018-08-16 [ae9538f](https://github.com/silverstripe/cwp-core/commit/ae9538f227f66f49c0b3f44063a4f2567f015704) SilverStripe debug logs and higher are now routed correctly to syslog (Graylog) (Robbie Averill)
 * 2018-07-14 [a0e0bed](https://github.com/silverstripe/recipe-core/commit/a0e0bed7e7fe83b98264563efdeffa82d0d01d04) Use Injector to create PasswordValidators (Daniel Hensby)
 * 2018-06-18 [0b69b49](https://github.com/silverstripe/cwp-recipe-cms/commit/0b69b498337e777f6d494bef438822378bc0d8b3) Add proxy configuration for embedded cURL requests (Robbie Averill)
 * 2018-06-12 [73cccf9](https://github.com/silverstripe/cwp-installer/commit/73cccf9eb62f8481452ab85e2b684936e3a5ead2) Removing syntax error in config file (Guy)
 * 2018-05-28 [d23faff](https://github.com/silverstripe/cwp-core/commit/d23faffae90c754358ed75ee94d889659ff28630) Correct assertion order in CwpStatsReportTest (Robbie Averill)
 * 2018-04-13 [478e5dc](https://github.com/silverstripe/recipe-cms/commit/478e5dc84021d45e9abc06747ab81e98d8062b89) Fix invalid htaccess (Damian Mooyman)
