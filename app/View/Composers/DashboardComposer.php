<?php

namespace App\View\Composers;

use App\Models\PetShop\Invoice;
use App\Models\PetShop\InvoiceItem;
use App\Models\PetShop\Owner;
use App\Models\PetShop\Passport;
use App\Models\PetShop\Pet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Gathers the Pet Shop numbers shown on the demo dashboard.
 *
 * Registered in AppServiceProvider for the 'admin.dashboard' view, so the
 * view itself stays free of queries.
 */
class DashboardComposer
{
    public function compose(View $view): void
    {
        $today = Carbon::today();
        $last30Start = $today->copy()->subDays(29);
        $previous30Start = $last30Start->copy()->subDays(30);
        $previous30End = $last30Start->copy()->subDay();

        $revenue30 = $this->revenueBetween($last30Start, $today);
        $revenuePrevious30 = $this->revenueBetween($previous30Start, $previous30End);

        $invoices30 = Invoice::whereBetween('issuance_date', [$last30Start, $today])->count();
        $invoicesPrevious30 = Invoice::whereBetween('issuance_date', [$previous30Start, $previous30End])->count();

        $view->with([
            'revenue30'            => $revenue30,
            'revenueChange'        => $this->percentChange($revenue30, $revenuePrevious30),
            'invoices30'           => $invoices30,
            'invoicesChange'       => $this->percentChange($invoices30, $invoicesPrevious30),
            'dueThisWeek'          => Invoice::whereBetween('due_date', [$today, $today->copy()->addDays(7)])->count(),
            'overdue'              => Invoice::whereDate('due_date', '<', $today)->whereDate('issuance_date', '>=', $today->copy()->subDays(60))->count(),
            'petsCount'            => Pet::count(),
            'speciesCount'         => Passport::distinct('species')->count('species'),
            'ownersCount'          => Owner::count(),
            'ownersWithInvoices30' => Invoice::whereBetween('issuance_date', [$last30Start, $today])->distinct('owner_id')->count('owner_id'),
            'recentInvoices'       => Invoice::with(['owner', 'items'])->orderByDesc('issuance_date')->orderByDesc('id')->limit(8)->get(),
            'topServices'          => $this->topServices($today->copy()->subDays(90), $today),
            'newPets'              => Pet::with(['passport', 'avatar', 'owners'])->latest('id')->limit(5)->get(),
        ]);
    }

    private function revenueBetween(Carbon $from, Carbon $to): float
    {
        return (float) InvoiceItem::query()
            ->join('invoices', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->whereNull('invoices.deleted_at')
            ->whereBetween('invoices.issuance_date', [$from->toDateString(), $to->toDateString()])
            ->sum(DB::raw('invoice_items.quantity * invoice_items.unit_price'));
    }

    private function topServices(Carbon $from, Carbon $to)
    {
        $services = InvoiceItem::query()
            ->join('invoices', 'invoices.id', '=', 'invoice_items.invoice_id')
            ->whereNull('invoices.deleted_at')
            ->whereBetween('invoices.issuance_date', [$from->toDateString(), $to->toDateString()])
            ->groupBy('invoice_items.description')
            ->select('invoice_items.description', DB::raw('SUM(invoice_items.quantity * invoice_items.unit_price) as revenue'), DB::raw('COUNT(*) as times_sold'))
            ->orderByDesc('revenue')
            ->limit(6)
            ->get();

        $max = (float) ($services->max('revenue') ?: 1);

        return $services->map(function ($service) use ($max) {
            $service->share = round($service->revenue / $max * 100);

            return $service;
        });
    }

    private function percentChange(float $current, float $previous): ?float
    {
        if ($previous == 0.0) {
            return null;
        }

        return round(($current - $previous) / $previous * 100, 1);
    }
}
