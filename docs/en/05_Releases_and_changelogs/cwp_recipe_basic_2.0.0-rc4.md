# 2.0.0-rc4

This security release removes the following file extensions from the default whitelist of accepted types for
uploaded files: `dotm`, `potm`, `jar`, `css`, `js` and `xltm`.

If you require the ability to upload these file types in your projects, you will need to add them back in again.
For more information, see ["Configuring: File types"](https://docs.silverstripe.org/en/4/developer_guides/files/file_security/#configuring-file-types).

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-05-24 [3bddea7](https://github.com/silverstripe/cwp-installer/commit/3bddea788374a3ba4289d86630db164f9701c1a9) Prevent php code execution in assets folder, and remove file extensions (Robbie Averill) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-26 [02db1cc](https://github.com/silverstripe/silverstripe-comments/commit/02db1cc86e60ae7d822d5476a60d5bad0ecdb948) Update jQuery version, remove entwine from frontend use (Dylan Wagstaff) - See [ss-2018-015](http://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [c461dcb](https://github.com/silverstripe/cwp-starter-theme/commit/c461dcb1ffd084e6d33f31b28570073f619da802) Update jQuery version used in templates (Dylan Wagstaff) - See [ss-2018-015](http://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [238ae51](https://github.com/silverstripe/cwp-watea-theme/commit/238ae5166a9e5d507a69023503301ff807c021ce) Update jQuery version used in templates (Dylan Wagstaff) - See [ss-2018-015](http://www.silverstripe.org/download/security-releases/ss-2018-015)
 * 2018-04-26 [299131ed2](https://github.com/silverstripe/silverstripe-framework/commit/299131ed2) File security documentation (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-25 [be96858](https://github.com/silverstripe/silverstripe-installer/commit/be96858e85272ca62f6f0ff3e24a44aa0248ac4d) Remove jar, dotm, potm, xltm from file extension whitelist, hard-code CSS and JS for TinyMCE support (Robbie Averill) - See [ss-2018-014](http://www.silverstripe.org/download/security-releases/ss-2018-014)
 * 2018-04-24 [f847f186b](https://github.com/silverstripe/silverstripe-framework/commit/f847f186b) Remove password text from session data on failed submission (Aaron Carlino) - See [ss-2018-013](http://www.silverstripe.org/download/security-releases/ss-2018-013)
 * 2018-04-23 [aa365e0](https://github.com/silverstripe/silverstripe-assets/commit/aa365e0) Remove dotm, potm, jar, css, js, xltm from default File.allowed_extensions (Robbie Averill) - See [ss-2018-014](http://www.silverstripe.org/download/security-releases/ss-2018-014)
 * 2018-04-23 [cf330de](https://github.com/silverstripe/cwp-core/commit/cf330def0f0afb7f82876a30eab4c0c658d40a1d) Enforce HTTPS for all URLs when in test mode (Robbie Averill) - See [ss-2018-009](http://www.silverstripe.org/download/security-releases/ss-2018-009)
 * 2018-04-23 [f9c03fa](https://github.com/silverstripe/silverstripe-installer/commit/f9c03fa623dc7237005901efd863256b7d356db7) Prevent php code execution in assets folder (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-23 [1e27835](https://github.com/silverstripe/silverstripe-assets/commit/1e27835) Prevent php code execution in assets folder (Damian Mooyman) - See [ss-2018-012](http://www.silverstripe.org/download/security-releases/ss-2018-012)
 * 2018-04-22 [beec0c0d4](https://github.com/silverstripe/silverstripe-framework/commit/beec0c0d4) regression of SS-2017-002 (Robbie Averill) - See [ss-2018-010](http://www.silverstripe.org/download/security-releases/ss-2018-010)
 * 2018-04-19 [b2c5576](https://github.com/silverstripe/silverstripe-taxonomy/commit/b2c5576) Fix search term escaping to prevent possible SQL injection attack (Robbie Averill) - See [ss-2018-11](http://www.silverstripe.org/download/security-releases/ss-2018-011)
 * 2018-04-11 [e409d6f67](https://github.com/silverstripe/silverstripe-framework/commit/e409d6f67) Restrict non-admins from being assigned to admin groups (Damian Mooyman) - See [ss-2018-001](http://www.silverstripe.org/download/security-releases/ss-2018-001)
 * 2018-04-10 [9053014a7](https://github.com/silverstripe/silverstripe-framework/commit/9053014a7) Validate against malformed urls (Damian Mooyman) - See [ss-2018-008](http://www.silverstripe.org/download/security-releases/ss-2018-008)
 * 2018-04-10 [2e13ae746](https://github.com/silverstripe/silverstripe-framework/commit/2e13ae746) Prevent code execution in template value resolution (Damian Mooyman) - See [ss-2018-006](http://www.silverstripe.org/download/security-releases/ss-2018-006)
 * 2018-04-09 [db04ed9](https://github.com/silverstripe/silverstripe-admin/commit/db04ed9) Remove on* events as allowed properties (Damian Mooyman) - See [ss-2018-004](http://www.silverstripe.org/download/security-releases/ss-2018-004)
 * 2018-04-08 [d935140a9](https://github.com/silverstripe/silverstripe-framework/commit/d935140a9) Prevent unauthenticated isDev / isTest being allowed (Damian Mooyman) - See [ss-2018-005](http://www.silverstripe.org/download/security-releases/ss-2018-005)

### Features and Enhancements

 * 2018-04-13 [24ff267](https://github.com/symbiote/silverstripe-queuedjobs/commit/24ff267b1311d7f10fa81f91211481a8a624b35d) Ability to inject a different process manager class. (Frank Mullenger)
 * 2018-04-08 [fa2bb55](https://github.com/silverstripe/silverstripe-documentconverter/commit/fa2bb5569641cd713d858c11c6a723845fad80a6) Replace HeaderField with LiteralField (Raissa North)
 * 2018-04-04 [ee6b9c8](https://github.com/symbiote/silverstripe-queuedjobs/commit/ee6b9c82c94b1e91bca415a555711b149fc40b0f) Allow ProcessManager log path to be configurable via environment variable (Robbie Averill)
 * 2017-12-21 [4d60f01](https://github.com/silverstripe/silverstripe-installer/commit/4d60f01d2dd17febcf15c08ecdc07af7380694d0) add test for a `--no-dev` build (Christopher Joe)

### Bugfixes

 * 2018-05-23 [e7e32d13a](https://github.com/silverstripe/silverstripe-framework/commit/e7e32d13a) Add namespace and encryptor to tests that expect blowfish to be available (Robbie Averill)
 * 2018-05-22 [a0230a3](https://github.com/silverstripe/silverstripe-spellcheck/commit/a0230a3360ece10495958b34a4e93e6a7a288258) Manually replace Maori with Māori (intl bug) (Robbie Averill)
 * 2018-05-18 [c7ab8df](https://github.com/silverstripe/cwp/commit/c7ab8df9d6b6deeaf05a66d026b348f0e784872d) broken links (Raissa North)
 * 2018-05-18 [4913290](https://github.com/silverstripe/silverstripe-userforms/commit/491329044b38314f217e750d810ec1237451c660) Add extension to remap polymorphic relationship classes for Parent and Form fields (Robbie Averill)
 * 2018-05-09 [8f363d6](https://github.com/silverstripe/silverstripe-userforms/commit/8f363d6b608b08a70c423a56473d673cbda923ff) Remove unnecessary translation of parameterised field value (Raissa North)
 * 2018-05-03 [a40daef](https://github.com/silverstripe/cwp/commit/a40daefc966e2143f57edd8e115fd89c87bebeeb) Set default_locale to en_NZ, and allow errors to be returned as 200 OK (Robbie Averill)
 * 2018-05-03 [a3b586a](https://github.com/silverstripe/silverstripe-spellcheck/commit/a3b586a3978ae1df00f8552142d96aa45f3ce23f) Allow configurable default locale, or use the first defined locale (Robbie Averill)
 * 2018-05-03 [c0bd59c](https://github.com/silverstripe/silverstripe-spellcheck/commit/c0bd59cc593c0fb8216a9942de6172ecae528592) Allow errors to be returned with 200 header codes (Robbie Averill)
 * 2018-04-23 [838ce23](https://github.com/silverstripe/cwp/commit/838ce231febc505c177e302931771740c953e2e5) regex in performance guide htaccess rules (Tomas Cantwell)
 * 2018-04-22 [dca8ae5](https://github.com/silverstripe/cwp/commit/dca8ae53a678a9de964dc3b5bbc11c71fcd7b5d3) regex issue in performance docs (Tomas Cantwell)
 * 2018-04-20 [b4943fb](https://github.com/silverstripe/silverstripe-subsites/commit/b4943fb77c4ee612bb8bc16772866f0f06e2501b) Automatically create default SiteTree records for new subsites (Robbie Averill)
 * 2018-04-20 [f47a222](https://github.com/silverstripe/cwp/commit/f47a2225d8b52f81f8038767e8e82be7764f4366) Unentice direct BasePage creation in the CMS (Dylan Wagstaff)
 * 2018-04-15 [4d333b2](https://github.com/silverstripe/silverstripe-taxonomy/commit/4d333b2a06bb5dd23fd106a56dcae892c60c6b93) Move directory controller template into correct location (Robbie Averill)
 * 2018-04-11 [caab511](https://github.com/silverstripe/silverstripe-userforms/commit/caab51122b0aedf4decd02a931391ebe24ea88ff) the each loop to propperly get the field passed in (Simon Erkelens)
 * 2018-04-05 [39044de](https://github.com/silverstripe/silverstripe-externallinks/commit/39044de8ad7d05cd07e51ee0f10149d465205012) Use correct CacheInterface API methods and remove doubled up logic (Robbie Averill)
 * 2018-04-04 [a886f68](https://github.com/silverstripe/silverstripe-comments/commit/a886f68c58c3b45ae70cd91906cbd0677e9fd821) reintroduce extension hook for comment form rendering (Raissa North)
 * 2018-04-03 [b450b5c](https://github.com/silverstripe/cwp/commit/b450b5ccbfcbab1bbe482a0bcc8b3699cd202b03) Only add File_ShowInSearch if File class is in query (Raissa North)
 * 2018-04-03 [2b3b0c8](https://github.com/silverstripe/silverstripe-iframe/commit/2b3b0c84ebf22fa2334e6390ab1717ee101936eb) Cast IFrameURL right title as HTMLText to avoid double escaping (Robbie Averill)
 * 2018-03-29 [0ca0b2c](https://github.com/silverstripe/cwp-starter-theme/commit/0ca0b2c0f56e88afdb395b979bf30e6153fb6af9) let CompositeField subclasses render themselves (Dylan Wagstaff)
 * 2018-03-23 [7e9f6ce](https://github.com/silverstripe/silverstripe-auditor/commit/7e9f6cef53fc235ea5997e0c295c82a653f4c8af) Handle nullable $original object argument in onAfterPublish (Robbie Averill)
 * 2018-03-23 [f7ffb70](https://github.com/silverstripe/silverstripe-userforms/commit/f7ffb706ce784fbdcf388ce888b0df9ff934b5b9) Use userforms template for member list field, fixes display rule issue (Robbie Averill)
 * 2018-03-20 [bb3e9d6](https://github.com/symbiote/silverstripe-queuedjobs/commit/bb3e9d6ab64aa6ba2b4c03a2e00fe986122ac299) Missing use statement for ProcessManager (Gordon Anderson)
 * 2018-02-06 [5bff64b47](https://github.com/silverstripe/silverstripe-framework/commit/5bff64b47) Fix Director::test() not persisting removed session keys on teardown (Damian Mooyman)
