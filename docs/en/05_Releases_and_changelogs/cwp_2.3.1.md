# 2.3.1

## Overview

This release includes the [silverstripe/hybridsessions:2.1.2](https://github.com/silverstripe/silverstripe-hybridsessions/releases/tag/2.1.2) update.

Upgrading to CWP 2.3.1 is recommended for CWP sites with [Active DR](https://www.cwp.govt.nz/developer-docs/en/2/how_tos/preparing_your_site_for_active_dr), or ones manually activating the `silverstripe/hybridsessions` module. This upgrade can be carried out by any development team familiar with SilverStripe CMS, however if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## Description

The issue breaks browser based `?flush`, `?isTest` and `dev/` urls, when used with [SilverStripe 4.4.0](https://docs.silverstripe.org/en/4/changelogs/4.4.0/).
The fix can be applied to existing CWP environments with existing session data managed in MySQL. It will not cause users to lose session data, or be logged out of the CMS. On subsequent writes to existing sessions, existing session data will automatically be converted to a binary-safe persistence format. New sessions will be persisted in the correct format by default.

## Technical details

We identified a binary safety issue in `SilverStripe\HybridSessions\Store\DatabaseStore` that may lose session data when trying to
persist content different from UTF-8 encoded text.

Here is an example:

```
$_SESSION['key_a'] = iconv('utf8', 'utf16', 'test');
$_SESSION['key_b'] = "\x80";
```

Both keys in the session above are valid PHP strings, but are not valid UTF-8. Before the fix silverstripe/hybridsessions was not be able to save
that session value to the database.

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Features and Enhancements

 * 2019-05-31 [7194e95](https://github.com/silverstripe/cwp/commit/7194e9501ddf2c32913537d44e989f3ccda1c110) CWP pages now use font icons instead of images (Robbie Averill)

### Bugfixes

 * 2019-06-30 [99b4f7c](https://github.com/silverstripe/silverstripe-hybridsessions/commit/99b4f7c16886803c0af5e0b5862d85ad6dac95f7) DatabaseStore binary safety (Serge Latyntcev)

### Other changes

 * 2019-06-14 [40ad8d1](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/40ad8d1dacb3b2444313b6119cbf1923c2845cc6) DOCS Twig improvements to change log template (Bryn Whyman)
 * 2019-06-14 [829fabe](https://github.com/silverstripe/cwp-recipe-kitchen-sink/commit/829fabedc74b5a8de18471f31bc4f0444fd75f9d) DOCS new headings for change log template (Bryn Whyman)
 * 2019-06-13 [fe202c6](https://github.com/silverstripe/cwp/commit/fe202c65d973b9fcd092156cd7a10bbf53c02f6c) DOCS update 2.3 changelog to reference 4.4.1 (Bryn Whyman)
 * 2019-05-09 [3fcebd6](https://github.com/silverstripe/silverstripe-hybridsessions/commit/3fcebd6399d18397a59a137856d63cef9170cda7) Update translations (Robbie Averill)
<!--- Changes above this line will be automatically regenerated -->
