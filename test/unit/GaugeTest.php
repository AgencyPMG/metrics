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

class GaugeTest extends UnitTestCase
{
    public function testCountConstructorReturnsACountGauge()
    {
        $g = Gauge::count(1);

        $this->assertEquals(Gauge::UNIT_COUNT, $g->getUnit());
        $this->assertEquals(1, $g->getValue());
    }
}
