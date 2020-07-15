# CWP Recipe 1.9.4

## Overview

This upgrade is a hotfix, only updating Framework up to the version 3.7.5, which includes some minor bugfixes and two security patches (listed below).

 * [Framework 3.7.4](https://docs.silverstripe.org/en/3/changelogs/3.7.4/)
 * [Framework 3.7.5](https://docs.silverstripe.org/en/3/changelogs/3.7.5/)

Upgrading to Recipe 1.9.4 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with Silverstripe CMS. However, if you would like Silverstripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).

## Security considerations

This release includes the following security fixes:

* [CVE-2019-5715 Reflected SQL Injection through Form and DataObject](https://www.silverstripe.org/download/security-releases/ss-2018-021)
* [CVE-2019-12203 Session fixation in "change password" form](https://www.silverstripe.org/download/security-releases/cve-2019-12203)
* [CVE-2020-9311 Malicious user profile information can cause login form XSS](https://www.silverstripe.org/download/security-releases/CVE-2020-9311)
* [CVE-2019-19326 Web Cache Poisoning](https://www.silverstripe.org/download/security-releases/CVE-2019-19326)


## Change Log

### Security

 * 2020-04-28 [98926e4e6](https://github.com/silverstripe/silverstripe-framework/commit/98926e4e6c26d1d43bb1faf516d15bdb2739556e) Stop honouring X-HTTP-Method-Override header, X-Original-Url header and _method POST variable. Add SS_HTTPRequest::setHttpMethod(). (Maxime Rainville) - See [cve-2019-19326](https://www.silverstripe.org/download/security-releases/cve-2019-19326)
 * 2020-04-23 [d3b23e702](https://github.com/silverstripe/silverstripe-framework/commit/d3b23e7024add23de1cb643a44e30d249c2b7cd6) Escape First Name when displaying re-login screen (Maxime Rainville) - See [cve-2020-9311](https://www.silverstripe.org/download/security-releases/cve-2020-9311)
 * 2019-09-16 [a86093fee](https://github.com/silverstripe/silverstripe-framework/commit/a86093fee6398881889d6d330a15f7042be25bff) Session fixation in "change password" form (Serge Latyntcev) - See [cve-2019-12203](https://www.silverstripe.org/download/security-releases/cve-2019-12203)
 * 2019-01-10 [c44f06cdf](https://github.com/silverstripe/silverstripe-framework/commit/c44f06cdf10387a987e4efb096ff06b3bb4495ef) Patch SQL Injection vulnerability when arrays are assigned to DataObject Fields (Aaron Carlino) - See [ss-2018-021](https://www.silverstripe.org/download/security-releases/ss-2018-021)
