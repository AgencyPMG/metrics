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

class InMemoryCollectorTest extends UnitTestCase
{
    private $metrics;

    public function testGaugesCanBeAddedAndFlushedOut()
    {
        $this->metrics->gauge('one', Gauge::count(2));

        $set = $this->metrics->flush();

        $this->assertCount(1, $set->getGauges());
        foreach ($set->getGauges() as $name => $metric) {
            $this->assertEquals(MetricName::ensure('one'), $name);
            $this->assertEquals(Gauge::count(2), $metric);
        }
    }

    protected function setUp()
    {
        $this->metrics = new InMemoryCollector();
    }
}
