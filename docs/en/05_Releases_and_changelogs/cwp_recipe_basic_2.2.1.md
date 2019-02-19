# 2.2.1

This release includes SilverStripe 4.3.1, which contains a critical security fix for CVE-2019-5715 (SS-2018-021). See the [related blog post](https://www.silverstripe.org/download/security-releases/ss-2018-021) for details.
<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-12-18 [c0338d191](https://github.com/silverstripe/silverstripe-framework/commit/c0338d191d8be0000ddb16b74832ed8e05ba7ff5) Fix potential SQL vulnerability in non-scalar value hyrdation (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)

### Bugfixes

 * 2019-01-29 [5d74bab](https://github.com/silverstripe/cwp/commit/5d74babb02441daba5c5cc1f1eb834ec673e0595) Fix missing right click image edit options (Will Rossiter)
 * 2018-09-05 [3f9f7c6](https://github.com/silverstripe/cwp-installer/commit/3f9f7c6ba6e8fa014bea866ac9510e94ed9476d1) Use correct Email namespace in cwpadmin email configuration (Robbie Averill)

### Other changes

 * 2019-01-14 [755ec6d](https://github.com/silverstripe/cwp/commit/755ec6d600eef23d82f1e6c365dcf6e4e71c9653) Add default configuration endpoint for silverstripe/ckan-registry, if installed (Robbie Averill)
 * 2019-01-11 [6054abb](https://github.com/silverstripe/cwp/commit/6054abb7150a163560ee3f298650937b054e6753) Add PHP 7.3 to Travis builds (Robbie Averill)
 * 2018-12-12 [50aa85e](https://github.com/silverstripe/recipe-authoring-tools/commit/50aa85eb4c6f774d5d734c7dede2910fb1e03cd3) Update path to global composer bin in Travis builds (Robbie Averill)
 * 2018-12-12 [581b3cd](https://github.com/silverstripe/recipe-blog/commit/581b3cda50f17664cee9f0bd4296e8482b689af4) Bump postgresql version in Travis (Robbie Averill)
 * 2018-12-12 [5f63ef7](https://github.com/silverstripe/cwp/commit/5f63ef7e604f1a2b06033a1aab64b8a8b294550d) Add CWP 2.2.0 to changelog index, mark CWP 2.1.x as EOL from 12/06/2020 (Robbie Averill)
 * 2018-11-07 [7878059](https://github.com/silverstripe/cwp-recipe-cms/commit/7878059afaed9bfcae2fdddcae987df699d914cf) Update path to global composer bin (Robbie Averill)
 * 2018-11-07 [aebbb6e](https://github.com/silverstripe/cwp-recipe-core/commit/aebbb6e06b525edbe3b037371f3bebb6f3f2525b) Update path to global composer bin (Robbie Averill)
 * 2018-09-18 [dcd6394](https://github.com/silverstripe/cwp-recipe-cms/commit/dcd6394f74342cd8177567c5b66ca83cbadaca82) Revert "FIX Add proxy configuration for embedded cURL requests" (Robbie Averill)
