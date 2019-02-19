# 1.8.3

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2019-01-10 [c44f06cdf](https://github.com/silverstripe/silverstripe-framework/commit/c44f06cdf10387a987e4efb096ff06b3bb4495ef) Patch SQL Injection vulnerability when arrays are assigned to DataObject Fields (Aaron Carlino) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
 * 2018-12-06 [a2a207f](https://github.com/symbiote/silverstripe-multivaluefield/commit/a2a207fbeb4af6a5f2c6781b21b63ecbc1ea4ae4) Adjust MultiValueField to work with the new scalarValueOnly method (Maxime Rainville) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
 * 2018-09-26 [598edd913](https://github.com/silverstripe/silverstripe-framework/commit/598edd91341f389d7b919ec1201e03d2aba4d284) Add confirmation token to dev/build (Loz Calver) - See [ss-2018-019](https://www.silverstripe.org/download/security-releases/ss-2018-019)

### Bugfixes

 * 2019-01-23 [746c0679a](https://github.com/silverstripe/silverstripe-framework/commit/746c0679ad1d6ceac03d2adf167367f0ca2259cd) Injector may instantiate prototypes as if they're singletons (fixes #8567) (Loz Calver)
 * 2018-11-15 [86701b8cd](https://github.com/silverstripe/silverstripe-framework/commit/86701b8cd0cd5f8de813a7c9347e7c8055d878f4) Redirect loop with multiple URL tokens (fixes #8607) (Loz Calver)
 * 2018-06-04 [41e601a03](https://github.com/silverstripe/silverstripe-framework/commit/41e601a036307065d9ea2ba8862f67be738d402f) Regression from #8009 (Daniel Hensby)
 * 2018-06-01 [5b47edc](https://github.com/silverstripe/cwp/commit/5b47edc5416cf8a4c8b1b9e2b6bea4bd50f0fb17) Fix broken links (#94) (Raissa North)
 * 2018-06-01 [ce1db58](https://github.com/silverstripe/cwp/commit/ce1db58045b6b1cfcfda8cc2ef7d88d1a3e0f17d) Fix broken link (#92) (Raissa North)
 * 2018-06-01 [1012ccb](https://github.com/silverstripe/cwp/commit/1012ccbb4c231caae30faa398c4aca935c5a3048) Fix broken link (Raissa North)
 * 2018-06-01 [af89140](https://github.com/silverstripe/cwp/commit/af8914063d3a3a8298ef6c3936f72ddd51d7174d) Fix broken link in developer docs (#91) (Raissa North)
 * 2018-06-01 [60a98be](https://github.com/silverstripe/cwp/commit/60a98be6391ec70f7fc6c4847ed2c9f60a44686c) Fix broken links in developer docs (Raissa North)
 * 2018-05-29 [1cbf27e0f](https://github.com/silverstripe/silverstripe-framework/commit/1cbf27e0f47c3547914b03193d0f5f77c87ff8d5) PHP 5.3 compat for referencing $this in closure, and make method public for same reason (Robbie Averill)
 * 2018-04-17 [af3a9f3ec](https://github.com/silverstripe/silverstripe-framework/commit/af3a9f3ec8a5465f841c5aa8ee1faf40c1b76bf4) Duplicating many_many relationships looses the extra fields (fixes #7973) (UndefinedOffset)
 * 2018-03-15 [d17d93f7](https://github.com/silverstripe/silverstripe-cms/commit/d17d93f784a6e01f3d396c55adc623d69a90261a) Remove SearchForm results() function from allowed_actions (Steve Dixon)
 * 2018-02-16 [86addea1d](https://github.com/silverstripe/silverstripe-framework/commit/86addea1d2a7b2e28ae8115279ae358bcb46648a) Split HTML manipulation to onadd, so elements are not accidentally duplicated (Christopher Joe)
 * 2018-02-13 [c767e472d](https://github.com/silverstripe/silverstripe-framework/commit/c767e472dc494408460ef47c27b8d34475da4ac6) DataObject singleton creation (Jonathon Menz)

### Other changes

 * 2019-02-18 [ea33b00](https://github.com/silverstripe/cwp-installer/commit/ea33b00286aa2ef211f120585c4b0fb53256cde3) Remove obsolete CWP repository configuration (Robbie Averill)
 * 2018-12-04 [cd47ef5](https://github.com/silverstripe/cwp/commit/cd47ef5dcba2476da1a95eb946afc7a0b68af6f0) detail what is synced in Active DR (Moss Cantwell)
 * 2018-08-09 [d9094a4](https://github.com/silverstripe/cwp/commit/d9094a40e8c261187b40e0b12ac841db964ae5ed) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-08-08 [6674e32](https://github.com/silverstripe/cwp/commit/6674e320b077337cce8e15b27db712f19f1233e3) Update realme_authentication.md (JessicaSilverStripe)
 * 2018-07-10 [08d46b2](https://github.com/silverstripe/cwp/commit/08d46b2ecc51db94fe77ff91cfd7571e4d3ee499) Mention php 7 can be enabled (jovenden)
 * 2018-06-02 [c1b0c5678](https://github.com/silverstripe/silverstripe-framework/commit/c1b0c56788a3ca230cbc76a2f38ee4300a678730) Increase memory limit to 2G in Travis builds (Robbie Averill)
 * 2018-05-31 [1f44a89](https://github.com/silverstripe/cwp/commit/1f44a89b2a608700e9fbdc8fb28bb6ae5498e3df) DOCS Update support timelines for CWP 1.8.1 and CWP 1.8.2 (#88) (Robbie Averill)
 * 2018-04-27 [766b2a494](https://github.com/silverstripe/silverstripe-framework/commit/766b2a4947ceff0217b6f70a848e720016bb59cc) Address issue #8038 (Matthew Walker)
 * 2018-04-17 [36198c482](https://github.com/silverstripe/silverstripe-framework/commit/36198c482e9e36638db59881a54915ef54b8a222) Removed extra lookup of the list (UndefinedOffset)
 * 2018-04-11 [51d4d2c11](https://github.com/silverstripe/silverstripe-framework/commit/51d4d2c11eb2c821eec9baf558667dc23d07116b) Update some phpdocs that had typos, missing parts or incorrect formats (Robbie Averill)
 * 2018-04-10 [6bce88b6b](https://github.com/silverstripe/silverstripe-framework/commit/6bce88b6bab6c8a6678b8c83e43ae03d3fe7d8b2) README fix contributing-link, add httpS (Lukas)
 * 2018-03-27 [61463424f](https://github.com/silverstripe/silverstripe-framework/commit/61463424ff134e4abc2c165cf7d7f846943c18ee) Support file grammer improvements (Daniel Hensby)
 * 2018-03-20 [78896a73e](https://github.com/silverstripe/silverstripe-framework/commit/78896a73e285ad602a49903f8d0e5b0d1753d3c8) Update link forum (Lukas)
 * 2018-03-11 [6fb8d27ac](https://github.com/silverstripe/silverstripe-framework/commit/6fb8d27ac57559031efef15f650562cfc77e4c33) Updated the DocBlock for ManyManyList's add() method (Benjamin Blake)
 * 2018-02-12 [e3cdefaa3](https://github.com/silverstripe/silverstripe-framework/commit/e3cdefaa3c214e1961179449242b0e77b535bf92) Add support.md file (Daniel Hensby)
 * 2018-02-12 [24ea2638f](https://github.com/silverstripe/silverstripe-framework/commit/24ea2638fe68a764a150fb04a819d62b17cd2c49) Create licence file so that GitHub (and humans) can more easily find it (Daniel Hensby)
 * 2015-07-27 [5df1ec7ee](https://github.com/silverstripe/silverstripe-framework/commit/5df1ec7eee53e50a5c0329ca73d67337f647d896) Use fputcsv in GridFieldExportButton (JorisDebonnet)
