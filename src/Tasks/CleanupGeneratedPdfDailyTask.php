<?php

class CleanupGeneratedPdfDailyTask extends DailyTask {

    public function process() {
        $task = new CleanupGeneratedPdfBuildTask();
        $task->run(null);
    }

}
