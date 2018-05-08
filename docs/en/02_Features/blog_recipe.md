title: Blogging
summary: Publish blog posts and allow the public to engage with you by commenting.

# Blogging

The SilverStripe blog module lets you publish blog posts and allow the public to
engage with you by commenting on your posts. The module supports flexible
categorisation and tagging of blog posts.

From 1.1.0 onwards the `blog recipe` is included along side the other SilverStripe and CWP recipes by default.

[Three levels of permissions are supported](https://github.com/silverstripe/silverstripe-blog/blob/master/docs/en/userguide/roles.md):

 * Editors who can control everything in their blog
 * Writers who can create and publish in their blog
 * Contributors who can write, but have limited permissions otherwise

Commenting can be enabled and disabled, and all comments go through a
[spam filter](../03_How_tos/akismet.md) and then need to be manually moderated before
they are published. The module provides an RSS feed to allow the public to
subscribe to your blog posts.

![Blog CMS](../_images/blog_cms.png)

![Blog Frontend](../_images/blog_frontend.png)

## Overview

This recipe includes the following modules:

 * [Akismet](https://github.com/silverstripe/silverstripe-akismet) - Implement default spam protection via Akismet service
 * [Blog](https://github.com/silverstripe/silverstripe-blog) - The main module for providing blogging functionality.
 * [Bulk Editing Tools](https://github.com/colymba/GridFieldBulkEditingTools) - Supporting module for Comments to allow bulk management of comments
 * [Comments](https://github.com/silverstripe/silverstripe-comments) - Allows nested page comments
 * [Comment Notifications](https://github.com/silverstripe-labs/comment-notifications) - Supporting module for Comments to notify authors of blog comments
 * [Content Widget](https://github.com/silverstripe-labs/silverstripe-content-widget) - Adds additional sidebar widget for HTML content
 * [Lumberjack](https://github.com/silverstripe/silverstripe-lumberjack) - Supporting module for Blog to allow management of pages via gridfield.
 * [Spam Protection](https://github.com/silverstripe/silverstripe-spamprotection) - Supporting module for Akismet to provide core spam protection API
 * [Widgets](https://github.com/silverstripe/silverstripe-widgets) - Adds sidebar widgets

## Upgrading

While the blog recipe is included by default in all cwp installs from 1.1.0 onwards, this must be manually included
in any existing sites if upgrading.

This can be added through the following change to your composer.json:


	"require": {
		"cwp/cwp-recipe-basic": "~1.1.0@stable",
		"cwp/cwp-recipe-blog": "~1.1.0@stable",
		"cwp-themes/default": "~1.1.0@stable"
	}


For any new project created from 1.1.0 onwards, this recipe can be removed if necessary to omit the above modules
from any site. If blogging or comments are not required for a CWP site it's advisable to manually remove this recipe.

## Configuration

Any new site created from 1.1.0 onwards will have a set of default configuration options added in order to best
customise the blog recipe for cwp defaults. These settings are included in the `cwp/cwp-installer` module in the
blog.yml file under `mysite/_config`. Sites upgrading from 1.0.7 or below may require one or more of these settings
to be manually added.

For configuration of anti-spam please see the [Akismet configuration guide](../03_How_tos/akismet.md) for more information.

For the basic configuration, see the default `mysite/_config/blog.yml` below for reference:

```yml
---
Name: mywidgetsconfig
Only:
  moduleexists:
    - silverstripe/blog
    - silverstripe/widgets
---
# Disable if you do not use widgets on your blog
SilverStripe\Blog\Model\Blog:
  extensions:
    - SilverStripe\Widgets\Extensions\WidgetPageExtension

SilverStripe\Blog\Model\BlogPost:
  extensions:
    - SilverStripe\Widgets\Extensions\WidgetPageExtension

---
Name: myblogconfig
Only:
  moduleexists:
    - silverstripe/blog
    - silverstripe/comments
---
# Enable page comments for blogs and blog posts on the site by default, including frontend moderation / approval
SilverStripe\Blog\Model\Blog:
  extensions:
    - SilverStripe\Comments\Extensions\CommentsExtension
  comments:
    enabled: false
    frontend_moderation: true
    require_moderation_nonmembers: true
    require_moderation_cms: true
    require_login: false
    require_login_cms: true
    nested_comments: true
    order_comments_by: '"Created" ASC'

SilverStripe\Blog\Model\BlogPost:
  default_notification_template: SilverStripe\CommentNotifications\BlogCommentEmail
  extensions:
    - SilverStripe\Comments\Extensions\CommentsExtension
  comments:
    enabled: true
    frontend_moderation: true
    require_moderation_nonmembers: true
    require_moderation_cms: true
    require_login: false
    require_login_cms: true
    nested_comments: true
    order_comments_by: '"Created" ASC'

---
Name: akismetconfig
Only:
  moduleexists: silverstripe/akismet
---
# Customise your akismet configuration here
SilverStripe\SiteConfig\SiteConfig:
  extensions:
    - SilverStripe\Akismet\Config\AkismetConfig
# Allows spam posts to be saved for review if necessary
SilverStripe\Akismet\AkismetSpamProtector:
  save_spam: true

---
Name: mycommentspamprotection
Only:
  moduleexists:
    - silverstripe/comments
    - silverstripe/spamprotection
---
# Enable spam protection for comments by default
SilverStripe\Comments\Controllers\CommentingController:
  extensions:
    - SilverStripe\SpamProtection\Extension\CommentSpamProtection
``` 
