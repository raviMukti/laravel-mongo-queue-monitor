<?php

namespace violetshih\MongoQueueMonitor\Tests\Support;

use violetshih\MongoQueueMonitor\Traits\IsMonitored;

class MonitoredJob extends BaseJob
{
    use IsMonitored;
}
