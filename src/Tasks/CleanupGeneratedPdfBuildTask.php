<?php

namespace CWP\CWP\Tasks;

use CWP\CWP\PageTypes\BasePage;
use SilverStripe\Dev\BuildTask;

class CleanupGeneratedPdfBuildTask extends BuildTask
{
    protected $title = 'Cleanup generated PDFs';

    protected $description = 'Removes generated PDFs on the site, forcing a regeneration of all exports to PDF '
        . 'when users go to download them. This is most useful when templates have been changed so users should '
        . 'receive a new copy';

    public function run($request)
    {
        $path = sprintf('%s/%s', BASE_PATH, BasePage::config()->generated_pdf_path);
        if (!file_exists($path)) {
            return false;
        }

        exec(sprintf('if [ "$(ls -A %s 2> /dev/null)" != "" ]; then rm %s/*; fi', $path, $path), $output, $return_val);

        // output any errors
        if ($return_val != 0) {
            user_error(sprintf('%s failed: ', get_class($this)) . implode("\n", $output), E_USER_ERROR);
        }
    }
}
