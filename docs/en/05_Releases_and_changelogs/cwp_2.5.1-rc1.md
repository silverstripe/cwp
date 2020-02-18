# 2.5.1-rc1

## Overview

This release includes [CMS and Framework version X.X.X](#).


## Release Candidate

This version of CWP is a **release candidate** for an upcoming stable version, and should not be applied to production websites. We encourage developers to test this version in development / testing environments and report any issues they encounter via GitHub.


<!--- Changes below this line will be automatically regenerated -->



## Change Log

### Bugfixes

 * 2020-02-18 [eabcd7c](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/eabcd7c19eff2be58f2e979b2a599690dd1ed00f) Apply mcrypt requirement (Garion Herman)
 * 2020-02-05 [96c2bc3](https://github.com/silverstripe/silverstripe-mfa/commit/96c2bc39017225edd2c81be2b2ea43e568983eab) Use correct translation string for AccountResetUI.renderSuccess() (Garion Herman)
 * 2020-01-07 [72bc71a](https://github.com/silverstripe/silverstripe-fulltextsearch/commit/72bc71a6a18e8003ad5d79d634121ede59c4103d) #270 - Reset variant state back to original state after processing (Brett Tasker)
 * 2020-01-05 [0685dfa](https://github.com/silverstripe/silverstripe-environmentcheck/commit/0685dfad75f1e5aff205337ef8db09ec2627e2eb) Add missing aliases for EnvironmentChecks (Garion Herman)
 * 2019-12-06 [be32dc2](https://github.com/silverstripe/cwp/commit/be32dc28ead2fb45bc5c7813d9f36ac8ffeaaca2) re-enable TinyMCE anchor plugin (Dylan Wagstaff)
 * 2019-12-03 [6eba8ab](https://github.com/silverstripe/silverstripe-auditor/commit/6eba8ab595efbe1952ea583428351b82b1d265b1) Replace deprecated implode parameter order (Garion Herman)
 * 2019-11-18 [49d7d5f](https://github.com/silverstripe/silverstripe-environmentcheck/commit/49d7d5f2a37dc092f0a62d256029bc93f6f8b9fc) Update Travis config to Xenial (Garion Herman)
 * 2019-09-05 [9dca139](https://github.com/silverstripe/silverstripe-realme/commit/9dca1398ddff6f8b8c93d77ea20f4262c5d1ee48) log in after logging in (Dylan Wagstaff)
 * 2019-08-27 [32e2f9f](https://github.com/silverstripe/silverstripe-textextraction/commit/32e2f9f84f2f897bb71d19e69612b133e9ce88b2) Ensure test uses database cache, it asserts assuming it is configured (Robbie Averill)
 * 2019-05-23 [156c3e5](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/156c3e54bfcc75da049a2c248af3be39a97cd817) fix: update Travis config (Sam)
 * 2019-05-23 [2405aa2](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/2405aa2667edff554d95de3e7bc272ad3680e351) fix: add subsite class check (Sam)
 * 2019-05-23 [40f05ea](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/40f05eaec56665b26a53d8ee2c956538326179da) fix: ensure preview url displays the correct subsite url (Sam)
 * 2019-02-19 [3ff72be](https://github.com/silverstripe/silverstripe-tagfield/commit/3ff72be24c7e3bfab595efa2c745984ae0e7fbbf) StringTagField now works with SS-2018-021/CVE-2019-5715 by serialising arrays before write (Robbie Averill)
 * 2018-09-17 [690f0cc](https://github.com/silverstripe/silverstripe-tagfield/commit/690f0cc7934bd51355c30acb8b61a2e806838568) Fix for $source left null (Damian Mooyman)

### Other changes

 * 2020-02-16 [ba5ae2d](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/ba5ae2d0024ce3ae203a25981780f30b609b2080) Add explicit ext-mcrypt requirement (Serge Latyntcev)
 * 2020-02-12 [8e2af78](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/8e2af788721431959f227316b8c25691abb53099) Specify php 7.1 (Steve Boyd)
 * 2020-02-04 [5c9a702](https://github.com/tractorcow-farm/silverstripe-fluent/commit/5c9a7023672acb60de15baaf7ff2681cb1bd65de) Rename contributing team =&gt; maintainer (Damian Mooyman)
 * 2020-02-04 [2ddc0a5](https://github.com/tractorcow-farm/silverstripe-fluent/commit/2ddc0a5febb8ce16b2b09a503eb0fdb8eff3860c) Update contributing guidelines (Damian Mooyman)
 * 2020-02-02 [eeafe1b](https://github.com/tractorcow-farm/silverstripe-fluent/commit/eeafe1b89b55a597f538c5907940619ed2c66e26) Fluent dev state fix (Mojmir Fendek)
 * 2020-01-31 [b073043](https://github.com/silverstripe/cwp/commit/b0730432e80821dccbfca0db5fef0642585370d2) DOCS more guidance on ensuring userform submissions stay secure (brynwhyman)
 * 2020-01-23 [4e0f0e9](https://github.com/silverstripe/silverstripe-userforms/commit/4e0f0e903dcb7554bb8c226ef53e41c7f9395039) Update jQuery to 3.4.1 (Garion Herman)
 * 2020-01-23 [f82e8ba](https://github.com/silverstripe/cwp-watea-theme/commit/f82e8ba149046dbe024433d0cf6d31092b1654fe) Update jQuery to 3.4.1 (Garion Herman)
 * 2020-01-23 [f0f7d3b](https://github.com/silverstripe/cwp-starter-theme/commit/f0f7d3be6123c03ad1d3bc18e834354bf65bd65f) Update jQuery to 3.4.1 (Garion Herman)
 * 2020-01-14 [8094fdd](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/8094fdd2ea1eb65074ff15b11db54dd1dea3aef7) DOC Adjust changelog template for RC releases (Garion Herman)
 * 2020-01-13 [8b8da33](https://github.com/silverstripe/cwp/commit/8b8da33403a35d287e6afae5dc66585785c3e6b2) DOCS update 2.5 changelog to include release announcement (brynwhyman)
 * 2019-12-18 [84145e8](https://github.com/silverstripe/cwp/commit/84145e8097a923449c0abaeacd2b0c5b5e930837) DOC Add 2.5.0 to release index, mark EOL date for 2.4.0 (Garion Herman)
 * 2019-11-26 [8643337](https://github.com/silverstripe/silverstripe-login-forms/commit/864333721d3a3b00d644687421f9cf162af3474c) Removed redundent CSS (James Cocker)
 * 2019-11-22 [1c52b0e](https://github.com/silverstripe/silverstripe-login-forms/commit/1c52b0ef084a99f49247f2ed7120ae6fcae68618) Resolve SVG IE11 logo scaling issue (James Cocker)
 * 2019-11-22 [afcfb12](https://github.com/silverstripe/silverstripe-login-forms/commit/afcfb12ed29f8adecd3e2e326130bf0ceb001b5e) Brand logo CSS improvements (James Cocker)
 * 2019-11-20 [5978c62](https://github.com/silverstripe/silverstripe-spamprotection/commit/5978c62022186b78549b70f54cd15d903de4fa2d) Update to Xenial, expand build matrix (Garion Herman)
 * 2019-11-18 [d24c0fb](https://github.com/silverstripe/cwp-pdfexport/commit/d24c0fb7e30ccd4294ca3ba871194e096c933f44) Update Travis config to Xenial (Garion Herman)
 * 2019-10-21 [71385fe](https://github.com/silverstripe/silverstripe-mfa/commit/71385fe9ce4fca0aabef70661f90429ada34da62) DOCs update docs link (brynwhyman)
 * 2019-10-21 [704b000](https://github.com/silverstripe/silverstripe-mfa/commit/704b000124ab2373584a999b7e5a85e1ffcb2abc) DOCS what members get MFA (brynwhyman)
 * 2019-10-21 [4e45a92](https://github.com/silverstripe/silverstripe-mfa/commit/4e45a92d5e2091ad106742da1fd0e5d6464f641e) DOCS remove empty docs file (brynwhyman)
 * 2019-09-09 [fbd8406](https://github.com/silverstripe/silverstripe-login-forms/commit/fbd8406eec0791c0813875d1138eec0cf24b4f4b) Update translations (Garion Herman)
 * 2019-08-27 [0d7c507](https://github.com/silverstripe/silverstripe-textextraction/commit/0d7c507b539beb41b036a2d58aca7c1e65eba2d4) Use trusty in Travis builds (Robbie Averill)
 * 2019-08-16 [9425139](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/94251390d612ec5d6c895b81dd24176e765cb792) Increase memory limit for kitchen sink builds (Robbie Averill)
 * 2019-08-14 [10e0898](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/10e0898fd2bcda94e7aeb5530efef76f623fda7a) Update agency-extensions and gridfieldqueuedexport (Robbie Averill)
 * 2019-05-09 [aae09ae](https://github.com/silverstripe/silverstripe-versionfeed/commit/aae09ae51f663678a0167309c26e003d3a7c8caa) Update translations (Robbie Averill)
 * 2019-05-09 [e024613](https://github.com/silverstripe/silverstripe-spamprotection/commit/e024613ede62f71f8431ebc86270272a38bd01e4) Update translations (Robbie Averill)
 * 2019-05-09 [d33b589](https://github.com/silverstripe/silverstripe-securityreport/commit/d33b589afd485d0e49dee0992578e7c324b000dc) Update translations (Robbie Averill)
 * 2019-05-09 [60e3d6d](https://github.com/silverstripe/silverstripe-documentconverter/commit/60e3d6d1aa083ff41687a4afcf9b00d01f6b4cb6) Update translations (Robbie Averill)
 * 2018-11-08 [9260d8c](https://github.com/silverstripe/silverstripe-versionfeed/commit/9260d8c744dd5097ce5b446adddba8964d40ef5d) Bump postgres version in Travis configuration to 2.1.x (Robbie Averill)
 * 2018-09-17 [77bad9b](https://github.com/silverstripe/silverstripe-tagfield/commit/77bad9b9437c68eb833c293c2674fd811fbac725) Use getShouldLazyLoad() accesser (Damian Mooyman)
 * 2018-09-17 [ce8ba85](https://github.com/silverstripe/silverstripe-tagfield/commit/ce8ba85182a012c28f91f54b3b24b7e3d5da2486) Revert default argument change (Damian Mooyman)
 * 2018-09-12 [024e648](https://github.com/silverstripe/silverstripe-tagfield/commit/024e648e5a807cc09f702d818ef1a1fcfffe035d) Added getSource() function to populate source inline with the api. (Simon Gow)
 * 2018-09-07 [fa754f3](https://github.com/silverstripe/silverstripe-tagfield/commit/fa754f3fd3cde7129473f380f5f471d97c933a52) TagField lazy load shouldnt render Options (Simon Gow)
 * 2018-09-06 [3797049](https://github.com/silverstripe/silverstripe-tagfield/commit/3797049a31bfddb53f9bfd6454b2726fc4a6aef4) Resolve Performance issues with TagField (Simon Gow)


<!--- Changes above this line will be automatically regenerated -->
