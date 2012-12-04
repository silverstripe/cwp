<?php

class NewsCategoryAdmin extends ModelAdmin {

	public static $url_segment = 'categories';
	public static $menu_title = 'Categories';
	public static $managed_models = array('NewsCategory');
}