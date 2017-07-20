title: Disable or enable basic authentication pop-up
summary: How to Disable or enable basic authentication pop-up on your environments.

# Introduction

Basic authentication (often refered to as "basic auth") is the pop-up box which asks for a user name and password that shows up when you first try to access a UAT environment.

## Getting through the pop-up

In order to get through basic auth you must have a CMS account on the environment you are trying to access and your CMS account must have the permission "Allow users to use their accounts to access the UAT server". If you meet both of these criteria then you can use your email address and password (as defined in the CMS of the environment) to get through the pop-up box. By default the permission "Allow users to use their accounts to access the UAT server" is granted only to the "Administrator" group but it can be granted to other groups too.

## Disabling on UAT and test environments

UAT and test environments have basic auth enabled by default, you can disable this in your code base with the following code in your `config.yml`:

```
CwpControllerExtension:
  test_basicauth_enabled: false
```

## Enabling on Production

Production is not protected with basic auth by default, but you may want to enable it in order to lock down the site prior to go-live. To enable, in your `config.yml` add:

```
CwpControllerExtension:
  live_basicauth_enabled: true
```
