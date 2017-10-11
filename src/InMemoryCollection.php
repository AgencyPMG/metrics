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
 * Used by InMemoryCollector to store metrics. Slightly less awkward iteration
 * than `SplObjectStorage`
 *
 * @since 0.1
 * @internal
 */
class InMemoryCollection implements \IteratorAggregate, \Countable
{
    private $storage = [];

    public function add(MetricName $name, Metric $metric)
    {
        $this->storage[] = [$name, $metric];
    }

    public function getIterator() : \Generator
    {
        foreach ($this->storage as [$name, $metric]) {
            yield $name => $metric;
        }
    }

    public function count() : int
    {
        return count($this->storage);
    }
}
