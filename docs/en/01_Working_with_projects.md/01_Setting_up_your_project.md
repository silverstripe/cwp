title: Setting up your project
summary: Getting started with git version control and GitLab code management tool.

# Setting up your project

## Accessing Gitlab
GitLab is the code management tool you'll use when working with code changes to your SilverStripe CMS website on the Common Web Platform.

Gitlab is available by accessing http://gitlab.cwp.govt.nz.

Once you're there, you'll be asked for an email and password. These details should've been emailed to you, so you can
enter these details now.

## Checking out an existing project

When accessing Gitlab, you'll see a page like this. On the right hand side is a listing of your projects you have
access to. Access a project from here to find more information including the repository URL details:

![Gitlab projects](/_images/gitlab-projects.jpg)

![Gitlab project repository URL](/_images/gitlab-project-repo-url.jpg)

<div class="notice" markdown='1'>
Use HTTPS address for interacting with your repository - SSH transport is not available currently.
</div>

Now that you have the repository URL for the project, you can check it out into your environment with the following
command:

	git clone https://gitlab.cwp.govt.nz/my-agency/my-project.git /path/to/webroot/myproject

Replace `/path/to/webroot` with the path on your computer where you wish to store the project code.

Then to install the SilverStripe CMS packages required for the project to run use the command:

	composer install

Assuming you followed through the Setting up an development environment guide, you can skip straight to "Accessing the site" now.

## Creating a new project
The preferred way to set up your repository from scratch is to use the
[cwp-installer](https://gitlab.cwp.govt.nz/cwp/cwp-installer/) module via Composer.

First, let's create new project using Composer by running the following command:

	composer create-project cwp/cwp-installer my-project --repository-url="https://packages.cwp.govt.nz" 
	# Note: Respond Y to the question about ".git" removal - we want to create our own Git project repository in this case.

This may take some time to run as it is collecting and downloading all the code required to run a default SilverStripe CMS website on CWP (the `Recipe` code).

### Making your first project commit
You will need to make your first commit to Git and push your project into your Git repository provided on GitLab when you signed up for CWP.
As mentioned you should not commit the packages of code managed by Composer to your project. To ensure this you need to use a `.gitignore` file stored in the root of your project (you should already have one of these files from the installation process).

Inside the `.gitignore` you store references to the folders in your project you DO NOT want commited to your project Git repository (these should be the same packages of code referenced in your composer.json file).

For example a `.gitignore` for a CWP recipe codebase might include:

    /framework
    /cms
    /cwp
    /cwp-core
    ...

Next, turn your project folder into a Git repository and commit all project files:

	git init
	git add --all
	git commit -m "Create project from cwp-installer"

Now configure your Git remote (the repositry on GitLab you'll be eventually deplayong your project to servers from):

	git remote add origin https://gitlab.cwp.govt.nz/you/your-repo.git

Finally push the master branch into your repository and set your local copy to watch the remote copy for changes.

	git push -u origin master

Your team should now be able to commence the development.

## Accessing the site
At this stage you should be able to run the website on the default theme included in this recipe locally by visiting it
in your browser (assuming that your LAMP stack is properly configured).

<div class="hint" markdown='1'>
You might need to configure your admin access credentials in the `_ss_environment.php` file to be able to access the
site (see [environment management](https://docs.silverstripe.org/en/3.2/getting_started/environment_management/) docs).
</div>

## Structure of the project
The CWP recipe codebase includes the following directories that are either part of your `Project`, commited into Git or managed via `Composer`.

 - `assets/` - Uploaded files & images through the CMS are stored here, need to ensure it is writable (not committed to Project or Composer).
 - `cms/`  - The files that power the CMS are stored in here (Composer).
 - `framework/` - The SilverStripe Framework, the heart of SilverStripe (Composer).
 - `mysite/` - The default project folder, your custom application code goes here (Project).
 - `themes/` - Available themes and templates are stored in subfolders here, each subfolder is a theme. Custom themes are usually part of your project code however some generic themes can be installed via composer (Project).
 - `vendor/` - Used by composer often for 3rd party dependencies and tools (Composer).
 - `cwp-recipe-basic/` - Contains the composer controlled list of modules (Composer).
 - `cwp-recipe-basic-dev/` - Contains composer controlled list of local development tools (Composer).
 - `cwp/` - Includes extra pre-written website functionality such as Page Types for use on CWP sites (Composer).
 - `cwp-core/` - IMPORTANT: must be included via composer as part of your project for the site to function correctly on the platform. Contains logging and Solr search pre-configuration (composer).
 - `composer.json` - List of dependencies included in project. Human-readable, can be edited directly to include new modules. Inspected when composer update is run to determine any new code dependencies (Project).
 - `composer.lock` - Auto-generated, less human-readable. Tracks the exact state of the installed code. Used when composer install command is run and ensures other developers end up with same set of code (Project).

The rest of the folders in a project are SilverStripe CMS code packages managed by the Composer tool. 
You should take care not to modify these module files, and should not commit these to your project (you instead commit a reference to these in your composer.json and comoser.lock files). 

Periodically you will need to update modules to the newest versions by invoking `composer update` and commiting
the resulting `composer.lock` file.

## Customising the project
You have now a private repository that you can modify. Here is a list of likely initial customisations:

 * Editing the name of the project in the root `composer.json` - find the **name** entry and change it so it's in the
format of "my-agency/basic" - "cwp" namespace is reserved for platform-endorsed modules and recipes.
 * Customising the `mysite/_config.php` to configure your project.
 * Customise the theme
 * Writing new project features
 * Adding more modules
 * Do any other housekeeping as necessary, for example edit or remove the `README` file.
