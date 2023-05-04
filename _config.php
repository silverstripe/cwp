<?php

use SilverStripe\Control\Director;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Manifest\ModuleLoader;
use SilverStripe\Forms\HTMLEditor\HTMLEditorConfig;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

// default to the binary being in the usual path on Linux
if (!Environment::getEnv('WKHTMLTOPDF_BINARY')) {
    Environment::setEnv('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf');
}

// TinyMCE configuration
/** @var TinyMCEConfig $cwpEditor */
$cwpEditor = HTMLEditorConfig::get('cwp');

// Start with the same configuration as 'cms' config (defined in framework/admin/_config.php).
$cwpEditor->setOptions([
    'friendly_name' => 'Default CWP',
    'priority' => '60',
    'skin' => 'silverstripe',
    'body_class' => 'typography',
    'document_base_url' => Director::absoluteBaseURL(),
    'cleanup_callback' => "sapphiremce_cleanup",
    'use_native_selects' => false,
    'valid_elements' => "@[id|class|style|title],a[id|rel|rev|dir|tabindex|accesskey|type|name|href|target|title"
        . "|class],-strong/-b[class],-em/-i[class],-strike[class],-u[class],#p[id|dir|class|align|style]"
        . ",-ol[class],"
        . "-ul[class],"
        . "-li[class],br,img[id|dir|longdesc|usemap|class|src|border|alt=|title|width|height|align|data*],"
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
        'img[class|src|alt|title|hspace|vspace|width|height|align|name|usemap|data*],'
        . 'object[classid|codebase|width|height|data|type],'
        . 'embed[width|height|name|flashvars|src|bgcolor|align|play|loop|quality|'
        . 'allowscriptaccess|type|pluginspage|autoplay],'
        . 'param[name|value],'
        . 'map[class|name|id],'
        . 'area[shape|coords|href|target|alt],'
        . 'ins[cite|datetime],del[cite|datetime],'
        . 'menu[label|type],'
        . 'meter[form|high|low|max|min|optimum|value],'
        . 'cite,abbr,,b,article,aside,code,col,colgroup,details[open],dfn,figure,figcaption,'
        . 'footer,header,kbd,mark,,nav,pre,q[cite],small,summary,time[datetime],var,ol[start|type]',
    'browser_spellcheck' => true,
    'theme_advanced_blockformats' => 'p,pre,address,h2,h3,h4,h5,h6'
]);

$cwpEditor->enablePlugins('media', 'fullscreen');

// Enable insert-link to internal pages
$cmsModule = ModuleLoader::inst()->getManifest()->getModule('silverstripe/cms');

$cwpEditor
    ->enablePlugins([
        'sslinkinternal' => $cmsModule
            ->getResource('client/dist/js/TinyMCE_sslink-internal.js'),
        'sslinkanchor' => $cmsModule
            ->getResource('client/dist/js/TinyMCE_sslink-anchor.js'),
    ]);

// Re-enable media dialog
$assetAdminModule = ModuleLoader::inst()->getManifest()->getModule('silverstripe/asset-admin');
if ($assetAdminModule) {
    $cwpEditor
        ->enablePlugins([
            'ssmedia' => $assetAdminModule
                ->getResource('client/dist/js/TinyMCE_ssmedia.js'),
            'ssembed' => $assetAdminModule
                ->getResource('client/dist/js/TinyMCE_ssembed.js'),
            'sslinkfile' => $assetAdminModule
                ->getResource('client/dist/js/TinyMCE_sslink-file.js'),
        ]);
    $cwpEditor->insertButtonsAfter('table', 'ssmedia');
    $cwpEditor->insertButtonsAfter('ssmedia', 'ssembed');
}

// Add SilverStripe link options
$adminModule = ModuleLoader::inst()->getManifest()->getModule('silverstripe/admin');
$cwpEditor
    ->enablePlugins([
        'image' => null,
        'anchor' => null,
        'sslink' => $adminModule->getResource('client/dist/js/TinyMCE_sslink.js'),
        'sslinkexternal' => $adminModule->getResource('client/dist/js/TinyMCE_sslink-external.js'),
        'sslinkemail' => $adminModule->getResource('client/dist/js/TinyMCE_sslink-email.js'),
    ])
    ->setOption('contextmenu', 'sslink anchor ssmedia ssembed inserttable | cell row column deletetable');

$cwpEditor->enablePlugins('template');
$cwpEditor->enablePlugins('visualchars');

// First line:
$cwpEditor->insertButtonsAfter('strikethrough', 'sub', 'sup');
$cwpEditor->removeButtons('underline', 'strikethrough', 'spellchecker');

// Second line:
$cwpEditor->insertButtonsBefore('formatselect', 'styleselect');
$cwpEditor->addButtonsToLine(
    2,
    'anchor',
    'separator',
    'fullscreen',
    'separator',
    'template',
    'separator'
);

// Add macrons
$cwpEditor->enablePlugins('charmap');
$cwpEditor->addButtonsToLine(1, 'charmap');
$cwpEditor->setOption('charmap_append', [
    ['256', 'A - macron'],
    ['274', 'E - macron'],
    ['298', 'I - macron'],
    ['332', 'O - macron'],
    ['362', 'U - macron'],
    ['257', 'a - macron'],
    ['275', 'e - macron'],
    ['299', 'i - macron'],
    ['333', 'o - macron'],
    ['363', 'u - macron']
]);

$cwpEditor->insertButtonsAfter('pasteword', 'removeformat');
$cwpEditor->insertButtonsAfter('selectall', 'visualchars');
$cwpEditor->removeButtons('visualaid');
