title: Implement a redirect
summary: How to implement a redirect on your stack.

# Introduction

There's a few ways developers can implement redirections on their CWP stacks:
- In the `.htaccess` file
- Within the site's `_config.php`
- With a module

## .htaccess

Implementing in `.htaccess` is more performant than using PHP to redirect and allows more control than your standard `Director` redirection. 

Other HTTP headers, for example HTTP Security Headers, should be placed in `public/.htaccess` and not in `.htaccess`

The below example shows complete `.htaccess` file which redirects redirection.com to www.redirection.com. 
Please note redirection rules should be placed before the `RewriteRule ^(.*)$ public/$1`

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTP_HOST} ^redirection\.com(.*)$ [NC]
    RewriteRule ^(.*)$ https://www\.redirection\.com/$1 [R=301,L]
    RewriteRule ^(.*)$ public/$1
</IfModule>

```

You may also want to enforce a global redirection to HTTPS in the `.htaccess` file in which case there's some things to consider due to requests coming through CWP's cache server which runs Varnish. You will need the following in your htaccess above your `<IfModule mod_rewrite.c>` section:

```
<IfModule mod_headers.c>
	Header always append Vary "X-Forwarded-Proto" "expr=%{REQUEST_STATUS} == 301"
	Header always append Vary "X-Forwarded-Proto" "expr=%{REQUEST_STATUS} == 302"
</IfModule>
```

If we don't vary on `X-Fowarded-Proto`, Varnish will cache the 301 HTTPS redirects. This will send users who request uncached HTTP pages into infinite redirect loops until the cache times out (redirects sends the user into the same URI, just with different X-Fowarded-Proto).

Once you have that then the redirection should be as follows:

```
RewriteCond %{HTTP_HOST} ^my\.domain\.govt\.nz$
RewriteCond %{HTTPS} !=on
Rewritecond %{HTTP:X-Forwarded-Proto} !https [NC]
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

This will then force all traffic to redirect to HTTPS on `my.domain.govt.nz`.

## \_config.php

Redirection to https or www can also be enabled using the `Director` class in your `_config.php` file, however using the `.htaccess` method is often more predictable. The following redirects all web traffic to https and www on a live site.

```
if(Director::isLive() && !Director::is_cli()) {
	Director::forceSSL();
	Director::forceWWW();
}
```

In this example `Director::isLive()` is used to only redirect on the CWP production environment. `!Director::is_cli()` ensures that this redirection does not impact command line actions such as the `dev/build` that occurs during deployment.

Note that this applies to all domains on your environment so be sure to check that they support https.

## Module

There's a number of modules that implement redirections in different ways, try searching the [add-ons site](http://addons.silverstripe.org/add-ons) for one that suits your needs. One popular example is [redirectedurls.](https://github.com/silverstripe/silverstripe-redirectedurls)
