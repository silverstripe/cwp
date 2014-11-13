<!--
title: Preparing your site for Active Disaster Recovery
pagenumber: 12
-->

# Preparing your site for Active Disaster Recovery

This guide describes the steps needed to get your site ready for Active Disaster Recovery instances. None of these
modifications are needed on regular instances.

Active DR instances have two properties:

 * They are load-balanced: the traffic is served from two datacentres, increasing the maximum potential capacity of the
 instance.
 * They are highly-available: if one datacentre / node exhibits a problem and is not reachable, or emits 5xx HTTP status
 code, this node will be pulled out of the pool and all traffic will be redirected to the other datacentre.

This distinction is significant, because of the difference in behaviour for sites that are live and sites that have not
yet been switched over to their production domain. Only live sites using the production domain are both load-balanced
and highly available. 

<div class="warning" markdown='1'>
Non-live sites served from the "cwp.govt.nz" domain are load-balanced and will survive a datacentre outage, but they
will not trigger failover on node failure - some of the requests will start failing.
</div>

The following chapters provide information on the required changes to your code to ensure the site works correctly with
Active Disaster Recovery.

## Shared sessions across servers

Your site needs to include the [hybridsessions](https://github.com/silverstripe-labs/silverstripe-hybridsessions) module.

If you're running at least version 1.0.5 of the cwp core code, this module should already
be installed. If you don't have it, you can install the module via composer:

	composer require "silverstripe/hybridsessions:*"

## Provide SSL certificate for your primary domain

You will need to provide us with an SSL certificate for your primary domain so HTTPS requests
are load-balanced between servers. We can also organise the SSL certificate for you if you prefer.

## Disable login SSL redirection

By default, logging in on an instance redirects you to https://myinstance.cwp.govt.nz. This URL is not fully enabled
for Active Disaster Recovery (see the chapter below) and thus we need to prevent the redirection and ensure the user
remains on your production domain. This is why we require you to supply the SSL certificate - to protect logins and
the admin area.

Please disable this redirection by setting the following in your `mysite/_config/config.yml`:

	---
	Name: domainredirection
	Only:
	  Environment: 'live'
	---
	CwpControllerExtension:
	  ssl_redirection_force_domain: false

