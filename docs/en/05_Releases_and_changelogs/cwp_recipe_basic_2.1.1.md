# 2.1.1

## Overview

This upgrade includes CMS and Framework version 4.2.1.

 * [Framework 4.2.1](https://github.com/silverstripe/silverstripe-framework/blob/4.2.1/docs/en/04_Changelogs/4.2.1.md)

Upgrade to Recipe 2.1.1 is optional, but is recommended for all CWP sites.

This upgrade can be carried out by any development team familiar with SilverStripe CMS, but if you
would like SilverStripe's assistance, please let us know.

## Upgrading Instructions

In order to update an existing site to use the new basic recipe the following changes to your composer.json
can be made:

```json
"require": {
    "cwp/cwp-recipe-core": "2.1.1@stable",
    "cwp/cwp-recipe-cms": "2.1.1@stable",
    "silverstripe/recipe-blog": "1.1.1@stable",
    "silverstripe/recipe-form-building": "1.1.1@stable",
    "silverstripe/recipe-authoring-tools": "1.1.1@stable",
    "silverstripe/recipe-collaboration": "1.1.1@stable",
    "silverstripe/recipe-reporting-tools": "1.1.1@stable",
    "cwp/cwp-recipe-search": "2.1.1@stable",
    "silverstripe/recipe-services": "1.1.1@stable",
    "silverstripe/subsites": "2.1.1@stable",
    "tractorcow/silverstripe-fluent": "4.1.4@stable",
    "cwp/starter-theme": "2.0.2@stable"
},
"prefer-stable": true
```

## Security fixes

No security issues have been discovered since the previous CWP Recipe Release (2.1.0).

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2018-08-01 [8927721](https://github.com/tractorcow/silverstripe-fluent/commit/8927721ea66c2c7f746d6dbe04316202ddd43e10) Ensure alterQuery is compatible with silverstripe/fulltextsearch &lt;3.3 (Robbie Averill)
 * 2018-08-01 [140f054](https://github.com/tractorcow/silverstripe-fluent/commit/140f054b87ab6073ddd1224a230518db11b70c2c) deprecated filter method in SearchVariant (Sander Hagenaars)
 * 2018-07-16 [65e1847](https://github.com/tractorcow/silverstripe-fluent/commit/65e184767d60c315c85fe41cba7487116abb8daf) linting issues (Damian Mooyman)
 * 2018-07-13 [0be2919](https://github.com/tractorcow/silverstripe-fluent/commit/0be2919c002df80ee75259927516a0b8b8ec0721) up regex logic and unit tests (Damian Mooyman)
 * 2018-07-05 [d533744](https://github.com/silverstripe/cwp-starter-theme/commit/d5337442d9af6b647823668ccbf84ecde57135ec) mobile search form action going to wrong route (Mikaela Young)
 * 2018-06-29 [9b95e8b](https://github.com/silverstripe/cwp-starter-theme/commit/9b95e8b8e7e5a02afaabbe186490f42db0ca96ba) Various fixes to banner blocks (Guy Marriott)
 * 2018-06-15 [ed80e1c](https://github.com/silverstripe/silverstripe-userforms/commit/ed80e1c95bfc5c3aa278e72437fb94287923969f) Prevent form's toolbar from extending into the preview (Raissa North)
 * 2018-05-18 [d81d7cd](https://github.com/tractorcow/silverstripe-fluent/commit/d81d7cd6a7ebe1f2459c14d88e3c7cb38c46e9bb) Implement localisable order by clause (Robbie Averill)
 * 2018-04-15 [4d333b2](https://github.com/silverstripe/silverstripe-taxonomy/commit/4d333b2a06bb5dd23fd106a56dcae892c60c6b93) Move directory controller template into correct location (Robbie Averill)

### Other changes

 * 2018-07-19 [72eae39](https://github.com/silverstripe/cwp-starter-theme/commit/72eae398670d2d20504c2714c741bb48587cf6c4) Add content field to news and events holder page templates (Mikaela Young)
 * 2018-07-13 [605c05b](https://github.com/tractorcow/silverstripe-fluent/commit/605c05b82cd4cd840f3fa7a9fc451738488b5432) Multi-byte characters in URLs are now supported. (Mojmir Fendek)
 * 2018-07-05 [ede0b7f](https://github.com/silverstripe/cwp-starter-theme/commit/ede0b7f66365870ef67acc8d7017ec2e4b7caad0) Hide page showcase background if no features/quicklinks exist (Mikaela Young)
 * 2018-07-05 [592e021](https://github.com/silverstripe/cwp-starter-theme/commit/592e021259f0d72d776c723e282501ba6d2c72c0) Change event dates to NZ format (Mikaela Young)
 * 2018-06-01 [d65ae5c](https://github.com/tractorcow/silverstripe-fluent/commit/d65ae5c8d525c887c944e08f275c0bb20c2cd500) Add tests for composite sorting on array of strings and subqueries (Robbie Averill)
 * 2018-06-01 [b6ef038](https://github.com/tractorcow/silverstripe-fluent/commit/b6ef0385c3b61ac63c2d35e113d1793895362640) Add more sorting tests (Robbie Averill)
 * 2018-05-31 [3a34d8b](https://github.com/tractorcow/silverstripe-fluent/commit/3a34d8b0a138e8c217a4a454e7d691481731fc95) Refactor tests for writing to current locale to be more indicative of the behaviour they actually test (Robbie Averill)
 * 2018-05-18 [be16f72](https://github.com/tractorcow/silverstripe-fluent/commit/be16f72872a0f9b2d86ea71b7919923391abe774) Add tests for localised sorting support (Robbie Averill)
 * 2018-04-18 [560e98f](https://github.com/silverstripe/silverstripe-taxonomy/commit/560e98f5321dfca7b98250af043241624e3ac548) [SS-2018-11] Fix search term escaping to prevent possible SQL injection attack (Robbie Averill)
 * 2018-04-06 [1e40d07](https://github.com/silverstripe/silverstripe-tagfield/commit/1e40d07a98e04c2eb8b39a318420cca763b823e0) Set "title field" at a meaningful point in TagField instantiation (Jackson)
