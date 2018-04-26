title: RealMe Authentication
summary: User authentication using RealMe for SilverStripe CMS websites.

# RealMe Authentication module

The [RealMe module](https://github.com/silverstripe/silverstripe-realme/) enables agencies to use RealMe, the 
government's preferred approach for website authentication, to deliver online services or restrict information to 
specific people.

This module is only supported from cwp recipe 1.2.0 and above.

The module facilitates the log-on process; agencies need to work with the RealMe team to conduct the 
integration, and will need to work with web developers to build whatever the system performs after you have logged in 
(e.g. a form that initiates a service from government). The module supports different strength logons (username/password 
only, or with SMS/Token as second factor) and only RealMe logon accounts. Support for RealMe verified accounts is 
something that an interested agency could commission SilverStripe to add.

This module doesn't come bundled in the CWP installer, as it requires a number of steps to be completed by the 
agency prior to being enabled, these are outlined below.

Agencies are encouraged to [discuss their requirements with the RealMe team](https://www.realme.govt.nz/realme-business/) 
as a first step. Prior to using this module, an agreement should be reached with the RealMe team, and access to the DIA 
Shared Workspace for RealMe should be granted.

Once this access is available, your development team will be able to begin following the 
[module installation process](https://github.com/silverstripe/silverstripe-realme/blob/master/docs/en/installation.md) 
and working through the requirements.

The CWP Operations team is available to assist with the integration of the ITE (Integrated Test Environment) and 
production environments, which map to your CWP UAT and production environments. Please 
[create a CWP Service Desk ticket](https://www.cwp.govt.nz/service-desk/new-request/) once you are ready for integration to 
be setup. The CWP Operations team will then generate the required SSL certificates, configure your UAT and production 
environments, and provide you with the necessary XML metadata to submit to RealMe in order to establish the two-way 
trusted chain that your developers set up while running through the installation instructions for their own development 
environments.

Note that while the process of integrating RealMe into your website is largely automated for CWP Operations, it still 
requires a significant amount of manual work by your agency, your development partners, and the RealMe team. Getting the 
UAT environment working with RealMe is likely to take 2-3 weeks once connectivity with the development environment is 
confirmed, as your checklists need to be submitted to Realme and then provisioned for installation. The same timeframe 
can be expected for release into production.

If there are any further questions, please don't hesitate to 
[get in touch](https://www.cwp.govt.nz/service-desk/new-request/).

## See Also

 * [Single sign-on via Active Directory](active_directory_single_sign_on.md)
