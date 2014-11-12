<!--
title: Preparing your site for Active Disaster Recovery
pagenumber: 12
-->

# Preparing your site for Active Disaster Recovery

This only applies to instances with Active DR. Some changes to your code may
be required to ensure the site works correctly with Active Disaster Recovery.

## Shared sessions across servers

Your site needs to include the [hybridsessions](https://github.com/silverstripe-labs/silverstripe-hybridsessions) module.

If you're running at least version 1.0.5 of the cwp core code, this module should already
be installed. If you don't have it, you can install the module via composer:

	composer require "silverstripe/hybridsessions:*"

## Provide SSL certificate for your primary domain

You will need to provide us with an SSL certificate for your primary domain so HTTPS requests
are load-balanced between servers. We can also organise the SSL certificate for you if you prefer.

## Disable login SSL redirection

By default, logging in on an instance redirects you to https://<instance>.cwp.govt.nz. This URL is not enabled
for Active Disaster Recovery, and may stop working if your instance goes down.

Disable this redirection and use your primary domain with SSL instead, by setting this
in your `mysite/_config/config.yml`:

	CwpControllerExtension:
	  ssl_redirection_force_domain: false
