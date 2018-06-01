title: Setting up a development environment
summary: Installing the tools required to develop SilverStripe CMS code for the Common Web Platform.

# Preparation of the developer's environment

Successful development of a Platform website relies on the ability to use the provided services and tools and build upon
them to provide the custom functionality where needed. A description of the high-level [technical architecture](https://www.cwp.govt.nz/about/technical-and-architecture-information/)
is available on this website.

CWP projects are installed using the Composer PHP package management tool. For general information about Composer, visit
the [SilverStripe Composer documentation](http://doc.silverstripe.org/framework/en/installation/composer) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

Please familiarise yourself with [CWP recipes](recipes_and_supported_modules) before starting to develop on CWP. To ensure your code works
smoothly with the platform it's important to either start from the stable release of
[cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer/) or include
[cwp-recipe-basic](https://gitlab.cwp.govt.nz/cwp/cwp-recipe-basic/) in your `composer.json`.

<div class="notice" markdown='1'>
To ensure security of your site and CWP in general make sure your code can be upgraded - maintain your modules using
composer. Then keep your dependencies updated with respect to the patch and sub-patch versions of the recipe - read
more about [CWP recipes](recipes).
</div>

Another reason why it's best to maintain your modules using composer is that this will allow you to easily share the
code with other agencies and enable easier upgrades. See [working with modules](working_with_modules)
for more information. If you decide to remove the `composer.json` file and instead commit the modules into the project code, we may not be able to support you because we will have to assume the modules have been customised.

## Server Configuration

You'll need an environment following SilverStripe's 
[server requirements](https://docs.silverstripe.org/en/getting_started/server_requirements/).

CWP's configuration is detailed in [infrastructure considerations](working_with_projects/infrastructural_considerations).

## Git

When working with CWP code you will be utilising git version control system, and the repositories will be stored on
Gitlab. We recommend reading through tutorials on using Git, available online. The [Pro Git](http://git-scm.com/book) book is a good reference guide.

### Installing Git

If you're on Mac OS X, one way to get Git installed is to get Xcode with command line tools component included. Git will
be included in that package.

On Linux, depending on your flavour, the package manager should have Git available so you can install it.  On Debian or
Ubuntu Linux `apt-get install git` should be enough to get you started.

On Windows install [msysgit](http://msysgit.github.com/) which provides Git support on Windows.

### Configuring Git
Apply some configuration changes to git for a smoother experience when working on CWP Git repositories.

#### Name and email
Setup your global user name and e-mail:

	git config --global user.name "<Your Name>"
	git config --global user.email "<Your E-mail Address"

These will identify you in code commits.

#### Increase the default post size

A common issue with using our specific installation of Gitlab is the limit to the git post size on the client side
(developer's machine). It will result in a 411 errors showing up when trying to push a significant amount of work to
upstream.

The default post size for git is 1 MB. To increase the value run the below command to increase the limit to 500MB:

	git config http.postBuffer 524288000

#### Caching Git passwords

You can avoid having to type the password in every time by using a git credential helper.

The easiest way is to use the in-built cacher:

	git config --global credential.helper cache

You can adjust the timeout period from the default 15 minutes:

	git config credential.helper 'cache --timeout=3600'

See [this stackoverflow thread](http://stackoverflow.com/questions/5343068/is-there-a-way-to-skip-password-typing-when-using-https-github)
for more information.

This will save you some typing, but not all of it. Another way to approach this is to store the password in a keychain
on your machine using the software built by a company called GitHub (not related to Gitlab). This will allow you to
securely store your password permanently. The software is available directly from
[GitHub](https://help.github.com/articles/set-up-git).

## Where to from here?

For people seasoned with SilverStripe development, you can try jump-starting your development activities with the
[getting started](/getting_started) guide.

For more information on correctly setting up your CWP project see [Setting up your project](setting_up_your_project). It shows how to set up Git and how to access Gitlab to manage your code repositories on the CWP platform.
