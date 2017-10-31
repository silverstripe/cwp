title: Supporting large numbers of files
summary: Troubleshooting sites with large numbers of files

If your site experiences slow or unusable performance when viewing the "Files" section in the CMS, it
could be due to your site containing an excessive number of files. Symptoms of this issue could include
the files section failing to load, loading for a long period of time, or a warning notification when
attempting to view that section.

The cause of this issue is the file "tree" view in the files section, which does not support
the pagination of list view, which allows it to limit visibility to a single page of files.

The resolution of this issue is to customise the AssetAdmin class to remove the tree view.
The list view, which does not suffer from performance degradation over multiple files, will
still be able to be used to navigate files as per normal.

Place the below code into a PHP class under mysite/ folder, and then apply the appropriate
YML configuration to replace the existing class via dependency injection.

`mysite/code/SimpleAssetAdmin.php`:


```php
<?php
class SimpleAssetAdmin extends AssetAdmin {
	public function getEditForm($id = null, $fields = null) {
		$form = parent::getEditForm($id, $fields);
		$form->Fields()->removeByName('TreeView');
		return $form;
	}

	public function SiteTreeAsUL() {
		return null;
	}
}
```


`mysite/_config/config.yml`:


```yaml
---
Name: myassetadmin
---
Injector:
  AssetAdmin:
    class: SimpleAssetAdmin
```

**(Optional)** In some instances, you may notice that you have two "Files" menu items. To remove the now unused "Files" menu item, add the following to your `_config.php`.  

`mysite/_config.php`:


```php
CMSMenu::remove_menu_item('AssetAdmin');
```

After making these changes, flush the site with ?flush=1 in your querystring, and the assets area
will load much more quickly.