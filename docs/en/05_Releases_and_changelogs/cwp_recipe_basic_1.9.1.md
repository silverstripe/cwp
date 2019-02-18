# 1.9.1

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2019-01-10 [6bf9542d6](https://github.com/silverstripe/silverstripe-framework/commit/6bf9542d664ac7935691c8055505b7ad8ea26e9a) Patch SQL Injection vulnerability when arrays are assigned to DataObject Fields (Aaron Carlino) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
 * 2018-12-06 [a2a207f](https://github.com/symbiote/silverstripe-multivaluefield/commit/a2a207fbeb4af6a5f2c6781b21b63ecbc1ea4ae4) Adjust MultiValueField to work with the new scalarValueOnly method (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
 * 2018-09-26 [598edd913](https://github.com/silverstripe/silverstripe-framework/commit/598edd91341f389d7b919ec1201e03d2aba4d284) Add confirmation token to dev/build (Loz Calver) - See [ss-2018-019](https://www.silverstripe.org/download/security-releases/ss-2018-019)
 * 2018-07-29 [144194600](https://github.com/silverstripe/silverstripe-framework/commit/144194600c24ac3858bea8de2dc91c8318a352be) Ignore arguments in mysqli::real_connect backtrace calls (Robbie Averill) - See [ss-2018-018](https://www.silverstripe.org/download/security-releases/ss-2018-018)

### Features and Enhancements

 * 2018-09-25 [518b6514c](https://github.com/silverstripe/silverstripe-framework/commit/518b6514cdda6496b59dcaac9020c331d03d6714) Add test for PHP 7.3 support (Sam Minnee)

### Bugfixes

 * 2019-01-30 [8e6e70335](https://github.com/silverstripe/silverstripe-framework/commit/8e6e70335895063c6e6cfd99cfcfb50c6f9c2ad9) Block Manifest of the compatibility class Object and lean on model/fieldtypes/compat/autoload.php (UndefinedOffset)
 * 2019-01-23 [746c0679a](https://github.com/silverstripe/silverstripe-framework/commit/746c0679ad1d6ceac03d2adf167367f0ca2259cd) Injector may instantiate prototypes as if they're singletons (fixes #8567) (Loz Calver)
 * 2019-01-11 [16a837d6a](https://github.com/silverstripe/silverstripe-framework/commit/16a837d6a093115755cd821c63be1e3be088645b) fix [Warning] on count() with PHP &gt;= 7.2 (lerni)
 * 2019-01-11 [eb14ac8](https://github.com/silverstripe/cwp/commit/eb14ac8dd8c4d3e83b5af92ecb2811ca903d7935) Add configuration to allow CWP to wait a few seconds before marking queued export generation jobs as complete (Robbie Averill)
 * 2018-11-15 [86701b8cd](https://github.com/silverstripe/silverstripe-framework/commit/86701b8cd0cd5f8de813a7c9347e7c8055d878f4) Redirect loop with multiple URL tokens (fixes #8607) (Loz Calver)
 * 2018-10-02 [c5201dc01](https://github.com/silverstripe/silverstripe-framework/commit/c5201dc01a69e9a0b9c84ad120104f9aeba7e86e) Allow DataObjectTest to be run by itself (Sam Minnee)
 * 2018-10-02 [ae9ab22a8](https://github.com/silverstripe/silverstripe-framework/commit/ae9ab22a8ff1b48c90f7dfe2899c09efaa65b161) Use DELETE FROM instead of TRUNCATE for clearTable (Sam Minnee)
 * 2018-10-01 [d6117630b](https://github.com/silverstripe/silverstripe-framework/commit/d6117630bdc3be78f6426cf672cda6e68762a4ba) Stricter regex syntax for PHP7.3 support. (Sam Minnee)
 * 2018-09-06 [8e871460](https://github.com/silverstripe/silverstripe-cms/commit/8e871460a86c1040c324a186f63e300494a63a78) Give Behat more memory in Travis builds (Robbie Averill)
 * 2018-09-05 [4acf401b](https://github.com/silverstripe/silverstripe-cms/commit/4acf401b71abdd593244d9d889df8dc8be524184) fixed deprecated create_function() in PHP 7.2 (zemiacsik)
 * 2018-08-13 [5f48b3e5d](https://github.com/silverstripe/silverstripe-framework/commit/5f48b3e5d202635b5bfb6d77f63d706d57c46118) txt/json is not a valid content type (Daniel Hensby)
 * 2018-07-18 [a4bf2cd1f](https://github.com/silverstripe/silverstripe-framework/commit/a4bf2cd1f301d06731dd56cb977a829fba4d7edd) Correct afterCallActionHandler arguments to match SS4. (Sam Minnee)
 * 2018-07-04 [fa7f1954b](https://github.com/silverstripe/silverstripe-framework/commit/fa7f1954be4c2548e8bfd16b07bd3537f11f839f) Fix test to match (Sam Minnee)
 * 2018-07-04 [9c9872eba](https://github.com/silverstripe/silverstripe-framework/commit/9c9872ebaccc75fda922d7fa5c93f26490ebcdde) Remove X-Requested-With from default Vary header. (Sam Minnee)
 * 2018-05-28 [d23faff](https://github.com/silverstripe/cwp-core/commit/d23faffae90c754358ed75ee94d889659ff28630) Correct assertion order in CwpStatsReportTest (Robbie Averill)

### Other changes

 * 2019-02-18 [ea33b00](https://github.com/silverstripe/cwp-installer/commit/ea33b00286aa2ef211f120585c4b0fb53256cde3) Remove obsolete CWP repository configuration (Robbie Averill)
 * 2019-01-15 [53e0f64](https://github.com/silverstripe/cwp-installer/commit/53e0f6475ad3c8eea628edc8ba33872af70d5e93) Add silverstripe-maintenance and related modules to gitignore (Robbie Averill)
 * 2019-01-08 [1bc51a1c3](https://github.com/silverstripe/silverstripe-framework/commit/1bc51a1c3949260e488b88fc2dd1fcf38b14bf39) Update Object.php (Joe Chenevey)
 * 2018-12-04 [cd47ef5](https://github.com/silverstripe/cwp/commit/cd47ef5dcba2476da1a95eb946afc7a0b68af6f0) detail what is synced in Active DR (Moss Cantwell)
 * 2018-09-27 [b74cd001](https://github.com/silverstripe/silverstripe-cms/commit/b74cd001ccd995f61190df66e3aa3cdf8ea788e1) Increase memory limit in Travis builds (Robbie Averill)
 * 2018-09-27 [ad5c2d41](https://github.com/silverstripe/silverstripe-cms/commit/ad5c2d41b48486ed9203973a77c55968daef48f9) PHP 5.3 compatibility in array syntax and use strict comparison operators (Robbie Averill)
 * 2018-09-26 [e86ac130](https://github.com/silverstripe/silverstripe-cms/commit/e86ac130a5d18fe189cb1cab530c1de541af06f4) PHP7.2 compatibility (Hendrik Schaper)
 * 2018-09-12 [8bccac1d](https://github.com/silverstripe/silverstripe-cms/commit/8bccac1d07e49803c67bc95ce11c105343f79368) do not die if there is no parent in RelativeLink (Tobias Oetiker)
 * 2018-08-13 [362c2f3b6](https://github.com/silverstripe/silverstripe-framework/commit/362c2f3b6488a1905ea5817f36dffd9f0567acb1) Make sure that CMS requests disable caching (Daniel Hensby)
 * 2018-08-09 [d9094a4](https://github.com/silverstripe/cwp/commit/d9094a40e8c261187b40e0b12ac841db964ae5ed) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-08-08 [6674e32](https://github.com/silverstripe/cwp/commit/6674e320b077337cce8e15b27db712f19f1233e3) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-07-26 [2f6d959](https://github.com/silverstripe/cwp/commit/2f6d9592d46189b1cc7df43c7e26a7093185bbbe) Update to include new feature details (Bryn Whyman)
 * 2018-07-26 [05da8cb](https://github.com/silverstripe/cwp/commit/05da8cb8aa5dac4eee1f0a28d2634f8718e2c683) DOCS Update reference to framework to include 3.7.1 (Robbie Averill)
 * 2018-07-05 [f7a0ec39](https://github.com/silverstripe/silverstripe-cms/commit/f7a0ec395ad12f532be1de4d01d157c4bc92ad1a) Unit test for class change (#2194) (Maxime Rainville)
 * 2018-07-04 [be348af3](https://github.com/silverstripe/silverstripe-cms/commit/be348af3ebca23216875802d8298201f5b9bd549) [Fix] (Squash) CMSMain::save class change (jcarter)
 * 2018-07-04 [72ce2b422](https://github.com/silverstripe/silverstripe-framework/commit/72ce2b422deecd567977c6b85270475ea0877a69) Update docs for Vary: X-Requested-With (Sam Minnee)
 * 2018-07-03 [fd7efba7d](https://github.com/silverstripe/silverstripe-framework/commit/fd7efba7d96c670ca611ad37eab99f3f52f4df8f) Make column work (Alex Saelens)
 * 2018-06-28 [d247027d0](https://github.com/silverstripe/silverstripe-framework/commit/d247027d0f8de975898872edca76f3bbd6908551) Add 'updateComponents' extend in DataObject-&gt;getComponents() (botzkobg)
