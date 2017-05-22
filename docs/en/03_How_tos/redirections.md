title: Implement a redirect
summary: How to implement a redirect on your instance.

# Introduction

There's a few ways developers can implement redirections on their CWP instance:
- in the `.htaccess` file
- within the site's `_config.php`
- with a module

## .htaccess

Implementing in `.htaccess` is more performant than using PHP to redirect and allows more control than your standard `Director` redirection. The below example redirects redirection.com to www.redirection.com.

```
RewriteCond %{HTTP_HOST} ^redirection\.com(.*)$ [NC]
RewriteRule ^(.*)$ http://www\.redirection\.com/$1 [R=301,L]
```

## _config.php

Redirection to https or www can be enabled using the `Director` class in your `_config.php` file. The following redirects all web traffic to https and www on a live site.

```
if(Director::isLive() && !Director::is_cli()) {
	Director::forceSSL();
	Director::forceWWW();
}
```

In this example `Director::isLive()` is used to only redirect on the CWP production environment. `!Director::is_cli()` ensures that this redirection does not impact command line actions such as the `dev/build` that occurs during deployment.

Note that this applies to all domains on your instance so be sure to check that they support https. 

## Module

There's a number of modules that implement redirections in different ways, try searching the [add-ons site](http://addons.silverstripe.org/add-ons) for one that suits your needs. One popular example is [redirectedurls.](https://github.com/silverstripe/silverstripe-redirectedurls)

