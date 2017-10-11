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
 * Glues together multiple collectors and reporters and hides their interaction
 * behind a `report` method.
 *
 * @since 0.1
 */
class Reporting
{
    /**
     * @var Collector[]
     */
    private $collectors;

    /**
     * @var Reporter[]
     */
    private $reporters;

    public function __construct(iterable $collectors, iterable $reporters)
    {
        $this->collectors = $collectors;
        $this->reporters = $reporters;
    }

    /**
     * Flush each collector and send its MetricSet to all the given reporters.
     *
     * Returns any exceptions thrown by reporters. Metrics Usually aren't crucial
     * to how an app runs, so this is making the call to try and keep running.
     *
     * If that's not what's required for an application, then this class should
     * not be used.
     */
    public function report() : ReportingResult
    {
        $sets = [];
        $errors = [];
        foreach ($this->collectors as $collector) {
            $sets[] = $set = $collector->flush();
            $errors[] = $this->reportOn($set);
        }

        return new ReportingResult($sets, array_merge(...$errors));
    }

    /**
     * Deliberately only catches `Exception` objects rather than all throwables.
     *
     * Exceptions are more likely to mean that something went wrong in the reporter
     * vs an error (which probably means the programmer messed up).
     */
    private function reportOn(MetricSet $set) : array
    {
        $errors = [];
        foreach ($this->reporters as $reporter) {
            try {
                $reporter->reportOn($set);
            } catch (\Exception $e) {
                $errors[] = $e;
            }
        }

        return $errors;
    }
}
