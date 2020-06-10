# 2.6.0 (Unreleased)

## Overview

This release includes CMS and Framework version 4.6.0.

 * [Framework 4.6.0](https://docs.silverstripe.org/en/4/changelogs/4.6.0/)


Upgrading to Recipe 2.6.0 is recommended for all CWP sites. This upgrade can be carried out by any development team familiar with SilverStripe. However, if you would like SilverStripe's assistance, you can request support via the [Service Desk](https://www.cwp.govt.nz/service-desk/new-request/).


### Multi-factor authentication (MFA) modules become a part of the default CWP installation

The following modules are now included into [cwp/installer](https://github.com/silverstripe/cwp-installer)
 * [silverstripe/mfa](https://github.com/silverstripe/silverstripe-mfa/)
 * [silverstripe/totp-authenticator](https://github.com/silverstripe/silverstripe-totp-authenticator/)

All new projects starting with the recipe of version 2.6.0 will have MFA support included.
Common Web Platform (CWP infrastructure) has the support for it already, so no extra setup required.

Since the modules become a part of [cwp/installer](https://github.com/silverstripe/cwp-installer), the change will only affect
new projects. An upgrade to 2.6.0 will not install the MFA modules. However, manual installation is as easy as `composer require`.