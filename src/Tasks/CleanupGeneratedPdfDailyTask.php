<?php

namespace CWP\CWP\Tasks;

use DailyTask;

class CleanupGeneratedPdfDailyTask extends DailyTask
{

    public function process()
    {
        $task = new CleanupGeneratedPdfBuildTask();
        $task->run(null);
    }
}
