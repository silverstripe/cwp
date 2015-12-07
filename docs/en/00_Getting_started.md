title: Getting started
summary: A short guide for getting a SilverStripe CMS project running on a local development environment. 

# Getting started

This is a short guide for those who are already familiar with SilverStripe development. This will allow you to setup a
CWP Gitlab project, repository and a local CWP-configured SilverStripe installation on which you can commit and push
code to GitLab.

* This guide assumes you already have a functioning LAMP/WAMP environment [setup on your workstation, PC or laptop with
composer](http://doc.silverstripe.org/framework/en/installation/composer/) and [git](working_with_projects/setting_up_a_development_environment/#git)
* Please replace "my-project" below with the actual name of your project. One naming technique is to use the intended
project's hostname e.g. "my-project.govt.nz" as the project's folder name
* If you're using Windows, you can use a command-line equivalent to interact with git and composer, offered by the
"MsysGit" package: http://msysgit.github.io

## Getting started with CWP codebase from scratch:

1. [Setup your project on Gitlab itself via a browser](working_with_projects/setting_up_a_development_environment)
1. Change into your web server's document root: `cd /var/www/htdocs`
1. `composer create-project cwp/cwp-installer my-project --repository-url="https://packages.cwp.govt.nz"`
1. `cd my-project`
1. `composer install`
1. `./framework/sake dev/build`
1. `git remote add origin https://gitlab.cwp.govt.nz/my-project.git`

You should now be able to visit: [http://localhost/my-project](http://localhost/my-project) and see a basic CWP-themed
site in your browser.

For a more in-depth walkthrough through CWP development activities, please refer to ["Working with projects"](working_with_projects).

## Troubleshooting

*Q: I cannot run "git remote add". git says: "fatal: remote origin already exists"*

A: If you've installed via the cwp-installer package and answered "no" the the question if the repository should be,
removed, the git remote named "origin" still exists and pointing at its git repository. You have two options:

* option a). Change origin to point at your Gitlab repository: git remote set-url origin https://gitlab.cwp.govt.nz/my-project.git https://gitlab.cwp.govt.nz/cwp/cwp-installer.git 
* option b). Set a new remote, called e.g. "my-project": git remote add my-project https://gitlab.cwp.govt.nz/my-project.git
 
*Q: I cannot complete the composer install command. PHP says: "Fatal error: Allowed memory size of 134217728 bytes
exhausted (tried to allocate 71 bytes) in phar:///usr/bin/composer"*
 
A: Some of the modules that composer needs e.g. "framework" and "cms" are rather large and composer needs more memory to
complete the requests.

Increase the `memory_limit` setting in php.ini to something higher than the default of 128Mb e.g. 256Mb or 512Mb and
then re-try.
