<?php

namespace violetshih\MongoQueueMonitor\Tests\Support;

use violetshih\MongoQueueMonitor\Services\QueueMonitor;
use violetshih\MongoQueueMonitor\Traits\IsMonitored;

class MonitoredFailingJobWithHugeExceptionMessage extends BaseJob
{
    use IsMonitored;

    public function handle(): void
    {
        throw new IntentionallyFailedException(str_repeat('x', QueueMonitor::MAX_BYTES_TEXT + 10));
    }
}
