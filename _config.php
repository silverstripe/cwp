<?php

## General CWP configuration

## More configuration is applied in _config/config.yml for APIs that use
## {@link Config} instead of setting statics directly.

## NOTE: Put your custom site configuration into mysite/_config/config.yml
## and if absolutely necessary if you can't use the yml file, mysite/_config.php instead.

// configure document converter.
if (class_exists('DocumentConverterDecorator')) {
	DocumentImportIFrameField_Importer::set_docvert_username(DOCVERT_USERNAME);
	DocumentImportIFrameField_Importer::set_docvert_password(DOCVERT_PASSWORD);
	DocumentImportIFrameField_Importer::set_docvert_url(DOCVERT_URL);
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

// default to the binary being in the usual path on Linux
if(!defined('WKHTMLTOPDF_BINARY')) {
	define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf');
}

if(class_exists('Solr')) {
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

// TinyMCE configuration
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

// configure administrative logging for web requests only
// it's disabled for cli, as it fills up logs even for unit tests
if(!Director::is_cli()) {
	$logFileWriter = new SS_SysLogWriter('SilverStripe', null, LOG_AUTH);
	$logFileWriter->setFormatter(new CwpLoggerFormatter());
	SS_Log::add_writer($logFileWriter, CwpLogger::PRIORITY, '=');
	MemberLoginForm::add_extension('CwpLogger');
	Security::add_extension('CwpLogger');
	RequestHandler::add_extension('CwpLogger');
	Controller::add_extension('CwpLogger');
	Member::add_extension('CwpLogger');
}

