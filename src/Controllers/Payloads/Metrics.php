<?php

namespace violetshih\MongoQueueMonitor\Controllers\Payloads;

final class Metrics
{
    /**
     * @var \violetshih\MongoQueueMonitor\Controllers\Payloads\Metric[]
     */
    public $metrics = [];

    /**
     * @return \violetshih\MongoQueueMonitor\Controllers\Payloads\Metric[]
     */
    public function all(): array
    {
        return $this->metrics;
    }

    public function push(Metric $metric): self
    {
        $this->metrics[] = $metric;

        return $this;
    }
}
