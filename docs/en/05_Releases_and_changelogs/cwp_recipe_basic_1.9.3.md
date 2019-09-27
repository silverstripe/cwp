# 1.9.3

This CWP release ensures compatiblity with PHP 7.2 and newer

## Upgrading

To upgrade, adjust your projects composer.json to reflect the new constraints:

```json
    "require": {
        "cwp/cwp-recipe-basic": "^1.9.3@stable",
        "cwp/cwp-recipe-blog": "^1.9.3@stable",
        [...]
    },
```

## Multi-factor Authentication (MFA)

This version has been released with a minor issue preventing MFA from operating in conjunction with the subsites module. Releases for both Framework and Subsites have been made since in order to rectify this, however as these were not included in the security audit for the 1.9.3 release agencies are encouraged to evaluate the decision to install these, and the impacts for them in deviating from the security audited CWP release.

In addition to following the installation steps of the [MFA module](https://github.com/silverstripe/silverstripe-mfa/tree/3.0.0), you will first need to inline the `cwp/cwp-recipe-basic` if it is in use.

To inline the requirements of `cwp/cwp-recipe-basic` you should make the following amendments to the site's composer.json:

```diff
-        "cwp/cwp-recipe-basic": "~1.9.3@stable",
+        "cwp/cwp": "1.9.3@stable",
+        "cwp/cwp-core": "1.9.3@stable",
+        "silverstripe/cms": "3.7.3@stable",
+        "silverstripe/framework": "3.7.3@stable",
+        "silverstripe/siteconfig": "3.7.3@stable",
+        "silverstripe/reports": "3.7.3@stable",
+        "symbiote/silverstripe-advancedworkflow": "4.2.0@stable",
+        "silverstripe/contentreview": "3.0.8@stable",
+        "silverstripe/documentconverter": "1.0.15@stable",
+        "silverstripe/externallinks": "1.1.0@stable",
+        "silverstripe/fulltextsearch": "2.5.0@stable",
+        "symbiote/silverstripe-gridfieldextensions": "2.1.0@stable",
+        "silverstripe/html5": "1.0.6@stable",
+        "silverstripe/iframe": "1.0.16@stable",
+        "silverstripe/mimevalidator": "1.0.12@stable",
+        "symbiote/silverstripe-multivaluefield": "3.1.1@stable",
+        "symbiote/silverstripe-queuedjobs": "3.1.3@stable",
+        "silverstripe/registry": "1.0.15@stable",
+        "silverstripe/restfulserver": "1.0.8@stable",
+        "silverstripe/secureassets": "1.2.0@stable",
+        "silverstripe/securityreport": "1.0.10@stable",
+        "silverstripe/selectupload": "1.0.7@stable",
+        "silverstripe/sharedraftcontent": "1.4.0@stable",
+        "silverstripe/sitewidecontent-report": "2.0.4@stable",
+        "undefinedoffset/sortablegridfield": "~1.0.3",
+        "silverstripe/spellcheck": "1.1.0@stable",
+        "silverstripe/subsites": "1.4.1@stable",
+        "silverstripe/taxonomy": "1.3.1@stable",
+        "silverstripe/translatable": "2.3.2@stable",
+        "silverstripe/userforms": "4.6.1@stable",
+        "symbiote/silverstripe-versionedfiles": "2.0.2@stable",
+        "silverstripe/versionfeed": "1.2.6@stable",
+        "bringyourownideas/silverstripe-maintenance": "1.1.0@stable",
+        "bringyourownideas/silverstripe-composer-update-checker": "1.1.0@stable",
+        "bringyourownideas/silverstripe-composer-security-checker": "1.1.0@stable"
```

Then change the requirement of `silverstripe/framework` to `3.7.4` and `silverstripe/subsites` to `1.4.2`.

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
