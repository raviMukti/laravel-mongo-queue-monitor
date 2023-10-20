<?php

namespace violetshih\MongoQueueMonitor\Tests\Support;

use violetshih\MongoQueueMonitor\Traits\IsMonitored;

class MonitoredJobWithArguments extends BaseJob
{
    use IsMonitored;

    public $first;

    public function __construct(string $first)
    {
        $this->first = $first;
    }
}
