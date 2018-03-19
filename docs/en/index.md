title: CWP developer documentation
introduction: This documentation covers specific information regarding how to work with SilverStripe CMS code when 
deployed on the Common Web Platform infrastructure.

# Developer documentation for SilverStripe CMS on CWP

The 'metapackages' that make up the codebase are referred to as the CWP `Recipes`. They are made up of your own custom 
developed code alongside:
 
 * SilverStripe CMS (open source CMS product).
 * SilverStripe commercially supported modules (which deliver many of the default features). 
 * Two CWP specific modules (cwp and cwp-core) that implement specific configuration and features related to running 
 websites on CWP.
 
 There are different recipe variations you can install for a CWP project.
 
 * [CWP Core Recipe](https://github.com/silverstripe/cwp-recipe-core) - Core functionality only recipe for a CWP 2.0 
 installation.
 * [CWP CMS Recipe](https://github.com/silverstripe/cwp-recipe-cms) - An extra CMS functionality recipe for a CWP 2.0 
 installation.
 * [CWP Search Recipe](https://github.com/silverstripe/cwp-recipe-search) - A recipe of modules to add search 
 functionality to your CWP 2 project.
 * [SilverStripe Authoring Tools Recipe](https://github.com/silverstripe/recipe-authoring-tools) - Extra tools for CMS 
 authoring in SilverStripe.
 * [SilverStripe Blog Recipe](https://github.com/silverstripe/recipe-blog) - Adds blog functionality for your project.
 * [SilverStripe Collaboration Recipe](https://github.com/silverstripe/recipe-collaboration) - Adds functionality to 
 enhance CMS author collaboration.
 * [SilverStripe CMS Reporting Tools Recipe](https://github.com/silverstripe/recipe-reporting-tools) - Adds extra CMS 
 reporting tools to your SilverStripe project.
 * [SilverStripe Content Blocks Recipe](https://github.com/silverstripe/recipe-content-blocks) - Adds content blocks to 
 your SilverStripe project.
 * [SilverStripe Form Building Recipe](https://github.com/silverstripe/recipe-form-building) - A recipe of modules to 
 help you build forms in SilverStripe.
 * [SilverStripe Services Recipe](https://github.com/silverstripe/recipe-services) - Adds API and content service 
 modules to your SilverStripe project.
 
 The above recipes can be combined as follows:
 
 * Bare bones - SilverStripe plus CWP mandated configuration.
 * Bare bones plus the [SilverStripe Blog Recipe](https://github.com/silverstripe/recipe-blog), or plus the 
 [SilverStripe Form Building Recipe](https://github.com/silverstripe/recipe-form-building), etc.
 * The [Common Web Platform Installer](https://github.com/silverstripe/cwp-installer) includes all of the above.
 * The [CWP Agency Extensions Module](https://github.com/silverstripe/cwp-agencyextensions) can be added to any of the 
 above.
 
  A base for jump-starting development of a CWP project is the 
  [Common Web Platform Installer](https://github.com/silverstripe/cwp-installer) package. This is a recommended way of 
  creating a CWP project. 
  The package includes the [CWP CMS Recipe](https://github.com/silverstripe/cwp-recipe-cms), the 
  [CWP Search Recipe](https://github.com/silverstripe/cwp-recipe-search), the 
  [Registry module](https://github.com/silverstripe/silverstripe-registry), the 
  [Fluent module](https://github.com/tractorcow/silverstripe-fluent), and the 
  [Subsites module](https://github.com/silverstripe/silverstripe-subsites).

For general information about working with SilverStripe CMS code, please consult the
[Official SilverStripe CMS developer documentation](https://docs.silverstripe.org/). 
We will point developers towards the official documentation when appropriate while ensuring CWP specific development 
guides are maintained in this documentation.

If you are completely new to SilverStripe CMS development, then you might like
to work through the online SilverStripe CMS [development lessons](https://www.silverstripe.org/learn/lessons/) or 
attend an [in-person introductory workshop](http://www.silverstripe.com/what-we-do/services/training/#jumpstart-course/).

[CHILDREN]
