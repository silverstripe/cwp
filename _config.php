<?php
/********************************************************************************
 * General configuration.
 ********************************************************************************/

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

// Override the default HtmlEditorConfig for all groups.
Object::add_extension('Group', 'CwpHtmlEditorConfig');

/********************************************************************************
 * Custom TinyMCE configuration for CWP
 ********************************************************************************/
$cwpEditor = HtmlEditorConfig::get('cwp');

// Start with the same configuration as 'cms' config (defined in framework/admin/_config.php).
$cwpEditor->setOptions(array(
	'friendly_name' => 'Default CWP',
	'priority' => '60',
	'mode' => 'none',

	'body_class' => 'typography',
	'document_base_url' => Director::absoluteBaseURL(),

	'cleanup_callback' => "sapphiremce_cleanup",

	'use_native_selects' => false,
	'valid_elements' => "@[id|class|style|title],a[id|rel|rev|dir|tabindex|accesskey|type|name|href|target|title"
		. "|class],-strong/-b[class],-em/-i[class],-strike[class],-u[class],#p[id|dir|class|align|style],-ol[class],"
		. "-ul[class],-li[class],br,img[id|dir|longdesc|usemap|class|src|border|alt=|title|width|height|align|data*],"
		. "-sub[class],-sup[class],-blockquote[dir|class],"
		. "-table[border=0|cellspacing|cellpadding|width|height|class|align|summary|dir|id|style],"
		. "-tr[id|dir|class|rowspan|width|height|align|valign|bgcolor|background|bordercolor|style],"
		. "tbody[id|class|style],thead[id|class|style],tfoot[id|class|style],"
		. "#td[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],"
		. "-th[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style],caption[id|dir|class],"
		. "-div[id|dir|class|align|style],-span[class|align|style],-pre[class|align],address[class|align],"
		. "-h1[id|dir|class|align|style],-h2[id|dir|class|align|style],-h3[id|dir|class|align|style],"
		. "-h4[id|dir|class|align|style],-h5[id|dir|class|align|style],-h6[id|dir|class|align|style],hr[class],"
		. "dd[id|class|title|dir],dl[id|class|title|dir],dt[id|class|title|dir],@[id,style,class]",
	'extended_valid_elements' =>
		'img[class|src|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name|usemap|data*],'
		. 'object[classid|codebase|width|height|data|type],'
		. 'embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|allowscriptaccess|type|pluginspage|autoplay],'
		. 'param[name|value],'
		. 'map[class|name|id],'
		. 'area[shape|coords|href|target|alt],'
		. 'cite,abbr,ins[cite|datetime],del[cite|datetime],b,article,aside,code,col,colgroup,details,dfn,figure,figcaption,'
		. 'footer,header,kbd,mark,menu,meter,nav,pre,q,small,summary,time,var,ol[start|type]',
	'spellchecker_rpc_url' => THIRDPARTY_DIR . '/tinymce-spellchecker/rpc.php',
	'theme_advanced_blockformats' => 'p,pre,address,h2,h3,h4,h5,h6'
));

$cwpEditor->enablePlugins('media', 'fullscreen', 'inlinepopups');
$cwpEditor->enablePlugins('template');
$cwpEditor->enablePlugins('visualchars');
$cwpEditor->enablePlugins('xhtmlxtras');
$cwpEditor->enablePlugins(array(
	'ssbuttons' => sprintf('../../../%s/tinymce_ssbuttons/editor_plugin_src.js', THIRDPARTY_DIR),
	'ssmacron' => sprintf('../../../%s/tinymce_ssmacron/editor_plugin_src.js', THIRDPARTY_DIR)
));

// First line:
$cwpEditor->removeButtons('underline');
$cwpEditor->insertButtonsAfter('strikethrough', 'sub', 'sup');

// Second line:
$cwpEditor->insertButtonsBefore('formatselect', 'styleselect');
$cwpEditor->addButtonsToLine(2,
	'ssmedia', 'sslink', 'unlink', 'anchor', 'separator','code', 'fullscreen', 'separator',
	'template', 'separator', 'ssmacron'
);
$cwpEditor->insertButtonsAfter('pasteword', 'removeformat');
$cwpEditor->insertButtonsAfter('selectall', 'visualchars');
$cwpEditor->removeButtons('visualaid');

// Third line:
$cwpEditor->removeButtons('tablecontrols');
$cwpEditor->addButtonsToLine(3, 'tablecontrols', 'separator', 'ssmacron', 'cite', 'abbr', 'ins', 'del');

