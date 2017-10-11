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

use PMG\Metrics\Exception\InvalidMetricName;

class MetricNameTest extends UnitTestCase
{
    public static function invalidNames()
    {
        return [
            [new \stdClass],
            [['an array']],
            [1],
            [1.0],
            [null],
            [true],
        ];
    }

    /**
     * @dataProvider invalidNames
     */
    public function testMetricNamesCannotBeCreatedWithAnInvalidType($name)
    {
        $this->expectException(InvalidMetricName::class);
        MetricName::ensure($name);
    }

    public function testMetricNamesCanBeCreatedWithStrings()
    {
        $name = MetricName::ensure('aname');

        $this->assertSame('aname', $name->getName());
    }

    public function testMetricNamesCanHaveDimensions()
    {
        $name = MetricName::ensure('name')->dimension('one', '1');

        $this->assertSame(['one' => '1'], $name->getDimensions());
    }
}
