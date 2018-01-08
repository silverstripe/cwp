<?php

namespace CWP\CWP\Tasks;

use SilverStripe\Core\Config\Configurable;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\CronTask\Interfaces\CronTask;

if (!interface_exists(CronTask::class)) {
    return;
}

/**
 * If the silverstripe/crontask module is installed, this will enable the PDF cleanup task to be run on a schedule
 */
class CleanupGeneratedPdfDailyTask implements CronTask
{
    use Configurable;

    /**
     * The cron schedule for this task (default: midnight every day)
     *
     * @config
     * @var string
     */
    private static $schedule = '0 0 * * *';

    /**
     * Whether this task is enabled (default false)
     *
     * @config
     * @return bool
     */
    private static $enabled = false;

    public function getSchedule()
    {
        return $this->config()->get('schedule');
    }

    public function process()
    {
        if (!$this->config()->get('enabled')) {
            return;
        }

        $task = Injector::inst()->create(CleanupGeneratedPdfBuildTask::class);
        $task->run(null);
    }
}
