# 1.8.2

This security release removes the following file extensions from the default whitelist of accepted types for 
uploaded files: `dotm`, `potm`, `jar`, `css`, `js` and `xltm`.

If you require the ability to upload these file types in your projects, you will need to add them back in again.
For more information, see ["Limit the allowed file types"](https://docs.silverstripe.org/en/3/developer_guides/forms/field_types/uploadfield/#limit-the-allowed-filetypes).

<!--- Changes below this line will be automatically regenerated -->

## Change Log

### Security

 * 2018-05-08 [19fdebfa2](https://github.com/silverstripe/silverstripe-framework/commit/19fdebfa2) Remove dotm, potm, jar, css, js, xltm from default File.allowed_extensions (Robbie Averill) - See [ss-2018-014](http://www.silverstripe.org/download/security-releases/ss-2018-014)
 * 2018-04-19 [560e98f](https://github.com/silverstripe/silverstripe-taxonomy/commit/560e98f5321dfca7b98250af043241624e3ac548) Fix search term escaping to prevent possible SQL injection attack (Robbie Averill) - See [ss-2018-011](http://www.silverstripe.org/download/security-releases/ss-2018-011)
 * 2018-04-11 [577138882](https://github.com/silverstripe/silverstripe-framework/commit/577138882) Restrict non-admins from being assigned to admin groups (Damian Mooyman) - See [ss-2018-001](http://www.silverstripe.org/download/security-releases/ss-2018-001)

### Bugfixes

 * 2018-04-03 [b450b5c](https://github.com/silverstripe/cwp/commit/b450b5c) Only add File_ShowInSearch if File class is in query (Raissa North)
 * 2018-03-12 [a5cc866](https://github.com/silverstripe/cwp/commit/a5cc866) Correct the end of support date for 1.8.0 release (Dylan)
