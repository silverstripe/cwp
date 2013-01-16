<?php
LeftAndMain::require_css('cwp/css/custom.css');	

Object::add_extension('ContentController', 'CustomContentController');
Object::add_extension('Security', 'CustomContentController');
Object::add_extension('SiteConfig', 'CustomSiteConfig');

// Don't allow h1 in the editor
HtmlEditorConfig::get('cms')->setOption('theme_advanced_blockformats', 'p,pre,address,h2,h3,h4,h5,h6');
// Add in start and type attributes for ol
HtmlEditorConfig::get('cms')->setOption('extended_valid_elements', 'img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap],iframe[src|name|width|height|title|align|allowfullscreen|frameborder|marginwidth|marginheight|scrolling],object[width|height|data|type],param[name|value],map[class|name|id],area[shape|coords|href|target|alt],ol[start|type]');
// Macrons
HtmlEditorConfig::get('cms')->enablePlugins(array('ssmacron' => '../../../framework/thirdparty/tinymce_ssmacron/editor_plugin_src.js'));
HtmlEditorConfig::get('cms')->insertButtonsAfter('charmap', 'ssmacron');

GD::set_default_quality(90);

FulltextSearchable::enable();

// Configure document converter.
if (class_exists('DocumentConverterDecorator')) {
	DocumentImportIFrameField_Importer::set_docvert_username('ss-express');
	DocumentImportIFrameField_Importer::set_docvert_password('hLT7pCaJrYVz');
	DocumentImportIFrameField_Importer::set_docvert_url('http://docvert.silverstripe.com:8888/');
	Object::add_extension('Page', 'DocumentConverterDecorator');
}

// Default translations
if (class_exists('Translatable')) {
	Translatable::set_default_locale('en_NZ');
	Translatable::set_allowed_locales(array(
		'en_NZ', // NZ English
		'mi_NZ', // Maori
		'zh_cmn', // Chinese (Mandarin)
		'en_GB' // Needed to be able to create users in the CMS
	));

	Object::add_extension('SiteTree', 'Translatable');
	Object::add_extension('SiteConfig', 'Translatable');
}

i18n::$common_locales['mi_NZ'][0] = 'Māori';
i18n::$common_languages['mi'][0] = 'Māori';
