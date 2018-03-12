# 1.8.1-rc1

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Features and Enhancements

 * 2017-11-14 [47f87be](https://github.com/symbiote/silverstripe-queuedjobs/commit/47f87bed67cb711c29f4d82a099c6a7f542fbe3f) Log job output into the job messages. (Sam Minnee)
 * 2017-11-13 [1f0d551](https://github.com/symbiote/silverstripe-queuedjobs/commit/1f0d5515b45e99107b82ac0319cb5e1212de865e) Add DeleteAllJobsTask (Sam Minnee)
 * 2017-11-10 [a99f165](https://github.com/symbiote/silverstripe-queuedjobs/commit/a99f165b730e1f7cd07a6ddd2f5b3780083e1e1f) Allow queueing of build tasks (Sam Minnee)

### Bugfixes

 * 2018-02-19 [f948afe](https://github.com/silverstripe/silverstripe-blog/commit/f948afe2710d90d0392b6647327010644f2de229) ing non int pagination variable server error (3Dgoo)
 * 2018-02-04 [96cde0f](https://github.com/silverstripe/silverstripe-userforms/commit/96cde0f04c4de1b6d90976839826ee22b8a6a4b5) Ensure display rules work correctly for EditableFormHeading (#712) (Scott Hutchinson)
 * 2018-01-26 [416915b08]() tableName is blank in CompositeDBField-&gt;addToQuery (Dominik Beerbohm)
 * 2018-01-25 [cf69d0486]() Fix ping including requirements (Damian Mooyman)
 * 2018-01-24 [c2cd6b383]() Fix Member_GroupSet::removeAll() (fixes #3948) (Loz Calver)
 * 2018-01-24 [f2b4c192e]() Fix UploadField cuts off “Save” button (closes #2862) (Loz Calver)
 * 2018-01-23 [7384e3fc2]() Gridfields with dropdowns having lots of overflow (Scott Hutchinson)
 * 2018-01-09 [2ef4a2d4e]() , adding a missing return statement. (Nathan)
 * 2017-12-21 [44930f211]() Allow HTML 5 input tags in FunctionalTest form submissions (Daniel Hensby)
 * 2017-12-14 [81150c592]() Use PHP 5.3 array syntax (Daniel Hensby)
 * 2017-12-12 [91dedf6](https://github.com/symbiote/silverstripe-multivaluefield/commit/91dedf6f7e1e4e53b426a5fb2ed3b15349c6632c) (MultiValueField) Better support for 3.5+ which uses the 'value' field in attributes exclusively (Marcus Nyeholt)
 * 2017-12-12 [0d9ed71](https://github.com/symbiote/silverstripe-multivaluefield/commit/0d9ed71217de4109a832bada497a66c316bf2241) (multivaluefield.css) Revert previous display inline block which breaks the field in the CMS (Marcus Nyeholt)
 * 2017-12-12 [9256ddb](https://github.com/symbiote/silverstripe-multivaluefield/commit/9256ddb15a4fb89b66e32bba20a027d7a9f9ace6) (MultiValueField) solves issue 51 (not tagging it because it's not fixed in master yet) (Marcus Nyeholt)
 * 2017-12-01 [18fe0a9](https://github.com/silverstripe/silverstripe-blog/commit/18fe0a96e78e28e4b147253fd7f327c4e02e0cbb) Add missing translation for GridFieldBlogPostState (Raissa North)
 * 2017-11-30 [0927553](https://github.com/symbiote/silverstripe-advancedworkflow/commit/09275532be59946b3785119e94e4bee16db0ccba) Remove PHP 5.3 from build matrix and include PHP 7.1 (Robbie Averill)
 * 2017-11-30 [e5ec697](https://github.com/symbiote/silverstripe-advancedworkflow/commit/e5ec6975a629ccdade0998360c5bfcd4d46cfdd6) Do not assign a default title if one has been set already (Robbie Averill)
 * 2017-11-22 [ec8ad45](https://github.com/silverstripe/cwp/commit/ec8ad45609a1dc00899f34c7d48235d91f86a149) added missing image for private modules (Tomas Cantwell)
 * 2017-11-15 [a950213](https://github.com/symbiote/silverstripe-queuedjobs/commit/a950213a8e741beb795d2051291581bcb8b063d4) Better messages. (Sam Minnee)
 * 2017-09-08 [2cbdeba](https://github.com/silverstripe/silverstripe-subsites/commit/2cbdeba69aff5a9f984cfcb471a287b6f4bfb073) Remove Behat tests from Travis matrix for SS3 (Robbie Averill)
 * 2017-09-04 [04a07d5](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/04a07d505f32f3256f35c7653389198e18e0bccd) Backport and sanitiseClassName for the "Save" action URL (Jake B)
 * 2017-08-31 [58200f8](https://github.com/symbiote/silverstripe-gridfieldextensions/commit/58200f847fbdeeae6f593274846e939e482cbdd5) When setting the page sizes, reset items per page to the first value (Robbie Averill)
 * 2016-10-21 [8e5bb6fbd]() Fix : relObject() should return null if one of the node is null (Jason)
 * 2016-03-15 [22b3a71ec]() ing val reference to url in https hotlink (Denise Rivera)
 * 2015-04-22 [1f63637b9]() for #4095, TinyMCE not able to modify props of embed media (bug 1) and invalid HTML inserted (bug 2) (Patrick Nelson)
