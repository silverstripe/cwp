# 1.6.0-rc2

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2017-05-24 [41270fcf](https://github.com/silverstripe/silverstripe-cms/commit/41270fcf9980c4be2529d2750c717675548eb617) Only allow HTTP(S) links for external redirector pages (Daniel Hensby) - See [ss-2017-003](http://www.silverstripe.org/download/security-releases/ss-2017-003)
 * 2017-05-09 [447ce0f84](https://github.com/silverstripe/silverstripe-framework/commit/447ce0f84f880c2bc969a89e4be528c53caeabe0) Lock out users who dont exist in the DB (Daniel Hensby) - See [ss-2017-002](http://www.silverstripe.org/download/security-releases/ss-2017-002)
 * 2017-05-09 [61cf72c0](https://github.com/silverstripe/silverstripe-cms/commit/61cf72c08dafddef416d73f943ccd45e70c5d43d) Unescaped fields in CMSPageHistroyController::compare() (Daniel Hensby) - See [ss-2017-004](http://www.silverstripe.org/download/security-releases/ss-2017-004)

### Bugfixes

 * 2017-06-01 [d353aba](https://gitlab.cwp.govt.nz/cwp/cwp-installer/commit/d353abab3bbe08159dddb3a297acd981244ba0d8) Update changelog prefix number. 04 is now performance guides. (Robbie Averill)
 * 2017-05-30 [51164768](https://github.com/silverstripe/silverstripe-cms/commit/51164768751de4e2c7c931d21f5635714df7bf34) Issue where CMS SiteTree can result in infinite recursion if parent and child relation is swapped (Daniel Hensby)
 * 2017-05-28 [16a74bc8a](https://github.com/silverstripe/silverstripe-framework/commit/16a74bc8a9fdee7cfb4f6f24493c271f90a76341) DataDifferencer needs to expliclty cast HTMLText values (Daniel Hensby)
 * 2017-05-24 [e86306c](https://github.com/silverstripe/silverstripe-userforms/commit/e86306c7bf12a3b17cb698e3559fc176444ef463) incorrect calculation of MAX_FILE_SIZE (#600) (Reece Alexander)
 * 2017-05-24 [ca1e2ab](https://github.com/silverstripe/silverstripe-userforms/commit/ca1e2abd833001d40bc2a32b55914e6670416601) Remove empty column in display logic GridField for form field (Sacha Judd)
 * 2017-05-22 [7c3edd4](https://github.com/silverstripe/silverstripe-userforms/commit/7c3edd4d5119fd6ff1634a74d087a5b995b0ea4a) Hide and show form fields by toggling the "hide" class instead of jQuery methods (Robbie Averill)
 * 2017-05-17 [11f43c2](https://github.com/silverstripe/silverstripe-userforms/commit/11f43c27dc56f0e592ad63ea15fab951d5be61bb) Make EditableLiteralField extensible, have its own template, honour visibility rules (Robbie Averill)
 * 2017-05-08 [14540729](https://github.com/silverstripe/silverstripe-cms/commit/14540729caa30dd2e782e4fd52afe518dc156ed8) Use framework 3.5 to test cms 3.5 (Sam Minnee)
 * 2017-05-03 [2d138b0ef](https://github.com/silverstripe/silverstripe-framework/commit/2d138b0ef06bd93958cc0678a0afa95560648fb9) class name reference consistency (Gregory Smirnov)
 * 2017-05-02 [2187c160b](https://github.com/silverstripe/silverstripe-framework/commit/2187c160b936620621fe746a1ffe36af568b21ff) ing pagination api doc typo (3Dgoo)
 * 2017-04-28 [a511e3511](https://github.com/silverstripe/silverstripe-framework/commit/a511e3511cace405dab7589a3406a0858cb6edf2) #6855: Mangled JS in Requirements, escaping replacement values prior to passing to preg_replace(). (Patrick Nelson)
 * 2017-04-26 [1ff6f3f1](https://github.com/silverstripe/silverstripe-cms/commit/1ff6f3f1b047a1d27b3d60217dc262e8a1c9f54c) ing doArchive (John Milmine)
 * 2017-04-24 [1d36f354e](https://github.com/silverstripe/silverstripe-framework/commit/1d36f354e8349616c7b39fcade859fbcf0f9c362) Create Image_Cached with Injector. (Gregory Smirnov)
 * 2017-04-05 [197bc53c4](https://github.com/silverstripe/silverstripe-framework/commit/197bc53c4963898d2c10621ca6d6031fdb14fe85) Add transparency percent argument to Image::generatePad to ensure transparency works from ::Pad (Robbie Averill)
