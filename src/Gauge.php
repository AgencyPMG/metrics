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

final class Gauge extends Metric
{
    const UNIT_COUNT = 'count';

    /**
     * @var float
     */
    private $value;

    /**
     * @var string
     */
    private $unit;

    public function __construct(float $value, string $unit, \DateTimeInterface $timestamp=null)
    {
        parent::__construct($timestamp);
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function count(float $value, \DateTimeInterface $timestamp=null) : self
    {
        return new self($value, self::UNIT_COUNT, $timestamp);
    }

    public function getValue() : float
    {
        return $this->value;
    }

    public function getUnit() : string
    {
        return $this->unit;
    }
}
