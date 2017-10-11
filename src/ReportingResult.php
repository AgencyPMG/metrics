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

final class ReportingResult
{
    private $metricSets;

    private $errors;

    public function __construct(iterable $metricSets, iterable $errors)
    {
        $this->metricSets = $metricSets;
        $this->errors = $errors;
    }

    public function getMetricSets() : iterable
    {
        return $this->metricSets;
    }

    public function getErrors() : iterable
    {
        return $this->errors;
    }
}
