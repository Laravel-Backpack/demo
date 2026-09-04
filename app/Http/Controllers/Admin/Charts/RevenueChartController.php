<?php

namespace App\Http\Controllers\Admin\Charts;

use App\Models\PetShop\InvoiceItem;
use Backpack\CRUD\app\Http\Controllers\ChartController;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Pet Shop revenue, per month, for the last 12 months.
 */
class RevenueChartController extends ChartController
{
    public function setup()
    {
        $this->chart = new Chart();

        $this->chart->labels($this->months()->map(fn (Carbon $month) => $month->format('M'))->all());
        $this->chart->load(backpack_url('charts/revenue'));
        $this->chart->minimalist(false);
        $this->chart->displayLegend(false);
    }

    /**
     * Respond to AJAX calls with all the chart data points.
     *
     * @return json
     */
    public function data()
    {
        $start = $this->months()->first();

        // One row per day, summed in the database; grouped per month in PHP so
        // the query stays portable across MySQL, SQLite and Postgres.
        $perDay = InvoiceItem::query()
            ->join('invoices', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.issuance_date', '>=', $start->toDateString())
            ->groupBy('invoices.issuance_date')
            ->select('invoices.issuance_date', DB::raw('SUM(invoice_items.quantity * invoice_items.unit_price) as revenue'))
            ->get();

        $perMonth = $perDay->groupBy(fn ($row) => Carbon::parse($row->issuance_date)->format('Y-m'))
            ->map(fn (Collection $rows) => round($rows->sum('revenue'), 2));

        $this->chart->dataset('Revenue', 'bar', $this->months()->map(fn (Carbon $month) => $perMonth[$month->format('Y-m')] ?? 0)->all())
            ->color('rgba(124, 105, 239, 1)')
            ->backgroundColor('rgba(124, 105, 239, 0.35)');
    }

    /**
     * The first day of each of the last 12 months, oldest first.
     */
    private function months(): Collection
    {
        return collect(range(11, 0))->map(fn (int $i) => now()->startOfMonth()->subMonths($i));
    }
}
