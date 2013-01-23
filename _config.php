<?php
LeftAndMain::require_css('cwp/css/custom.css');

Object::add_extension('SiteConfig', 'CustomSiteConfig');

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

// Add the ability to augment links with extra classes and meta information.
Object::add_extension('DBField', 'RichLinksExtension');

// Customise TinyMCE
$cmsEditor = HtmlEditorConfig::get('cms');
$cmsEditor->enablePlugins(array('ssmacron' => '../../../framework/thirdparty/tinymce_ssmacron/editor_plugin_src.js'));
$cmsEditor->enablePlugins('template');
$cmsEditor->enablePlugins('visualchars');
$cmsEditor->enablePlugins('xhtmlxtras');
// Don't allow h1 in the editor
$cmsEditor->setOption('theme_advanced_blockformats', 'p,pre,address,h2,h3,h4,h5,h6');
// Add b, abbr, article, aside, cite, code, col, colgroup, del, details, dfn, figure, figcaption, footer, header, ins, kbd, mark, menu, meter, nav, pre, q, small, summary, time, var and attributes for ol
// Remove iframe (done with IFramePages or shortcodes)
$cmsEditor->setOption('extended_valid_elements', 'img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap|data*],object[classid|codebase|width|height|data|type],embed[src|type|pluginspage|width|height|autoplay],param[name|value],map[class|name|id],area[shape|coords|href|target|alt],cite,abbr,ins[cite|datetime],del[cite|datetime],b,article,aside,code,col,colgroup,details,dfn,figure,figcaption,footer,header,kbd,mark,menu,meter,nav,pre,q,small,summary,time,var,ol[start|type]');
// First line changes:
$cmsEditor->removeButtons('underline');
$cmsEditor->insertButtonsAfter('strikethrough', 'sub', 'sup');
$cmsEditor->insertButtonsAfter('charmap', 'ssmacron');
// Second line changes:
$cmsEditor->insertButtonsAfter('pasteword', 'removeformat');
$cmsEditor->insertButtonsAfter('selectall', 'visualchars');
$cmsEditor->removeButtons('visualaid');
$cmsEditor->addButtonsToLine(2, 'template');
// Third line changes:
$cmsEditor->setButtonsForLine(3, 'cite', 'abbr', 'ins', 'del', 'separator');
