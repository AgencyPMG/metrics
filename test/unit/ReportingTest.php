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

class ReportingTest extends UnitTestCase
{
    private $collector, $set;

    public function testReportingSendsMetricSetToAllReporters()
    {
        $r = $this->newReporter();
        $r->expects($this->once())
            ->method('reportOn')
            ->with($this->identicalTo($this->set));
        $reporting = $this->newReporting([$r]);

        $result = $reporting->report();

        $this->assertCount(0, $result->getErrors());
        $this->assertSame([$this->set], $result->getMetricSets());
    }

    public function testReportingSwallowsAnyExceptionsThrownByReportersAndReturnsThemInTheResult()
    {
        $ex = new \Exception('oh noz');
        $r = $this->newReporter();
        $r->expects($this->once())
            ->method('reportOn')
            ->with($this->identicalTo($this->set))
            ->willThrowException($ex);
        $reporting = $this->newReporting([$r]);

        $result = $reporting->report();

        $this->assertSame([$ex], $result->getErrors());
        $this->assertSame([$this->set], $result->getMetricSets());
    }

    protected function setUp() : void
    {
        $this->collector = $this->createMock(Collector::class);
        $this->set = new MetricSet([]);
        $this->collector->expects($this->atLeastOnce())
            ->method('flush')
            ->willReturn($this->set);
    }

    private function newReporting(array $reporters) : Reporting
    {
        return new Reporting([$this->collector], $reporters);
    }

    private function newReporter() : Reporter
    {
        return $this->createMock(Reporter::class);
    }
}
