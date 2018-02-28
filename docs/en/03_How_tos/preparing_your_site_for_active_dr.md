title: Active Disaster Recovery
summary: How to Prepare your website to use Active DR infrastructure.

# Preparing your site for Active Disaster Recovery

This guide describes the steps needed to get your site ready for Active Disaster Recovery (DR) stacks. None of these
modifications are needed on regular stacks.

Active DR stacks have two properties:

 * They are load-balanced. The traffic is served from two data centres, increasing the maximum potential capacity of the
 stack.
 * They are highly-available. If one data centre / node exhibits a problem and is not reachable, or emits 5xx HTTP status
 codes, this node will be pulled out of the pool and all traffic will be redirected to the other data centre.


Your custom domains will be actively load balanced between the two nodes. *.cwp.govt.nz domains are not load balanced and point to either the Wellington or Auckland node. We supply two domains for Active DR environments for both UAT and PROD to help debug issues:
 * stack.cwp.govt.nz - points to Wellington
 * stack-dr.cwp.govt.nz - points to Auckland


<div class="alert alert-warning" markdown='1'>
In other words, we can't make your site highly-available if your production domain is not pointing to CWP (i.e. your
site is not live).  Additionally, accessing your site at any time through the "cwp.govt.nz" domain will not exhibit the
highly-available property.
</div>

The following chapters provide information on the required changes to your code to ensure the site works correctly with
Active Disaster Recovery.

## Provide an SSL certificate for your primary domain

You will need to provide us with an SSL certificate for your primary domain so HTTPS requests
are load-balanced between servers. We can also organise the SSL certificate for you if you prefer.

## Shared sessions across servers

If you are running at least version 1.0.4 of the [cwp-core](https://github.com/silverstripe/cwp-core) module, shared
sessions have already been configured. You can skip this step.

Otherwise, if you are running an earlier version, please follow these steps:

### 1. Install the Hybrid Sessions module

```
composer require "silverstripe/hybridsessions:*"
```

### 2. Configure the module

In your `mysite/_config.php` file, add this configuration:

```php
// Automatically configure session key for activedr with hybridsessions module
if (Environment::getEnv('CWP_INSTANCE_DR_TYPE')
    && Environment::getEnv('CWP_INSTANCE_DR_TYPE') === 'active'
    && Environment::getEnv('SS_SESSION_KEY')
    && class_exists(HybridSession::class)
) {
    HybridSession::init(Environment::getEnv('SS_SESSION_KEY'));
}
```
