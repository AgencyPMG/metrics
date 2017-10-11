# Metrics


**Warning: this is very unstable software right now**. PMG is adding features to
this as we need them.

## Core Concepts

- A **Collector** collects metrics over the course of an application lifecycle
  and stores them someplace locally (usually just in memory)
- A **Reporter** takes a *metric set* flushed out of a collector and sends it
  to a real metrics backend (like [cloudwatch](https://github.com/AgencyPMG/metrics-cloudwatch)).
- A **Metric** is just some sort of measurement taken with an application. Comes
  in several flavors.
    - A **Gauge** is a static value taken at a point in time.

## Usage Example

```php
use PMG\Metrics\Metrics;
use PMG\Metrics\Gauge;

$collector = Metrics::collector();

// track `someName` with a count gauge with a value of 10
$collector->gauge('someName', Gauge::count(10));

// Same as the above but tag `someName` with dimensions
$collector->gauge(
    Metrics::name('someName')->dimension('example', '1'),
    Gauge::count(10)
);

/* @var Reporter $reporter **/
$reporter->reportOn($collector->flush());

// $collector is now empty and ready to go
```
