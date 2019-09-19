# 1.9.3

This CWP release ensures compatiblity with PHP 7.2 and newer

## Upgrading

To upgrade, adjust your projects composer.json to reflect the new constraints:

```json
        "cwp/cwp-recipe-basic": "^1.9.3@stable",
        "cwp/cwp-recipe-blog": "^1.9.3@stable"
```

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Bugfixes

 * 2019-08-22 [12deace](https://github.com/silverstripe/cwp/commit/12deacebba7c1b904c8c7d40eed476bb886f9b20) Use SS_Object for PHP 7.2 compatibility (Robbie Averill)
 * 2019-08-20 [0928fda](https://github.com/silverstripe/cwp/commit/0928fda3998ea33cea7c8fac93c8a2d9a9432e1f) DatedUpdateHolder should use aggregated columns for better MySQL version support (Guy Marriott)
 * 2019-08-20 [671e1b1](https://github.com/silverstripe/cwp/commit/671e1b15d86bf66eccbe7f3f779b1f1376e4a4ed) Ensure PHP 7.2+ compatibility (Guy Marriott)

### Other changes

 * 2019-09-18 [f23e4a1](https://github.com/silverstripe/cwp-recipe-basic/commit/f23e4a1a279e21285d4deb417073321ae88e1567) Update development dependencies (Dylan Wagstaff)
 * 2019-09-03 [384a01e](https://github.com/silverstripe/cwp/commit/384a01eb921cd63099bcfaaa3531c1ca975a7169) DOCS correct 1.9 release description (Bryn Whyman)
 * 2019-08-22 [b82dbc4](https://github.com/silverstripe/cwp-recipe-basic/commit/b82dbc42051b4810d7f07ad95e4aa3d45922c7a6) Update sortablegridfield to ~1.0 (Robbie Averill)
<!--- Changes above this line will be automatically regenerated -->
