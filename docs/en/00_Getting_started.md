title: Getting started
summary: A short guide for getting a SilverStripe CMS project running on a local development environment.

# Getting started

This is a short guide for those who are already familiar with SilverStripe development. This will allow you to setup a
CWP Gitlab project, repository and a local CWP-configured SilverStripe installation on which you can commit and push
code to GitLab.

## Before you begin
This guide assumes you already have:

* A server with [Apache, MySQL and PHP](01_Working_with_projects/00_Setting_up_a_development_environment.md)
* [Git version control](01_Working_with_projects/00_Setting_up_a_development_environment.md/#git)
* [Composer](https://docs.silverstripe.org/en/4/getting_started/composer/)

If you're using Windows, you can use a command-line equivalent to interact with git and composer, offered by the [MsysGit package](http://msysgit.github.io)

### Have an existing GitLab project?

Follow the instructions at [Setting up your project](01_Working_with_projects/01_Setting_up_your_project.md) to setup an environment with an existing CWP project.

## Getting started with CWP codebase from scratch:

Please replace "my-project" below with the actual name of your project. One naming technique is to use the intended project's hostname e.g. "my-project.govt.nz" as the project's folder name

1. Change into your web server's document root: `cd /var/www/htdocs`
2. Create new project using Composer by running the following command:

	composer create-project cwp/cwp-installer my-project

This may take some time to run as it is collecting and downloading all the code required to run a default SilverStripe CMS website on CWP (the `Recipe` code).
3. If composer asks `Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]` then choose Y. This removes the existing cwp-installer history so you can turn this into your own project.
4. `cd my-project` to move into your new project folder
5. Make sure your folder permissions are correctly set (see [File permission problems](https://docs.silverstripe.org/en/4/getting_started/installation/common_problems/#i-ve-got-file-permission-problems-during-installation)), you will also need to create an 'assets' folder if one isn't already created
6. Create a `.env` environment file in the `/htdocs` folder and fill it in with your local details

 * [CWP Environment variables](01_Working_with_projects/12_CWP_environment_variables.md) has more details about CWP specific variables that you can set in your environment file
 * [Environment management](https://docs.silverstripe.org/en/4/getting_started/environment_management/) has more details about how to create a environment file
 * Adding `SS_SEND_ALL_EMAILS_TO='your@address.govt.nz'` stops any debugging emails going out accidentally to live emails

7. Now run a build of the database either by going to `http://localhost/my-project/dev/build?flush=1` or using [Sake](https://docs.silverstripe.org/en/4/developer_guides/cli/) to run the dev/build via the command line `vendor/bin/sake dev/build`

You should now be able to visit: http://localhost/my-project and see a basic CWP-themed site in your browser.

For a more in-depth walkthrough through CWP development activities, please refer to ["Working with projects"](01_Working_with_projects).
Even if you already know how to develop in SilverStripe, please review our
[Performance Guide](04_Performance_Guide) to ensure you create a stable and performant site.

## Troubleshooting

*Q: I can't complete the composer install command. PHP says: "Fatal error: Allowed memory size of 134217728 bytes
exhausted (tried to allocate 71 bytes) in phar:///usr/bin/composer"*

A: Some of the modules that composer needs e.g. "framework" and "cms" are rather large and composer needs more memory to
complete the requests.

Increase the `memory_limit` setting in php.ini to something higher than the default of 128Mb e.g. 256Mb or 512Mb and
then re-try.
