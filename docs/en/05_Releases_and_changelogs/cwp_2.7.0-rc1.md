# 2.7.0-rc1

## Overview

This release includes [Silverstripe CMS Recipe version 4.7.0-rc1](https://docs.silverstripe.org/en/4/changelogs/rc/4.7.0-rc1/#4-7-0-rc1).


## Release Candidate

This version of CWP is a **release candidate** for an upcoming stable version, and should not be applied to production websites. We encourage developers to test this version in development / testing environments and report any issues they encounter via GitHub.


<!--- Changes below this line will be automatically regenerated -->

## Change Log


### Security


 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-05-11 [27228d1](https://github.com/silverstripe/silverstripe-userforms/commit/27228d12af8a458d0edcb3e8f2154d9731e7c303) Require MimeUploadValidator on userformis&amp;#039; File Upload field (Maxime Rainville) - See [cve-2020-9309](https://www.silverstripe.org/download/security-releases/cve-2020-9309)

    
### Features and Enhancements


 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-11-03 [2a47b18](https://github.com/silverstripe/silverstripe-userforms/commit/2a47b1821edfec37446a26ba51633623ae4b1ac2) Extension to link file submissions to userform on the used on table (Steve Boyd)

 * silverstripe/elemental-fileblock (2.0.0 -&gt; 2.1.1)   
    * 2020-11-03 [c32cda0](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/c32cda03ecb6f3d168d9daa9f36d285e4858ecfd) Update singular and plural names to file block(s) (Steve Boyd)
    * 2020-07-30 [3cfec57](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/3cfec572a428d698c396aa8fb70495740f22abe0) Update singular and plural names (Steve Boyd)

 * silverstripe/elemental-bannerblock (2.1.1 -&gt; 2.2.0)
    * 2020-11-04 [c7c7808](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/c7c780858e7812285d77a847fe640352a2e84876) Update singular and plural names to banner block(s) (Steve Boyd)

 * silverstripe/login-forms (4.2.1 -&gt; 4.3.0-rc1)
    * 2020-08-27 [a7416f1](https://github.com/silverstripe/silverstripe-login-forms/commit/a7416f10fef93443f6d19b44715a50abab2916dc) Prevent using Page_Controller Requirements (Steve Boyd)

    
### Bugfixes


 * silverstripe/blog (3.5.1 -&gt; 3.6.0)
    * 2020-10-01 [fc890d7](https://github.com/silverstripe/silverstripe-blog/commit/fc890d71c169ba4016e019abe353abf326d77e21) Fix category and tag buttons using input groups from bootstrap (Marcio Barrientos)
    * 2020-08-25 [dd8ce8b](https://github.com/silverstripe/silverstripe-blog/commit/dd8ce8b8ddc98b006c482fc049aa9a8323551750) augmentLoadLazyFields doesn&amp;#039;t work with renamed tables (wernerkrauss)
    * 2020-08-10 [31a3c3e](https://github.com/silverstripe/silverstripe-blog/commit/31a3c3e7d1b448d6ac0fc7dcf0f1cb3660734c81) forward IDs given by DataList::relation() (wernerkrauss)

 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-10-31 [0ce94b7](https://github.com/silverstripe/silverstripe-userforms/commit/0ce94b75f5988993fde74979206559ff6b3aebeb) correctly calculate MaxFileSizeMB (Dylan Wagstaff)
    * 2020-09-15 [24e770e](https://github.com/silverstripe/silverstripe-userforms/commit/24e770e00d9425d3a75c5a516e5f6d42cd3b2065) Remove old boostrap 3 CSS class (Maxime Rainville)
    * 2020-09-15 [f09691f](https://github.com/silverstripe/silverstripe-userforms/commit/f09691f9cbe78929402b32af9c9d5891316b7e0f) Vertically align confirm folder icon (Steve Boyd)
    * 2020-07-21 [81fcd66](https://github.com/silverstripe/silverstripe-userforms/commit/81fcd669a2a324743be2fd1ae01870de0281096d) Show custom validation message for checkbox and radio groups (Steve Boyd)
    * 2020-06-30 [6ca8ce2](https://github.com/silverstripe/silverstripe-userforms/commit/6ca8ce2596b209784b0c4e4a24fba0f37e472b0c) Fixing plain email blank file field value (#940) (3Dgoo)

 * silverstripe/tagfield (2.4.3 -&gt; 2.5.0)
    * 2020-07-15 [70d8092](https://github.com/silverstripe/silverstripe-tagfield/commit/70d80920d77e797a82a152a02cd42079d7df2a9b) Preselect based on SS_List values (Ingo Schommer)

 * silverstripe/externallinks (2.0.5 -&gt; 2.1.0)
    * 2020-07-06 [9282ed2](https://github.com/silverstripe/silverstripe-externallinks/commit/9282ed2e2df96ca02ec00f46ef7958396f1ebf08) Allow to configure CurlLinkChecker request headers (#64) (Alex Saelens)

 * cwp/cwp-search (1.3.0 -&gt; 1.4.0)
    * 2020-07-01 [b0b3699](https://github.com/silverstripe/cwp-search/commit/b0b3699a5abbe94f3221de381408bd0da8fc1933) Restore &amp;quot;Use IndexableService to filter search results&amp;quot; (Maxime Rainville)
    * 2020-07-01 [67528e3](https://github.com/silverstripe/cwp-search/commit/67528e35ed40b308b037acfb98183626420cf089) Revert &amp;quot;Use IndexableService to filter search results&amp;quot; (Maxime Rainville)

 * cwp/starter-theme (3.0.5 -&gt; 3.1.0)
    * 2020-09-17 [d53b8db](https://github.com/silverstripe/cwp-starter-theme/commit/d53b8dbfb7190587c2015acf1c1bb7780784e84f) Fix Missing `Required` helper text for Checkbox (Mark Anthony Adriano)
    * 2020-09-17 [3e464b3](https://github.com/silverstripe/cwp-starter-theme/commit/3e464b378ab0270913f0bdf192b1d6e48055587b) Fix Missing `Required` helper text for Checkbox Group and Radio Button Group (Mark Anthony Adriano)
    * 2020-08-24 [3e252b9](https://github.com/silverstripe/cwp-starter-theme/commit/3e252b94a042dc182426013686e787765524500c) Adjust ElementalArea check to allow nesting of regular Pages (Garion Herman)

 * silverstripe/mfa (4.1.1 -&gt; 4.2.0)
    * 2020-09-15 [0a31f18](https://github.com/silverstripe/silverstripe-mfa/commit/0a31f181ace542c4d16eb3d29a8925a21a66e9a5) Correct URL for Simon&amp;#039;s original module (Garion Herman)
    * 2020-09-15 [f34ae85](https://github.com/silverstripe/silverstripe-mfa/commit/f34ae85eb678ff708c33a616d3b33ae2d2aa5a85) Provide clearer credit to Simon Erkelens for his contributions (Garion Herman)
    * 2020-08-19 [3cc810f](https://github.com/silverstripe/silverstripe-mfa/commit/3cc810f7d1b9f246a3bf334297bdaec0bf49a7f5) Reinstate recent translation strings after update (Garion Herman)

 * silverstripe/totp-authenticator (4.0.0 -&gt; 4.1.0)
    * 2019-11-12 [1ddecb1](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/1ddecb14d2a5a7d021421fcbd16a6f3311589dae) linting issues (Garion Herman)
    * 2019-08-22 [16f4ec3](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/16f4ec3c04ed01d4585a5b9a992c9a66c0e43130) Fix link to MFA module in readme (Michal Kleiner)

 * cwp/agency-extensions (2.4.0 -&gt; 2.4.1)
    * 2020-08-06 [b2510de](https://github.com/silverstripe/cwp-agencyextensions/commit/b2510de0d8edc5b36c3f4bb9ea1e8a73c3c82895) Remove broken translation (Maxime Rainville)

 * silverstripe/ldap (1.1.2 -&gt; 1.2.0)
    * 2020-09-15 [b801559](https://github.com/silverstripe/silverstripe-ldap/commit/b801559b8227257368c213a7f301f6fa37bd3383) Remove old boostrap 3 CSS class (Maxime Rainville)
    * 2019-11-18 [8054581](https://github.com/silverstripe/silverstripe-ldap/commit/80545815c4d2b4fdeea7fc8bf8b42aaf1b5e3aec) Bump PostgreSQL version in Travis config (Garion Herman)
    * 2019-11-18 [6ec785a](https://github.com/silverstripe/silverstripe-ldap/commit/6ec785accf1fb0745e07e5649c7c672d5b54a8e4) Update Travis config to Xenial (Garion Herman)
    * 2019-11-18 [f043d56](https://github.com/silverstripe/silverstripe-ldap/commit/f043d56ee8773b5472e3f5e3241b4bac69b54b14) Use stable releases of CMS 4.2 for Travis tests (Garion Herman)
    * 2019-05-14 [f8b0f79](https://github.com/silverstripe/silverstripe-ldap/commit/f8b0f79e56d6271d542826aa824e29300b43a038) prevents users being removed from the LDAPService::$default_group (Tim Kung)

 * silverstripe/elemental-bannerblock (2.1.1 -&gt; 2.2.0)
    * 2020-10-16 [6a0aa4f](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/6a0aa4fcb897c77a1e78cd7d10364816c10aa9eb) Fix PHP8 build (Maxime Rainville)

 * silverstripe/realme (4.0.0 -&gt; 4.0.1)
    * 2020-11-10 [7f2c31a](https://github.com/silverstripe/silverstripe-realme/commit/7f2c31a0b8ee2891eb59a0c1025b6cb6eda99509) Quote yml string, use shared travis config, use sminnee/phpunit (Steve Boyd)
    * 2020-08-18 [935598b](https://github.com/silverstripe/silverstripe-realme/commit/935598b536375d5decac97ed08edac6179da1e0a) Add default translations for LoginHandler and MiniLoginForm (Steve Boyd)

 * silverstripe/webauthn-authenticator (4.0.1 -&gt; 4.1.0)
    * 2019-11-12 [b57a09f](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/b57a09f1fc741d8d5968ed1972651d0ffd7d661c) Fix linting issues (Maxime Rainville)
    * 2019-07-31 [d8a924a](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/d8a924a5c448eefdc54de4ed0ea9b682e9349a7f) unsquish text on small viewports (Dylan Wagstaff)

    
### API Changes


 * cwp/cwp-recipe-kitchen-sink (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-06-15 [220ec69](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/220ec69f5f7b131e0e8048660a29b3f3fb1dd5e8) Include silverstripe/subsites as it is no longer included in cwp/cwp-installer (Steve Boyd)

    
### Dependencies


 * silverstripe/comments (3.3.1 -&gt; 3.4.0)
    * 2020-07-30 [8bc492b](https://github.com/silverstripe/silverstripe-comments/commit/8bc492bb77e0f61238dde0f76a43c0d22ab66c7d) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [f91b13a](https://github.com/silverstripe/silverstripe-comments/commit/f91b13ad964ba4a8ce356a724a0114b746beb9bb) Bump npm from 6.13.4 to 6.14.7 (dependabot[bot])
    * 2020-07-16 [1e9d8fc](https://github.com/silverstripe/silverstripe-comments/commit/1e9d8fcd1b0ddca13bc8c3d6cdfad9ffc70112cc) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-08 [bcbc58f](https://github.com/silverstripe/silverstripe-comments/commit/bcbc58f46e1c14eb90b4923f4d08c7d2c485d854) Bump npm-registry-fetch from 4.0.2 to 4.0.5 (dependabot[bot])
    * 2019-12-13 [e2db114](https://github.com/silverstripe/silverstripe-comments/commit/e2db114158534c73a157f3b7f1534e93347f7945) Bump npm from 6.13.0 to 6.13.4 (dependabot[bot])

 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-07-30 [719ed96](https://github.com/silverstripe/silverstripe-userforms/commit/719ed96570b9f2954060bdf6190c7898ca6b5fe2) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [4bbd57c](https://github.com/silverstripe/silverstripe-userforms/commit/4bbd57c5f6f264e8f111df31ed79d74cd854abc6) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [3f474b6](https://github.com/silverstripe/silverstripe-userforms/commit/3f474b6cca32c30478bc79f3f5e8bf379ebb50a2) Bump npm-registry-fetch from 4.0.2 to 4.0.5 (dependabot[bot])

 * silverstripe/tagfield (2.4.3 -&gt; 2.5.0)
    * 2020-07-30 [2af3422](https://github.com/silverstripe/silverstripe-tagfield/commit/2af34223aab570e7c81b481b46c3ef349ce48742) Bump elliptic from 6.5.0 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [7a43f3a](https://github.com/silverstripe/silverstripe-tagfield/commit/7a43f3af3642a75d30325bc9d67860dff6fc6983) Bump npm from 6.13.4 to 6.14.7 (dependabot[bot])
    * 2020-07-17 [4c7174d](https://github.com/silverstripe/silverstripe-tagfield/commit/4c7174d9b701593faa0317d10122c078327f3450) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [b1a2783](https://github.com/silverstripe/silverstripe-tagfield/commit/b1a278303cde7164ee44538f17711d3a2d2e1ae8) Bump npm-registry-fetch from 4.0.2 to 4.0.5 (dependabot[bot])
    * 2020-06-07 [ee7f71b](https://github.com/silverstripe/silverstripe-tagfield/commit/ee7f71b753f139f5b5c91bb8b80168dc3ad906ad) Bump websocket-extensions from 0.1.3 to 0.1.4 (dependabot[bot])
    * 2020-04-30 [9e66d61](https://github.com/silverstripe/silverstripe-tagfield/commit/9e66d61fa4796be2c9e502d7574dfda9a377f08c) Bump jquery from 3.4.1 to 3.5.0 (dependabot[bot])
    * 2019-12-28 [54cbb3e](https://github.com/silverstripe/silverstripe-tagfield/commit/54cbb3e14a4885bb1304f83d88b4a7df468f1ebc) Bump handlebars from 4.1.2 to 4.5.3 (dependabot[bot])
    * 2019-12-13 [410c35d](https://github.com/silverstripe/silverstripe-tagfield/commit/410c35d9a259a56bad0a99ea7754aa307919132f) Bump npm from 6.10.2 to 6.13.4 (dependabot[bot])

 * silverstripe/fulltextsearch (3.7.0 -&gt; 3.8.0)
    * 2020-11-05 [8465c44](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/8465c448259b3483b64bd8312c59147d66bbb08c) use sminnee/phpunit fork (Serge Latyntcev)

 * cwp/starter-theme (3.0.5 -&gt; 3.1.0)
    * 2020-09-07 [22f5067](https://github.com/silverstripe/cwp-starter-theme/commit/22f5067c3f476e30402d041869d0188a50e411d1) Bump http-proxy from 1.18.0 to 1.18.1 (dependabot[bot])
    * 2020-07-30 [2a303a1](https://github.com/silverstripe/cwp-starter-theme/commit/2a303a1d0b7f43c1ab1d8e1b1a4fda85f79bf854) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-16 [9f60268](https://github.com/silverstripe/cwp-starter-theme/commit/9f60268615f6dc328222986b010ec8a40ae51004) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-06-06 [98bca72](https://github.com/silverstripe/cwp-starter-theme/commit/98bca727a87e4d59b38ce7e46862a110bb0980dd) Bump websocket-extensions from 0.1.3 to 0.1.4 (dependabot[bot])

 * silverstripe/mfa (4.1.1 -&gt; 4.2.0)
    * 2020-09-05 [489e0b5](https://github.com/silverstripe/silverstripe-mfa/commit/489e0b5dd68239d8fd40b4a01fa0adc6babdaeab) Bump node-sass from 4.12.0 to 4.14.1 (dependabot[bot])
    * 2020-08-02 [24d56d1](https://github.com/silverstripe/silverstripe-mfa/commit/24d56d1fa8740acba386f4728e1fbd4f363a2296) Bump elliptic from 6.4.1 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [8ffb71b](https://github.com/silverstripe/silverstripe-mfa/commit/8ffb71b544f078a16072831bb5efe322391a2fbd) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [904aa2b](https://github.com/silverstripe/silverstripe-mfa/commit/904aa2b5faba724a1868cea660188d0ba71835fb) Bump npm from 6.14.5 to 6.14.6 (dependabot[bot])

 * silverstripe/totp-authenticator (4.0.0 -&gt; 4.1.0)
    * 2020-10-16 [9e2835f](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/9e2835f3237119d515491238f6c4a2ab1b0e5775) Bump npm-user-validate from 1.0.0 to 1.0.1 (dependabot[bot])
    * 2020-09-04 [7c6f541](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/7c6f5415d3c5eb3ea13d65c5d459fa9621c99c5c) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])
    * 2020-07-30 [b2666fe](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/b2666fec7b542af17fd580367a020a72c80503ef) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-16 [118381e](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/118381e2281d9c1585fca8529ecc5d98f553631e) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [433c6d0](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/433c6d0c897d67c7fde9de1deaf5aa0e82ddac4a) Bump npm from 6.13.4 to 6.14.6 (dependabot[bot])
    * 2019-12-13 [ab03e82](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/ab03e829245d17f0ce191f63a336c8cd09aa8e57) Bump npm from 6.13.0 to 6.13.4 (dependabot[bot])

 * silverstripe/elemental-bannerblock (2.1.1 -&gt; 2.2.0)
    * 2020-07-21 [555e089](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/555e0898c8e5ed2289ee62f341337926f1bbe39a) Bump npm from 6.14.5 to 6.14.7 (dependabot[bot])
    * 2020-07-17 [24163d8](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/24163d8f395c7a777d434ad8b198c2d6d515d781) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-08 [c2014cf](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/c2014cf0026ad0791fb127ee3e0c88c129f50b5b) Bump npm-registry-fetch from 4.0.4 to 4.0.5 (dependabot[bot])

 * silverstripe/webauthn-authenticator (4.0.1 -&gt; 4.1.0)
    * 2020-10-16 [f8b0417](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/f8b04176ed4a67bff38edaf678e0e59cd3a1acdb) Bump npm-user-validate from 1.0.0 to 1.0.1 (dependabot[bot])
    * 2020-09-05 [887c999](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/887c999053cbbe3852285d70e6a53c65139a536f) Bump handlebars from 4.5.1 to 4.7.6 (dependabot[bot])
    * 2020-09-04 [8beeac3](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/8beeac3262052f0f2a21291f65f88c784911678e) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])
    * 2020-07-30 [0bd5127](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/0bd512759bccccb4c3858b46a6c3e9095b782468) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-16 [6be1f49](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/6be1f498e04bf4f7f8431dd029ead057e302ab4a) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [a1694b1](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/a1694b1b3b6b6b7cf766e01b2fe9677094a973b5) Bump npm from 6.14.2 to 6.14.6 (dependabot[bot])
    * 2020-03-19 [0fd4455](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/0fd445549297841b6e97ae0506c3afc7d6118fb4) Bump npm from 6.13.0 to 6.14.2 (dependabot[bot])
    * 2019-12-13 [3de9517](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/3de951729535e42efd4157735b5e0279a9ce1fa6) Bump npm from 6.13.0 to 6.13.4 (dependabot[bot])

 * silverstripe/login-forms (4.2.1 -&gt; 4.3.0-rc1)
    * 2020-10-16 [d2b572b](https://github.com/silverstripe/silverstripe-login-forms/commit/d2b572b365d2180081fa7bc010ba5da113c130ca) Bump npm-user-validate from 1.0.0 to 1.0.1 (dependabot[bot])
    * 2020-09-04 [ebcba46](https://github.com/silverstripe/silverstripe-login-forms/commit/ebcba467fd336308598cf2c992a2a5a595548d22) Bump node-sass from 4.11.0 to 4.14.1 (dependabot[bot])
    * 2020-09-04 [3c97760](https://github.com/silverstripe/silverstripe-login-forms/commit/3c97760e4d425ca7b1effbadc9f9e5dce2e58160) Bump lodash.mergewith from 4.6.1 to 4.6.2 (dependabot[bot])
    * 2020-07-30 [16194f2](https://github.com/silverstripe/silverstripe-login-forms/commit/16194f28134b6f4d2dfdc321c5de23d292a07515) Bump elliptic from 6.4.1 to 6.5.3 (dependabot[bot])
    * 2020-07-16 [211f5a3](https://github.com/silverstripe/silverstripe-login-forms/commit/211f5a3bd05205a1bb9cc33114d412a392ef8c0f) Bump lodash from 4.17.11 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [9f83601](https://github.com/silverstripe/silverstripe-login-forms/commit/9f83601d15d359b9e68b036344b79892320d4a03) Bump npm from 6.13.4 to 6.14.6 (dependabot[bot])
    * 2020-06-30 [b71bb53](https://github.com/silverstripe/silverstripe-login-forms/commit/b71bb537b8536ebf0778d4d5b45ac8440d2eb9f3) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])

    
### Documentation


 * cwp/cwp-recipe-kitchen-sink (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-07-13 [151dc24](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/151dc24f62ea113ab306771a512391c8d4eaf771) changelog template typo (brynwhyman)

 * cwp/cwp (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-07-16 [f15e72c](https://github.com/silverstripe/cwp/commit/f15e72c3c2f524d0ba2eab9864dccf62fd3b1486) update support date to match CWP contract (brynwhyman)
    * 2020-07-15 [34f86ec](https://github.com/silverstripe/cwp/commit/34f86ec5cb99134c55ee8b3af776e5927c35008f) Add 1.9.4 changelogs (Serge Latyntcev)
    * 2020-07-13 [51a6aaa](https://github.com/silverstripe/cwp/commit/51a6aaaa25c96e99a86b93fab0386871e22c53d7) Add 2.6.0 to the changelog index (Serge Latyntcev)

 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-07-01 [a8c7623](https://github.com/silverstripe/silverstripe-userforms/commit/a8c7623867a2f95107ebca495ed7c4ede069f015) Add user help for securing file upload form submissions (Sacha Judd)

 * silverstripe/documentconverter (2.0.3 -&gt; 2.1.0)
    * 2018-08-20 [0839670](https://github.com/silverstripe/silverstripe-documentconverter/commit/0839670fa49cc09fcf9155e44d4659b397adbb45) Update folder structure for userhelp.silverstripe.org [ci skip] (Sacha Judd)

 * silverstripe/fulltextsearch (3.7.0 -&gt; 3.8.0)
    * 2020-07-06 [ea4b6cd](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/ea4b6cd19c719a68384781723e42845c5e18dfe6) Use the correct name for the executable in the getting started doc (Maxime Rainville)

 * silverstripe/totp-authenticator (4.0.0 -&gt; 4.1.0)
    * 2020-06-03 [062300e](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/062300e8ec920ce0f2a98ce647e013758f60093d) More universal way to generate keys (Ingo Schommer)
    * 2020-03-15 [a9cb87f](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/a9cb87f072829e2cb7e221bed718f861944b010f) Generate secret key (Ingo Schommer)

 * silverstripe/ldap (1.1.2 -&gt; 1.2.0)
    * 2019-07-25 [c5a332c](https://github.com/silverstripe/silverstripe-ldap/commit/c5a332cc39a8e7ec213e659d5a72996e504fb7c8) Remove note to add ldap to gitignore - it is a vendor module (Robbie Averill)

 * silverstripe/webauthn-authenticator (4.0.1 -&gt; 4.1.0)
    * 2020-05-11 [ee3b401](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/ee3b4016bf00ab66693fb422c9d1d53d29a68f51) Add php-gmp extension as a requirement in readme (Robbie Averill)

    
### Other changes

 * silverstripe/blog (3.5.1 -&gt; 3.6.0)
    * 2020-11-17 [a07c2bb](https://github.com/silverstripe/silverstripe-blog/commit/a07c2bb9cac5f314bd76592219d470bfcda1540e) Update translations (Steve Boyd)

 * silverstripe/mfa (4.1.1 -&gt; 4.2.0)
    * 2020-11-17 [ec14688](https://github.com/silverstripe/silverstripe-mfa/commit/ec14688cbb90e6c750e427f8a47bc78dc1b38e8c) Update translations (Steve Boyd)

 * cwp/cwp-recipe-kitchen-sink (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [b49915f](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/b49915f8244c03ab9a6263e66302b411d0495559) Update for 2.7 (Steve Boyd)
    * 2020-07-29 [55a4894](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/55a48944f758b909006117505f3946ce8fa66008) Update .changelog.md.twig (Ingo Schommer)
    * 2020-07-16 [f507b34](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/f507b34ed0280b79d8666f02786712fdd870d6fa) Cow changelog template update (Serge Latyntcev)
    * 2020-06-14 [73bef09](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/73bef0996cf96d594767b3e0354bee6f065a889c) Remove mfa (bergice)

 * cwp/cwp-installer (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [4efa969](https://github.com/silverstripe/cwp-installer/commit/4efa9695d26fc091c92fbeb78ea88ebb1481afcd) Update for 2.7 (Steve Boyd)
    * 2020-06-18 [b13d412](https://github.com/silverstripe/cwp-installer/commit/b13d412a697c1d1eb3e9076989f744345fe24d30) Require phpunit-mock-objects (Steve Boyd)
    * 2020-06-15 [479b802](https://github.com/silverstripe/cwp-installer/commit/479b8029b9794c7fcd76ec05c185180d01dfc5ce) Use 2.x-dev for mfa and totp (Steve Boyd)

 * cwp/cwp-recipe-core (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [2b82772](https://github.com/silverstripe/cwp-recipe-core/commit/2b82772fcbcb1423730f707a8073d68b94a65602) Update for 2.7 (Steve Boyd)
    * 2020-06-18 [ddeeac7](https://github.com/silverstripe/cwp-recipe-core/commit/ddeeac7a0fd1175f77dc38fe512dda0c9b98ac97) Require phpunit-mock-objects (Steve Boyd)

 * cwp/cwp-core (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-17 [b47e727](https://github.com/silverstripe/cwp-core/commit/b47e72741cb5a0e27b0e933121dd031bb31a35bc) Update translations (Steve Boyd)
    * 2020-11-16 [3367926](https://github.com/silverstripe/cwp-core/commit/3367926fe5535bbf00d98bf9dae1fa571311ac49) Update for 2.7 (Steve Boyd)

 * cwp/cwp-recipe-cms (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [5d27543](https://github.com/silverstripe/cwp-recipe-cms/commit/5d27543de134ebcec2f6bca1db47cdbe9732f34a) Update for 2.7 (Steve Boyd)
    * 2020-06-18 [f9988ce](https://github.com/silverstripe/cwp-recipe-cms/commit/f9988ce89689d2753f3fe5260d22ef826c7b853e) Require phpunit-mock-objects (Steve Boyd)

 * cwp/cwp (2.6.1 -&gt; 2.7.0-rc1)
   * 2020-11-17 [31d3ee7](https://github.com/silverstripe/cwp/commit/31d3ee7abe39f8c15662fca90925ebb43e105855) Update translations (Steve Boyd)
    * 2020-07-09 [f7ad03f](https://github.com/silverstripe/cwp/commit/f7ad03f8abae0fb9ae15e87d7eea242dd12fd76d) Clarify DocumentRoot configuration within CWP and its implications (Michal Kleiner)
    * 2020-07-02 [a4cc08c](https://github.com/silverstripe/cwp/commit/a4cc08ce596015859359383c08cf04716a4867fa) Clarify where redirects should go. (Mateusz U)

 * silverstripe/recipe-blog (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [440ce89](https://github.com/silverstripe/recipe-blog/commit/440ce89d0183442f094ca4677439f03c40bca0d8) Update for 1.7 (Steve Boyd)

 * silverstripe/comments (3.3.1 -&gt; 3.4.0)
    * 2020-11-17 [739b211](https://github.com/silverstripe/silverstripe-comments/commit/739b211afb165417ff4e325ae83bae6d6bd5e9e7) Update translations (Steve Boyd)
    * 2020-04-19 [82c817c](https://github.com/silverstripe/silverstripe-comments/commit/82c817c45233542a3e30f2ec08b5282296141579) Fixes #300 (torleif)

 * silverstripe/recipe-form-building (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [6f4b4b6](https://github.com/silverstripe/recipe-form-building/commit/6f4b4b65cbff4193751d2ab09cd595eb6b950fbe) Update for 1.7 (Steve Boyd)

 * silverstripe/userforms (5.6.2 -&gt; 5.8.0)
    * 2020-11-17 [5c64cc8](https://github.com/silverstripe/silverstripe-userforms/commit/5c64cc825fbf34bc8b0c9ad2b5fad57913fc173a) Update translations (Steve Boyd) 
    * 2020-07-06 [d24db18](https://github.com/silverstripe/silverstripe-userforms/commit/d24db1886d3cc7240cf3ecc088cd6ef2c9310c75) Update docs/en/userguide/form-submissions.md (Sacha Judd)
    * 2020-06-18 [7eda3c2](https://github.com/silverstripe/silverstripe-userforms/commit/7eda3c23d9a58fc006d20324962ee213bd1e0958) Require recipe-cms 4.6 (Steve Boyd)

 * silverstripe/recipe-authoring-tools (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [8c53794](https://github.com/silverstripe/recipe-authoring-tools/commit/8c5379419594df819266cb4622ddc52741bceec5) Update for 1.7 (Steve Boyd)

 * silverstripe/documentconverter (2.0.3 -&gt; 2.1.0)
    * 2020-11-17 [9dfa055](https://github.com/silverstripe/silverstripe-documentconverter/commit/9dfa055e0ca69be37f48f89d7a9dc13b78334fe1) Update translations (Steve Boyd)
    * 2019-12-19 [b38afaf](https://github.com/silverstripe/silverstripe-documentconverter/commit/b38afaf75c710a8e5c547b3590193018e90d9715) META: Add github action to build docs (Aaron Carlino)
    * 2018-06-15 [a6a19a6](https://github.com/silverstripe/silverstripe-documentconverter/commit/a6a19a613a898e292a8a2c70fb1aa8f83a71a9ab) Add supported module badge to readme (Dylan Wagstaff)

 * silverstripe/iframe (2.0.4 -&gt; 2.1.0)
    * 2020-11-17 [23ab2ec](https://github.com/silverstripe/silverstripe-iframe/commit/23ab2ecca1cef47c4aca2d39dce7ae9792d5e789) Update translations (Steve Boyd)
    * 2020-01-15 [e551026](https://github.com/silverstripe/silverstripe-iframe/commit/e551026cad0c029139b433ecbecbfd64c6cfd438) Update load event registration (Maxime Claudel)
    * 2019-12-19 [c4ebf0a](https://github.com/silverstripe/silverstripe-iframe/commit/c4ebf0ad60944ae3af2569f6c0f78254272583cf) META: Add github action to build docs (Aaron Carlino)
    * 2019-11-18 [3e66485](https://github.com/silverstripe/silverstripe-iframe/commit/3e6648558ff6106e43ae0640b156b09f67e3460e) A small code style fix (Serge Latyntcev)
    * 2019-01-22 [b5306a2](https://github.com/silverstripe/silverstripe-iframe/commit/b5306a2f1fb569d8f59e1eb4afb9ade2b90e2e1a) Add legacy.yml for upgrading (Will Rossiter)
    * 2018-06-15 [a2ac63b](https://github.com/silverstripe/silverstripe-iframe/commit/a2ac63bb62aa8d663038519c9308023701ede074) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-06-14 [ec6ed4b](https://github.com/silverstripe/silverstripe-iframe/commit/ec6ed4b686494d765c35e4a552ebc6b3f5928df1) Update branch alias for 2.x-dev (Guy)

 * silverstripe/tagfield (2.4.3 -&gt; 2.5.0)
    * 2020-07-15 [2c0c712](https://github.com/silverstripe/silverstripe-tagfield/commit/2c0c712b59058523198d64924885485f1338f1df) Remove cms dependance in unit tests (Ingo Schommer)

 * silverstripe/recipe-collaboration (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [fd7a67e](https://github.com/silverstripe/recipe-collaboration/commit/fd7a67ef9d44b15a12a034eaa10efe7adc85c1e8) Update for 1.7 (Steve Boyd)

 * silverstripe/recipe-reporting-tools (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [2c44b69](https://github.com/silverstripe/recipe-reporting-tools/commit/2c44b698fdf1dfa3ab9c250bdef6955868516f13) Update for 1.7 (Steve Boyd)

 * silverstripe/externallinks (2.0.5 -&gt; 2.1.0)
    * 2018-06-15 [8002624](https://github.com/silverstripe/silverstripe-externallinks/commit/8002624da948a9b444e0486301f9b87473463359) Add supported module badge to readme (Dylan Wagstaff)

 * cwp/cwp-recipe-search (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [47b5568](https://github.com/silverstripe/cwp-recipe-search/commit/47b5568ee90199f30e2d4db2678aef4dd02ae78f) Update for 2.7 (Steve Boyd)
    * 2020-06-18 [0b16118](https://github.com/silverstripe/cwp-recipe-search/commit/0b1611834c0533b788882cffa1f03cc05483d52b) Require phpunit-mock-objects (Steve Boyd)

 * cwp/cwp-search (1.3.0 -&gt; 1.4.0)
    * 2020-11-17 [365335d](https://github.com/silverstripe/cwp-search/commit/365335dd8f4de315858f9d0190fdff0b24b0c9cf) Update translations (Steve Boyd)
    * 2019-10-22 [53fe09e](https://github.com/silverstripe/cwp-search/commit/53fe09e96b457567a7f3ad71eca2aa04460bff42) Make spellcheck configurable (Will Rossiter)

 * silverstripe/fulltextsearch (3.7.0 -&gt; 3.8.0)
    * 2020-06-18 [2bdd3ea](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/2bdd3eacdd929be69d040b8f731da91577bbdfd0) Require phpunit-mock-objects, use caret versions (Steve Boyd)

 * silverstripe/recipe-services (1.6.1 -&gt; 1.7.0-rc1)
    * 2020-11-16 [e5d38ef](https://github.com/silverstripe/recipe-authoring-tools/commit/e5d38efc591aaa480ee0e3e2c2d9440d4e213da4) Update for 1.7 (Steve Boyd)

 * tractorcow/silverstripe-fluent (4.5.0 -&gt; 4.5.1)
    * 2020-08-31 [964175f](https://github.com/tractorcow-farm/silverstripe-fluent/commit/964175f0afbbd825e843fc00843ad2398a4ef0a6) Wrap middleware state mutations inside state helpers (Damian Mooyman)
    * 2020-06-23 [740c368](https://github.com/tractorcow-farm/silverstripe-fluent/commit/740c3681c83f4afb357a84e5853b27df5235c02e) Add PHP7.4 build (Maxime Rainville)

 * cwp/starter-theme (3.0.5 -&gt; 3.1.0)
    * 2019-06-13 [34dca18](https://github.com/silverstripe/cwp-starter-theme/commit/34dca186ffe2d6b017e5454679ac25ace62b635a) Delete bzdiff (Ingo Schommer)
    * 2019-06-13 [cf2125e](https://github.com/silverstripe/cwp-starter-theme/commit/cf2125effa3e37b1e888bf9a05d63668a888cbda) Update Bootstrap version in scss docs (Robbie Averill)

 * silverstripe/totp-authenticator (4.0.0 -&gt; 4.1.0)
    * 2020-11-17 [3408d03](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/3408d035e31bfe54df646d277ccce4b060a1e791) Update translations (Steve Boyd)
    * 2020-08-05 [bc738a4](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/bc738a49d79b4ce0f95e1fba8fbd32c4db1815b2) PHPCS Move strict_types to seperate lines (Steve Boyd)
    * 2019-11-11 [12841e4](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/12841e45b5a5d95236bbf058ebce1091af6fe0ec) Upgrade dependencies (Maxime Rainville)
    * 2019-06-26 [14fa26e](https://github.com/silverstripe/silverstripe-totp-authenticator/commit/14fa26e787f3761b9f9eb8064b01708ec176fe75) Add 4.x-dev branch alias (Garion Herman)

 * silverstripe/ldap (1.1.2 -&gt; 1.2.0)
    * 2020-11-17 [7f03c26](https://github.com/silverstripe/silverstripe-ldap/commit/7f03c26bd6ec348d0b21ccc8bb5546f5fa483a9a) Update translations (Steve Boyd)
    * 2020-06-09 [8ceee93](https://github.com/silverstripe/silverstripe-ldap/commit/8ceee930967c287fb9a4565a9274b302f1decb98) Fixed old namespaces in developer.md (Amenel Voglozin)
    * 2019-11-17 [fb1930d](https://github.com/silverstripe/silverstripe-ldap/commit/fb1930d1b84c95b28a5e4be296653321b2f2861d) Update config for LDAP 1.x / CMS 4.5.x branches (Garion Herman)
    * 2019-01-24 [fefd57a](https://github.com/silverstripe/silverstripe-ldap/commit/fefd57a474f7e1353c6f131b2cc39767941f575d) Update LDAPService.php (James Davis)
    * 2019-01-15 [9788dee](https://github.com/silverstripe/silverstripe-ldap/commit/9788dee221946b8ae8086877cfe1168431854a9c) Updating branch alias (Guy Marriott)

 * silverstripe/recipe-content-blocks (2.6.1 -&gt; 2.7.0-rc1)
    * 2020-11-16 [6ed0e96](https://github.com/silverstripe/recipe-content-blocks/commit/6ed0e96d46266193e426394ec8408eecc25311d8) Update for 2.7 (Steve Boyd)

 * silverstripe/elemental-fileblock (2.0.0 -&gt; 2.1.1)
    * 2020-11-17 [9135f82](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/9135f82f46e7d37a9d799a1422e58ba9c91a7bee) Update translations (Steve Boyd)
    * 2020-03-17 [61be5a8](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/61be5a865d9823682d0a36db6dee7a3a9206401b) Update readme with example screenshots (matt-in-a-hat)
    * 2018-11-27 [3ffe433](https://github.com/silverstripe/silverstripe-elemental-fileblock/commit/3ffe4332cd7042b7b63c9c3a94722f852c19175a) Add supported module badge to readme (Robbie Averill)

 * silverstripe/elemental-bannerblock (2.1.1 -&gt; 2.2.0)
    * 2020-11-17 [356d524](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/356d5243e0fe01d9c9a18dd2b23c904a0dce0d61) Update translations (Steve Boyd)
    * 2020-06-29 [51afbcc](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/51afbcc658046f34cd6a8d91aa0d93db2362a6f2) Use xenial and Node 10 (Steve Boyd)
    * 2020-06-18 [d0acbe9](https://github.com/silverstripe/silverstripe-elemental-bannerblock/commit/d0acbe92977638f914dcebc207252177326aafbb) Modify required versions (Steve Boyd)

 * silverstripe/webauthn-authenticator (4.0.1 -&gt; 4.1.0)
    * 2020-11-17 [603bae6](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/603bae6bca407740ba689f94880d82b1ac3e0035) Update translations (Steve Boyd)
    * 2019-11-11 [cc44b38](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/cc44b386953a2e55a5cd1f4a6ef130aeb7bac148) Upgrade dependencies (Maxime Rainville)

 * silverstripe/login-forms (4.2.1 -&gt; 4.3.0-rc1)
    * 2020-11-17 [603bae6](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/603bae6bca407740ba689f94880d82b1ac3e0035) Update translations (Steve Boyd)
    * 2020-11-02 [30cf78d](https://github.com/silverstripe/silverstripe-login-forms/commit/30cf78d108167eb5e16dec7894b1cd71084ab01b) Update translations (Maxime Rainville)
    * 2020-07-13 [8bb8f5e](https://github.com/silverstripe/silverstripe-login-forms/commit/8bb8f5e8f76fcc86b2e70f8cf906df2ffe1ebb49) Minor template fixes (3Dgoo)

 * silverstripe/realme (4.0.0 -&gt; 4.0.1)
    * 2020-11-17 [0238a24](https://github.com/silverstripe/silverstripe-realme/commit/0238a241450f0483d728d30a8e801bd840da100e) Update translations (Steve Boyd)
    

<!--- Changes above this line will be automatically regenerated -->
