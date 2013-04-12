<?php
/********************************************************************************
 * General configuration.
 ********************************************************************************/

// redirect some requests to the secure domain
if(defined('CWP_SECURE_DOMAIN') && @$_SERVER['HTTP_X_FORWARDED_PROTOCOL'] != 'https') {
	Director::forceSSL(array('/^Security/'), CWP_SECURE_DOMAIN);
	// Note 1: the platform always redirects "/admin" to CWP_SECURE_DOMAIN regardless of what you set here.
	// Note 2: if you have your own certificate installed, you can use your own domain, just omit the second parameter:
	//   Director::forceSSL(array('/^Security/'));
	//
	// See Director::forceSSL for more information.
}

LeftAndMain::require_css('cwp/css/custom.css');

SiteConfig::add_extension('CustomSiteConfig');

GD::set_default_quality(90);

// Configure document converter.
if (class_exists('DocumentConverterDecorator')) {
	DocumentImportIFrameField_Importer::set_docvert_username('ss-express');
	DocumentImportIFrameField_Importer::set_docvert_password('hLT7pCaJrYVz');
	DocumentImportIFrameField_Importer::set_docvert_url('http://docvert.silverstripe.com:8888/');
	Page::add_extension('DocumentConverterDecorator');
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

	SiteTree::add_extension('Translatable');
	SiteConfig::add_extension('Translatable');
}

// set the system locale to en_GB. This also means locale dropdowns
// and date formatting etc will default to this locale. Note there is no
// English (New Zealand) option
i18n::set_locale('en_GB');

// Add the ability to augment links with extra classes and meta information.
DBField::add_extension('RichLinksExtension');

// Override the default HtmlEditorConfig for all groups.
Group::add_extension('CwpHtmlEditorConfig');

// default to the binary being in the usual path on Linux
if(!defined('WKHTMLTOPDF_BINARY')) {
	define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf');
}

if(class_exists('Solr')) {
	SearchUpdater::bind_manipulation_capture();

	$extrasPath = BASE_PATH . '/mysite/conf/extras';
	if(!file_exists($extrasPath)) {
		$extrasPath = BASE_PATH . '/fulltextsearch/conf/extras';
	}

	Solr::configure_server(array(
		'host' => defined('SOLR_SERVER') ? SOLR_SERVER : 'localhost',
		'port' => defined('SOLR_PORT') ? SOLR_PORT : 8983,
		'path' => defined('SOLR_PATH') ? SOLR_PATH : '/solr/',
		'indexstore' => array(
			'mode' => defined('SOLR_MODE') ? SOLR_MODE : 'file',
			'auth' => defined('SOLR_AUTH') ? SOLR_AUTH : NULL,
			// Allow storing the solr index and config data in an arbitrary location,
			// e.g. outside of the webroot
			'path' => defined('SOLR_INDEXSTORE_PATH') ? SOLR_INDEXSTORE_PATH : BASE_PATH . '/.solr',
			'remotepath' => defined('SOLR_REMOTE_PATH') ? SOLR_REMOTE_PATH : null
		),
		'extraspath' => $extrasPath
	));
}

/********************************************************************************
 * Custom TinyMCE configuration for CWP
 ********************************************************************************/
$cwpEditor = HtmlEditorConfig::get('cwp');

HtmlEditorField_Toolbar::add_extension('CustomHtmlEditorFieldToolbar');

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
		. "-table[cellspacing|cellpadding|width|height|class|align|dir|id|style],"
		. "-tr[id|dir|class|rowspan|width|height|align|valign|bgcolor|background|bordercolor|style],"
		. "tbody[id|class|style],thead[id|class|style],tfoot[id|class|style],"
		. "#td[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style|headers],"
		. "-th[id|dir|class|colspan|rowspan|width|height|align|valign|scope|style|headers],caption[id|dir|class],"
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
		. 'ins[cite|datetime],del[cite|datetime],'
		. 'menu[label|type],'
		. 'meter[form|high|low|max|min|optimum|value],'
		. 'cite,abbr,,b,article,aside,code,col,colgroup,details[open],dfn,figure,figcaption,'
		. 'footer,header,kbd,mark,,nav,pre,q[cite],small,summary,time[datetime],var,ol[start|type]',
	'spellchecker_rpc_url' => THIRDPARTY_DIR . '/tinymce-spellchecker/rpc.php',
	'theme_advanced_blockformats' => 'p,pre,address,h2,h3,h4,h5,h6'
));

$cwpEditor->enablePlugins('media', 'fullscreen', 'inlinepopups');
$cwpEditor->enablePlugins('template');
$cwpEditor->enablePlugins('lists');
$cwpEditor->enablePlugins('visualchars');
$cwpEditor->enablePlugins('xhtmlxtras');
$cwpEditor->enablePlugins(array(
	'ssbuttons' => sprintf('../../../%s/tinymce_ssbuttons/editor_plugin_src.js', THIRDPARTY_DIR),
	'ssmacron' => sprintf('../../../%s/tinymce_ssmacron/editor_plugin_src.js', THIRDPARTY_DIR)
));

// First line:
$cwpEditor->insertButtonsAfter('strikethrough', 'sub', 'sup');
$cwpEditor->removeButtons('underline', 'strikethrough');

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
$cwpEditor->addButtonsToLine(3, 'cite', 'abbr', 'ins', 'del', 'separator', 'tablecontrols');

// Taxonomies
TaxonomyTerm::add_extension('TaxonomyTermExtension');

// configure administrative logging
$logFileWriter = new SS_SysLogWriter('SilverStripe', null, LOG_AUTH);
$logFileWriter->setFormatter(new CwpLoggerFormatter());
SS_Log::add_writer($logFileWriter, CwpLogger::PRIORITY, '=');
MemberLoginForm::add_extension('CwpLogger');
Security::add_extension('CwpLogger');
RequestHandler::add_extension('CwpLogger');
Controller::add_extension('CwpLogger');
Member::add_extension('CwpLogger');
Group::add_extension('CwpLogger');
SiteTree::add_extension('CwpLogger');

