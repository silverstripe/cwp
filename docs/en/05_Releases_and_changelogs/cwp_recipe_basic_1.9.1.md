# 1.9.1

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2019-01-10 [6bf9542d6](https://github.com/silverstripe/silverstripe-framework/commit/6bf9542d664ac7935691c8055505b7ad8ea26e9a) Patch SQL Injection vulnerability when arrays are assigned to DataObject Fields (Aaron Carlino) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
 * 2018-12-06 [a2a207f](https://github.com/symbiote/silverstripe-multivaluefield/commit/a2a207fbeb4af6a5f2c6781b21b63ecbc1ea4ae4) Adjust MultiValueField to work with the new scalarValueOnly method (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)

### Bugfixes

 * 2019-01-30 [8e6e70335](https://github.com/silverstripe/silverstripe-framework/commit/8e6e70335895063c6e6cfd99cfcfb50c6f9c2ad9) Block Manifest of the compatibility class Object and lean on model/fieldtypes/compat/autoload.php (UndefinedOffset)
 * 2019-01-23 [746c0679a](https://github.com/silverstripe/silverstripe-framework/commit/746c0679ad1d6ceac03d2adf167367f0ca2259cd) Injector may instantiate prototypes as if they're singletons (fixes #8567) (Loz Calver)
 * 2019-01-11 [16a837d6a](https://github.com/silverstripe/silverstripe-framework/commit/16a837d6a093115755cd821c63be1e3be088645b) fix [Warning] on count() with PHP &gt;= 7.2 (lerni)
 * 2019-01-11 [eb14ac8](https://github.com/silverstripe/cwp/commit/eb14ac8dd8c4d3e83b5af92ecb2811ca903d7935) Add configuration to allow CWP to wait a few seconds before marking queued export generation jobs as complete (Robbie Averill)
 * 2018-11-15 [86701b8cd](https://github.com/silverstripe/silverstripe-framework/commit/86701b8cd0cd5f8de813a7c9347e7c8055d878f4) Redirect loop with multiple URL tokens (fixes #8607) (Loz Calver)
 * 2018-05-28 [d23faff](https://github.com/silverstripe/cwp-core/commit/d23faffae90c754358ed75ee94d889659ff28630) Correct assertion order in CwpStatsReportTest (Robbie Averill)

### Other changes

 * 2019-02-18 [ea33b00](https://github.com/silverstripe/cwp-installer/commit/ea33b00286aa2ef211f120585c4b0fb53256cde3) Remove obsolete CWP repository configuration (Robbie Averill)
 * 2019-01-15 [53e0f64](https://github.com/silverstripe/cwp-installer/commit/53e0f6475ad3c8eea628edc8ba33872af70d5e93) Add silverstripe-maintenance and related modules to gitignore (Robbie Averill)
 * 2019-01-08 [1bc51a1c3](https://github.com/silverstripe/silverstripe-framework/commit/1bc51a1c3949260e488b88fc2dd1fcf38b14bf39) Update Object.php (Joe Chenevey)
 * 2018-12-04 [cd47ef5](https://github.com/silverstripe/cwp/commit/cd47ef5dcba2476da1a95eb946afc7a0b68af6f0) detail what is synced in Active DR (Moss Cantwell)
 * 2018-08-09 [d9094a4](https://github.com/silverstripe/cwp/commit/d9094a40e8c261187b40e0b12ac841db964ae5ed) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-08-08 [6674e32](https://github.com/silverstripe/cwp/commit/6674e320b077337cce8e15b27db712f19f1233e3) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-07-26 [2f6d959](https://github.com/silverstripe/cwp/commit/2f6d9592d46189b1cc7df43c7e26a7093185bbbe) Update to include new feature details (Bryn Whyman)
 * 2018-07-26 [05da8cb](https://github.com/silverstripe/cwp/commit/05da8cb8aa5dac4eee1f0a28d2634f8718e2c683) DOCS Update reference to framework to include 3.7.1 (Robbie Averill)
