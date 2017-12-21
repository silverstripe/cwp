<?php

namespace CWP\CWP\Tasks;

use DailyTask;

// @todo replace with QueuedJobs
class CleanupGeneratedPdfDailyTask // extends DailyTask
{
    public function process()
    {
        $task = new CleanupGeneratedPdfBuildTask();
        $task->run(null);
    }
}
