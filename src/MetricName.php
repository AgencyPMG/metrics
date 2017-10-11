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
 * Value object representing the metric name.
 *
 * @since 0.1
 */
final class MetricName
{
    private $name;

    private $dimensions;

    public function __construct(string $name, array $dimensions=[])
    {
        $this->name = $name;
        $this->dimensions = $dimensions;
    }

    public static function ensure($name) : self
    {
        if (!is_string($name) && !$name instanceof MetricName) {
            throw new Exception\InvalidMetricName(sprintf(
                'Expected $name to be a string or %s instance, got "%s"',
                MetricName::class,
                is_object($name) ? get_class($name) : gettype($name)
            ));
        }

        return is_string($name) ? new MetricName($name) : $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getDimensions() : array
    {
        return $this->dimensions;
    }

    public function dimension(string $name, string $value) : self
    {
        $out = clone $this;
        $out->dimensions[$name] = $value;
        return $out;
    }
}
