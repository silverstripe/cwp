title: Getting started
summary: A short guide for getting a SilverStripe CMS project running on a local development environment. 

# Getting started

This is a short guide for those who are already familiar with SilverStripe development. This will allow you to setup a
CWP Gitlab project, repository and a local CWP-configured SilverStripe installation on which you can commit and push
code to GitLab.

## Before you begin
This guide assumes you already have:

* A server with [Apache, MySQL and PHP](working_with_projects/setting_up_a_development_environment)
* [Git version control](working_with_projects/setting_up_a_development_environment/#git)
* [Composer](http://doc.silverstripe.org/framework/en/installation/composer/)

If you're using Windows, you can use a command-line equivalent to interact with git and composer, offered by the [MsysGit package](http://msysgit.github.io)

### Have an existing Gitlab project?

Follow the instructions at [Setting up your project](working_with_projects/setting_up_your_project) to setup an environment with an existing CWP project.

## Getting started with CWP codebase from scratch:

<div class="notice" markdown='1'>
Please replace "my-project" below with the actual name of your project. One naming technique is to use the intended project's hostname e.g. "my-project.govt.nz" as the project's folder name
</div>

1. Change into your web server's document root: `cd /var/www/htdocs`
2. Create new project using Composer by running the following command:

	composer create-project cwp/cwp-installer my-project --repository-url="https://packages.cwp.govt.nz"

This may take some time to run as it is collecting and downloading all the code required to run a default SilverStripe CMS website on CWP (the `Recipe` code).
3. If composer asks `Do you want to remove the existing VCS (.git, .svn..) history? [Y,n]` then choose Y. This removes the existing cwp-installer history so you can turn this into your own project.
3. `cd my-project` to move into your new project folder
4. Make sure your folder permissions are correctly set (see [File permission problems](https://docs.silverstripe.org/en/3.2/getting_started/installation/common_problems/#i-ve-got-file-permission-problems-during-installation)), you will also need to create an 'assets' folder if one isn't already created
5. Create a `_ss_environment.php` environment file in the `/htdocs` folder and fill it in with your local details

 * [CWP Environment variables](working_with_projects/cwp_environment_variables/) has more details about CWP specific variables that you can set in your environment file
 * [Environment management](https://docs.silverstripe.org/en/3.2/getting_started/environment_management/) for more details about how to create a environment file
 * Adding `define('SS_SEND_ALL_EMAILS_TO', 'your@address.govt.nz');` stops any debugging emails going out accidentally to live emails

6. Now run a build of the database either by going to `http://localhost/my-project/dev/build?flush=1` or using [Sake](https://docs.silverstripe.org/en/3.2/developer_guides/cli/) to run the dev/build via the command line `./framework/sake dev/build`

You should now be able to visit: [http://localhost/my-project](http://localhost/my-project) and see a basic CWP-themed site in your browser.

For a more in-depth walkthrough through CWP development activities, please refer to ["Working with projects"](working_with_projects).

## Troubleshooting
 
*Q: I cannot complete the composer install command. PHP says: "Fatal error: Allowed memory size of 134217728 bytes
exhausted (tried to allocate 71 bytes) in phar:///usr/bin/composer"*
 
A: Some of the modules that composer needs e.g. "framework" and "cms" are rather large and composer needs more memory to
complete the requests.

Increase the `memory_limit` setting in php.ini to something higher than the default of 128Mb e.g. 256Mb or 512Mb and
then re-try.
