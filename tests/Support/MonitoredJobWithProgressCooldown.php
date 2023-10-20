<?php

namespace sbourdette\MongoQueueMonitor\Tests\Support;

use sbourdette\MongoQueueMonitor\Traits\IsMonitored;

class MonitoredJobWithProgressCooldown extends BaseJob
{
    use IsMonitored;

    public $progress;

    public function __construct(int $progress)
    {
        $this->progress = $progress;
    }

    public function handle(): void
    {
        $this->queueProgress(0);
        $this->queueProgress($this->progress);
    }

    public function progressCooldown(): int
    {
        return 10;
    }
}
