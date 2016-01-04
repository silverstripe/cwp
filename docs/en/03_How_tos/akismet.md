<!--
title: Configure Akismet anti-spam
summary: Setting up Akismet spam protection for forms.
-->

# Introduction

As a part of the CWP 1.1.0 release, blogging and user-commenting features are built into the
recipe by default. This includes Akismet anti-spam as a pre-installed component.

## What is Akismet

Akismet is a third party service developed by Wordpress. See [the Akismet home page](http://akismet.com/) for
more information on the service and how it works.

When content is submitted for spam verification to a CWP site, this content is sent to the remote service to be
scanned for spam-worthy content. A message of either "spam" or "ham" (not spam) is returned.

## Setting up your installation for Akismet

Before an installation of CWP can process comments for spam it's necessary to first setup an Akismet API key.

This key can be obtained either by signing up for a [free, or paid account at akismet.com](http://akismet.com/plans/).

Once a key has been obtained it can be loaded into a CWP site using one of the below methods:

### Configure via SiteConfig

On the "Settings" menu in the CMS under the "Akismet" tab, you can paste your key into the password field and save
to store this value.

### Configure via yaml config

You can also add the following YAML code into your mysite/_config/config.yml


	:::yml
	---
	Name: myspamprotection
	---
	AkismetSpamProtector:
	  api_key: XXXXXXXXXXXXX


### Configure via _config.php

You can also add the below code (or some similar version) to your _config.php. This solution may be useful if
a site has multiple keys controlled by business logic via php.


	:::php
	define('SS_AKISMET_API_KEY', 'XXXXXXXXXXXXX');


### Security

As Akismet is a third party service which analyses user-submitted data, it's important to note that potentially 
user-identifiable information could be sent to this API. This service is hosted outside of New Zealand.

