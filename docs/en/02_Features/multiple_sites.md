title: Multiple sites
summary: Set up a stack with multiple websites

# Subsites

The subsites module provides a convenient way of running multiple websites from a single installation of SilverStripe, sharing users, content, and assets between them - the sites will be managed from a single CMS.

For more information about the subsites module go to the [github repository](https://github.com/silverstripe/silverstripe-subsites/) and go to [user documentation](https://userhelp.silverstripe.org/en/optional_features/working_with_multiple_sites/) for more information about setting up a subsite in the CMS.

# Setup

This module was provided by default in the CWP basic recipe in versions prior to 2.6.0. From this version onwards, you need to install it manually:

`composer require silverstripe/subsites ^2.3`

To learn how to set up a subsite in the CMS, visit the [user documentation](https://userhelp.silverstripe.org/en/optional_features/working_with_multiple_sites/set_up).

# Technical

There is a good [overview](https://github.com/silverstripe/silverstripe-subsites/blob/master/docs/en/introduction.md) to get you familiarised with the module and if you wish to extend the existing subsites architecture then there is some [technical](https://github.com/silverstripe/silverstripe-subsites/blob/1.2/docs/en/technical.md) documentation to get you started.

## Go live

See [DNS/Go-live](https://www.cwp.govt.nz/working-with-cwp/instance-management/dns-go-live/) for more information about setting up your DNS configuration for subsites.
