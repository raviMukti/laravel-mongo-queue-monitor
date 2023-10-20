<?php

namespace violetshih\MongoQueueMonitor\Tests\Support;

use violetshih\MongoQueueMonitor\Traits\IsMonitored;

class MonitoredPartiallyKeptJob extends BaseJob
{
    use IsMonitored;

    public static function keepMonitorOnSuccess(): bool
    {
        return false;
    }
}
