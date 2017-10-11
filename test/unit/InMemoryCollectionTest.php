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

class InMemoryCollectionTest extends UnitTestCase
{
    public function testCollectionIsCountable()
    {
        $c = new InMemoryCollection();
        $c->add(MetricName::ensure('one'), Gauge::count(1));

        $this->assertCount(1, $c);
    }

    public function testCollectionIterationusesMetricNamesAsKeys()
    {
        $c = new InMemoryCollection();
        $c->add(MetricName::ensure('one'), Gauge::count(1));

        foreach ($c as $name => $metric) {
            $this->assertEquals(MetricName::ensure('one'), $name);
            $this->assertEquals(Gauge::count(1), $metric);
        }
    }
}
