# 2.5.0

## Overview

This release includes CMS and Framework version 4.5.0.

- [Framework 4.5.0](https://docs.silverstripe.org/en/4/changelogs/4.5.0/)

Upgrading to Recipe 2.5.0 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## New features

The [release announcement](https://www.cwp.govt.nz/updates/news/cwp-2-5-has-arrived) includes the note worthy features, but be sure to review the change log for full detail of all new features.

## Known Issues

### Expected test failures

The following PHPUnit test failures are expected and do not represent functional issues in CWP:

* `SilverStripe\TextExtraction\Tests\FileTextExtractableTest::testExtractFileAsText`: This test was not correctly configured. It has been [fixed upstream](https://github.com/silverstripe/silverstripe-textextraction/commit/32e2f9f84f2f897bb71d19e69612b133e9ce88b2), and will pass in a future release.
* `Symbiote\QueuedJobs\Tests\QueuedJobsAdminTest::testConstructorParamsShouldBeATextarea`: This test was not correctly configured. It has been [fixed upstream](https://github.com/symbiote/silverstripe-queuedjobs/pull/269/commits/1814136404bb5477c8c1024bcabd47997fd535ce), and will pass in a future release.
* `Symbiote\QueuedJobs\Tests\QueuedJobsAdminTest::testCreateJobWithConstructorParams`: This test was not correctly configured. It has been [fixed upstream](https://github.com/symbiote/silverstripe-queuedjobs/pull/269/commits/1814136404bb5477c8c1024bcabd47997fd535ce), and will pass in a future release.

## Upgrading instructions

In order to update an existing site to use the new CWP recipe the following changes to your composer.json can be made:

```
"require": {
    "cwp/cwp-recipe-core": "2.5.0@stable",
    "cwp/cwp-recipe-cms": "2.5.0@stable",
    "silverstripe/recipe-blog": "1.5.0@stable",
    "silverstripe/recipe-form-building": "1.5.0@stable",
    "silverstripe/recipe-authoring-tools": "1.5.0@stable",
    "silverstripe/recipe-collaboration": "1.5.0@stable",
    "silverstripe/recipe-reporting-tools": "1.5.0@stable",
    "cwp/cwp-recipe-search": "2.5.0@stable",
    "silverstripe/recipe-services": "1.5.0@stable",
    "silverstripe/subsites": "2.3.3@stable",
    "tractorcow/silverstripe-fluent": "4.4.4@stable",
    "cwp/starter-theme": "3.0.2@stable"
},
"prefer-stable": true
```

<!--- Changes below this line will be automatically regenerated -->



## Change Log

### API Changes

 * 2019-08-26 [90f1013](https://github.com/dnadesign/silverstripe-elemental/commit/90f10134f82c3350951a2e9a3ba7d2d6701f9938) Add classname utility method to prefix class names (Maxime Rainville)

### Features and Enhancements

 * 2019-10-15 [019d806](https://github.com/dnadesign/silverstripe-elemental/commit/019d806af0e24456b00107a8e722a698bad58630) Tweak child rendering error translation key, add to lang files (Garion Herman)
 * 2019-10-09 [2c025c6](https://github.com/dnadesign/silverstripe-elemental/commit/2c025c6c69ff5a4d7caace2efbeb33d78f25890d) Introduce error boundary to Element for softer crashes (Garion Herman)
 * 2019-09-20 [5d1df63](https://github.com/dnadesign/silverstripe-elemental/commit/5d1df63122f42639eeae38d323fe0139f17c42ee) ability to configure content field replacement (Dylan Wagstaff)
 * 2019-08-20 [ed44168](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/ed4416894136a8ad789401291a6eaacfd1bdda25) Add extensions with page to allow custom behaviour on previews (Scott Hutchinson)
 * 2019-06-28 [67167c0](https://github.com/silverstripe/silverstripe-comments/commit/67167c080915e67e05f0e5b36d8a633076c02088) Add tabindex="-1" to comment submission message for a11y support (Garion Herman)

### Bugfixes

 * 2019-11-14 [1fe0938](https://github.com/silverstripe/recipe-content-blocks/commit/1fe0938959426059e4d0e80c6bfbe593188988c7) Fix travis build (Serge Latyntcev)
 * 2019-11-12 [5113339](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/51133391e9fe1e927b6bbc73bb4724d27d5ba674) Fix linting issues (Maxime Rainville)
 * 2019-11-11 [0b63d35](https://github.com/silverstripe/cwp-installer/commit/0b63d35b32d95c6f4cac0a3e702c50eefc5df550) max-age syntax in config is incorrect (brynwhyman)
 * 2019-11-11 [8b5cbf2](https://github.com/silverstripe/cwp-core/commit/8b5cbf2fd33caaf54f1309b4581dc431a2115302) max-age syntax in comments is incorrect (brynwhyman)
 * 2019-11-07 [f457e69](https://github.com/tractorcow-farm/silverstripe-fluent/commit/f457e6998cabd1b972a899a1b4b7f6c9d8dff8a2) Fix issue with localisations being randomly deleted (Damian Mooyman)
 * 2019-11-04 [32798e0](https://github.com/dnadesign/silverstripe-elemental/commit/32798e02b11ba2f9a8d117d907f9478da8ce94e0) Cancel move operation if block move data is not provided (Garion Herman)
 * 2019-11-04 [e8d5ecf](https://github.com/dnadesign/silverstripe-elemental/commit/e8d5ecfc4abf03ca7f70f54d6ed4e87f0b49649c) Correct check for block being shifted to top of list (Garion Herman)
 * 2019-10-30 [893f2d0](https://github.com/dnadesign/silverstripe-elemental/commit/893f2d0967bab7e30a443bf560778025a40ea118) Handle edgecase when Element is 'moved' to the same place (Garion Herman)
 * 2019-10-29 [21e66e5](https://github.com/dnadesign/silverstripe-elemental/commit/21e66e5713d7a4838a95741027cffcd2669f12dd) Resolve issues with drag/drop behaviour on Elements (Garion Herman)
 * 2019-10-18 [ac0b263](https://github.com/silverstripe/silverstripe-restfulserver/commit/ac0b26368386c412f011979074645787ddb36813) Restoring PHP5.6 support (Maxime Rainville)
 * 2019-10-18 [d846cd3](https://github.com/silverstripe/silverstripe-mfa/commit/d846cd3d2289bbc80dc7f1a7983d5ee152a7715a) Update react-injector to remove sourcemaps (Garion Herman)
 * 2019-10-18 [b41a2ea](https://github.com/silverstripe/silverstripe-security-extensions/commit/b41a2ea058bae64be01674910b44fe019596161d) Use trusty for Travis CI builds (Garion Herman)
 * 2019-10-18 [2781aa3](https://github.com/silverstripe/silverstripe-mfa/commit/2781aa3cde9318c27b9095072509058e9689694c) linting errors (Garion Herman)
 * 2019-10-17 [1652e9e](https://github.com/silverstripe/silverstripe-mfa/commit/1652e9e1a5adafef45694802db4510f62fc6dba3) Allow compatibility with patched releases of Subsites 2.2 (Garion Herman)
 * 2019-10-15 [d8509a4](https://github.com/tractorcow-farm/silverstripe-fluent/commit/d8509a45748bb003c4da69e22b6ba0b9e4f96af4) Support localised types specified as explicit FQN class names (Damian Mooyman)
 * 2019-10-07 [dfeb922](https://github.com/silverstripe/silverstripe-userforms/commit/dfeb922818979c764211667c26d4a4256b8c50da) Add missing import statement for SilverStripe\ORM\ValidationResult in UserDefinedFormController and EditableFileField. (Charlie Bergthaler)
 * 2019-09-23 [a8f778f](https://github.com/silverstripe/cwp-installer/commit/a8f778f764e1f16350b6a5d6f6df122da2351af3) Update Apache .htaccess for new access directives (Dylan Wagstaff)
 * 2019-09-23 [f177606](https://github.com/silverstripe/recipe-core/commit/f1776060fec34ba5ac83f1be9f88906e055b1c20) Update Apache .htaccess for new access directives (Dylan Wagstaff)
 * 2019-09-19 [e67ea14](https://github.com/tractorcow-farm/silverstripe-fluent/commit/e67ea1497159c23c0677b3975796f0f55323ec56) Warn during dev/build if fluent extension is applied in too many, or the wrong places (Damian Mooyman)
 * 2019-09-19 [3bdaffe](https://github.com/tractorcow-farm/silverstripe-fluent/commit/3bdaffe9e9887c100933751e7e6cdb14d8a944c1) Don't use unsecure cookies if session is secure (Damian Mooyman)
 * 2019-09-12 [5b74459](https://github.com/silverstripe/silverstripe-mfa/commit/5b74459e93124f0d34a65a799a110c478b40435d) Re-fix the Notification.REGISTERED/REMOVED translations (Garion Herman)
 * 2019-09-06 [0348e5d](https://github.com/silverstripe/silverstripe-userforms/commit/0348e5dd15cc43c843c1d3eb9a182bdfac4f5633) fix(submitted-form): Pass member to parent calls (Marco (Valandur))
 * 2019-09-05 [696fa1d](https://github.com/silverstripe/silverstripe-userforms/commit/696fa1d05ea213847438cfe4e89f0d895b4fef74) fix(submitted-form): canCreate not checking parent (Marco (Valandur))
 * 2019-09-03 [ec27b70](https://github.com/dnadesign/silverstripe-elemental/commit/ec27b702fd3a2eddec8d2995bfd9a9626b7f5812) allow extending function by extension even if $page is null (Jules)
 * 2019-08-28 [b996f05](https://github.com/dnadesign/silverstripe-elemental/commit/b996f05150246da93572692ddf87191f440ea028) AddElementPopoverComponent target on HoverBar wasn't matching an actual target. (Maxime Rainville)
 * 2019-08-28 [1913ee5](https://github.com/dnadesign/silverstripe-elemental/commit/1913ee51b67b937688b6d1346ec5bb85fe4d8ed2) Remove unused method from AddElementPopover (Maxime Rainville)
 * 2019-08-22 [953b6d9](https://github.com/dnadesign/silverstripe-elemental/commit/953b6d96283883c542f630b718dbc90b448e72cf) Make the HoverBar in-between block more visible (Maxime Rainville)
 * 2019-08-22 [12deace](https://github.com/silverstripe/cwp/commit/12deacebba7c1b904c8c7d40eed476bb886f9b20) Use SS_Object for PHP 7.2 compatibility (Robbie Averill)
 * 2019-08-20 [0928fda](https://github.com/silverstripe/cwp/commit/0928fda3998ea33cea7c8fac93c8a2d9a9432e1f) DatedUpdateHolder should use aggregated columns for better MySQL version support (Guy Marriott)
 * 2019-08-20 [a6002d5](https://github.com/dnadesign/silverstripe-elemental/commit/a6002d57aa2c3f7bfdf7f0667bc2e3b558be7b46) Fix 'User help guide' link in Introduction section (benwrighton)
 * 2019-08-20 [671e1b1](https://github.com/silverstripe/cwp/commit/671e1b15d86bf66eccbe7f3f779b1f1376e4a4ed) Ensure PHP 7.2+ compatibility (Guy Marriott)
 * 2019-08-15 [a62539e](https://github.com/dnadesign/silverstripe-elemental/commit/a62539eca44e1beb1c4341786ba03ee3d4edd852) Remove pagination on blocks so more than 100 blocks appear in editor (Guy Marriott)
 * 2019-08-15 [09c94b8](https://github.com/dnadesign/silverstripe-elemental/commit/09c94b8345e8122c2ad7c889b9dadcad941c61a0) Restore the statusbar to TinyMCE in blocks (and the drag handle with it) (Guy Marriott)
 * 2019-08-14 [50c476c](https://github.com/dnadesign/silverstripe-elemental/commit/50c476ca85fb5ae0ef27d78d2cf712df59b53bac) Reorder block actions (Maxime Rainville)
 * 2019-08-02 [1946337](https://github.com/tractorcow-farm/silverstripe-fluent/commit/19463371657978264a0f4955fb5cc5f338968b2e) Fixed  missing -&gt; operator. (taoceanz)
 * 2019-07-31 [5e9601b](https://github.com/silverstripe/silverstripe-login-forms/commit/5e9601be63268c81e2d1a9a0971aff39d1122c46) Unlock text from forcing horizontal scroll (Dylan Wagstaff)
 * 2019-07-29 [9176406](https://github.com/silverstripe/silverstripe-subsites/commit/917640699d344b0686de7e16994bd5242cc80abb) Prevent undefined index notice when trying to determine HTTP… (#440) (Guy Marriott)
 * 2019-07-26 [9a7cdbb](https://github.com/silverstripe/silverstripe-subsites/commit/9a7cdbbe2d59518d83f04da726c821ced35ea663) Prevent undefined index notice when trying to determine HTTP_HOST during dev/build (Robbie Averill)
 * 2019-07-15 [c0f0c99](https://github.com/silverstripe/silverstripe-comments/commit/c0f0c99e5624e3de0bb3a907e27280c38aad6de8) CommentAdmin implements PermissionProvider (Jason Irish)
 * 2019-07-12 [58f8980](https://github.com/silverstripe/silverstripe-subsites/commit/58f89801b09e6945dd93529843340948ccb10e03) Ensure constant is accessed correctly (Guy Marriott)
 * 2019-05-31 [2eb04ff](https://github.com/silverstripe/silverstripe-subsites/commit/2eb04ffa7894e145a29c3cfea34d9d850515f014) Improving support for cascading themes (Guy Marriott)
 * 2019-05-20 [3142b35](https://github.com/silverstripe/recipe-core/commit/3142b3531689eb7d17a461ebb1db99934c7d52bb) #42: Remove excess RewriteCond and clean up comments to reflect current functionality. (Patrick Nelson)
 * 2019-05-08 [0b39d8c](https://github.com/symbiote/silverstripe-queuedjobs/commit/0b39d8c7352305c873a70ee6990f5e39e5018d66) Fix(mutex) make the mutex update check for finished or running jobs (Stephen McMahon)
 * 2019-05-08 [8a7327b](https://github.com/silverstripe/recipe-core/commit/8a7327bad1369255ecc5689b9643e0e5361eb5a4) Fix travis dependencies (Aaron Carlino)
 * 2019-04-18 [6cb26dc](https://github.com/silverstripe/silverstripe-akismet/commit/6cb26dc634e17c48f400bbfbac0c85483c2af3ba) fixed confirmationField (setError is depreciated) (Makreig)
 * 2019-04-15 [f63973f](https://github.com/silverstripe/recipe-core/commit/f63973f062757f7faa90358d411e9070cb74f277) Disable uneeded File ID Helper on new project (Maxime Rainville)
 * 2019-03-18 [398457e](https://github.com/silverstripe/silverstripe-ckan-registry/commit/398457e4c650a49d9d833b4752ab18577c114a7d) Column source checkbox now no longer has a left margin override - fixes checkbox indentation (Robbie Averill)
 * 2018-10-30 [d1eae39](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/d1eae3934886151e308f74cb68c198e377a436d7) Use Configurable trait (James Ayers)

### Other changes

 * 2019-12-17 [1bb0b0f](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/1bb0b0f88aaf1f1b138bfbddac87b71fcd248ec3) Update development dependencies (Garion Herman)
 * 2019-12-17 [b7ef67c](https://github.com/silverstripe/recipe-content-blocks/commit/b7ef67cfdfa19fb40b23ac97fd397a7dd239b400) Update development dependencies (Garion Herman)
 * 2019-12-17 [d9de0db](https://github.com/silverstripe/cwp-installer/commit/d9de0db7d8bb61832c64e12b652b24995daa8e74) Update development dependencies (Garion Herman)
 * 2019-12-17 [9b837dd](https://github.com/silverstripe/recipe-authoring-tools/commit/9b837dd478d6258fa9ef373e5295e6d977fe6678) Update development dependencies (Garion Herman)
 * 2019-12-17 [7b7a697](https://github.com/silverstripe/recipe-reporting-tools/commit/7b7a6975cc512b7dc236c76ecbaceb9e4dbeefdb) Update development dependencies (Garion Herman)
 * 2019-12-17 [62ae41c](https://github.com/silverstripe/recipe-collaboration/commit/62ae41cfa983a04f7ad003bb97d7873f0005799c) Update development dependencies (Garion Herman)
 * 2019-12-17 [3a010e2](https://github.com/silverstripe/recipe-authoring-tools/commit/3a010e28712c652f283905485a023dcbebe5a7f0) Update development dependencies (Garion Herman)
 * 2019-12-17 [6626989](https://github.com/silverstripe/recipe-form-building/commit/6626989177410bcbd79fbf15aa4fec91f6419c58) Update development dependencies (Garion Herman)
 * 2019-12-17 [2dc6819](https://github.com/silverstripe/recipe-blog/commit/2dc6819e46949465f8bc6b10e0ea00c447a877ab) Update development dependencies (Garion Herman)
 * 2019-12-17 [58d289c](https://github.com/silverstripe/cwp-recipe-cms/commit/58d289c73f3e80c602a5bfffadae40c17c8e7e3b) Update development dependencies (Garion Herman)
 * 2019-12-17 [f1dfdf8](https://github.com/silverstripe/cwp-recipe-core/commit/f1dfdf82632ab7b0908ca5c1bbc3e994da595b69) Update development dependencies (Garion Herman)
 * 2019-12-17 [674e1e3](https://github.com/silverstripe/recipe-core/commit/674e1e3f7b4ad4a651b32f4284482039f1cacda9) Update development dependencies (Serge Latyntcev)
 * 2019-11-18 [41ca970](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/41ca97097d6c4906fc8a201f2f971afa7d3584fe) Update development dependencies (Garion Herman)
 * 2019-11-18 [bcd9a01](https://github.com/silverstripe/recipe-content-blocks/commit/bcd9a01c10ae4f3e9c5b5f906a474670f890097d) Update development dependencies (Garion Herman)
 * 2019-11-18 [b4b8ff9](https://github.com/silverstripe/cwp-installer/commit/b4b8ff9cc7e65735e9e2df2507ba6da58b073710) Update development dependencies (Garion Herman)
 * 2019-11-18 [76b8fef](https://github.com/silverstripe/recipe-authoring-tools/commit/76b8fefa04e4e18b81c5d52edfcc40d50d21153b) Update development dependencies (Garion Herman)
 * 2019-11-18 [3268dcc](https://github.com/silverstripe/cwp-recipe-search/commit/3268dcc86823a3a75d6f346e23ea4307b452d822) Update development dependencies (Garion Herman)
 * 2019-11-18 [17cde56](https://github.com/silverstripe/recipe-reporting-tools/commit/17cde566338f424abb17b4795e1090637e30b922) Update development dependencies (Garion Herman)
 * 2019-11-18 [1795aeb](https://github.com/silverstripe/recipe-collaboration/commit/1795aebbf27f911f4791568138f330468ea88e64) Update development dependencies (Garion Herman)
 * 2019-11-18 [753eb0e](https://github.com/silverstripe/recipe-authoring-tools/commit/753eb0ea0e8120ab031dba29b9d2e4b425b5b135) Update development dependencies (Garion Herman)
 * 2019-11-18 [2200cb3](https://github.com/silverstripe/recipe-form-building/commit/2200cb37e1e8ab3224ea2b5b572a8542918fc20a) Update development dependencies (Garion Herman)
 * 2019-11-18 [d5b302c](https://github.com/silverstripe/recipe-blog/commit/d5b302c3c5ca30b2e76070222f1e6c732ff210b2) Update development dependencies (Garion Herman)
 * 2019-11-18 [3116957](https://github.com/silverstripe/cwp-recipe-cms/commit/3116957195ba114f3c8617fcc73a9045ea5ec03c) Update development dependencies (Garion Herman)
 * 2019-11-18 [17e4726](https://github.com/silverstripe/cwp-recipe-core/commit/17e4726de0c0f14146b6aa0d5ad93e6a890968d0) Update development dependencies (Garion Herman)
 * 2019-11-18 [e87107b](https://github.com/silverstripe/recipe-cms/commit/e87107b4177869f9b8b046e38ed438ca4fc84e97) Update development dependencies (Serge Latyntcev)
 * 2019-11-18 [e1bedfd](https://github.com/silverstripe/recipe-authoring-tools/commit/e1bedfd711b39c6d11af2b5166b1ba454ee6bc16) Update to CMS 4.5 (Garion Herman)
 * 2019-11-18 [f5aa73b](https://github.com/silverstripe/recipe-cms/commit/f5aa73baaebdd3124558a2c5bcab7689889c319f) Update Travis config to Xenial (Garion Herman)
 * 2019-11-17 [d0b6181](https://github.com/silverstripe/silverstripe-comments/commit/d0b6181b4837737ea476492fa700349b88047dd8) Update config for 3.3 / CMS 4.5 branches (Garion Herman)
 * 2019-11-15 [3643275](https://github.com/dnadesign/silverstripe-elemental/commit/36432754cb7f61f1f41808fe3e13d4b97149632d) Update travis for 4.3 (Serge Latyntcev)
 * 2019-11-15 [cc2526a](https://github.com/silverstripe/silverstripe-userforms/commit/cc2526aac48d7d2f52f29ce0da602260808f4f63) Update Composer / Travis configuration for Userforms 5.5 release (Garion Herman)
 * 2019-11-14 [0ce38c0](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/0ce38c0246e40255971ca9e20131fc9410454d35) Update Composer config to CMS 4.5 / CWP 2.5 series (Garion Herman)
 * 2019-11-14 [c344179](https://github.com/silverstripe/cwp-installer/commit/c344179afa21be354584c7e25c1bf4238d055d82) Update Composer / Travis config to CMS 4.5 / CWP 2.5 series (Garion Herman)
 * 2019-11-14 [d34486b](https://github.com/silverstripe/recipe-authoring-tools/commit/d34486becaea4d8db2432057de47cf260ddc300b) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [a7f6ce0](https://github.com/silverstripe/recipe-form-building/commit/a7f6ce03828e3527f74b33a1279205393a3cb36f) Update Composer / Travis config to CMS 4.5 series (Garion Herman)
 * 2019-11-14 [635e205](https://github.com/silverstripe/recipe-collaboration/commit/635e205ba1ba35c4fdcde030ce23fd90bdd1dc93) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [9430cb2](https://github.com/silverstripe/recipe-blog/commit/9430cb20ba9f58ea6fa2afb36c1b245f6d1aa868) Update Composer / Travis config to CMS 4.5 series (Garion Herman)
 * 2019-11-14 [5e1640b](https://github.com/silverstripe/recipe-reporting-tools/commit/5e1640bdb5f197fe891be0ccc4d2d3703857d1d9) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [fca6c31](https://github.com/silverstripe/cwp-recipe-cms/commit/fca6c31d73906b25246b676fce3d385fc25a2648) Update Composer / Travis config to CMS 4.5 / CWP 2.5 series (Garion Herman)
 * 2019-11-14 [186c872](https://github.com/silverstripe/cwp-recipe-search/commit/186c872c4cc67a88260d469d5d86648cebe93dc4) Create 2.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [f101c75](https://github.com/silverstripe/cwp-recipe-core/commit/f101c75ef543b79c66915801b6365dae5abdc004) Update Composer / Travis config to CMS 4.5 / CWP 2.5 series (Garion Herman)
 * 2019-11-14 [2c08929](https://github.com/silverstripe/recipe-authoring-tools/commit/2c08929e6dbb9e51ff6d86cedcb0723bd4821aff) Create 1.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [e5d8980](https://github.com/silverstripe/recipe-content-blocks/commit/e5d89801081670b9a51082e004d41f39d6f89afb) Create 2.5 minor branch (Serge Latyntcev)
 * 2019-11-14 [023109a](https://github.com/silverstripe/cwp-core/commit/023109a172cfb9e38a10e457da83821c9c551d0f) Update Composer requirements to CMS 4.5 (Garion Herman)
 * 2019-11-14 [c214a55](https://github.com/silverstripe/cwp/commit/c214a55f29a1042356b87d143280951860b81467) Update Travis config to test 2.5 series (Garion Herman)
 * 2019-11-14 [58a4e04](https://github.com/silverstripe/recipe-cms/commit/58a4e04e8828faf5f8f319f650a7b72ac82f41e0) Remove obsolete branch-alias (Serge Latyntcev)
 * 2019-11-14 [8e3498d](https://github.com/silverstripe/recipe-core/commit/8e3498d850ee881f04d5d5be37322c95667edf4a) Remove obsolete branch-alias (Serge Latyntcev)
 * 2019-11-11 [05c5cb6](https://github.com/silverstripe/silverstripe-comments/commit/05c5cb64a7f0d5a91bd93abc389ba4139622e561) Restore empty comments.css file (Maxime Rainville)
 * 2019-11-11 [df6fa16](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/df6fa16553ee7a0c437aa924340b773315908663) Upgrade dependencies (Maxime Rainville)
 * 2019-11-11 [ae53b88](https://github.com/silverstripe/silverstripe-security-extensions/commit/ae53b8836c37a3ba694d9a672133c7cb984054a9) Upgrade dependencies (Maxime Rainville)
 * 2019-11-11 [b92143a](https://github.com/silverstripe/silverstripe-userforms/commit/b92143a7764d5036e43120430745965f4a4dd55d) Upgrade dependencies (Maxime Rainville)
 * 2019-11-11 [69395ea](https://github.com/silverstripe/silverstripe-blog/commit/69395eaeaa6f4cf77fa02ea9d4da1acbc5679efb) Add jQuery dependency (Maxime Rainville)
 * 2019-11-11 [74be25c](https://github.com/silverstripe/silverstripe-segment-field/commit/74be25c43cebbe867ccf43f661f1cd0d2ef3bf56) Removing superfluous legacy linting exclusion (Maxime Rainville)
 * 2019-11-11 [ef241e2](https://github.com/silverstripe/cwp/commit/ef241e2f52350362cda354388f6a4ee2a60a08e0) Update composer.json for the major branch 2; patch travis configs (Serge Latyntcev)
 * 2019-11-10 [85374a1](https://github.com/silverstripe/silverstripe-comments/commit/85374a1f7677917c1f1cafe9e942d68bb48a341e) Upgrade dependencies and build settings (Maxime Rainville)
 * 2019-11-10 [ceb82ea](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/ceb82ea8f41050b3f59fdd688abaa52ed7d37569) Update composer.json for the major branch 2 (Serge Latyntcev)
 * 2019-11-10 [19a6b3f](https://github.com/silverstripe/cwp-installer/commit/19a6b3fcbf913f9a9d4b6a0524e59b96c311269d) Patch composer.json for the major branch 2; update travis configs (Serge Latyntcev)
 * 2019-11-10 [4349bd3](https://github.com/silverstripe/recipe-blog/commit/4349bd3ae8a2e3f6359b7450091e23a63c9b284a) Patch up composer.json for the major branch 1 (Serge Latyntcev)
 * 2019-11-08 [d1e8b51](https://github.com/silverstripe/silverstripe-blog/commit/d1e8b518a6b75dfe40aefc533b15cb5378465de4) Upgradeing dependencies (Maxime Rainville)
 * 2019-11-08 [73ca615](https://github.com/silverstripe/recipe-form-building/commit/73ca615cd41b3f6cb0712d48663661c5432488d6) Patch up the composer.json for the major branch 1 (Serge Latyntcev)
 * 2019-11-08 [d51020a](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/d51020ad563bb4daecd3ae8c7b7814cd64440241) Upgrade dependencies (Maxime Rainville)
 * 2019-11-07 [d0d5a03](https://github.com/silverstripe/cwp-recipe-cms/commit/d0d5a033f8d93ba1e9d887d2fbb16eafd9f1cb76) Patch up the composer.json for the major branch 2 (Serge Latyntcev)
 * 2019-11-07 [b49fb04](https://github.com/silverstripe/cwp-recipe-core/commit/b49fb04de947e1713c4c787ebfa53a1a7c1fe470) Patch up the composer.json for the major branch 2 (Serge Latyntcev)
 * 2019-11-07 [81ac515](https://github.com/silverstripe/silverstripe-segment-field/commit/81ac51562d3cea1e051ef909006be156686a3651) Upgrade JS dependencies and JS build setup (Maxime Rainville)
 * 2019-11-04 [d567ae1](https://github.com/tractorcow-farm/silverstripe-fluent/commit/d567ae1cf942e23d927383b15aa7621439d7c4a4) Bump sshpk from 1.13.1 to 1.16.1 (dependabot[bot])
 * 2019-11-03 [ca507f6](https://github.com/tractorcow-farm/silverstripe-fluent/commit/ca507f6005b6c504d97317ec311e5b200d41e714) Bump macaddress from 0.2.8 to 0.2.9 (dependabot[bot])
 * 2019-11-03 [b207d74](https://github.com/tractorcow-farm/silverstripe-fluent/commit/b207d74a6c9b3b7225fea56f3ad7c746e4a220a6) Manual merge of https://github.com/tractorcow-farm/silverstripe-fluent/pull/564 (Damian Mooyman)
 * 2019-11-03 [dd626c5](https://github.com/tractorcow-farm/silverstripe-fluent/commit/dd626c52948e11872e13f316fecd21b7a95fdb98) Bump merge from 1.2.0 to 1.2.1 (dependabot[bot])
 * 2019-11-01 [483dd76](https://github.com/dnadesign/silverstripe-elemental/commit/483dd7633e402ecbf6409ab2000bbd7b59d05622) Upgrde dependencies (Maxime Rainville)
 * 2019-10-25 [50a6032](https://github.com/dnadesign/silverstripe-elemental/commit/50a6032b2ccd1b6bf08f5405b8f2502ca7ddfc73) Make sure ignored_classes are ignored (#742) (Guy Marriott)
 * 2019-10-25 [7eee13f](https://github.com/dnadesign/silverstripe-elemental/commit/7eee13ff45f243868b810ccad96273d559589c01) Make sure ignored_classes are ignored (Remy Vaartjes)
 * 2019-10-24 [485f112](https://github.com/dnadesign/silverstripe-elemental/commit/485f1125ec67868c6ef259fc07362259ab5c35c1) DOCS Update Adding blocks between blocks image and content (#741) (Guy Marriott)
 * 2019-10-24 [ebe5b96](https://github.com/dnadesign/silverstripe-elemental/commit/ebe5b96935afbf657551269330636e9e624f1edb) DOCS Update Adding blocks between blocks image and content (Sacha Judd)
 * 2019-10-18 [ba5fb9d](https://github.com/silverstripe/silverstripe-security-extensions/commit/ba5fb9d3292ec3b6f0fbd8fe89fe3b493fb6aab1) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])
 * 2019-10-15 [b6da3ec](https://github.com/silverstripe/cwp-core/commit/b6da3ec935e60f33f4011d3e591d030732ab6fc3) composer.json for the branch 2.x-dev (Serge Latyntcev)
 * 2019-10-03 [250e522](https://github.com/silverstripe/silverstripe-comments/commit/250e522887d43fe0da3cdb9f72b6641e7f4afe5b) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])
 * 2019-10-03 [d5b9a28](https://github.com/silverstripe/silverstripe-comments/commit/d5b9a2818c5de4f31733c9abd364c3fc2fd86b9f) Update Installing.md (AdamSawoscianik)
 * 2019-09-30 [a8e3f40](https://github.com/dnadesign/silverstripe-elemental/commit/a8e3f40ecc3ec8137a85040e69fd9c1f8ceb5737) Add config to replace content field (#732) (Guy Marriott)
 * 2019-09-27 [fad4b4c](https://github.com/silverstripe/cwp/commit/fad4b4c31eacdf5f96a146a73c97dc8de838db8f) Update docs/en/05_Releases_and_changelogs/cwp_recipe_basic_1.9.3.md (Dylan Wagstaff)
 * 2019-09-27 [9ba147a](https://github.com/silverstripe/cwp/commit/9ba147a3a292dfcf2eb240f860c98e2f733de28b) Update the 1.9.3 release docs re: MFA again (Dylan Wagstaff)
 * 2019-09-26 [2039b93](https://github.com/silverstripe/cwp/commit/2039b93d6114bf01f89ca2f86be6a3ea17cae402) 1.9.3 release notes tweaks per review (Dylan Wagstaff)
 * 2019-09-26 [30a5de7](https://github.com/silverstripe/cwp/commit/30a5de7c8531c7d29d1b76a82c6bb977054c3bed) Update 1.9.3 changelog with MFA installation instructions (Dylan Wagstaff)
 * 2019-09-24 [1e71b7a](https://github.com/silverstripe/recipe-core/commit/1e71b7a258496f3046685405973a3b9d613ebc01) Update TravisCI config for old dist so builds will pass (Dylan Wagstaff)
 * 2019-09-19 [c7d4745](https://github.com/tractorcow-farm/silverstripe-fluent/commit/c7d47457f186b865035c9fc599644e8698c02c1e) DOCS Describe how to mutate state programatically (Damian Mooyman)
 * 2019-09-19 [a2f060b](https://github.com/silverstripe/cwp/commit/a2f060bccc9d7ac885b9d9689752686fa5aa0538) Update support log for recent 1.9.3 release (Dylan Wagstaff)
 * 2019-09-18 [24ac3a9](https://github.com/silverstripe/cwp/commit/24ac3a9833b605cead8549f62e761d03b7906454) DOCS add post-2020 note to changlog index (brynwhyman)
 * 2019-09-12 [eedb534](https://github.com/silverstripe/cwp/commit/eedb53446d9ec82dd59075f5e97655d362665057) Amended release list to reflect 2.4.0 tracking 4.4.3 (Garion Herman)
 * 2019-09-12 [602de88](https://github.com/silverstripe/cwp/commit/602de88484f2c771c0df1d375a1a1022ddbc60af) DOC Temporarily revert 2.4.0 release (Garion Herman)
 * 2019-09-12 [263d71f](https://github.com/silverstripe/silverstripe-mfa/commit/263d71fdbd4e89d9abf520feb66559cd2584b222) Re-build client files with new translations (Garion Herman)
 * 2019-09-09 [76c3576](https://github.com/silverstripe/silverstripe-userforms/commit/76c3576de6e340654e36388564e2790d1637044f) Update travis yaml 'dist:' version (Dylan Wagstaff)
 * 2019-09-03 [cd7dd78](https://github.com/dnadesign/silverstripe-elemental/commit/cd7dd78bd56c8ff4d2cd0b2068b1e6657f034c68) Add configuration to allow not replacing the 'Content' field to enable backwards compatibility with older content blocks modules. (Charlie Bergthaler)
 * 2019-09-03 [51da698](https://github.com/dnadesign/silverstripe-elemental/commit/51da6982820c843781653b68c32726c5fe898d6c) set  to null if  is not present and allow extending at this point (#731) (Guy Marriott)
 * 2019-09-03 [384a01e](https://github.com/silverstripe/cwp/commit/384a01eb921cd63099bcfaaa3531c1ca975a7169) DOCS correct 1.9 release description (Bryn Whyman)
 * 2019-09-02 [aa860e3](https://github.com/silverstripe/recipe-core/commit/aa860e365a484f25aa8be20131656ab84ef73101) Remove installer public files (Aaron Carlino)
 * 2019-08-30 [47de7ef](https://github.com/dnadesign/silverstripe-elemental/commit/47de7ef52891568657167598d15b60e615832feb) Set the number of rows config in HTMLEditor field (Ishan Jayamanne)
 * 2019-08-29 [28ec057](https://github.com/bringyourownideas/silverstripe-maintenance/commit/28ec057efe6858eec400e0d2b85ed3323c39d4de) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])
 * 2019-08-29 [a2918f6](https://github.com/dnadesign/silverstripe-elemental/commit/a2918f6bb44860631ee750f2d3c41f6c12259f44) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])
 * 2019-08-27 [ce72d57](https://github.com/dnadesign/silverstripe-elemental/commit/ce72d57a5e15f39f384ad416f2b0adef20aaf374) Answer PR feedback (Maxime Rainville)
 * 2019-08-26 [f9e2992](https://github.com/dnadesign/silverstripe-elemental/commit/f9e299227ff2b2359f57514861d24d04e393dfcf) Doc type of cssPrefix argument (Maxime Rainville)
 * 2019-08-26 [0160e43](https://github.com/dnadesign/silverstripe-elemental/commit/0160e4302ebfd270be82b1343c770fa279eb32c3) Bring back element-editor top class wrapper (Maxime Rainville)
 * 2019-08-22 [ccbcc3b](https://github.com/silverstripe/cwp/commit/ccbcc3b16cf7bd6ebcf0f65d13b1f5640c79ae8e) Remove invalid PHP 7.2 statement (Guy Marriott)
 * 2019-08-22 [8d2367d](https://github.com/silverstripe/cwp/commit/8d2367df8b61cb390af857248f8288073bf1c3e8) Update index.md with more appropriate CWP 1.9.2 description (Guy Marriott)
 * 2019-08-19 [3e2b5ae](https://github.com/silverstripe/cwp/commit/3e2b5ae9e01215611d80985d129e601db83cdefb) DOCS Update incorrecty 1.9.2 reference (Guy Marriott)
 * 2019-08-15 [1108756](https://github.com/silverstripe/cwp-core/commit/1108756119fd36790ba1ecd30076c555eb3075f2) Alias 2.x-dev as 2.5.x-dev (Robbie Averill)
 * 2019-08-15 [05814bd](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/05814bdc52d5b04d55cc0d32c147e46cd0c266f6) Increase memory limit to 2G in Travis (Robbie Averill)
 * 2019-08-15 [9ef88c6](https://github.com/silverstripe/cwp-recipe-core/commit/9ef88c68fa95fa09e0d5a0b6436b5910d08a4708) Increase SilverStripe to 4.5.x (Robbie Averill)
 * 2019-08-15 [50e24a4](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/50e24a40ce691e05f8c2b26623f913214fa926b4) Use trusty distro in Travis builds (Robbie Averill)
 * 2019-08-15 [5b23043](https://github.com/silverstripe/silverstripe-segment-field/commit/5b23043bc618523568453054db441595edeab148) Use trusty distro in Travis builds and update tested SilverStripe versions (Robbie Averill)
 * 2019-08-15 [99f8643](https://github.com/silverstripe/recipe-authoring-tools/commit/99f8643f3fd81bf62fa59172de4b3168cd227965) Update root version in Travis (Robbie Averill)
 * 2019-08-15 [4426374](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/4426374173eb43d247ad0f9ce00d4ca62f8f98e6) Use trusty distro in Travis builds and update tested SilverStripe versions (Robbie Averill)
 * 2019-08-15 [f8edb71](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/f8edb716ec9af6ddb3df8eef9c393a2fede8daea) Use trusty distro in Travis builds and update tested SilverStripe versions (Robbie Averill)
 * 2019-08-15 [4be2e24](https://github.com/silverstripe/cwp-recipe-core/commit/4be2e24673244db3c15f4a5e750896b7945b0653) Update dependencies for SilverStripe 4.5 (Robbie Averill)
 * 2019-08-15 [9382688](https://github.com/silverstripe/cwp-core/commit/9382688d65472c526464bf40da22f4d2d0e554ad) Update SilverStripe to 4.5 (Robbie Averill)
 * 2019-08-04 [76cb1d8](https://github.com/silverstripe/recipe-form-building/commit/76cb1d83ef881eda3b96d0f33c27c73c613fc2d1) Use trusty distro in Travis builds (Robbie Averill)
 * 2019-08-04 [be55c0d](https://github.com/silverstripe/recipe-collaboration/commit/be55c0dc4379eff760a299e21a8219a0d4b16ece) Use trusty distro in Travis builds (Robbie Averill)
 * 2019-08-02 [02def5f](https://github.com/dnadesign/silverstripe-elemental/commit/02def5f62b612b844e89f42a9b0cc64f8bbb6d7f) DOCS Searching blocks (Ingo Schommer)
 * 2019-08-02 [8805e73](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/8805e7335864212f4446e40db7874432647f7c50) Use trusty distro in Travis builds (Robbie Averill)
 * 2019-07-29 [09abe2b](https://github.com/silverstripe/silverstripe-subsites/commit/09abe2b2f2dc405fca8e876fd372399980d2f146) Use Director::host() over direct $_SERVER access (Robbie Averill)
 * 2019-07-22 [b0653f4](https://github.com/silverstripe/cwp/commit/b0653f452de7bbcbc60e54647b4e575dce4bd9be) Update Travis matrix (Robbie Averill)
 * 2019-07-22 [aa580ab](https://github.com/silverstripe/cwp/commit/aa580ab7c4daf47eb2412483937bdc9ecef3884f) Update phpunit (Robbie Averill)
 * 2019-07-22 [6715ed2](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/6715ed281908d5867a9ba648d5f0192c930ae9fe) DOCS Add troubleshooting section for Page and PageController parent classes (Robbie Averill)
 * 2019-07-16 [75bec8c](https://github.com/silverstripe/silverstripe-userforms/commit/75bec8ceb294768dae61deb57590fa9844974ef4) Enable better button functionality (#897) (Guy Marriott)
 * 2019-07-15 [8703ace](https://github.com/silverstripe/silverstripe-userforms/commit/8703ace32a0242c822f4bc04c690ca4b12cbc7af) validate that a classname had been set (Bram de Leeuw)
 * 2019-07-12 [e80795b](https://github.com/silverstripe/silverstripe-userforms/commit/e80795b52d3321aaafa4a02612bd9b98c641470f) Add a comment for clarity (Bram de Leeuw)
 * 2019-07-08 [d489271](https://github.com/silverstripe/silverstripe-userforms/commit/d4892711977018a51b215c7536e624868e245041) Disable add action in Submissions detail form (Remy Vaartjes)
 * 2019-07-08 [f682e74](https://github.com/silverstripe/silverstripe-userforms/commit/f682e74f440e24cb58aa62591f5b84cc581ef895) Enable 4.4 better button functionality (Remy Vaartjes)
 * 2019-07-07 [0ba849e](https://github.com/silverstripe/silverstripe-login-forms/commit/0ba849e94468fd104c02349f83b6f18bab906adb) Docs and extendable config (#32) (Guy Marriott)
 * 2019-07-05 [86de04f](https://github.com/silverstripe/silverstripe-login-forms/commit/86de04f8fb5dbcff224ef9fefc3c302e27f2c24f) More docs (Ingo Schommer)
 * 2019-07-05 [67e1b3b](https://github.com/silverstripe/silverstripe-login-forms/commit/67e1b3b9bec3a1d95cd87357efe8b546a8a6cd98) Moving theme config to YAML (Ingo Schommer)
 * 2019-07-05 [9e5e7ba](https://github.com/silverstripe/cwp/commit/9e5e7ba39e47834006253519ee43a3f39a238002) DOCS add reference to 2.3.1 release (Bryn Whyman)
 * 2019-07-02 [cad9369](https://github.com/silverstripe/silverstripe-comments/commit/cad9369f7b580782bcea0a446b2eb79bbd60bbb3) Add legacy YAML for upgrading (Will Rossiter)
 * 2019-07-01 [c152c03](https://github.com/silverstripe/cwp/commit/c152c03df3d2270302156db368153c3d802efa24) DOCS Clarify public/.htaccess (Ingo Schommer)
 * 2019-06-28 [45b3bc5](https://github.com/silverstripe/cwp/commit/45b3bc5b3ab15dfe1fbc01e18a9b0032836bf7ff) Change casing in cURL (Robbie Averill)
 * 2019-06-28 [65a207e](https://github.com/silverstripe/cwp/commit/65a207e3d46542784f741b17275152157dd61292) Add note on allow_url_fopen / fopen / file_get_contents (madmatt)
 * 2019-06-27 [0114ea4](https://github.com/silverstripe/silverstripe-userforms/commit/0114ea4275475c8079130d9519641c0b093aab8e) Remove SilverStripe 4.0-4.2 from Travis builds (Robbie Averill)
 * 2019-06-25 [7d27abf](https://github.com/silverstripe/silverstripe-subsites/commit/7d27abf2b1bab1251d26e30342c99f0153403f8e) Update expected json content type in unit test (Robbie Averill)
 * 2019-06-14 [2d0d949](https://github.com/silverstripe/silverstripe-comments/commit/2d0d949fc36073afbbe9f41ab2e19f0b9d4a73c0) Update @silverstripe/webpack-config to patch vulnerable deps (Garion Herman)
 * 2019-06-14 [14675b5](https://github.com/silverstripe/silverstripe-comments/commit/14675b53bff4c809b2cdd8a48a657187edc18f2c) Add NVM config (Garion Herman)
 * 2019-06-12 [7014605](https://github.com/silverstripe/silverstripe-userforms/commit/701460505ee53244ab311a945cf3339c5b7e1cac) Form submission now triggers an event (Adrian Humphreys)
 * 2019-06-05 [69690b7](https://github.com/symbiote/silverstripe-queuedjobs/commit/69690b74b9474ab840ce0c309b5097f0ef77b20f) Log severity in queue messages (Ingo Schommer)
 * 2019-05-31 [9feef18](https://github.com/silverstripe/silverstripe-subsites/commit/9feef185dce259ca4f7a90a150c7e6bb49e3184f) Adding documentation about cascading themes (Guy Marriott)
 * 2019-05-27 [b7b5624](https://github.com/symbiote/silverstripe-queuedjobs/commit/b7b5624df6bda1efbeec182d0337667e16e4a2c6) Remove use of deprecated DB::getConn() and run import optimisation (Robbie Averill)
 * 2019-05-23 [9926d7b](https://github.com/silverstripe/recipe-core/commit/9926d7b4dead6e8218910ea486cb6bdc60800395) Update minimum PHP version to 7.1 in Travis (Robbie Averill)
 * 2019-05-23 [29320ff](https://github.com/silverstripe/recipe-cms/commit/29320ff4a1ce7e1cabf30260586d3e87d41d6b3d) Update minimum PHP version to 7.1 in Travis (Robbie Averill)
 * 2019-05-16 [8284562](https://github.com/silverstripe/silverstripe-comments/commit/82845626bca723c6d40fce5a5a7cf86ddbf7b3b9) comments extension filters on Parent Class (Heath Dunlop)
 * 2019-05-09 [6c15ea4](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/6c15ea4e6939420e3f44b149836460664ad910d8) Update translations (Robbie Averill)
 * 2019-05-08 [83a05e2](https://github.com/silverstripe/recipe-core/commit/83a05e2dc7ce7ffd90ac892b4ba36f6530c80857) Remove cms travis dependency (Aaron Carlino)
 * 2019-04-21 [374dd63](https://github.com/silverstripe/recipe-cms/commit/374dd6337177f7b29c4f1a8b9bd94db291687f07) Bump core constraints to 4.5.x-dev (Robbie Averill)
 * 2019-04-21 [c19845e](https://github.com/silverstripe/recipe-core/commit/c19845e0ee0607ff61ef8ef34c8333533018803f) Bump core constraints to 4.5.x-dev (Robbie Averill)
 * 2019-04-15 [812a530](https://github.com/silverstripe/recipe-blog/commit/812a5303ab15fe5ed895c8ab525a1cbd26ddbb73) Update composer root version in Travis builds (Robbie Averill)
 * 2018-11-07 [78b82ec](https://github.com/silverstripe/recipe-blog/commit/78b82ec9d3d57bad77671e3535d9f33fe2d99122) Bump postgres version in Travis configuration to 2.1.x (Robbie Averill)
 * 2018-11-07 [b769051](https://github.com/silverstripe/recipe-blog/commit/b7690517657509755210616f513ef3260c491318) Update path to global composer bin (Robbie Averill)
 * 2018-10-25 [36c5536](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/36c55361c31a83dfade994c88814c612379b9afc) Change config method & default timeout to null to disable. (James Ayers)
 * 2018-10-24 [a29eb83](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/a29eb830f2a2070cc9359fe844309e3f998e8d8c) Update Process timeout via Config (James Ayers)
 * 2018-10-16 [9736b26](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/9736b26a17a9d6a36e37d0d5203757141a2e97b1) Update config.yml (Hayden Shaw)
 * 2018-07-30 [30b0692](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/30b06922b456f4827c2ee3708305ed12489b18d5) Update README.md (Guy Marriott)
 * 2018-06-15 [c3816de](https://github.com/silverstripe/recipe-authoring-tools/commit/c3816de4fd72e4b0e69d6c7a667239ed1b7e40b5) Add supported module badge to readme (Dylan Wagstaff)
 * 2018-06-15 [6f3cf36](https://github.com/silverstripe/recipe-reporting-tools/commit/6f3cf36aaf60548254e6d12e0feb5f3c479af962) Add supported module badge to readme (Dylan Wagstaff)
 * 2018-06-15 [a3ec10c](https://github.com/silverstripe/recipe-collaboration/commit/a3ec10cf9299be648856f896b45d82cb4a0b1bc7) Add supported module badge to readme (Dylan Wagstaff)
 * 2018-06-15 [34e281d](https://github.com/silverstripe/silverstripe-akismet/commit/34e281d08fc647430141bcb0bdfc561f95a16e4a) Add supported module badge to readme (Dylan Wagstaff)
 * 2018-06-15 [ac2e699](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/ac2e699c04d15f66c8b493abaef93831cfb9dc00) Add supported module badge to readme (Dylan Wagstaff)
 * 2018-06-15 [806f44f](https://github.com/bringyourownideas/silverstripe-composer-update-checker/commit/806f44f908472b3249193183737f266246dea50c) Add supported module badge to readme (Dylan Wagstaff)


<!--- Changes above this line will be automatically regenerated -->
