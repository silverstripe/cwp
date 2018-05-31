<?php

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

    /**
     * Updates the dropdown filter used to filter supported packages by renaming the labels (replaces the existing
     * filter options)
     *
     * @param GridFieldDropdownFilter $dropdownFilter
     */
    public function updateDropdownFilterOptions($dropdownFilter)
    {
        $dropdownFilter->removeFilterOption('supported');
        $dropdownFilter->removeFilterOption('unsupported');

        $dropdownFilter->addFilterOption(
            'supported',
            _t(__CLASS__ . '.FilterSupported', 'CWP recipe modules'),
            ['Supported' => true]
        );
        $dropdownFilter->addFilterOption(
            'unsupported',
            _t(__CLASS__ . '.FilterUnsupported', 'Non CWP modules'),
            ['Supported' => false]
        );
    }
}
