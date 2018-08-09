title: RealMe Authentication
summary: User authentication using RealMe for SilverStripe CMS websites.

# RealMe Authentication 

## RealMe authentication
[RealMe® login service](https://developers.realme.govt.nz/how-realme-works/how-realme-works-2/) provides a single login, letting citizens use one username and password to access a wide range of government services online. It also offers two-factor login where the online service requires a higher level of security.

The RealMe module enables agencies to use RealMe authentication, to deliver online services or restrict information to specific people.

<div class="alert alert-info" markdown='1'> We strongly recommend using the most recent version of the module.</div>

The module provides the foundation to support easy integration with the RealMe login service. Web developers will still need to build the service provided following successful authentication. 

This module doesn't come bundled in the CWP installer, as it requires a number of steps to be completed by the agency prior to being enabled, these are outlined below.

Agencies are encouraged to [discuss their requirements](https://www.realme.govt.nz/realme-business/) with the [RealMe team](https://developers.realme.govt.nz/about/contact-us/) as a first step. Developers can use the module to connect the CWP UAT environment to the [RealMe Message Testing Service](https://developers.realme.govt.nz/try-it-out-now/) for initial system development. Prior to connecting UAT to the RealMe Integrated Testing Environment (ITE) - pre-production platform, contact the RealMe integration team to get access to the online configuration tool and discuss the project’s business context.

Once this access is available, your development team will be able to begin following the [module installation process](https://github.com/silverstripe/silverstripe-realme/blob/master/docs/en/configuration.md) and working through the requirements.

The CWP Operations team is available to assist with the integration of the ITE (Integrated Test Environment) and production environments, which map to your CWP UAT and production environments. Please [create a CWP Service Desk ticket](https://www.cwp.govt.nz/service-desk/new-request/) once you are ready for integration to be setup. The CWP Operations team will then generate the required SSL certificates, configure your UAT and production environments, and provide you with the necessary XML metadata to submit to RealMe in order to establish the two-way trusted chain that your developers set up while running through the installation instructions for their own development environments.

Note that while the process of integrating RealMe into your website is largely automated for CWP Operations, it still requires manual work by your agency, your development partners, and the RealMe team. Getting the UAT environment working with RealMe is likely to take 2-3 weeks once connectivity with the development environment is confirmed, as your configuration details need to be submitted to the RealMe integration team and then provisioned for installation. A similar timeframe can be expected for release into production.

If there are any further questions, please don't hesitate to [get in touch](https://www.cwp.govt.nz/service-desk/new-request/).

## RealMe assertion
[RealMe® assertion service](https://developers.realme.govt.nz/how-realme-works/how-realme-works-4/) provides the means for a customer to prove personal information online. At present, we offer verified identity (name, date and place of birth, gender) and verified residential address. Over time, other attributes will be included such as citizenship, visa status and key professional qualifications. The service is often referred to as RealMe verified identity as this is usually the most essential set of personal data. 

The SilverStripe RealMe module enables both government agencies and approved private sector organisations to use verified attributes via RealMe to determine eligibility for entitlements or to participate in compliance processes for individuals such as AML/CFT and Police vetting. 

<div class="alert alert-info" markdown='1'>We strongly recommend using the most recent version of the module.</div>

The module provides the foundation to support easy integration with the RealMe assertion service. Typically, the successfully asserted identity and optional address information is returned to a web form where the applicant is entering the other information required by the online service.

This module doesn't come bundled in the CWP installer, as it requires a number of steps to be completed by the agency prior to being enabled, these are outlined below.

Agencies are encouraged to [discuss their requirements](https://www.realme.govt.nz/realme-business/) with [the RealMe team](https://developers.realme.govt.nz/about/contact-us/) as a first step. Developers can use the module to connect the CWP UAT environment to the [RealMe Message Testing Service](https://developers.realme.govt.nz/try-it-out-now/) for initial system development. Prior to connecting UAT to the RealMe Integrated Testing Environment (ITE) - pre-production platform, contact the RealMe integration team to get access to the online configuration tool and discuss the project’s business context and the verified attributes that are required.

Once this access is available, your development team will be able to begin following the [module installation process](https://github.com/silverstripe/silverstripe-realme/blob/master/docs/en/configuration.md) and working through the requirements.

The CWP Operations team is available to assist with the integration of the ITE (Integrated Test Environment) and production environments, which map to your CWP UAT and production environments. Please [create a CWP Service Desk ticket](https://www.cwp.govt.nz/service-desk/new-request/) once you are ready for integration to be setup. The CWP Operations team will then generate the required SSL certificates, configure your UAT and production environments, and provide you with the necessary XML metadata to submit to RealMe in order to establish the two-way trusted chain that your developers set up while running through the installation instructions for their own development environments.

Note that while the process of integrating RealMe into your website is largely automated for CWP Operations, it still requires manual work by your agency, your development partners, and the RealMe team. Getting the UAT environment working with RealMe is likely to take 2-3 weeks once connectivity with the development environment is confirmed, as your configuration details need to be submitted to the RealMe integration team and then provisioned for installation. A similar timeframe can be expected for release into production.

If there are any further questions, please don't hesitate to [get in touch](https://www.cwp.govt.nz/service-desk/new-request/).


## See Also

 * [Single sign-on via Active Directory](active_directory_single_sign_on)
