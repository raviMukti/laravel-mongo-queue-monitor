<?php

namespace violetshih\MongoQueueMonitor\Tests;

use violetshih\MongoQueueMonitor\Services\ClassUses;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredExtendingJob;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredJob;
use violetshih\MongoQueueMonitor\Traits\IsMonitored;

class ClassUsesTraitTest extends TestCase
{
    public function testUsingMonitorTrait()
    {
        $this->assertArrayHasKey(
            IsMonitored::class,
            ClassUses::classUsesRecursive(MonitoredJob::class)
        );
    }

    public function testUsingMonitorTraitExtended()
    {
        $this->assertArrayHasKey(
            IsMonitored::class,
            ClassUses::classUsesRecursive(MonitoredExtendingJob::class)
        );
    }
}
