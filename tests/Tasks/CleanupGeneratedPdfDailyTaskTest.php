<?php

namespace CWP\CWP\Tests\Tasks;

use CWP\CWP\Tasks\CleanupGeneratedPdfDailyTask;
use SilverStripe\Core\Config\Config;
use SilverStripe\CronTask\Interfaces\CronTask;
use SilverStripe\Dev\SapphireTest;

class CleanupGeneratedPdfDailyTaskTest extends SapphireTest
{
    /**
     * @var CleanupGeneratedPdfDailyTask
     */
    protected $task;

    protected function setUp()
    {
        parent::setUp();

        if (!interface_exists(CronTask::class)) {
            $this->markTestSkipped('Test class requires the silverstripe/crontask module to be installed');
        }

        $this->task = new CleanupGeneratedPdfDailyTask();
    }

    public function testCronScheduleIsConfigurable()
    {
        Config::modify()->set(CleanupGeneratedPdfDailyTask::class, 'schedule', '* 1 2 3 *');

        $this->assertSame('* 1 2 3 *', $this->task->getSchedule());
    }
}
