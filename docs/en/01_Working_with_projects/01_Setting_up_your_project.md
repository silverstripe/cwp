title: Setting up your project
summary: Getting started with git version control and GitLab code management tool.

# Setting up your project

## Development environment

See [Setting up a development environment](../01_Working_with_projects/00_Setting_up_a_development_environment.md).

The below relates to the use of a GitLab CWP hosted repository. If you have [migrated to a GitHub Git repository](../01_Working_with_projects/01_Setting_up_your_project.md/#making-your-first-project-commit), [start here](https://help.github.com/articles/cloning-a-repository/).

## Accessing GitLab
GitLab is the code management tool you'll use when working with code changes to your SilverStripe CMS website on the Common Web Platform.

GitLab is available by accessing https://gitlab.cwp.govt.nz.

Once you're there, you'll be asked for an email address and password. These details should have been emailed to you. If not, please contact us.

## Checking out an existing project

When accessing GitLab you'll see a page like this (below). On the right hand side is a listing of your projects you have
access to. Access a project from here to find more information including the repository URL details:

#### GitLab projects overview
![GitLab projects](../_images/gitlab-projects.jpg)

#### Project details
![GitLab project repository URL](../_images/gitlab-project-repo-url.jpg)

1. Now that you have the repository URL for the project, you can check it out in your development environment with the 
following command:

    `git clone https://gitlab.cwp.govt.nz/my-agency/my-project.git /path/to/webroot/myproject`

2. Replace `/path/to/webroot/myproject` with the path on your computer where you wish to store the project code.

3. Then navigate to your project folder:
	
    `cd /path/to/webroot/myproject`

4. To install the SilverStripe CMS packages required for the project to run use the following command:

    `composer install`

This may take some time to run. There is some more information on these steps in the [Getting Started guide](../00_Getting_started.md).

Assuming you followed through the "Setting up an development environment" guide, you can skip straight to "[Accessing the site](../01_Working_with_projects/01_Setting_up_your_project.md#accessing-the-site)" now.

### Creating a new project?
The preferred way to set up a new repository is to use the
[cwp-installer](https://github.com/silverstripe/cwp-installer) module via Composer. Follow the instructions at [Getting Started](../00_Getting_started.md) which will step you through how to create a project from scratch.

## Making your first project commit
You will need to make your first commit to Git and push your project into your Git repository provided on GitLab when you signed up for CWP.

As mentioned you should not commit the packages of code managed by Composer to your project. To ensure this you need to use a `.gitignore` file stored in the root of your project (you should already have one of these files from the installation process).

Inside the `.gitignore` you store references to the folders in your project you DON'T want committed to your project Git repository.

For example, a `.gitignore` for a CWP recipe codebase might include:

    /.env
    /resources/
    /silverstripe-cache/
    /themes/simple/
    /vendor/
    ...

You can also install a Git hook module which will auto-generate this for you. [See here for more information](https://docs.silverstripe.org/en/4/getting_started/composer/#installing-and-enabling-the-ssautogitignore-package).

Next, turn your project folder into a Git repository and commit all project files:

	git init
	git add --all
	git commit -m "Create project from cwp-installer"

Now configure your Git remote (the repository on GitLab you'll be eventually deploying your project to servers from):

	git remote add origin https://gitlab.cwp.govt.nz/you/your-repo.git

Finally push the master branch into your repository and set your local copy to watch the remote copy for changes.

	git push -u origin master

Your team should now be able to commence development on the project.

## Accessing the site
At this stage you should be able to run the website on the default theme included in this recipe locally by visiting it
in your browser (assuming that your LAMP stack is properly configured).

You might need to configure your admin access credentials in the `.env` file to be able to access the
site (see [environment management](https://docs.silverstripe.org/en/4/getting_started/environment_management/) docs).

## Structure of the project
The CWP recipe codebase includes the following directories that are either part of your `Project`, committed into Git or managed via `Composer`.

 - `assets/` - Uploaded files & images through the CMS are stored here, need to ensure it is writable (not committed to Project or Composer).
 - `mysite/` - The default project folder, your custom application code goes here (Project).
 - `themes/starter` - Available themes and templates are stored in the themes folders, each subfolder is a theme. CWP provides a starter theme for you to work with. Custom themes are usually part of your project code however some generic themes can be installed via composer (Project). Note that if a theme folder contains an underscore (e.g. `starter_watea`) it is likely to be a [subtheme](https://docs.silverstripe.org/en/4/developer_guides/templates/themes/#developing-your-own-theme).
 - `vendor/` - Used by composer for SilverStripe as well as 3rd party dependencies and tools (Composer).
 - `composer.json` - List of dependencies included in project. Human-readable, can be edited directly to include new modules. Inspected when `composer update` is run to determine any new versions of dependencies (Project).
 - `composer.lock` - Auto-generated, less human-readable. Tracks the exact state of the installed code modules. Used when `composer install` command is run and ensures other developers end up with same set of code (Project).

Periodically you will need to update modules to the newest versions by invoking `composer update` and committing
the resulting `composer.lock` file.

## Customising the project
You have now a private repository that you can modify. Here is a list of likely initial customisations:

 * Editing the name of the project in the root `composer.json` - find the **name** entry and change it so it's in the
format of "my-agency/basic" - "cwp" namespace is reserved for platform-endorsed modules and recipes.
 * Customising the `mysite/_config.php` to configure your project.
 * [Customise the theme](05_Customising_the_starter_theme.md)
 * Writing new project features
 * [Adding more modules](06_Working_with_modules.md)
 * Do any other housekeeping as necessary, for example edit or remove the `README` file.

## Troubleshooting

*Q: I can't run "git remote add". git says: "fatal: remote origin already exists"*

A: If you've installed via the cwp-installer package and answered "no" the the question if the repository should be removed, the git remote named "origin" still exists and points at its git repository. You have two options:

* Option A: Change origin to point at your Gitlab repository: `git remote set-url origin https://gitlab.cwp.govt.nz/my-project.git`
* Option B: Set a new remote, called e.g. "my-project": `git remote add my-project https://gitlab.cwp.govt.nz/my-project.git`

*Q: I get an error message "error: The requested URL returned error: 401 Unauthorized while accessing..." when cloning an existing GitLab repository*

A: If you get this error message you can work around it by including your GitLab username in the repository URL.
For example:
```
git clone https://your.username@gitlab.cwp.govt.nz/your-organisation/your-repo.git
```
