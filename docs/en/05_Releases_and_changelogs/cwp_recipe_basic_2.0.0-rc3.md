# 2.0.0-rc3

**Release Candidate 3**: All relase notes for this pre-release are merged into the release notes for `2.0.0` stable (which is as yet unreleased). Please [refer there]
(https://www.cwp.govt.nz/developer-docs/en/2/releases_and_changelogs/cwp_recipe_basic_2.0.0/) for more complete state of the upgrade, or below for the changes since `
2.0.0-rc2`

This release candidate is essentially the same as rc2, however addresses a few small issues with composer dependency resolutions which prevented rc2 from being able to be installed. The modules affected by this were:

 - silverstripe/content-widget
 - silverstripe/externallinks
 - silverstripe/sitewidecontent-report
 - silverstripe/akismet

The following recipes were not updated in the last release as an oversight, and tried to require older versions of their modules which also impacted composer:

 - silverstripe/recipe-reporting-tools
 - silverstripe/recipe-content-blocks
 - cwp/cwp-recipe-search

The github issue tracking all of the above can be found at the cwp/cwp-installer repository on [github](https://github.com/silverstripe/cwp-installer/issues/18)

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2018-04-08 [cbca821](https://github.com/silverstripe/silverstripe-restfulserver/commit/cbca821c9b8975270c2828c5b1068b00c9fc9605) comply with psr-2 (Andreas Piening)
 * 2018-04-08 [d0149f8](https://github.com/silverstripe/silverstripe-restfulserver/commit/d0149f899596103fefeb7d442d779c64c107ec7c) add missing canView check in json (Andreas Piening)
 * 2018-04-06 [30704f5](https://github.com/symbiote/silverstripe-advancedworkflow/commit/30704f50de30189f7228c9271c22b2ea56bbfdf7) Update path to template (Raissa North)
 * 2018-04-05 [b4aae0f](https://github.com/silverstripe/cwp-core/commit/b4aae0fa891f9e840c7a82523b3a48f3f92040bb) Remove attempt to import environment into conifg for docvert (Dylan Wagstaff)
 * 2018-04-04 [d45a407](https://github.com/silverstripe/silverstripe-restfulserver/commit/d45a407185fae6d11353dbe259eb4db27423bb7b) make RestfulServer:: configurable (Andreas Piening)
 * 2018-04-03 [4544cd3](https://github.com/silverstripe/cwp/commit/4544cd3c5b0fbc102ad72f892064859777fed704) module references and mention base module (Ingo Schommer)
 * 2018-04-03 [7eba03a](https://github.com/silverstripe/cwp/commit/7eba03a3b4eb48d3783f23bacd707da78d174192) Switch example date format to match HTML5 datetime field format (Robbie Averill)
 * 2018-04-03 [ff885e9](https://github.com/silverstripe/cwp/commit/ff885e98889f5c2cf8e283d484b31a30df3984b7) Remove rogue nbsp; from Start Time field labels (Robbie Averill)
 * 2018-02-26 [4413db4](https://github.com/silverstripe/cwp-search/commit/4413db4135b0a7f24d8995709fa4ecad9c2061a7) use appropriate constraints for our CI testing (Dylan Wagstaff)
 * 2018-02-25 [ceba6c1](https://github.com/silverstripe/silverstripe-externallinks/commit/ceba6c14069e06eeb3659e3a159fd632eba213be) Update requirements & travis config to be consistent with acutal requirements (Dylan Wagstaff)
