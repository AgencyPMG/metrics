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
 * Helper factor methods.
 *
 * @since 0.1
 */
final class Metrics
{
    public static function collector() : Collector
    {
        return new InMemoryCollector();
    }

    public static function name($name) : MetricName
    {
        return MetricName::ensure($name);
    }

    // @codeCoverageIgnoreStart
    private function __construct()
    {
        // noop
    }
    // @codeCoverageIgnoreEnd
}
