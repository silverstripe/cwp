<?php

namespace CWP\CWP\Extensions;

use SilverStripe\Core\Extension;

/**
 * Extends the site summary report to list the appropriate versions in the report header
 */
class CwpSiteSummaryExtension extends Extension
{

    /**
     * Updates the modules used for the version label by:
     *  - Removing SS Framework
     *  - Adding CWP
     *  - Relabelling SS CMS
     *
     * @param array $modules
     */
    public function updateVersionModules(&$modules)
    {
        unset($modules['silverstripe/framework']);
        $modules = ['cwp/cwp' => 'CWP'] + $modules;
        $modules['silverstripe/cms'] = 'SilverStripe CMS';
    }
}
