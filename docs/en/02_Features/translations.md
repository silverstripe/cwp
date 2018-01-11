title: Working with translations
summary: Adding translated content to your website.

# Translations

The [SilverStripe Fluent](https://github.com/tractorcow/silverstripe-fluent) module allows you to create and edit
multiple pages in various languages or locales within languages. This module also adds the ability for your users
to select which language of a page they wish to view.

<div class="notice" markdown='1'>The SilverStripe Fluent module does not translate content automatically, content
authors will need to enter the translated content manually for each translated page</div>

## Setup

The Fluent module is already included as part of the CWP basic recipe and the starter and Wātea CWP themes are
set up to switch between different languages.

To set up new locales in the CMS, navigate to the "Locales" tab and start creating new locales. You can switch
between locale contexts using the dropdown menu in the top left corner at any time, and pages edited in the
selected locale will be saved for that locale.

You can also define inheritance for locales, meaning content that isn't modified at a certain locale can be inherited
from the "fallback locale".

For more information on using Fluent, please see the [module documentation](https://github.com/tractorcow/silverstripe-fluent/blob/4.0.0-beta2/readme.md).

## Technical

The Fluent module (like other modules like Subsites and Translatable) modifies the SQL queries that SilverStripe
performs. On occasions this could cause unintended side effects. If you need to perform an action within a certain
locale, or without a locale, you can pass a callback into `FluentState::singleton()->withState()` to perform a
function in isolation.

It is also recommended to use the SilverStripe ORM wherever possible and avoid writing manual SQL queries. 
