<?php declare(strict_types=1);

/**
 * This file is part of pmg/metrics
 *
 * Copyright (c) PMG <https://www.pmg.com>
 *
 * For full copyright information see the LICENSE file distributed
 * with this source code.
 *
 * @license     http://opensource.org/licenses/Apache-2.0 Apache-2.0
 */

namespace PMG\Metrics;

/**
 * ABC for metrics collectors. This just collects values in memory leaving it
 * to the `flush` method to send the data to a real backend.
 *
 * @since 0.1
 */
final class InMemoryCollector implements Collector
{
    private $gauges;

    public function __construct()
    {
        $this->resetStorage();
    }

    /**
     * {@inheritdoc}
     */
    public function gauge($name, Gauge $gauge) : void
    {
        $this->gauges->add(MetricName::ensure($name), $gauge);
    }

    /**
     * {@inheritdoc}
     */
    public function flush() : MetricSet
    {
        $set = new MetricSet($this->gauges);
        $this->resetStorage();

        return $set;
    }

    private function resetStorage()
    {
        $this->gauges = new InMemoryCollection();
    }
}
