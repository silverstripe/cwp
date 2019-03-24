# 2.2.3

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2019-03-19 [938ac4a](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/938ac4ac2b2ea40d3ba161cf8b4d59637069f08e) Remove bottom margin from security alerts container (Robbie Averill)
 * 2019-03-19 [f8b72c6](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/f8b72c6d57e3febd963a2cacdc9cd3cb7f483be2) Make task work (Ingo Schommer)
 * 2019-03-10 [82593a5](https://github.com/silverstripe/cwp-core/commit/82593a53d49c18cb953dd138e004c3a8403b3eba) Fix test for InitialisationMiddleware to use putenv instead of Environment::setEnv to test behaviour. (Charlie Bergthaler)
 * 2019-03-08 [3dd303a](https://github.com/silverstripe/cwp-core/commit/3dd303ad794c2952237833f4b6400affd83a7018) Use putenv instead of Environment::setEnv() for setting http_proxy, https_proxy and NO_PROXY in InitialisationMiddleware to allow curl via exec() as per documentation. (Charlie Bergthaler)
 * 2019-03-08 [30939cf](https://github.com/silverstripe/cwp-core/commit/30939cf6554a5edae1a7eaed5d9cacd400f841e7) Configure egress proxy and domain exclusions before delegating the request in InitialisationMiddleWare. (Charlie Bergthaler)
 * 2019-03-05 [d04eacc](https://github.com/silverstripe/silverstripe-auditor/commit/d04eaccda970461fa936709bc72c6bb54872f078) DB manipulations without an ID specified are now handled correctly (Robbie Averill)
 * 2019-01-11 [fb1be62](https://github.com/silverstripe/silverstripe-auditor/commit/fb1be62b68c561a29707f68c62f4be60455bdf2c) Fix Travis builds for 1.0 and 1.1 recipes, add PHP 7.3 and various core recipe versions (Robbie Averill)

### Other changes

 * 2019-03-24 [c625dcb](https://github.com/silverstripe/cwp/commit/c625dcb76b390c4e869108329d6bf2f6396aaac7) Update translations (Garion Herman)
 * 2019-03-22 [bbe633f](https://github.com/silverstripe/cwp-recipe-cms/commit/bbe633fbbb6d8abead13f396d3f41a5946ac5308) Add empty public folder to ensure that public webroot is used in cwp-recipe-cwp by default (Robbie Averill)
 * 2019-03-22 [ca0f7ed](https://github.com/silverstripe/cwp-recipe-core/commit/ca0f7ed60adb8e13c596d0ba4610d966f1527f8b) Add empty public folder to ensure that public webroot is used in cwp-recipe-core by default (Robbie Averill)
 * 2019-03-19 [29c5eb4](https://github.com/silverstripe/recipe-cms/commit/29c5eb49a1fe06b681120bbc4f7dfc52154599fe) Update development dependencies (Aaron Carlino)
 * 2019-03-19 [3ccab90](https://github.com/silverstripe/recipe-core/commit/3ccab90b5f26623dff2da18c0b487069e200c426) Update development dependencies (Aaron Carlino)
 * 2019-03-14 [a455af6](https://github.com/silverstripe/cwp/commit/a455af6603ce488610e78ae81a4051ac799b92b1) Add legacy yaml file for use with SS3 to SS4 upgrades (adunn)
 * 2019-03-11 [303b6ef](https://github.com/silverstripe/cwp-core/commit/303b6ef143f99ef5253e0a97a6a543d6d09d43b0) Add PHP 7.3 to Travis builds (Robbie Averill)
 * 2019-03-11 [4e26ecd](https://github.com/silverstripe/cwp-core/commit/4e26ecd1ca0404294db1e6f43eedda016aa02371) Constrain silverstripe/versioned in Travis builds to 1.1.x-dev (Robbie Averill)
 * 2019-03-11 [03f32c8](https://github.com/silverstripe/cwp-core/commit/03f32c86c916aee829ab41a15de2be3f920666ec) Remove function imports from InitialisationMiddlewareTest (Robbie Averill)
 * 2019-03-11 [b7c029b](https://github.com/silverstripe/cwp/commit/b7c029bf6d6961e43950c7d3578f28349293ee42) Update changelog index following 2.2.2 release (Dylan Wagstaff)
 * 2019-03-11 [6f25ec3](https://github.com/silverstripe/cwp/commit/6f25ec378efdac89a5124df66c4d9e74e6c9c907) Add note to changelog including core and ckan-registry (Robbie Averill)
 * 2019-02-20 [fec6924](https://github.com/bringyourownideas/silverstripe-composer-security-checker/commit/fec69246c91bbe51e1a9e47cc142fd508e75351b) Test assertions should not care about sorting result (Robbie Averill)
