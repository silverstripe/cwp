title: Setting up a development environment
summary: Installing the tools required to develop SilverStripe CMS code for the Common Web Platform.

# Preparation of the developer's environment

Successful development of a Platform website relies on the ability to use the provided services and tools and build upon
them to provide the custom functionality where needed. A description of the high-level [technical architecture](https://www.cwp.govt.nz/about/technical-and-architecture-information/)
is available on this website.

CWP projects are installed using the Composer PHP package management tool. For general information about Composer, visit
the [SilverStripe Composer documentation](https://docs.silverstripe.org/en/3/getting_started/composer/) or read the
installation documentation on the [Composer site](http://getcomposer.org/doc/00-intro.md).

Please familiarise yourself with the [CWP recipes](03_Recipes_and_supported_modules.md) before starting to develop on CWP. To ensure your code works
smoothly with the platform it's important to either start from the stable release of
[cwp-installer](https://github.com/silverstripe/cwp-installer) or include
your desired [CWP recipes](03_Recipes_and_supported_modules.md) in your `composer.json`.

To ensure security of your site, and of CWP in general, please make sure your code can be easily upgraded by 
maintaining your modules using composer. This will help to keep your dependencies updated with respect to the patch and 
sub-patch versions of the recipe - read more about [CWP recipes](03_Recipes_and_supported_modules.md).

Another reason why it's best to maintain your modules using composer is that this will allow you to easily share the
code with other agencies and enable easier upgrades. See [working with modules](06_Working_with_modules.md)
for more information. If you decide to remove the `composer.json` file and instead commit the modules into the project code, we may not be able to support you because we will have to assume the modules have been customised.

## Server Configuration

You'll need an environment following SilverStripe's
[server requirements](https://docs.silverstripe.org/en/4/getting_started/server_requirements/).

CWP's configuration is detailed in [infrastructure considerations](11_Infrastructural_considerations.md).

## Git

When working with CWP code you will be utilising the Git version control system, and the core CWP repositories will be stored on GitHub, while you are free to store your code wherever you choose. By default your code will be stored on GitLab. We recommend reading through tutorials on using Git, available online. The [Pro Git](http://git-scm.com/book) book is a good reference guide.

### Installing Git

If you're on Mac OS X, one way to get Git installed is to get Xcode with command line tools component included. Git will
be included in that package. You could also install it using the [Homebrew package manager](https://brew.sh).

On Linux, depending on your flavour, the package manager should have Git available so you can install it.  On Debian or
Ubuntu Linux `apt-get install git` should be enough to get you started.

On Windows install [msysgit](http://msysgit.github.com/) which provides Git support on Windows.

### Configuring Git
Apply some configuration changes to git for a smoother experience when working on CWP Git repositories.

#### Name and email
Setup your global user name and e-mail:

	git config --global user.name "Your Name"
	git config --global user.email "your@emailaddress.com"

These will identify you in code commits that you make.

#### Increase the default post size

A common issue with using our specific installation of GitLab is the limit to the Git post size on the client side
(developer's machine). It will result in a 411 errors showing up when trying to push a significant amount of work to
upstream.

The default post size for git is 1 MB. To increase the value run the below command to increase the limit to 500MB:

	git config http.postBuffer 524288000

#### Caching Git passwords

You can avoid having to type the password in every time by using a Git credential helper.

The easiest way is to use the in-built cacher:

	git config --global credential.helper cache

You can adjust the timeout period from the default 15 minutes:

	git config credential.helper 'cache --timeout=3600'

See [this Stackoverflow thread](http://stackoverflow.com/questions/5343068/is-there-a-way-to-skip-password-typing-when-using-https-github)
for more information.

This will save you some typing, but not all of it. Another way to approach this is to store the password in a keychain
on your machine using the software built by a company called GitHub (not related to GitLab). This will allow you to permanently store your password in a secure manner. The software is available directly from
[GitHub](https://help.github.com/articles/set-up-git).

## Where to from here?

For people seasoned with SilverStripe development you can try jump-starting your development activities with the
[getting started](../00_Getting_started.md) guide.

For more information on correctly setting up your CWP project see [Setting up your project](01_Setting_up_your_project.md). It shows how to set up Git and how to access GitLab to manage your code repositories on the CWP platform.
