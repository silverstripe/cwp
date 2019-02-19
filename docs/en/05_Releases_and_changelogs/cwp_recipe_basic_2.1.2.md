# 2.1.2

This release includes SilverStripe 4.2.4, which contains a critical security fix for CVE-2019-5715 (SS-2018-021). See the [related blog post](https://www.silverstripe.org/download/security-releases/ss-2018-021) for details.
<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-12-18 [7cc40fe39](https://github.com/silverstripe/silverstripe-framework/commit/7cc40fe392ed907be8fbfc73579b4888840c39e6) Fix potential SQL vulnerability in non-scalar value hyrdation (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)

### Bugfixes

 * 2019-01-31 [cda9eef](https://github.com/silverstripe/silverstripe-assets/commit/cda9eef992b70fd46377be6d4459260d31ea2215) Fix for issue #212 (Joe Madden)
 * 2019-01-25 [568be8e29](https://github.com/silverstripe/silverstripe-framework/commit/568be8e29b9a6f9205dd28a823ed5294cc95a590) Misconfiguration for versioned cache segmentation (fixes #8754) (Loz Calver)
 * 2019-01-25 [0797ab7](https://github.com/silverstripe/silverstripe-asset-admin/commit/0797ab7762a4a64f2dc89c754a6bb04216b96fe1) Fix GraphQL FolderTypeCreator::resolveChildrenConnection on PostgreSQL (#901) (Serge Latyntcev)
 * 2019-01-24 [d00c59c38](https://github.com/silverstripe/silverstripe-framework/commit/d00c59c383dee270c9c1753dd8b64b8cd1b15489) Fix tests not loading fixtures and loading themes in CWP recipe kitchen sink (Robbie Averill)
 * 2019-01-17 [9ced2347](https://github.com/silverstripe/silverstripe-cms/commit/9ced23473f2f102de5b6d828d093be1102f8d570) Don't convert datalist to arraylist when filtering pages (Damian Mooyman)
 * 2019-01-13 [5c3b95ac](https://github.com/silverstripe/silverstripe-cms/commit/5c3b95ac8977f77e7d95d4da6333ca12b5ef465f) Multibyte URL routing (Ingo Schommer)
 * 2019-01-11 [2cb49ea](https://github.com/silverstripe/silverstripe-versioned/commit/2cb49ea79d6babb80289f170dc6102c82f5b0d69) [Warning] on count() with PHP &gt;= 7.2 (Lukas)
 * 2019-01-10 [34ac22802](https://github.com/silverstripe/silverstripe-framework/commit/34ac228029a4609d993e8604aad16e72bd52ac9c) Fix issue with assertListEquals() ignoring field getters (Damian Mooyman)
 * 2019-01-08 [c43f4e0](https://github.com/silverstripe/silverstripe-graphql/commit/c43f4e0708fd86e8078ef3326d963005d626baf4) Ensure queries are sorted before limiting (Damian Mooyman)
 * 2018-12-18 [3d841a4](https://github.com/silverstripe/silverstripe-installer/commit/3d841a409c43752a8192afea5ebc48327e2ac3d3) / Behat tests (Serge Latyntcev)
 * 2018-12-13 [c4a0d5f0](https://github.com/silverstripe/silverstripe-cms/commit/c4a0d5f0831f0f27022905700a0ffb86cc56aceb) Publish button text merge regression (Aaron Carlino)
 * 2018-09-27 [ce3a1ce9](https://github.com/silverstripe/silverstripe-cms/commit/ce3a1ce91307424f643a15f0c292e16b35f35873) Use correct subsites namespace in SiteTree and test classes (Robbie Averill)
 * 2019-01-11 [a32c924](https://github.com/silverstripe/cwp/commit/a32c924a7038814200730e14b72d10165f4a0c3a) Add configuration to allow CWP to wait a few seconds before marking queued export generation jobs as complete (Robbie Averill)
 * 2018-11-27 [142f31a](https://github.com/silverstripe/recipe-blog/commit/142f31a37bdc26243b9fce6a1149e4b8f7230423) Update path to global composer bin in Travis builds (Robbie Averill)
 * 2018-11-27 [a7dad10](https://github.com/silverstripe/recipe-blog/commit/a7dad1080c758c1d947e73e44a8fa8a3a87c5e64) Updated YML config now references correct commentnotifications template (Massey Isa'ako)

### Other changes

 * 2019-01-11 [6054abb](https://github.com/silverstripe/cwp/commit/6054abb7150a163560ee3f298650937b054e6753) Add PHP 7.3 to Travis builds (Robbie Averill)
 * 2018-12-12 [50aa85e](https://github.com/silverstripe/recipe-authoring-tools/commit/50aa85eb4c6f774d5d734c7dede2910fb1e03cd3) Update path to global composer bin in Travis builds (Robbie Averill)
 * 2018-12-12 [581b3cd](https://github.com/silverstripe/recipe-blog/commit/581b3cda50f17664cee9f0bd4296e8482b689af4) Bump postgresql version in Travis (Robbie Averill)
 * 2018-12-04 [2ba6d36](https://github.com/silverstripe/cwp/commit/2ba6d36c5d040ab71622cb8dd2721e3f9456f65c) detail what is synced in Active DR cwp2.x (Moss Cantwell)
 * 2018-11-08 [22d88db](https://github.com/silverstripe/recipe-authoring-tools/commit/22d88db5050713990ff2262505b2390f97b89854) Update path to global composer bin (Robbie Averill)
 * 2018-11-07 [7878059](https://github.com/silverstripe/cwp-recipe-cms/commit/7878059afaed9bfcae2fdddcae987df699d914cf) Update path to global composer bin (Robbie Averill)
 * 2018-11-07 [aebbb6e](https://github.com/silverstripe/cwp-recipe-core/commit/aebbb6e06b525edbe3b037371f3bebb6f3f2525b) Update path to global composer bin (Robbie Averill)
 * 2018-09-18 [4b4fc67](https://github.com/silverstripe/cwp-core/commit/4b4fc6778c0ce7e204c1f534ec8f01b0550930a7) Move CWP proxy configuration from oembed from recipe to cwp/cwp-core (Robbie Averill)
 * 2018-09-18 [dcd6394](https://github.com/silverstripe/cwp-recipe-cms/commit/dcd6394f74342cd8177567c5b66ca83cbadaca82) Revert "FIX Add proxy configuration for embedded cURL requests" (Robbie Averill)
