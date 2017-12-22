<?php

use SilverStripe\Core\Environment;

// default to the binary being in the usual path on Linux
if (!Environment::getEnv('WKHTMLTOPDF_BINARY')) {
    Environment::setEnv('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf_12');
}
