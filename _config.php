<?php

// default to the binary being in the usual path on Linux
if (!defined('WKHTMLTOPDF_BINARY')) {
    define('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf_12');
}
