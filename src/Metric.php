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
 * Common interface for metrics objects.
 *
 * @since 0.1
 */
abstract class Metric
{
    private $timestamp;

    public function __construct(?\DateTimeInterface $timestamp=null)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * Get the time at which the metric occured. This may be `null` -- meaning
     * the metric doesn't care about its timestamp.
     */
    public function getTimestamp() : ?\DateTimeInterface
    {
        return $this->timestamp;
    }
}
