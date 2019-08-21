<?php

// Ensure compatibility with PHP 7.2 ("object" is a reserved word),
// with SilverStripe 3.6 (using Object) and SilverStripe 3.7 (using SS_Object)
if (!class_exists('SS_Object')) class_alias('Object', 'SS_Object');

// default to the binary being in the usual path on Linux
if(!defined('WKHTMLTOPDF_BINARY')) {
	define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf_12');
}
