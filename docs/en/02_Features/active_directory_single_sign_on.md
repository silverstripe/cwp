title: Active directory single sign-on
summary: Active directory user authentication for CWP websites.

# Active directory single sign-on

Single sign-on (SSO) is a user authentication process that allows a
user to enter their username and password once in order to access
multiple applications. The process authenticates the user for all
the applications they have been given access to and eliminates
further prompts when they switch applications.

## Introduction

Single sign-on is provided by the open sourced module 
[SilverStripe Active Directory](https://github.com/silverstripe/silverstripe-activedirectory).

This module allows users of a CWP intranet site to seamlessly login once and never be prompted to login to the site again.

The users access rights are defined in a Microsoft Active Directory
(AD) and are surfaced to the intranet site via an Active Directory
Federation Services (ADFS) add-on to the AD.

It also provides a way of regularly importing users into a
SilverStripe site so that a developer agency can for example create
Staff Directory pages with the information provided by the Active
Directory.

The module only works with Active Directory and Active Directory
Federation Services, for further information see the [module requirements](https://github.com/silverstripe/silverstripe-activedirectory#requirements).

## Responsibilities

CWP is [supporting](https://www.cwp.govt.nz/about/technical-and-architecture-information/#SupportedModules)
the `silverstripe-activedirectory` module and the hosting of the
intranet site.

The agency must have an Active Directory and Active Directory
Federation Services hosted, maintained and operated by
them.

The agency's development team needs to develop and configure the
module to the agencies infrastructure and functional requirements.

The agency will also need a Virtual Private Network (VPN) between
their CWP intranet site and the Active Directory Service.

## Brief Technical Overview

The idea is that a user can open their browser, go to the
intranet site and be automatically logged in with their already
authenticated Windows user.

This single sign-on solution is "opinionated", which means it has
very firm ideas about how things ought to be done. The solution
tightly couples a set of services to provide the best user
experience and therefore the requirements are strict.

- The users need to be logged into a Windows network via means of an AD.
- Their browser of choice must be able to automatically send their
  windows credentials to an ADFS server that can authenticate them
  from an AD server.
- The ADFS server must be configured to allow the intranet site to
  "ask" for a users authenticity.
- The intranet site must be configured to allow users to
  authenticate via ADFS.
- The AD must allow the intranet site to query user details,
  through an AD account that has read access.

The communication between the intranet site and ADFS happens
within the user's browser with the help of SAML 2.0 protocol, an XML-based,
open-standard data format for exchanging authentication and
authorization data between parties.

The communication between the intranet site and the AD happens over
a secure VPN link with Lightweight Directory Access Protocol
(LDAP).

## Getting started

To find more information about the solution, please see the
SilverStripe Active Directory module [documentation on github](https://github.com/silverstripe/silverstripe-activedirectory/blob/master/README.md#overview).

To start the process of setting up a VPN connection between a CWP
stack and your internal network, please create a support ticket
in the [CWP Service Desk](https://www.cwp.govt.nz/service-desk/new-request/) as a **Support request**.

## CWP technical implementation

The [Developer Guide](https://github.com/silverstripe/silverstripe-activedirectory/blob/master/docs/en/developer.md) contains the information necessary for a developer to configure the module.

The following sections list some necessary changes to configuration for CWP.

### X.509 certificates

On the CWP platform the [X.509 certificates](https://github.com/silverstripe/silverstripe-activedirectory/blob/master/docs/en/developer.md#make-x509-certificates-available) 
for the SilverStripe site have already been generated.

To be able to use them on a CWP site you will override the default
[YAML configuration](https://github.com/silverstripe/silverstripe-activedirectory/blob/master/docs/en/developer.md#yaml-configuration)
with the following in `mysite/_config.php`

**Replace 'stackname' with the actual stack name so that the URL is correct.**
```php
// Configure SAML certificates for the CWP UAT environment
if(defined('CWP_ENVIRONMENT') && (CWP_ENVIRONMENT == 'uat' || CWP_ENVIRONMENT == 'uatdr')) {
    Config::inst()->update('SAMLConfiguration', 'SP', [
        'entityId' => 'https://stackname-uat.cwp.govt.nz/',
        'privateKey' => '../../certs/saml.pem',
        'x509cert' => '../../certs/saml.crt'
    ]);
// Configure SAML certificates for the CWP Production environment
} elseif(defined('CWP_ENVIRONMENT') && (CWP_ENVIRONMENT == 'prod' || CWP_ENVIRONMENT == 'dr')) {
    Config::inst()->update('SAMLConfiguration', 'SP', [
        'entityId' => 'https://stackname.cwp.govt.nz/',
        'privateKey' => '../../certs/saml.pem',
        'x509cert' => '../../certs/saml.crt'
    ]);
}
```
	
### Disable the basic auth for an intranet site

CWP by default prevents access to the UAT environment by
restricting access people with logins. This prevents the ADFS
server from [accessing the metadata](https://github.com/silverstripe/silverstripe-activedirectory/blob/master/docs/en/adfs.md#select-data-source) on this environment.

Since the intranet site should only be reachable over a VPN link,
this feature can be disabled.

```yaml
---
Name: mysitesecuritytest
After: '#cwpsecuritytest'
---
# The basic authentication popup must be disabled in the UAT
# environment, otherwise the ADFS server can't get the
# metadata of the SAML Service Provider
SilverStripe\Security\BasicAuth:
  entire_site_protected: false
```

## Frequently Asked Questions

### Why not use Kerberos?

Generally a Domain Controller (DC) uses Integrated Windows
Authentication (IWA, usually Kerberos or NTLM) to authenticate a
user to the application they are trying to access.

However this only works if:

 - The user has direct access to the Domain Controller (DC)
 - The users device supports IWA

For security reasons the DC should never be exposed to the public
internet so that would prevent users from using a public and
private resource and had to login to them individually.

The ADFS will step in as a web endpoint on a secure HTTPS
connection that uses the DC as a Identity Provider.

Mobile devices often can't provide IWA details so that would
prevent Single sign-on for mobile devices.

Since ADFS is exposed as a website it can automatically login users
if their device support IWA or can fall back to a standard login
form.

Allowing additional services to use the ADFS as an authentication
endpoint doesn't require opening network ports or ip whitelisting.

Other reasons for not using Kerberos also include:

 - Open source web servers like Apache have limited support for Kerberos
   through extensions, but are not officially supported and can
   be difficult to setup and configure.
 - Clocks between AD and the web server have to be perfectly matched
   in order for it to work without failures.

### Why does the intranet site need access to the AD server?

It's strictly not necessary for authentication, but to be able to
synchronise a custom Staff Directory Page with the Active
Directory, the SilverStripe site needs to synchronise daily without
any user intervention. This can only be done if the SilverStripe
site can connect to the AD.

## See Also

 * [Authentication via RealMe](realme_authentication)
