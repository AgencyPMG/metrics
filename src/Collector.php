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
 * Represent a single metric.
 *
 * @since 0.1
 */
interface Collector
{
    /**
     * Write a static, numeric value to the metrics collector.
     *
     * @param string|MetricName $name The metrics name
     * @param $value The gague value
     * @throws Exception\InvalidMetricName if $name is not a string or MetricName object
     */
    public function gauge($name, Gauge $value) : void;

    /**
     * Flushes any currently collected metrics into a set and resets the
     * collector. This is usually used for reporting and probably only called
     * once at the termination of a request.
     */
    public function flush() : MetricSet;
}
