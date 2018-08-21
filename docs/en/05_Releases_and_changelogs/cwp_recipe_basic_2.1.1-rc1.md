# 2.1.1-rc1

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-07-18 [e2af1cf](https://github.com/silverstripe/cwp-installer/commit/e2af1cfdee33be8e8a4e89fd099c7d9d12d4cb6b) Disabling use of serialise fallback in MultiValueField for new installations (Guy Marriott) - See [ss-2018-017](https://www.silverstripe.org/download/security-releases/ss-2018-017)

### Features and Enhancements

 * 2018-04-18 [3561466](https://github.com/silverstripe/recipe-core/commit/3561466e5ea479ee5602451d9fe2240a952ed56a) Provide default IIS rewriting rules with recipe (Damian Mooyman)
 * 2018-04-13 [24ff267](https://github.com/symbiote/silverstripe-queuedjobs/commit/24ff267b1311d7f10fa81f91211481a8a624b35d) Ability to inject a different process manager class. (Frank Mullenger)
 * 2018-04-04 [ee6b9c8](https://github.com/symbiote/silverstripe-queuedjobs/commit/ee6b9c82c94b1e91bca415a555711b149fc40b0f) Allow ProcessManager log path to be configurable via environment variable (Robbie Averill)
 * 2017-12-20 [35fa3c3](https://github.com/symbiote/silverstripe-queuedjobs/commit/35fa3c382dca145a2104fcb2f25a50c10f107373) Convert to vendor module, update use of cli-script with sake and some readme examples (Robbie Averill)
 * 2017-11-14 [47f87be](https://github.com/symbiote/silverstripe-queuedjobs/commit/47f87bed67cb711c29f4d82a099c6a7f542fbe3f) Log job output into the job messages. (Sam Minnee)
 * 2017-11-13 [1f0d551](https://github.com/symbiote/silverstripe-queuedjobs/commit/1f0d5515b45e99107b82ac0319cb5e1212de865e) Add DeleteAllJobsTask (Sam Minnee)
 * 2017-11-10 [a99f165](https://github.com/symbiote/silverstripe-queuedjobs/commit/a99f165b730e1f7cd07a6ddd2f5b3780083e1e1f) Allow queueing of build tasks (Sam Minnee)

### Bugfixes

 * 2018-08-01 [8927721](https://github.com/tractorcow/silverstripe-fluent/commit/8927721ea66c2c7f746d6dbe04316202ddd43e10) Ensure alterQuery is compatible with silverstripe/fulltextsearch &lt;3.3 (Robbie Averill)
 * 2018-08-01 [140f054](https://github.com/tractorcow/silverstripe-fluent/commit/140f054b87ab6073ddd1224a230518db11b70c2c) deprecated filter method in SearchVariant (Sander Hagenaars)
 * 2018-07-26 [9822a7c](https://github.com/silverstripe/cwp/commit/9822a7c8f0ce8cd828b06ab46a1f91a98257bc88) Correct assertion order in CwpStatsReportTest (Robbie Averill)
 * 2018-07-16 [65e1847](https://github.com/tractorcow/silverstripe-fluent/commit/65e184767d60c315c85fe41cba7487116abb8daf) linting issues (Damian Mooyman)
 * 2018-07-14 [a0e0bed](https://github.com/silverstripe/recipe-core/commit/a0e0bed7e7fe83b98264563efdeffa82d0d01d04) Use Injector to create PasswordValidators (Daniel Hensby)
 * 2018-07-13 [0be2919](https://github.com/tractorcow/silverstripe-fluent/commit/0be2919c002df80ee75259927516a0b8b8ec0721) up regex logic and unit tests (Damian Mooyman)
 * 2018-07-09 [c3ac001](https://github.com/silverstripe/silverstripe-blog/commit/c3ac001a0a73194b48b642b8132813f941c2c68b) Unable to remove 'Post Options' tab (Loz Calver)
 * 2018-07-05 [d533744](https://github.com/silverstripe/cwp-starter-theme/commit/d5337442d9af6b647823668ccbf84ecde57135ec) mobile search form action going to wrong route (Mikaela Young)
 * 2018-06-29 [9b95e8b](https://github.com/silverstripe/cwp-starter-theme/commit/9b95e8b8e7e5a02afaabbe186490f42db0ca96ba) Various fixes to banner blocks (Guy Marriott)
 * 2018-06-20 [a2af250](https://github.com/symbiote/silverstripe-queuedjobs/commit/a2af250bb7fac32952e7b2358022933f99b0e4bb) Allow integration/unit tests to use more memory, update assertions and docblock tweaks (Robbie Averill)
 * 2018-06-18 [0b69b49](https://github.com/silverstripe/cwp-recipe-cms/commit/0b69b498337e777f6d494bef438822378bc0d8b3) Add proxy configuration for embedded cURL requests (Robbie Averill)
 * 2018-06-18 [d989074](https://github.com/symbiote/silverstripe-queuedjobs/commit/d989074f4049239a59b3e368f501259b8f35c4cf) ed a case where original user was missing when unsetting a user. (Mojmir Fendek)
 * 2018-06-15 [ed80e1c](https://github.com/silverstripe/silverstripe-userforms/commit/ed80e1c95bfc5c3aa278e72437fb94287923969f) Prevent form's toolbar from extending into the preview (Raissa North)
 * 2018-06-12 [73cccf9](https://github.com/silverstripe/cwp-installer/commit/73cccf9eb62f8481452ab85e2b684936e3a5ead2) Removing syntax error in config file (Guy)
 * 2018-05-29 [8fc5a6b](https://github.com/symbiote/silverstripe-queuedjobs/commit/8fc5a6b7deabb0fea6f8554ba811901b9ebda52c) Implement subsites namespace into QueuedJobService (Robbie Averill)
 * 2018-05-28 [d23faff](https://github.com/silverstripe/cwp-core/commit/d23faffae90c754358ed75ee94d889659ff28630) Correct assertion order in CwpStatsReportTest (Robbie Averill)
 * 2018-05-28 [2a97b05](https://github.com/symbiote/silverstripe-queuedjobs/commit/2a97b05f50bac8f7df8bfd40f4d1cfb861dd2ed4) Mock current date and time in scheduled execution test (Robbie Averill)
 * 2018-05-27 [191178c](https://github.com/symbiote/silverstripe-queuedjobs/commit/191178cbca78c8e2b6b5f75979637544970828f3) Use correct namespaces for Versioned and ErrorPage (Robbie Averill)
 * 2018-05-18 [d81d7cd](https://github.com/tractorcow/silverstripe-fluent/commit/d81d7cd6a7ebe1f2459c14d88e3c7cb38c46e9bb) Implement localisable order by clause (Robbie Averill)
 * 2018-05-06 [b3cff89](https://github.com/symbiote/silverstripe-queuedjobs/commit/b3cff8990eec35917dddf79542c7001f214d4b5e) Fixes #173 Check for excistence of root object. (Russell Michell)
 * 2018-04-24 [2e18723](https://github.com/symbiote/silverstripe-queuedjobs/commit/2e18723f4cd8875313b0e8714508b7f60cd67b43) Swap deprecated Member::currentUser and check that $jobType is a job (Robbie Averill)
 * 2018-03-27 [d0c07de](https://github.com/symbiote/silverstripe-queuedjobs/commit/d0c07de2c606e1481998ed1438d34c254f6dc101) Clear the binary so that PHP is not used to interpret the sake bash script. (Frank Mullenger)
 * 2018-03-20 [3a3f90e](https://github.com/symbiote/silverstripe-queuedjobs/commit/3a3f90ed9efd23dc060e45998eb5dc9b5f669494) travix builds (Daniel Hensby)
 * 2018-03-20 [bb3e9d6](https://github.com/symbiote/silverstripe-queuedjobs/commit/bb3e9d6ab64aa6ba2b4c03a2e00fe986122ac299) Missing use statement for ProcessManager (Gordon Anderson)
 * 2018-03-20 [8868535](https://github.com/symbiote/silverstripe-queuedjobs/commit/8868535ff5449f27d039edf8f3f21934a2afa11a) Ensure null-&gt;ID is not evaluated (Gordon Anderson)
 * 2018-01-26 [02b3218](https://github.com/symbiote/silverstripe-queuedjobs/commit/02b3218f3b07e96f955db509b75bd611551db895) Correct field name in execute action handler and update icons to use admin icons (Robbie Averill)
 * 2018-01-25 [92b25b8](https://github.com/symbiote/silverstripe-queuedjobs/commit/92b25b896dee86c50cb9b25cd5b0f9d931f3f00f) Use 'clipboard-pencil' font icon and delete graphic used prior (Raissa North)
 * 2017-12-21 [3e45f63](https://github.com/symbiote/silverstripe-queuedjobs/commit/3e45f639efc2d079d76254adbb6482d97c3995db) Fixes #156 Addition of missing `TempFolder` and `Environment` (Russell Michell)
 * 2017-12-21 [b58f6d0](https://github.com/symbiote/silverstripe-queuedjobs/commit/b58f6d0af2ec4374422a6563b2cde749ab46f630) (travis) remove php 5.3 from Travis config as it's no longer supported (Stephen McMahon)
 * 2017-12-21 [f6750a9](https://github.com/symbiote/silverstripe-queuedjobs/commit/f6750a9849eaa3fa51d08460282e4a114a10cd50) (Service) ensure run as user is cleared at the end of each runJob (Stephen McMahon)
 * 2017-12-20 [1aa94d7](https://github.com/symbiote/silverstripe-queuedjobs/commit/1aa94d7d00363bd4be25fac1ac4c2bcba9365114) Switch tab whitespace for spaces to fix linting (Robbie Averill)
 * 2017-11-15 [a950213](https://github.com/symbiote/silverstripe-queuedjobs/commit/a950213a8e741beb795d2051291581bcb8b063d4) Better messages. (Sam Minnee)
 * 2017-11-02 [087c8ca](https://github.com/symbiote/silverstripe-queuedjobs/commit/087c8ca1ac10b2b0b38810417e6880d1e671f26d) ImmediateQueueHandler needs `scheduleJob` method to match expected API (Daniel Hensby)
 * 2017-10-04 [1c0b041](https://github.com/symbiote/silverstripe-queuedjobs/commit/1c0b0415bd4e5a4fe3d07439a3201962fbf2240d) convert CI bootstrap references to new their new locations in vendor (Dylan Wagstaff)
 * 2017-09-26 [71359b4](https://github.com/symbiote/silverstripe-queuedjobs/commit/71359b46460a1ad30afa123b0c85480b23e3a1d6) Complete namespacing of translations, remove en_US.php and run text collection (Robbie Averill)
 * 2017-09-24 [ccf8f72](https://github.com/symbiote/silverstripe-queuedjobs/commit/ccf8f7207ca6c4258601f81b8064377a41a9c178) Update "Create new job" button to use bootstrap and escape HTML in messages in GridField (Robbie Averill)
 * 2017-07-20 [4103227](https://github.com/symbiote/silverstripe-queuedjobs/commit/4103227be50726a4ec031bfad95a171c0d8864c4) (defaultJobs) fix filtering of active jobs. Improve log messages (Stephen McMahon)
 * 2017-07-19 [35d1ade](https://github.com/symbiote/silverstripe-queuedjobs/commit/35d1ade3303c1eda4292366f8995d73f278be967) (defaultJobs) update readme and default jobs check to use injector correctly (Stephen McMahon)
 * 2017-07-11 [46f240e](https://github.com/symbiote/silverstripe-queuedjobs/commit/46f240ea1e22f87db89b688236114eea5ffd8ad9) , replacing a deprecated class, since this statement doesn't need to exist. (Nathan Glasl)
 * 2017-07-11 [ca98461](https://github.com/symbiote/silverstripe-queuedjobs/commit/ca98461c48d10811afafd989b48efba51356f465) , updating the maintainer address and temporarily removing the broken CI. (Nathan Glasl)
 * 2017-07-10 [8fc975f](https://github.com/symbiote/silverstripe-queuedjobs/commit/8fc975fef27d6953fd9dbf20aa351827f7e94560) , correcting some references that are no longer valid with SS4. (Nathan Glasl)
 * 2017-07-10 [a134ca1](https://github.com/symbiote/silverstripe-queuedjobs/commit/a134ca13c31da1a0f1e76abedc13cb3d74f173f3) , replacing a deprecated function. (Nathan Glasl)
 * 2017-07-05 [59f0cb9](https://github.com/symbiote/silverstripe-queuedjobs/commit/59f0cb90ab1b3c3eceb537196220246070f1581b) (defaultJobs) config now loads correctly. Add SS_Log of missing job. Change admin email queued_job_admin_email (Stephen McMahon)
 * 2017-07-05 [69b27e9](https://github.com/symbiote/silverstripe-queuedjobs/commit/69b27e970225b1e678ea1a9bf5c25b84fc7d4396) (QueuedJobService): When a job hits the "Job releasing memory and waiting" case and completed successfully, it would not run the 'afterComplete' logic. (Jake Bentvelzen)
 * 2017-06-30 [b0a83fb](https://github.com/symbiote/silverstripe-queuedjobs/commit/b0a83fb934e7dc2f01144920dcbcf12da1cfd311) , correcting an issue where the module would end up on the wrong path. (Nathan Glasl)
 * 2017-05-15 [f6f6731](https://github.com/symbiote/silverstripe-queuedjobs/commit/f6f67314dad8b90ca22b918de033257f189e3dcb) markStarted not calculating timeout correctly (matt-in-a-hat)
 * 2017-05-10 [a28aae9](https://github.com/symbiote/silverstripe-queuedjobs/commit/a28aae9c5234c241447d7752d6464d7042c3b4be) (JobErrorHandler): Fix bug where deprecation / variable set in if-statement would always cause zero outputting of errors to console. Modified logic to align with Core silverstripe functions (Jake Bentvelzen)
 * 2017-05-07 [3f094b3](https://github.com/symbiote/silverstripe-queuedjobs/commit/3f094b35c194cd7e0499108e460a3bc8003c4af6) Issue where setting isComplete=true during 'setup()' or 'prepareForRestart()' causes the job to say its "Running" indefinitely. (Marcus Nyeholt)
 * 2017-02-19 [0215e70](https://github.com/symbiote/silverstripe-queuedjobs/commit/0215e7009826d3f52b0f80ca98d4b89adf6655b1) (defaultJobs) improve code clarity (Stephen McMahon)
 * 2017-02-14 [b3e40dc](https://github.com/symbiote/silverstripe-queuedjobs/commit/b3e40dc91ee02cbea42e12b0041579f18588ce76) (defaultJobs) add content to missing job email (Stephen McMahon)
 * 2017-02-07 [4072408](https://github.com/symbiote/silverstripe-queuedjobs/commit/4072408ce6e597ea966ca2c025bd44b964fab53c) (QueuedJobService) Broken job status set Wait (Marcus Nyeholt)
