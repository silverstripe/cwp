# 2.8.0-beta1

## Overview

This release includes [Silverstripe CMS Recipe version X.X.X](#).


<!--- Changes below this line will be automatically regenerated -->

## Change Log


### Features and Enhancements


 * silverstripe/auditor (2.2.1 -&gt; 2.3.0-beta1)
    * 2021-03-28 [698c495](https://github.com/silverstripe/silverstripe-auditor/commit/698c495f34b122e1a888c338b8d0cea383a02c5b) Support for session-manager module (Steve Boyd)

 * silverstripe/comments (3.4.0 -&gt; 3.5.0-beta1)
    * 2021-03-04 [3b37fdb](https://github.com/silverstripe/silverstripe-comments/commit/3b37fdb1ae6bfeee054392f0b8de51db172bfc4c) Use yarn and webpack to upgrade jquery (Steve Boyd)

 * silverstripe/userforms (5.8.3 -&gt; 5.9.0-beta1)
    * 2021-03-04 [9eaee41](https://github.com/silverstripe/silverstripe-userforms/commit/9eaee412826b52060cbe13110fcd1e2cca48d194) Use yarn and webpack to upgrade jquery (Steve Boyd)

 * symbiote/silverstripe-advancedworkflow (5.3.0 -&gt; 5.4.0-beta1)
    * 2021-04-20 [00e710f](https://github.com/symbiote/silverstripe-advancedworkflow/commit/00e710f18710953c2e63b2e87c5e2f2c01814fcf) Extend hooks for publish/unpublish (Aaron Carlino)

 * silverstripe/mfa (4.2.2 -&gt; 4.3.0-beta1)
    * 2021-01-19 [85d4fb0](https://github.com/silverstripe/silverstripe-mfa/commit/85d4fb033cf15ccc0c123e281d8b3213d7486c71) Disable MFA via environment var (Ingo Schommer)

 * silverstripe/crontask (2.1.3 -&gt; 2.2.0)
    * 2020-08-26 [45ab00e](https://github.com/silverstripe/silverstripe-crontask/commit/45ab00e9f7c2d0189eded121e75b49d20fdd4dab) Bump minimum PHP requirement to 7.1. (Sam Minnee)

 * silverstripe/login-forms (4.3.0 -&gt; 4.4.1)
    * 2021-04-14 [5ebdbff](https://github.com/silverstripe/silverstripe-login-forms/commit/5ebdbff9e4d57ccca04a6e230e9bf62d54515e7a) Use popover for help icon (Steve Boyd)
    * 2021-01-21 [1449aac](https://github.com/silverstripe/silverstripe-login-forms/commit/1449aac66db602b032dca50c90b6d04cd6aff3e2) Updating Silverstripe logo to new logo (#75) (3Dgoo)

    
### Bugfixes


 * silverstripe/widgets (2.0.2 -&gt; 2.1.0-beta1)
    * 2019-11-18 [42af106](https://github.com/silverstripe/silverstripe-widgets/commit/42af10671e9f356ccd03ba28883c21c60876520a) Fetch source so that PHPCS config is available (Garion Herman)

 * silverstripe/comments (3.4.0 -&gt; 3.5.0-beta1)
    * 2021-03-20 [9c3c1e8](https://github.com/silverstripe/silverstripe-comments/commit/9c3c1e812060c7f46b25a530fed8238b9c56a3c9) Fix merge conflict (Steve Boyd)

 * silverstripe/userforms (5.8.3 -&gt; 5.9.0-beta1)
    * 2021-04-02 [78f3e68](https://github.com/silverstripe/silverstripe-userforms/commit/78f3e68a2542a07926147534b32655c2cf51346d) Fix directory for UsedOnTableExtension namespace, to be psr-4 compliant. New dir rather than namespace to prevent backwards-incompat. (Luke Fromhold)
    * 2021-03-22 [c71cf11](https://github.com/silverstripe/silverstripe-userforms/commit/c71cf11a8e6f914aea8c03262a0c87122250af80) Fix &amp;amp;lt;br&amp;amp;gt; in textarea on validation redirect (#1035) (3Dgoo)
    * 2021-01-28 [52e678c](https://github.com/silverstripe/silverstripe-userforms/commit/52e678c6e7e8d58ef77e171d6f2b9de143b09d4f) Include merge fields in plain text emails (Steve Boyd)
    * 2021-01-17 [8801790](https://github.com/silverstripe/silverstripe-userforms/commit/8801790b660576f95165660e4209821561c14f96) Show correct fields in email preview (Steve Boyd)
    * 2021-01-11 [79259b5](https://github.com/silverstripe/silverstripe-userforms/commit/79259b593a5bf99ec332f67b9ec6be3584908f34) Visibility of subsequent form fields and step buttons (Steve Boyd)

 * silverstripe/contentreview (4.1.2 -&gt; 4.2.0-beta1)
    * 2020-01-29 [ad22d6b](https://github.com/silverstripe/silverstripe-contentreview/commit/ad22d6b8054a365a33791671fe2500c3fe9bce22) Fix behat test and update travis matrix (Steve Boyd)

 * silverstripe/sharedraftcontent (2.3.5 -&gt; 2.4.0-beta1)
    * 2021-03-23 [1aa9d98](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/1aa9d98d83e4eccc722f556282c4eb9530e6f15a) Subsite share links need to be absolute (Will Rossiter)
    * 2021-01-21 [dfd9eeb](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/dfd9eeb337651f60d7e1bade851c9fd392716cba) Handle Redirects within a page (e.g. root redirects onto an action) (#131) (Lee Bradley)

 * symbiote/silverstripe-advancedworkflow (5.3.0 -&gt; 5.4.0-beta1)
    * 2021-03-22 [05bdf3f](https://github.com/symbiote/silverstripe-advancedworkflow/commit/05bdf3f5201ce45aa72f9f89c41fb0d39dd95580) fix(WorkflowInstance) Added condition for targetDiff for prior SS 4.7 &amp;amp; PHP 7.4 upgrade (Jem Lopez (Symbiote))

 * cwp/starter-theme (3.1.0 -&gt; 3.2.0-beta1)
    * 2021-03-01 [50c8d40](https://github.com/silverstripe/cwp-starter-theme/commit/50c8d401f95ef95742b99038b8dd2cb35b78e464) Update to jQuery 3.5.1, inline dependency (Garion Herman)

 * cwp/watea-theme (3.0.3 -&gt; 3.1.0-beta1)
    * 2021-03-01 [01d716d](https://github.com/silverstripe/cwp-watea-theme/commit/01d716d1d669b05b6fb0ff471d5e9348940e52ff) Update jQuery to 3.5.1 via inlined dep in starter theme (Garion Herman)

 * silverstripe/crontask (2.1.3 -&gt; 2.2.0)
    * 2020-08-26 [e568dba](https://github.com/silverstripe/silverstripe-crontask/commit/e568dba77937b7440b7e6ea769bfebca232caaf5) Drop use of abandoned package in favour of its replacement. (Sam Minnee)

 * silverstripe/login-forms (4.3.0 -&gt; 4.4.1)
    * 2021-04-12 [a44bd51](https://github.com/silverstripe/silverstripe-login-forms/commit/a44bd511d9b3a24ac1c8982a5d10bffe1a665007) Fix checkbox alignment (André Kiste)
    * 2021-04-12 [08b5eac](https://github.com/silverstripe/silverstripe-login-forms/commit/08b5eacf84e3e2703300600a62074800e4baf441) Fix checkbox field rendering tooltip twice (André Kiste)
    * 2021-02-15 [c618b63](https://github.com/silverstripe/silverstripe-login-forms/commit/c618b63529730fb989f4d04179b222745129f54f) Avoid clipping of the Silverstripe CMS logo (Maxime Rainville)
    * 2021-01-21 [1ac3429](https://github.com/silverstripe/silverstripe-login-forms/commit/1ac342993dc40a48ecfd8b566efa18eea9372573) Allow title and form to resize independently (#81) (Garion Herman)

    
### Dependencies


 * cwp/cwp-recipe-core (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-12 [0c5090b](https://github.com/silverstripe/cwp-recipe-core/commit/0c5090b1dc018606171cd7d216608ae04a3f30c4) Fix dependencies to reflect next-minor branch (Garion Herman)

 * silverstripe/environmentcheck (2.2.0 -&gt; 2.3.0-beta1)
    * 2020-12-21 [dd037c8](https://github.com/silverstripe/silverstripe-environmentcheck/commit/dd037c8f50a644964b7f9b866f78f70276e31cab) Remove explicit dev requirement for sminnee/phpunit-mock-objects (Maxime Rainville)

 * silverstripe/blog (3.6.0 -&gt; 3.7.0-beta1)
    * 2021-04-29 [45d1b6e](https://github.com/silverstripe/silverstripe-blog/commit/45d1b6e55cf7066b51d379a4763d29fce8c17472) Bump ssri from 6.0.1 to 6.0.2 (dependabot[bot])
    * 2021-04-07 [dfdcaae](https://github.com/silverstripe/silverstripe-blog/commit/dfdcaaef4bdfe3a76827d1f3185f5faa61fbed42) Bump npm-user-validate from 1.0.0 to 1.0.1 (dependabot[bot])

 * silverstripe/comments (3.4.0 -&gt; 3.5.0-beta1)
    * 2020-09-04 [a8d1cf1](https://github.com/silverstripe/silverstripe-comments/commit/a8d1cf1355336582aacea843025138c276156cba) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])

 * silverstripe/segment-field (2.2.3 -&gt; 2.3.0-beta1)
    * 2020-12-11 [005b00a](https://github.com/silverstripe/silverstripe-segment-field/commit/005b00a3a4c649361e32a6eff959cce8390b7cfc) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])
    * 2020-09-04 [31caccc](https://github.com/silverstripe/silverstripe-segment-field/commit/31cacccb8086690b6f2ab0d4bbbbccca4bbbc3fa) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])
    * 2020-07-30 [ecb81b9](https://github.com/silverstripe/silverstripe-segment-field/commit/ecb81b96b596a03a9fcf15058e6ed3c721ab205a) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [5a404b3](https://github.com/silverstripe/silverstripe-segment-field/commit/5a404b3e5151685493bb5161c3bf32033639b759) Bump npm from 6.13.7 to 6.14.7 (dependabot[bot])
    * 2020-07-17 [986fb7c](https://github.com/silverstripe/silverstripe-segment-field/commit/986fb7cd0bfba9f9dc0fbef6e447095e61272975) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-08 [d49679b](https://github.com/silverstripe/silverstripe-segment-field/commit/d49679b6f68a58afc2246cec43a918863833c775) Bump npm-registry-fetch from 4.0.3 to 4.0.5 (dependabot[bot])
    * 2020-04-30 [9186b0f](https://github.com/silverstripe/silverstripe-segment-field/commit/9186b0fc9fd37a9eb92222d3f1fe15d5949db067) Bump jquery from 3.4.1 to 3.5.0 (dependabot[bot])
    * 2020-02-14 [032c89d](https://github.com/silverstripe/silverstripe-segment-field/commit/032c89d02d3df768ac99d5c8f2ff5c00a52ae59a) Bump npm from 6.13.0 to 6.13.7 (dependabot[bot])
    * 2019-12-13 [76c4062](https://github.com/silverstripe/silverstripe-segment-field/commit/76c4062e4cbb7074512c548b0a87e3c658b612db) Bump npm from 6.13.0 to 6.13.4 (dependabot[bot])

 * silverstripe/userforms (5.8.3 -&gt; 5.9.0-beta1)
    * 2020-12-11 [85fa3be](https://github.com/silverstripe/silverstripe-userforms/commit/85fa3be97628eb6df5c85d99d7cfa6fb8df0afd6) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])
    * 2020-11-16 [ad0c8ae](https://github.com/silverstripe/silverstripe-userforms/commit/ad0c8ae52f989f5a2616a2aefed2b7c4d9cd9160) Rebuild assets after node-sass update (Garion Herman)
    * 2020-09-04 [0c01160](https://github.com/silverstripe/silverstripe-userforms/commit/0c01160e749cc0d7303dbb86f448e00d3d47dbed) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])

 * silverstripe/tagfield (2.5.0 -&gt; 2.6.0-beta1)
    * 2020-09-04 [c7c3778](https://github.com/silverstripe/silverstripe-tagfield/commit/c7c37787c450e96083e00faee7626e5d1352bb50) Bump node-sass from 4.12.0 to 4.14.1 (dependabot[bot])

 * silverstripe/contentreview (4.1.2 -&gt; 4.2.0-beta1)
    * 2019-12-14 [79f7ed7](https://github.com/silverstripe/silverstripe-contentreview/commit/79f7ed77f855dd428fcbc8aa5a5f1c10be5dad02) Bump jquery from 3.2.1 to 3.4.0 (dependabot[bot])
    * 2019-12-14 [9180213](https://github.com/silverstripe/silverstripe-contentreview/commit/9180213d63626da5051a3ce3643c3607030da3e6) Bump stringstream from 0.0.5 to 0.0.6 (dependabot[bot])

 * silverstripe/sharedraftcontent (2.3.5 -&gt; 2.4.0-beta1)
    * 2020-12-11 [78ca8a1](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/78ca8a1d5399e9868a81922fb084e3d067876147) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])
    * 2020-04-30 [9b10d9f](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/9b10d9f2879ad2158115ba6f44c941017058ea95) Bump jquery from 3.4.1 to 3.5.0 (dependabot[bot])
    * 2019-12-13 [0b18126](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/0b18126bbf6b4b7266387c5e0de825cfd7526267) Bump npm from 6.13.0 to 6.13.4 (dependabot[bot])

 * symbiote/silverstripe-advancedworkflow (5.3.0 -&gt; 5.4.0-beta1)
    * 2020-09-04 [f3cae3f](https://github.com/symbiote/silverstripe-advancedworkflow/commit/f3cae3ff3fbcd48db0e1411ce555898010774b3a) Bump node-sass from 4.7.2 to 4.14.1 (dependabot[bot])
    * 2020-07-30 [d8e4d38](https://github.com/symbiote/silverstripe-advancedworkflow/commit/d8e4d388487d125214793b70c1b7d0f5d5e1d905) Bump elliptic from 6.4.0 to 6.5.3 (dependabot[bot])
    * 2020-04-30 [a166c04](https://github.com/symbiote/silverstripe-advancedworkflow/commit/a166c047e8dbc6e15bebc182585273c028501695) Bump jquery from 3.3.1 to 3.5.0 (dependabot[bot])
    * 2019-11-17 [635d744](https://github.com/symbiote/silverstripe-advancedworkflow/commit/635d744d71e51726834911321ec1312531b102c9) Bump macaddress from 0.2.8 to 0.2.9 (dependabot[bot])
    * 2019-11-17 [e07d033](https://github.com/symbiote/silverstripe-advancedworkflow/commit/e07d033f053dd3fe4b218de56b6fb5bb69e1864c) Bump sshpk from 1.13.1 to 1.16.1 (dependabot[bot])
    * 2019-11-17 [27fe2f1](https://github.com/symbiote/silverstripe-advancedworkflow/commit/27fe2f1cb4da8237928382c1f52a77109d5effa4) Bump merge from 1.2.0 to 1.2.1 (dependabot[bot])
    * 2019-11-17 [ff31bc4](https://github.com/symbiote/silverstripe-advancedworkflow/commit/ff31bc4b4403a53bfd6e09d17c74ee45eb854939) Bump extend from 3.0.1 to 3.0.2 (dependabot[bot])

 * cwp/starter-theme (3.1.0 -&gt; 3.2.0-beta1)
    * 2020-12-11 [0f555fe](https://github.com/silverstripe/cwp-starter-theme/commit/0f555fefd8f7a552310fcb8471d5726f122a3164) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])

 * silverstripe/mfa (4.2.2 -&gt; 4.3.0-beta1)
    * 2020-12-20 [c994647](https://github.com/silverstripe/silverstripe-mfa/commit/c994647c205abc3639318d8202c40d423f9c9eeb) Bump dot-prop from 4.2.0 to 4.2.1 (dependabot[bot])

 * cwp/agency-extensions (2.4.1 -&gt; 2.5.0-beta1)
    * 2021-04-21 [3a14531](https://github.com/silverstripe/cwp-agencyextensions/commit/3a145313cf7f156755cad51b9e2394c6434e43fc) Bump handlebars from 4.5.2 to 4.7.7 (dependabot[bot])
    * 2021-04-19 [c60eb7a](https://github.com/silverstripe/cwp-agencyextensions/commit/c60eb7a307e8a7d4583e2a7cf48bc66a76929710) Bump ssri from 6.0.1 to 6.0.2 (dependabot[bot])
    * 2020-12-11 [2ce90ea](https://github.com/silverstripe/cwp-agencyextensions/commit/2ce90ea0160c4aefe2f200018145abdc81669dce) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])
    * 2020-09-04 [887e19a](https://github.com/silverstripe/cwp-agencyextensions/commit/887e19a89e8480d033897cb8c5ed41fc6f585a2f) Bump node-sass from 4.13.0 to 4.14.1 (dependabot[bot])
    * 2020-07-30 [56f4c40](https://github.com/silverstripe/cwp-agencyextensions/commit/56f4c40460c40ead69dabfe89531c94d6889e023) Bump elliptic from 6.5.1 to 6.5.3 (dependabot[bot])
    * 2020-07-21 [03d3a5b](https://github.com/silverstripe/cwp-agencyextensions/commit/03d3a5b364f2984dca408fe9df9d5e25a25ec6df) Bump npm from 6.13.4 to 6.14.7 (dependabot[bot])
    * 2020-07-16 [5b592eb](https://github.com/silverstripe/cwp-agencyextensions/commit/5b592eb83f91a8654f30ded88fc05310ddd5e2e9) Bump lodash from 4.17.15 to 4.17.19 (dependabot[bot])
    * 2020-07-07 [eb715c3](https://github.com/silverstripe/cwp-agencyextensions/commit/eb715c34022e45931d3fbd9b9a26fe2647c4641b) Bump npm-registry-fetch from 4.0.2 to 4.0.5 (dependabot[bot])

 * cwp/watea-theme (3.0.3 -&gt; 3.1.0-beta1)
    * 2021-04-19 [fc51700](https://github.com/silverstripe/cwp-watea-theme/commit/fc517001aa82e689c7e6c73c98576de0b3eabeb4) build(deps): bump ssri from 6.0.1 to 6.0.2 (dependabot[bot])
    * 2020-09-07 [1433223](https://github.com/silverstripe/cwp-watea-theme/commit/1433223ad1d8c5c4ab9c7d0012c61bc8c08822d1) build(deps): bump http-proxy from 1.17.0 to 1.18.1 (dependabot[bot])
    * 2020-07-30 [7ab4436](https://github.com/silverstripe/cwp-watea-theme/commit/7ab4436abaeb4116a9ed4affb64e5fbdd84e0ea2) build(deps): bump elliptic from 6.4.1 to 6.5.3 (dependabot[bot])
    * 2020-07-16 [ed2be36](https://github.com/silverstripe/cwp-watea-theme/commit/ed2be36ef2fbd5640787cc79ba2904d2b1d6a245) build(deps): bump lodash from 4.17.11 to 4.17.19 (dependabot[bot])
    * 2020-06-06 [7229e54](https://github.com/silverstripe/cwp-watea-theme/commit/7229e545ff3523a344717cf6c64c5586ec7a98fa) build(deps): bump websocket-extensions from 0.1.3 to 0.1.4 (dependabot[bot])
    * 2019-12-14 [529a649](https://github.com/silverstripe/cwp-watea-theme/commit/529a649bd5d2146d0d9d49dafa49e73d63745e92) build(deps): bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])
    * 2019-11-06 [c6d287f](https://github.com/silverstripe/cwp-watea-theme/commit/c6d287fbea044bbb13f1cebeebc5d746ebae3981) build(deps): bump js-yaml from 3.12.0 to 3.13.1 (dependabot[bot])

 * silverstripe/ckan-registry (1.1.2 -&gt; 1.2.0-beta1)
    * 2020-04-30 [0315147](https://github.com/silverstripe/silverstripe-ckan-registry/commit/03151478f2a495a8680b0fdd57db8850004e4f27) Bump jquery from 3.4.1 to 3.5.0 (dependabot[bot])
    * 2019-12-13 [530055d](https://github.com/silverstripe/silverstripe-ckan-registry/commit/530055d411909b0fe11b35298d106303a7d6f139) Bump npm from 6.12.1 to 6.13.4 (dependabot[bot])

 * silverstripe/webauthn-authenticator (4.1.0 -&gt; 4.2.0-beta1)
    * 2020-12-11 [c1935a6](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/c1935a67fdc59b357b8427d56f8fc9da2bf96fdb) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])

 * silverstripe/security-extensions (4.0.3 -&gt; 4.1.0-beta1)
    * 2019-10-18 [7193bde](https://github.com/silverstripe/silverstripe-security-extensions/commit/7193bde67c7f5caebfd47af15f9f0001d15565cf) Bump mixin-deep from 1.3.1 to 1.3.2 (dependabot[bot])

 * silverstripe/login-forms (4.3.0 -&gt; 4.4.1)
    * 2020-12-11 [9e097f4](https://github.com/silverstripe/silverstripe-login-forms/commit/9e097f45c815b606a6936a6cb23b47cd206231f1) Bump ini from 1.3.5 to 1.3.7 (dependabot[bot])
    * 2020-11-12 [c06130e](https://github.com/silverstripe/silverstripe-login-forms/commit/c06130e613fcf02c8a64fee37dc323c1766ec1b9) Bump dot-prop from 4.2.0 to 4.2.1 (dependabot[bot])

    
### Documentation


 * cwp/cwp (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-04-06 [411dc7b](https://github.com/silverstripe/cwp/commit/411dc7ba1c676db88df22334ef8bbe53b29a2b12) Change remember me login period from 90 to 30 days (Steve Boyd)
    * 2021-02-05 [30b9ddf](https://github.com/silverstripe/cwp/commit/30b9ddfbaa7e924b1c228168f55e98668114f5f7) Update how to change the Git repo from within Dash (Indy Griffiths)
    * 2021-01-28 [3de9f07](https://github.com/silverstripe/cwp/commit/3de9f071a6a7e17a12ac23f039497f0d48162833) add release announcement link to changelog (brynwhyman)

 * silverstripe/blog (3.6.0 -&gt; 3.7.0-beta1)
    * 2021-04-07 [65f4c22](https://github.com/silverstripe/silverstripe-blog/commit/65f4c22e84cd93098f3a41fb65380dd1e71aa7c3) Add explanation for default values (Steve Boyd)

    
### Other changes


 * cwp/cwp-installer (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [a6b23b6](https://github.com/silverstripe/cwp-installer/commit/a6b23b64204961e2f9211b7c367eb16cbf214dbd) Update build status badge (Steve Boyd)

 * cwp/cwp-recipe-core (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [c67cf7f](https://github.com/silverstripe/cwp-recipe-core/commit/c67cf7f74fa838b789220bdf467b938d518f9ee7) Update build status badge (Steve Boyd)

 * cwp/cwp-core (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [d9c2bb7](https://github.com/silverstripe/cwp-core/commit/d9c2bb791ca7edbd96f9a5522698c4a42ef3bd73) Update build status badge (Steve Boyd)

 * silverstripe/auditor (2.2.1 -&gt; 2.3.0-beta1)
    * 2021-01-21 [41815f8](https://github.com/silverstripe/silverstripe-auditor/commit/41815f892eebf8032b74f8c50ae77e95bc4a0002) Update build status badge (Steve Boyd)

 * silverstripe/environmentcheck (2.2.0 -&gt; 2.3.0-beta1)
    * 2021-01-21 [029078d](https://github.com/silverstripe/silverstripe-environmentcheck/commit/029078d157361d0e6217a497de8c92d95d28744b) Update build status badge (Steve Boyd)
    * 2020-06-18 [56dab10](https://github.com/silverstripe/silverstripe-environmentcheck/commit/56dab108c90d388be8d7441c24eb54e726aca080) Require phpunit-mock-objects, bump recipe versions (Steve Boyd)

 * cwp/cwp-recipe-cms (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [7976c9a](https://github.com/silverstripe/cwp-recipe-cms/commit/7976c9a8b8b222c21e9ac23cd5ab4459c95214a5) Update build status badge (Steve Boyd)

 * cwp/cwp (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [8346175](https://github.com/silverstripe/cwp/commit/834617541bf1511b7cf00c35325e6cac9a22f3a2) Update build status badge (Steve Boyd)

 * cwp/cwp-pdfexport (1.1.1 -&gt; 1.2.0-beta1)
    * 2021-01-21 [2323e7b](https://github.com/silverstripe/cwp-pdfexport/commit/2323e7ba2f598b615711947a88f34331fbec72af) Update build status badge (Steve Boyd)

 * silverstripe/html5 (2.0.1 -&gt; 2.1.0-beta1)
    * 2021-01-21 [e9187af](https://github.com/silverstripe/silverstripe-html5/commit/e9187af91087d698d22557bf76be91781c688f75) Update build status badge (Steve Boyd)
    * 2019-11-20 [379e9ec](https://github.com/silverstripe/silverstripe-html5/commit/379e9ec41fde27c8ef90bdbce574d8c274c4c201) Shift to local PHPCS configuration (Garion Herman)
    * 2019-11-19 [0c67095](https://github.com/silverstripe/silverstripe-html5/commit/0c67095a5fb24a525b25fae95e52138fefd83da1) Update to Xenial, expand matrix to cover new CMS releases (Garion Herman)
    * 2018-06-15 [32d59a3](https://github.com/silverstripe/silverstripe-html5/commit/32d59a347edb9a4aee20e6490c1cbaee4263cc6a) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-06-10 [dc31f70](https://github.com/silverstripe/silverstripe-html5/commit/dc31f70b927008fe983596308dadde13535c2fc8) Remove obsolete branch alias (Robbie Averill)

 * silverstripe/recipe-blog (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [5227e1a](https://github.com/silverstripe/recipe-blog/commit/5227e1ac1aa2e9ec35adb6c7a8617e186eac8468) Update build status badge (Steve Boyd)

 * silverstripe/blog (3.6.0 -&gt; 3.7.0-beta1)
    * 2021-04-09 [d6d57d8](https://github.com/silverstripe/silverstripe-blog/commit/d6d57d86891ef02ba83601fcfa930d38effd7b5e) Add doc blocks for featured image and summary (armsofnoodle)
    * 2021-02-24 [6f3bc62](https://github.com/silverstripe/silverstripe-blog/commit/6f3bc628a7278d507bb9cc89be3bcc5c84f417e6) Ensure pagination start is not a negative number (3Dgoo)
    * 2021-01-21 [54f50eb](https://github.com/silverstripe/silverstripe-blog/commit/54f50eb06ba4e942e3d3b28041bca8a3599f7c7d) Update build status badge (Steve Boyd)

 * silverstripe/widgets (2.0.2 -&gt; 2.1.0-beta1)
    * 2021-01-21 [0f37c09](https://github.com/silverstripe/silverstripe-widgets/commit/0f37c09531adbed49b21f464e67d2e7361ea3be0) Update build status badge (Steve Boyd)

 * silverstripe/content-widget (2.1.0 -&gt; 2.2.0-beta1)
    * 2021-01-21 [56258ac](https://github.com/silverstripe/silverstripe-content-widget/commit/56258ac31686e240d24d340a02210cb627f66280) Update build status badge (Steve Boyd)

 * silverstripe/spamprotection (3.0.2 -&gt; 3.1.0-beta1)
    * 2021-01-21 [1459ed8](https://github.com/silverstripe/silverstripe-spamprotection/commit/1459ed89ff27bdf3155ecd391421c2624fe7258e) Update build status badge (Steve Boyd)
    * 2020-11-25 [857389c](https://github.com/silverstripe/silverstripe-spamprotection/commit/857389c7ff855664c0bc705624e9ebddb1e4a233) Makes use of EditableFormField updateFormField (3Dgoo)
    * 2018-09-19 [506d82f](https://github.com/silverstripe/silverstripe-spamprotection/commit/506d82fc9dbb0139a68f9287659374a23e85b0a2) Add legacy mapping (Will Rossiter)
    * 2018-06-15 [fe2aed7](https://github.com/silverstripe/silverstripe-spamprotection/commit/fe2aed7e58d6b9769b0c5c3015e6c2adfc85d85b) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-06-11 [4c65d66](https://github.com/silverstripe/silverstripe-spamprotection/commit/4c65d66931a26f85181a5954875559be679a3663) Update branch alias for 3.x-dev (Robbie Averill)

 * silverstripe/akismet (4.0.4 -&gt; 4.1.0-beta1)
    * 2021-01-21 [360abcf](https://github.com/silverstripe/silverstripe-akismet/commit/360abcf3d8cac4c1f17875d9896472e548b878cf) Update build status badge (Steve Boyd)

 * silverstripe/comments (3.4.0 -&gt; 3.5.0-beta1)
    * 2021-01-21 [fb15ba7](https://github.com/silverstripe/silverstripe-comments/commit/fb15ba7d4315f5a0735f1791ca39a1a1d683ce91) Update build status badge (Steve Boyd)

 * silverstripe/comment-notifications (2.0.1 -&gt; 2.1.0-beta1)
    * 2021-01-21 [a21e033](https://github.com/silverstripe/comment-notifications/commit/a21e033ea6ee40242d44d51593431a9374aa51e2) Update build status badge (Steve Boyd)
    * 2020-05-28 [c81bae7](https://github.com/silverstripe/comment-notifications/commit/c81bae7c181e7525bb629ab5b42edbcca87cfdf8) Lowercase phpunit for packagist (Steve Boyd)
    * 2020-05-28 [a7a7aee](https://github.com/silverstripe/comment-notifications/commit/a7a7aeeaa2531d1cef1ce29e299efcdfcb2eea1c) Remove branch-alias (Steve Boyd)
    * 2018-06-15 [b30f13e](https://github.com/silverstripe/comment-notifications/commit/b30f13ed4df36295de9e7158ba4ded1d780242b1) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-06-11 [ebd7c58](https://github.com/silverstripe/comment-notifications/commit/ebd7c5804dc9e66a588cf20de30e5b9fa4cda78e) Update branch alias for 2.x-dev (Robbie Averill)
    * 2018-06-11 [6ffe880](https://github.com/silverstripe/comment-notifications/commit/6ffe880c8966972ebfb8f2898441fe2b849050b5) Remove obsolete branch alias (Robbie Averill)

 * silverstripe/recipe-form-building (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [ace5724](https://github.com/silverstripe/recipe-form-building/commit/ace5724e48ba9a17ad0937a5002a45717ab19643) Update build status badge (Steve Boyd)

 * silverstripe/segment-field (2.2.3 -&gt; 2.3.0-beta1)
    * 2021-01-21 [d371c09](https://github.com/silverstripe/silverstripe-segment-field/commit/d371c09c306452b3464d536274de1eab2cefa727) Update build status badge (Steve Boyd)
    * 2019-11-11 [d87762c](https://github.com/silverstripe/silverstripe-segment-field/commit/d87762ce6f6d72e1c47e89375a33c237f790eeb3) Removing superfluous legacy linting exclusion (Maxime Rainville)
    * 2019-11-07 [d3e88cc](https://github.com/silverstripe/silverstripe-segment-field/commit/d3e88cce738d5a7e0c24e3241d1ebd4a3d40c0c2) Upgrade JS dependencies and JS build setup (Maxime Rainville)
    * 2018-06-15 [7893b96](https://github.com/silverstripe/silverstripe-segment-field/commit/7893b96a7153e3fd415b4eed962d46395681cf59) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-05-25 [0170849](https://github.com/silverstripe/silverstripe-segment-field/commit/0170849f45efdd2ca134114becd9577401ab1d07) Update branch alias for 2.x-dev (Robbie Averill)

 * silverstripe/userforms (5.8.3 -&gt; 5.9.0-beta1)
    * 2021-02-09 [0abda42](https://github.com/silverstripe/silverstripe-userforms/commit/0abda421797c7132f9340a5437027e4c5e665054) Use correct directory separator on Windows when selecting email templates (Michal Kleiner)
    * 2021-01-21 [18bf5c7](https://github.com/silverstripe/silverstripe-userforms/commit/18bf5c71866fa118c17feffc8639a43907316321) Update build status badge (Steve Boyd)

 * silverstripe/recipe-authoring-tools (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [d01c24b](https://github.com/silverstripe/recipe-authoring-tools/commit/d01c24bbccd7894c0326feab1a9810b22788c19b) Update build status badge (Steve Boyd)

 * silverstripe/spellcheck (2.1.0 -&gt; 2.2.0-beta1)
    * 2021-01-21 [aefb6e4](https://github.com/silverstripe/silverstripe-spellcheck/commit/aefb6e48261aa7eb49043f4de710e743d5c06447) Update build status badge (Steve Boyd)

 * silverstripe/tagfield (2.5.0 -&gt; 2.6.0-beta1)
    * 2021-01-21 [0a1a370](https://github.com/silverstripe/silverstripe-tagfield/commit/0a1a370d65baaacb87f8e13cc28863eb5df5b360) Update build status badge (Steve Boyd)

 * silverstripe/taxonomy (2.1.0 -&gt; 2.2.0-beta1)
    * 2021-02-25 [dc9010d](https://github.com/silverstripe/silverstripe-taxonomy/commit/dc9010d9a5736b4e2a4924bf6d6bb8a2a2d9aba0) Add docblocks to TaxonomyTerm and Type (Chris Penny)
    * 2021-01-21 [e1df955](https://github.com/silverstripe/silverstripe-taxonomy/commit/e1df955bb5cd88e47e57924d8669ff4e3fe3025a) Update build status badge (Steve Boyd)

 * silverstripe/recipe-collaboration (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [b8c317f](https://github.com/silverstripe/recipe-collaboration/commit/b8c317fb52a5aafa8bf5fc81d00453fac02e426c) Update build status badge (Steve Boyd)

 * silverstripe/contentreview (4.1.2 -&gt; 4.2.0-beta1)
    * 2021-01-21 [c5f2b44](https://github.com/silverstripe/silverstripe-contentreview/commit/c5f2b44895338b16af6dababf6f1fe1009f469b4) Update build status badge (Steve Boyd)
    * 2019-12-19 [49ac8de](https://github.com/silverstripe/silverstripe-contentreview/commit/49ac8de8f065e108442606d816cc0e3b0cc1618e) META: Add new action to build docs (Aaron Carlino)
    * 2018-10-04 [1bd0418](https://github.com/silverstripe/silverstripe-contentreview/commit/1bd0418b6218ae93447d4afd98146919ac379218) Prevent eslint rules from cascading. (Janzen Zarzoso)
    * 2018-06-15 [d3de12f](https://github.com/silverstripe/silverstripe-contentreview/commit/d3de12fd590cb7b534f3fa820cbc2f942ef9a0a3) Add supported module badge to readme (Dylan Wagstaff)
    * 2018-06-11 [bc74fc0](https://github.com/silverstripe/silverstripe-contentreview/commit/bc74fc019d24b53d5182cb9fdef61415927e9057) Update branch alias for 4.x-dev (Robbie Averill)

 * silverstripe/sharedraftcontent (2.3.5 -&gt; 2.4.0-beta1)
    * 2021-03-11 [64d46ae](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/64d46ae8fd83fe706146f76f01d6dbef8d8c844b) Extend ShareTokenLink #134 (Jackson Darlow)
    * 2021-01-21 [0ef44d2](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/0ef44d2f38228a769bb4f062ffba7564b5c1300d) Update build status badge (Steve Boyd)
    * 2019-12-19 [be488bd](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/be488bd12e1e5707576bc5d88b488285b4a0ff27) META: Add github action to build docs (Aaron Carlino)
    * 2019-11-08 [ed5b280](https://github.com/silverstripe/silverstripe-sharedraftcontent/commit/ed5b280ba1c63631206d8adfce6024c277faf0d9) Upgrade dependencies (Maxime Rainville)

 * symbiote/silverstripe-advancedworkflow (5.3.0 -&gt; 5.4.0-beta1)
    * 2019-12-19 [c485a5a](https://github.com/symbiote/silverstripe-advancedworkflow/commit/c485a5ae6845f4fdef0146f0fcff46cb1c0c71d0) META: Add action to build docs on Netlify (Aaron Carlino)

 * silverstripe/recipe-reporting-tools (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [d211aeb](https://github.com/silverstripe/recipe-reporting-tools/commit/d211aebe3945131cb38d3eb00508d53ca948331e) Update build status badge (Steve Boyd)

 * silverstripe/securityreport (2.2.0 -&gt; 2.3.0-beta1)
    * 2021-01-21 [0203a0e](https://github.com/silverstripe/silverstripe-securityreport/commit/0203a0e8046a835c97c072b477592cfb0bcd6295) Update build status badge (Steve Boyd)
    * 2020-11-12 [1ea2e55](https://github.com/silverstripe/silverstripe-securityreport/commit/1ea2e554473e642b490fed9022211edcc9666f83) Delete 1.0 (Steve Boyd)

 * silverstripe/sitewidecontent-report (3.0.4 -&gt; 3.1.0-beta1)
    * 2021-01-21 [0b7e2a2](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/0b7e2a25d0063dbecb4838a7dd39c54355c63c9c) Update build status badge (Steve Boyd)
    * 2019-12-19 [ab42916](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/ab42916e22e36a5e336793cd6dd991a0ed3a7d48) META: Add github action to build docs (Aaron Carlino)
    * 2018-06-17 [f6df1de](https://github.com/silverstripe/silverstripe-sitewidecontent-report/commit/f6df1de7ad87e4b639417a744ddef6b2d106112c) Add supported module badge to readme (#34) (Dylan Wagstaff)

 * cwp/cwp-recipe-search (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [c61d5e1](https://github.com/silverstripe/cwp-recipe-search/commit/c61d5e10f864e2d59b78eca2014d318ab4e0bed2) Update build status badge (Steve Boyd)

 * cwp/cwp-search (1.4.0 -&gt; 1.5.0-beta1)
    * 2021-01-21 [f1649ac](https://github.com/silverstripe/cwp-search/commit/f1649ac88cdb9cff2abaa2b7488277e599155095) Update build status badge (Steve Boyd)

 * silverstripe/recipe-services (1.7.1 -&gt; 1.8.0-beta1)
    * 2021-01-21 [0d62f91](https://github.com/silverstripe/recipe-authoring-tools/commit/0d62f914972dafb13bc6a1835f957f57a985efe7) Update build status badge (Steve Boyd)

 * silverstripe/restfulserver (2.2.1 -&gt; 2.3.0-beta1)
    * 2021-01-21 [3da21bb](https://github.com/silverstripe/silverstripe-restfulserver/commit/3da21bb6c2ed9474afe7f02612424fd44d0c7ca1) Update build status badge (Steve Boyd)

 * silverstripe/registry (2.2.1 -&gt; 2.3.0-beta1)
    * 2021-01-21 [ce7c2f7](https://github.com/silverstripe/silverstripe-registry/commit/ce7c2f7568db309b6ac42f1133d82a2e4c4ab57f) Update build status badge (Steve Boyd)
    * 2019-12-19 [96a3b3f](https://github.com/silverstripe/silverstripe-registry/commit/96a3b3f05916cb733f2b137ad8660c5b6305a649) META: New github action for deploying docs (Aaron Carlino)

 * cwp/starter-theme (3.1.0 -&gt; 3.2.0-beta1)
    * 2021-01-21 [e85960d](https://github.com/silverstripe/cwp-starter-theme/commit/e85960d5b176fc724a95efa6f4ac4c632668d62b) Update build status badge (Steve Boyd)

 * silverstripe/mfa (4.2.2 -&gt; 4.3.0-beta1)
    * 2021-01-21 [1fc4e5c](https://github.com/silverstripe/silverstripe-mfa/commit/1fc4e5cb3ff5e6d46a5c5d5b3d49255d32cd9b52) Update build status badge (Steve Boyd)

 * cwp/agency-extensions (2.4.1 -&gt; 2.5.0-beta1)
    * 2021-01-21 [a8747b7](https://github.com/silverstripe/cwp-agencyextensions/commit/a8747b753a0cb9040c45d26f375a3d837078ddc2) Update build status badge (Steve Boyd)

 * cwp/watea-theme (3.0.3 -&gt; 3.1.0-beta1)
    * 2021-01-21 [18c4b73](https://github.com/silverstripe/cwp-watea-theme/commit/18c4b7314b67126f9b3c146fe9246d68d3894fe1) Update build status badge (Steve Boyd)
    * 2019-06-13 [c60f705](https://github.com/silverstripe/cwp-watea-theme/commit/c60f705d89c292161c04c2a5f63bbf965ac02992) Bump version of Bootstrap in docs (Robbie Averill)

 * silverstripe/crontask (2.1.3 -&gt; 2.2.0)
    * 2021-01-21 [0986241](https://github.com/silverstripe/silverstripe-crontask/commit/098624155cc5feee86d8076165910e30e49b3adc) Update build status badge (Steve Boyd)
    * 2018-06-11 [5c0ea40](https://github.com/silverstripe/silverstripe-crontask/commit/5c0ea405cfa8370d95d66bae1c187a1bd828ecf0) Update branch alias for 2.x-dev (Robbie Averill)

 * silverstripe/gridfieldqueuedexport (2.3.0 -&gt; 2.4.0-beta1)
    * 2021-01-21 [9a0dd45](https://github.com/silverstripe/silverstripe-gridfieldqueuedexport/commit/9a0dd45539d22934678ec43d0770d31394afdfae) Update build status badge (Steve Boyd)

 * silverstripe/recipe-content-blocks (2.7.1 -&gt; 2.8.0-beta1)
    * 2021-01-21 [96245c1](https://github.com/silverstripe/recipe-content-blocks/commit/96245c12e9b168f31d1f6c28e4a5b8c652b26e7b) Update build status badge (Steve Boyd)

 * silverstripe/textextraction (3.1.0 -&gt; 3.2.0-beta1)
    * 2021-01-21 [795abde](https://github.com/silverstripe/silverstripe-textextraction/commit/795abde8f10c70a69a6fd419c78d3333628a01f7) Update build status badge (Steve Boyd)

 * silverstripe/realme (4.0.2 -&gt; 4.1.0)
    * 2021-04-07 [f6a104b](https://github.com/silverstripe/silverstripe-realme/commit/f6a104bba29e484b396fd3072e9455d892c9b12a) FEAT: Upgrade to new Azure platform for MTS, ITE and PROD (#69) (Matt Peel)
    * 2021-03-02 [ffcfcc7](https://github.com/silverstripe/silverstripe-realme/commit/ffcfcc7ba0567d6da0c56db1380b7f93d34f576d) FEAT: Upgrade to new MTS and ITE integrations on new Azure platform (#66) (Matt Peel)
    * 2021-01-21 [88a2fba](https://github.com/silverstripe/silverstripe-realme/commit/88a2fba48dc51a99a8b0fa0e059b6ffe0a4c2d81) Update build status badge (Steve Boyd)

 * silverstripe/ckan-registry (1.1.2 -&gt; 1.2.0-beta1)
    * 2021-01-21 [7844e03](https://github.com/silverstripe/silverstripe-ckan-registry/commit/7844e0351abc9f1cf1da28b8d09c7385f42f86a2) Update build status badge (Steve Boyd)
    * 2019-12-19 [a3cb0ec](https://github.com/silverstripe/silverstripe-ckan-registry/commit/a3cb0ec38728c9d0c11a4d30d3f0685b84cdde49) META: Add github action to build docs (Aaron Carlino)
    * 2019-12-14 [9da3b41](https://github.com/silverstripe/silverstripe-ckan-registry/commit/9da3b41be746b3d4c10d36c4774b29a264806ea8) Ignore constant visibility rule until we require PHP 7.1 (Robbie Averill)

 * silverstripe/webauthn-authenticator (4.1.0 -&gt; 4.2.0-beta1)
    * 2021-01-21 [ea5da59](https://github.com/silverstripe/silverstripe-webauthn-authenticator/commit/ea5da59a058d9b516142fd92570ab3c7ff10a127) Update build status badge (Steve Boyd)

 * silverstripe/security-extensions (4.0.3 -&gt; 4.1.0-beta1)
    * 2021-01-21 [2abe068](https://github.com/silverstripe/silverstripe-security-extensions/commit/2abe068e55ce606253a56553319ea21211a2d84f) Update build status badge (Steve Boyd)
    * 2019-11-11 [9908c14](https://github.com/silverstripe/silverstripe-security-extensions/commit/9908c14b5c8ee88c4839fb50f81be23aeb8055b7) Upgrade dependencies (Maxime Rainville)

 * silverstripe/login-forms (4.3.0 -&gt; 4.4.1)
    * 2021-04-13 [370c3ca](https://github.com/silverstripe/silverstripe-login-forms/commit/370c3ca0f87261c0807d4851766dee116ea008bd) Display tooltip when title is set (André Kiste)
    * 2021-04-13 [4554bc5](https://github.com/silverstripe/silverstripe-login-forms/commit/4554bc5712ba9af5e747cde37aff594967002737) • Move attribute to login-forms (André Kiste)
    * 2021-04-12 [a73d0e7](https://github.com/silverstripe/silverstripe-login-forms/commit/a73d0e7caecfbeacf860b7d889e4d3c71a9c0e0e) Move bootstrap to npm (André Kiste)
    * 2021-04-08 [51432f9](https://github.com/silverstripe/silverstripe-login-forms/commit/51432f92cb045d4ed632472433ee2f8924ca458e) Use new designs (André Kiste)
    * 2021-03-30 [effb664](https://github.com/silverstripe/silverstripe-login-forms/commit/effb664f46e66d5417203c46218e0726159687c9) Better describe the &amp;#039;keep me signed in&amp;#039; option (André Kiste)
    * 2021-01-21 [f38beb9](https://github.com/silverstripe/silverstripe-login-forms/commit/f38beb964af88a277bec05f5a57da39c726e4541) Update build status badge (Steve Boyd)
    * 2020-11-06 [127532c](https://github.com/silverstripe/silverstripe-login-forms/commit/127532cdf67e21d6ff6ba492717dc849f55add4c) Setting form max width (Michael Nowina-Krowicki)

    

<!--- Changes above this line will be automatically regenerated -->
