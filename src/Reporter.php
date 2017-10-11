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
 * Sends the collected metrics to some sort of reporting backend.
 *
 * @since 2017-10-10
 */
interface Reporter
{
    public function reportOn(MetricSet $set) : void;
}
