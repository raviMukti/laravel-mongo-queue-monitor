<?php

namespace violetshih\MongoQueueMonitor\Tests;

use violetshih\MongoQueueMonitor\Models\Monitor;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredBroadcastingJob;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredExtendingJob;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredJob;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredJobWithArguments;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredPartiallyKeptFailingJob;
use violetshih\MongoQueueMonitor\Tests\Support\MonitoredPartiallyKeptJob;
use violetshih\MongoQueueMonitor\Tests\Support\UnmonitoredJob;

class MonitorCreationTest extends TestCase
{
    public function testCreateMonitor()
    {
        $this
            ->dispatch(new MonitoredJob())
            ->assertDispatched(MonitoredJob::class)
            ->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredJob::class, $monitor->name);
    }

    public function testCreateMonitorFromExtending()
    {
        $this
            ->dispatch(new MonitoredExtendingJob())
            ->assertDispatched(MonitoredExtendingJob::class)
            ->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredExtendingJob::class, $monitor->name);
    }

    public function testDontCreateMonitor()
    {
        $this
            ->dispatch(new UnmonitoredJob())
            ->assertDispatched(UnmonitoredJob::class)
            ->workQueue();

        $this->assertCount(0, Monitor::all());
    }

    public function testDontKeepSuccessfulMonitor()
    {
        $this
            ->dispatch(new MonitoredPartiallyKeptJob())
            ->assertDispatched(MonitoredPartiallyKeptJob::class)
            ->workQueue();

        $this->assertCount(0, Monitor::all());
    }

    public function testDontKeepSuccessfulMonitorFailing()
    {
        $this
            ->dispatch(new MonitoredPartiallyKeptFailingJob())
            ->assertDispatched(MonitoredPartiallyKeptFailingJob::class)
            ->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredPartiallyKeptFailingJob::class, $monitor->name);
    }

    public function testBroadcastingJob()
    {
        $this
            ->dispatch(new MonitoredBroadcastingJob())
            ->assertDispatched(MonitoredBroadcastingJob::class)
            ->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredBroadcastingJob::class, $monitor->name);
    }

    public function testDispatchingJobViaDispatchableTrait()
    {
        MonitoredJob::dispatch();

        $this->assertDispatched(MonitoredJob::class);
        $this->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredJob::class, $monitor->name);
    }

    public function testDispatchingJobViaDispatchableTraitWithArguments()
    {
        MonitoredJobWithArguments::dispatch('foo');

        $this->assertDispatched(MonitoredJobWithArguments::class);
        $this->workQueue();

        $this->assertInstanceOf(Monitor::class, $monitor = Monitor::query()->first());
        $this->assertEquals(MonitoredJobWithArguments::class, $monitor->name);
    }
}
