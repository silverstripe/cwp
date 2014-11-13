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

This distinction is significant, because we can only satisfy both properties if your site is live and only if you
are accessing the site using your production domain (or custom aliases). This is because we can only use your
production domain for sending HTTP probes and these will only control the non-cwp.govt.nz site.

<div class="warning" markdown='1'>
In other words: we cannot make your site highly-available if your production domain is not pointing to CWP (i.e. your
site is not live).  Additionally, accessing your site at any time through the "cwp.govt.nz" domain will not exhibit the
highly-available property. It will still be load-balanced in both cases.
</div>

The following chapters provide information on the required changes to your code to ensure the site works correctly with
Active Disaster Recovery.

## Provide SSL certificate for your primary domain

You will need to provide us with an SSL certificate for your primary domain so HTTPS requests
are load-balanced between servers. We can also organise the SSL certificate for you if you prefer.

## Shared sessions across servers

If you are running at least version 1.0.4 of the [cwp-core](https://gitlab.cwp.govt.nz/cwp/cwp-core) module, shared
sessions have already been configured. You can skip this step.

Otherwise, if you running an earlier version, please follow these steps:

### 1. Install the hybridsessions module

	composer require "silverstripe/hybridsessions:*"

### 2. Configure the module

In your `mysite/_config.php` file, add this configuration:

	if(defined('CWP_INSTANCE_DR_TYPE') && CWP_INSTANCE_DR_TYPE === 'active'
		&& defined('SS_SESSION_KEY') && class_exists('HybridSessionStore')
		&& !HybridSessionStore::is_enabled()
	) {
		HybridSessionStore::init(SS_SESSION_KEY);
	}
