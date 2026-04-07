# Report Operation

---

<a name="about"></a>
## About

This operation adds a **Report** page to any CrudController, allowing admins to see metrics (stats, charts) about the entity's data. Each metric fetches its data independently via AJAX, so the page loads fast and metrics render as they become available.

Key features:
- **Stat metrics** — single-value cards (count, sum, avg, min, max) with optional comparison (previous period, or custom);
- **Line & bar chart metrics** — time-series data grouped by day/week/month/year;
- **Per-metric AJAX** — each metric (or group of metrics) makes its own request;
- **Grouped metrics** — metrics that share a query can be batched into a single AJAX request;
- **Auto-injected filters** — date range and interval filters are added automatically;
- **Custom resolve** — full control over the data returned by any metric;
- **Config file** — cross-controller defaults for wrappers, interval, period column, etc.

![Backpack Report Operation](https://backpackforlaravel.com/uploads/docs/report-operation.png)

<a name="requirements"></a>
## Requirements

None, besides a working Backpack CRUD installation. The operation uses [Chart.js](https://www.chartjs.org/) for charts, loaded automatically via `@basset`.

<a name="how-to-use"></a>
## How to Use

**Step 1. Use the operation trait on your CrudController:**

```php
use \Backpack\CRUD\app\Http\Controllers\Operations\ReportOperation;
```

**Step 2. Define your metrics in `setupReportOperation()`:**

```php
protected function setupReportOperation()
{
    $this->addMetric('total_orders', [
        'type'      => 'stat',
        'label'     => 'Total Orders',
        'aggregate' => 'count',
        'period'    => 'created_at',
        'compare'   => true,
    ]);

    $this->addMetric('orders_over_time', [
        'type'      => 'line',
        'label'     => 'Orders Over Time',
        'aggregate' => 'count',
        'period'    => 'created_at',
    ]);
}
```

That's it. A **Report** button will appear in the List operation top bar, linking to the report page.

<a name="how-it-works"></a>
## How It Works

The `ReportOperation` uses two routes:
- `GET  /{segment}/report` — renders the report page with metric placeholders (spinners);
- `POST /{segment}/report/metric-data` — AJAX endpoint that resolves one or more metrics and returns JSON;

On page load, the JavaScript reads the metric widgets from the DOM and builds a **load plan**: ungrouped metrics fire individual requests, grouped metrics share a single request. When data comes back, stat cards are updated with their values and chart canvases are rendered via Chart.js.

Two CRUD filters are auto-injected:
- **Date Range** (`date_range` type) — sets the time window for all metrics;
- **Interval** (`dropdown` type) — controls chart grouping (Daily / Weekly / Monthly / Yearly);

When filters change, all metrics automatically re-fetch.

<a name="metric-types"></a>
## Metric Types

<a name="stat-metric"></a>
### Stat

A single-value card showing an aggregate number.

```php
$this->addMetric('total_products', [
    'type'      => 'stat',       // required
    'label'     => 'Total Products',
    'aggregate' => 'count',      // count | sum | avg | min | max
    'column'    => 'price',      // required for sum, avg, min, max
    'period'    => 'created_at', // date column for filtering & comparison
    'compare'   => true,         // show % change vs previous period
    'format'    => '$:value',    // format the displayed value
]);
```

<a name="line-metric"></a>
### Line

A time-series line chart.

```php
$this->addMetric('revenue_over_time', [
    'type'      => 'line',       // required
    'label'     => 'Revenue Over Time',
    'column'    => 'amount',
    'aggregate' => 'sum',        // count | sum | avg | min | max
    'period'    => 'created_at', // date column used for grouping & filtering
]);
```

<a name="bar-metric"></a>
### Bar

Same as `line` but renders as a bar chart. Use `'type' => 'bar'`.

<a name="metric-options"></a>
## Metric Options Reference

| Option      | Type          | Default            | Description |
|-------------|---------------|--------------------|-------------|
| `type`      | `string`      | `'stat'`           | Metric type: `stat`, `line`, `bar`. |
| `label`     | `string`      | Auto from name     | Display label on the card/chart. |
| `column`    | `string|null` | `null`             | DB column for `sum`/`avg`/`min`/`max` aggregates. |
| `aggregate` | `string`      | `'count'`          | Aggregate function: `count`, `sum`, `avg`, `min`, `max`. |
| `period`    | `string|null` | Config default     | Date column for time filtering and chart grouping. Falls back to `defaultPeriodColumn` in config. |
| `compare`   | `bool|MetricComparison|null` | `null` | Set to `true` for previous-period comparison, or pass a `MetricComparison` instance for custom logic. |
| `format`    | `string|null` | `null`             | Format string for `stat` display. `:value` is replaced with the actual value. E.g. `'$:value'`, `':value users'`. |
| `wrapper`   | `array`       | From config        | HTML attributes for the wrapper `<div>`. Typically `['class' => 'col-md-4']`. Defaults come from the `defaultWrappers` config. |
| `query`     | `Closure|null`| `null`             | Modify the base query before aggregation. Receives `$query`, should return `$query`. |
| `resolve`   | `Closure|null`| `null`             | Fully custom data resolution. Receives `($query, $filters)`, must return an array. |
| `group`     | `string|null` | `null`             | Group name. Metrics with the same group share a single AJAX request. |

<a name="customizing-queries"></a>
## Customizing Queries

<a name="query-scope"></a>
### Scoping with `query`

Use the `query` option to add conditions to the base query before the aggregate runs:

```php
$this->addMetric('active_users', [
    'type'      => 'stat',
    'label'     => 'Active Users',
    'aggregate' => 'count',
    'query'     => fn ($query) => $query->where('status', 'active'),
]);
```

This works for both `stat` and chart metrics.

<a name="custom-resolve"></a>
### Full Control with `resolve`

When you need complete control over what a metric returns, use `resolve`. The closure receives the query (already scoped by date range if a `period` is set) and the filters array:

```php
$this->addMetric('unique_categories', [
    'type'    => 'stat',
    'label'   => 'Unique Categories',
    'resolve' => function ($query, $filters) {
        return [
            'value' => $query->distinct('category_id')->count('category_id'),
        ];
    },
]);
```

For chart metrics, your `resolve` must return `['labels' => [...], 'data' => [...]]`:

```php
$this->addMetric('custom_chart', [
    'type'    => 'line',
    'label'   => 'Custom Chart',
    'resolve' => function ($query, $filters) {
        $rows = $query->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
                      ->groupBy('m')->orderBy('m')->get();
        return [
            'labels' => $rows->pluck('m')->toArray(),
            'data'   => $rows->pluck('c')->toArray(),
        ];
    },
]);
```

<a name="custom-comparisons"></a>
## Custom Comparisons

The `compare` option accepts `true` (shorthand for previous-period comparison) or any class implementing `MetricComparison`. This lets you create your own comparison strategies without modifying the core package.

<a name="metric-comparison-interface"></a>
### The `MetricComparison` Interface

```php
use Backpack\CRUD\app\Library\CrudPanel\CrudMetric;
use Illuminate\Database\Eloquent\Builder;

interface MetricComparison
{
    public function resolve(CrudMetric $metric, Builder $query, array $filters, float $currentValue): array;
}
```

Your `resolve` method receives:
- `$metric` — the `CrudMetric` instance (access `$metric->query`, `$metric->getPeriodColumn()`, `$metric->runAggregate()`, etc.);
- `$query` — the base query, already scoped by date range;
- `$filters` — the current filter values (`date_from`, `date_to`, `interval`);
- `$currentValue` — the aggregate value for the current period;

It must return an array with `previous` and `change` keys:

```php
return [
    'previous' => 42.0,   // the comparison value
    'change'   => 15.3,   // percentage change (positive = up arrow, negative = down arrow)
];
```

<a name="built-in-previous-period"></a>
### Built-in: `PreviousPeriod`

The built-in `PreviousPeriod` comparison computes the same aggregate for a period of equal duration immediately before the selected date range. Using `'compare' => true` is equivalent to:

```php
use Backpack\CRUD\app\Library\CrudPanel\Metrics\PreviousPeriod;

$this->addMetric('total_orders', [
    'type'    => 'stat',
    'compare' => new PreviousPeriod(),
]);
```

<a name="custom-comparison-example"></a>
### Creating a Custom Comparison

For example, to compare against the same date range in the previous year:

```php
namespace App\Metrics;

use Backpack\CRUD\app\Library\CrudPanel\CrudMetric;
use Backpack\CRUD\app\Library\CrudPanel\Metrics\MetricComparison;
use Closure;
use Illuminate\Database\Eloquent\Builder;

class PreviousYear implements MetricComparison
{
    public function resolve(CrudMetric $metric, Builder $query, array $filters, float $currentValue): array
    {
        $from = $filters['date_from'] ?? null;
        $to = $filters['date_to'] ?? null;
        $periodColumn = $metric->getPeriodColumn($query);

        if (! $from || ! $to || ! $periodColumn) {
            return ['previous' => null, 'change' => null];
        }

        // Shift the date range back by one year.
        $previousFrom = date('Y-m-d', strtotime($from . ' -1 year'));
        $previousTo = date('Y-m-d', strtotime($to . ' -1 year'));

        $previousQuery = $query->getModel()->newQuery();
        if ($metric->query instanceof Closure) {
            $previousQuery = ($metric->query)($previousQuery) ?? $previousQuery;
        }

        $previousQuery->where($periodColumn, '>=', $previousFrom)
                       ->where($periodColumn, '<=', $previousTo);

        $previous = $metric->runAggregate($previousQuery);

        $change = $previous != 0
            ? round((($currentValue - $previous) / abs($previous)) * 100, 1)
            : ($currentValue != 0 ? 100.0 : 0.0);

        return [
            'previous' => $previous,
            'change'   => $change,
        ];
    }
}
```

Then use it:

```php
use App\Metrics\PreviousYear;

$this->addMetric('total_orders', [
    'type'    => 'stat',
    'label'   => 'Total Orders',
    'compare' => new PreviousYear(),
]);
```

<a name="grouping-metrics"></a>
## Grouping Metrics

By default, each metric fires its own AJAX request. If several metrics query the same table and you want to reduce requests, group them:

```php
$this->addMetric('total_orders', [
    'type' => 'stat',
    'aggregate' => 'count',
]);

$this->addMetric('avg_order_value', [
    'type' => 'stat',
    'column' => 'total',
    'aggregate' => 'avg',
    'format' => '$:value',
]);

$this->groupMetrics('order_stats', ['total_orders', 'avg_order_value']);
```

Grouped metrics are resolved in a single POST request. Each metric still runs its own query and aggregate, but the overhead of multiple HTTP roundtrips is avoided.

> **Note:** Grouping only affects the AJAX transport. Each metric still gets its own independent query — they don't share a database query.

<a name="wrapper-customization"></a>
## Wrapper / Layout

Each metric is wrapped in a `<div>` whose HTML attributes you can control via the `wrapper` option, just like you would with CRUD fields:

```php
$this->addMetric('big_chart', [
    'type'    => 'line',
    'label'   => 'Revenue',
    'wrapper' => ['class' => 'col-md-12'],  // full width
]);

$this->addMetric('small_stat', [
    'type'    => 'stat',
    'label'   => 'Users',
    'wrapper' => ['class' => 'col-md-3', 'style' => 'min-height: 120px;'],
]);
```

Default wrappers per metric type are defined in the [config file](#configuration).

<a name="filters"></a>
## Filters

The operation auto-injects two filters:
- `report_date_range` — a `date_range` filter for selecting the time window;
- `report_interval` — a `dropdown` filter for chart grouping (Daily, Weekly, Monthly, Yearly);

These filters are added **before** `setupReportOperation()` runs, so you can remove or override them:

```php
protected function setupReportOperation()
{
    // Remove the interval filter
    $this->crud->removeFilter('report_interval');

    // Replace the date range filter with a custom one
    $this->crud->removeFilter('report_date_range');
    $this->crud->addFilter([
        'name' => 'report_date_range',
        'type' => 'date_range',
        'label' => 'Period',
    ], false, function ($value) {
        // custom logic if needed
    });

    // ... add metrics
}
```

<a name="metrics-api"></a>
## Metrics API

All methods are available on the controller via the `ReportOperation` trait:

| Method | Description |
|--------|-------------|
| `$this->addMetric(string $name, array $config)` | Add a metric. |
| `$this->removeMetric(string $name)` | Remove a metric by name. |
| `$this->metric(string $name)` | Get a single `CrudMetric` instance. |
| `$this->metrics()` | Get all registered metrics as an associative array. |
| `$this->modifyMetric(string $name, array $config)` | Update properties of an existing metric. |
| `$this->groupMetrics(string $groupName, array $metricNames)` | Batch metrics into a single AJAX request. |

```php
// Modify an existing metric
$this->modifyMetric('total_orders', [
    'label' => 'All Orders',
    'wrapper' => ['class' => 'col-md-6'],
]);

// Remove a metric
$this->removeMetric('avg_order_value');
```

<a name="configuration"></a>
## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=backpack-report-config
```

This creates `config/backpack/operations/report.php`:

```php
return [
    // CSS class for the report content container.
    'contentClass' => 'col-md-12',

    // Default date column when no 'period' is specified on a metric.
    'defaultPeriodColumn' => 'created_at',

    // Default chart interval: day | week | month | year
    'defaultInterval' => 'day',

    // Default wrapper classes per metric type.
    'defaultWrappers' => [
        'stat'  => ['class' => 'col-md-3'],
        'line'  => ['class' => 'col-md-6'],
        'bar'   => ['class' => 'col-md-6'],
        'pie'   => ['class' => 'col-md-6'],
        'table' => ['class' => 'col-md-12'],
    ],

    // Chart library adapter. Only 'chartjs' is supported.
    'chartLibrary' => 'chartjs',
];
```

You can also override config values per-controller:

```php
protected function setupReportOperation()
{
    $this->crud->setOperationSetting('contentClass', 'col-md-10 mx-auto');

    // ... add metrics
}
```

<a name="overriding-views"></a>
## Overriding Views

You can override any of the report views by creating them in your `resources/views/vendor/backpack/crud/` folder:

| View | Purpose |
|------|---------|
| `report.blade.php` | Main report page layout |
| `metrics/stat.blade.php` | Stat card template |
| `metrics/line.blade.php` | Line chart card template |
| `metrics/inc/report_scripts.blade.php` | JavaScript for AJAX fetching and chart rendering |
| `buttons/report.blade.php` | Report button in the List operation |

<a name="full-example"></a>
## Full Example

```php
<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ReportOperation;

class OrderCrudController extends CrudController
{
    use ListOperation;
    use ReportOperation;

    protected function setupReportOperation()
    {
        // Stat cards
        $this->addMetric('total_orders', [
            'type'      => 'stat',
            'label'     => 'Total Orders',
            'aggregate' => 'count',
            'period'    => 'created_at',
            'compare'   => true,
            'wrapper'   => ['class' => 'col-md-4'],
        ]);

        $this->addMetric('total_revenue', [
            'type'      => 'stat',
            'label'     => 'Total Revenue',
            'column'    => 'total',
            'aggregate' => 'sum',
            'format'    => '$:value',
            'period'    => 'created_at',
            'compare'   => true,
            'wrapper'   => ['class' => 'col-md-4'],
        ]);

        $this->addMetric('avg_order', [
            'type'      => 'stat',
            'label'     => 'Avg Order Value',
            'column'    => 'total',
            'aggregate' => 'avg',
            'format'    => '$:value',
            'wrapper'   => ['class' => 'col-md-4'],
        ]);

        // Charts
        $this->addMetric('orders_over_time', [
            'type'      => 'line',
            'label'     => 'Orders Over Time',
            'aggregate' => 'count',
            'period'    => 'created_at',
        ]);

        $this->addMetric('revenue_over_time', [
            'type'      => 'bar',
            'label'     => 'Revenue Over Time',
            'column'    => 'total',
            'aggregate' => 'sum',
            'period'    => 'created_at',
        ]);

        // Group stat cards into one request
        $this->groupMetrics('stats', ['total_orders', 'total_revenue', 'avg_order']);
    }
}
```

<a name="troubleshooting"></a>
## Troubleshooting

**Chart spinner stays visible / chart doesn't render**
- Clear the basset cache: `php artisan basset:clear`, then hard-refresh the page.
- Open the browser console and check for JavaScript errors. If `Chart is not defined`, the Chart.js CDN failed to load — check your network or CSP settings.

**Stat shows "—" (dash)**
- The AJAX request failed. Open the browser console's Network tab to check for errors on the `metric-data` POST request. Common causes: invalid `column` name, missing `period` column, or a query error.

**Date range filter has no effect**
- Make sure the `period` option is set on your metric and points to a valid date/datetime column. Metrics without a `period` won't be filtered by date range.

**Previous period comparison shows 100% always**
- Comparison requires both `period` and `compare => true` (or a `MetricComparison` instance) on a `stat` metric. It also requires a date range to be selected — without a date range there's no "previous period" to compare against.

**All metrics show the same data across different CrudControllers**
- Clear the basset cache: `php artisan basset:clear`. The JS is cached via `@bassetBlock` and reads the data URL from the HTML, so this shouldn't happen after a cache clear.

**`DATE_FORMAT` errors on SQLite or PostgreSQL**
- The default time-series resolution uses MySQL's `DATE_FORMAT()`. For other databases, provide a custom `resolve` closure that uses the appropriate date functions.

**Filters not showing up**
- The report auto-injects filters during the `report:before_setup` lifecycle hook. If you've overridden that hook or removed filters in your `setupReportOperation()`, they won't appear. Check that you haven't accidentally called `removeAllFilters()`.
