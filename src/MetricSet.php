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
 * Value object containing all metrics a collector has collected.
 *
 * All the collections of metrics here are in $name => $metric pairs.
 *
 * @since 0.1
 */
final class MetricSet
{
    /**
     * @var Gauge[]
     */
    private $gauges;

    public function __construct(iterable $gauges)
    {
        $this->gauges = $gauges;
    }

    public function getGauges() : iterable
    {
        return $this->gauges;
    }
}
