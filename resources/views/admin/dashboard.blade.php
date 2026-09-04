{{--
    The Pet Shop dashboard: what a real admin panel's first screen looks like.
    All numbers come from App\View\Composers\DashboardComposer.
    The revenue chart is a Backpack "chart" widget (App\Http\Controllers\Admin\Charts\RevenueChartController).
--}}
@extends(backpack_view('blank'))

@php
    // Widget::make() (not add) so the chart is rendered only where we place it.
    $revenueChart = Widget::make([
        'type'         => 'chart',
        'wrapperClass' => 'col-lg-8',
        'controller'   => \App\Http\Controllers\Admin\Charts\RevenueChartController::class,
        'content'      => [
            'header' => 'Revenue, last 12 months',
        ],
    ]);

    $money = fn ($amount) => '$'.number_format($amount, 0);
@endphp

@section('header')
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">Pet Shop</div>
                <h2 class="page-title">Dashboard</h2>
            </div>
            <div class="col-auto ms-auto d-print-none">
                <a href="{{ backpack_url('pet-shop/invoice/create') }}" class="btn btn-primary">
                    <i class="la la-plus me-1"></i> New invoice
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')

    {{-- A friendly reminder that this is a shared playground --}}
    <div class="alert alert-warning alert-dismissible mt-3 mb-3" role="alert">
        <div class="d-flex align-items-center">
            <span class="avatar bg-yellow-lt me-3 flex-shrink-0"><i class="la la-hourglass-half fs-2"></i></span>
            <div>
                <h4 class="alert-title mb-0">This demo resets every hour</h4>
                <div class="text-secondary">At hh:00 every entry is deleted and re-seeded. Go ahead: add, edit, break things.</div>
            </div>
        </div>
        <a class="btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
    </div>

    {{-- KPIs --}}
    <div class="row row-deck row-cards g-3 mb-3">
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Revenue, last 30 days</div>
                    <div class="d-flex align-items-baseline mt-1">
                        <div class="h1 mb-0 me-2">{{ $money($revenue30) }}</div>
                        @include('admin.partials.dashboard_change', ['change' => $revenueChange])
                    </div>
                    <div class="text-secondary small mt-1">vs. the previous 30 days</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Invoices, last 30 days</div>
                    <div class="d-flex align-items-baseline mt-1">
                        <div class="h1 mb-0 me-2">{{ number_format($invoices30) }}</div>
                        @include('admin.partials.dashboard_change', ['change' => $invoicesChange])
                    </div>
                    <div class="text-secondary small mt-1">{{ $dueThisWeek }} due this week</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Pets</div>
                    <div class="h1 mb-0 mt-1">{{ number_format($petsCount) }}</div>
                    <div class="text-secondary small mt-1">{{ $speciesCount }} species</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="subheader">Owners</div>
                    <div class="h1 mb-0 mt-1">{{ number_format($ownersCount) }}</div>
                    <div class="text-secondary small mt-1">{{ $ownersWithInvoices30 }} invoiced this month</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue chart + top services --}}
    <div class="row row-deck row-cards g-3 mb-3">
        @include(backpack_view('inc.widgets'), ['widgets' => [$revenueChart]])

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Top services, last 90 days</h3>
                </div>
                <div class="card-body">
                    @forelse($topServices as $service)
                        <div class="{{ $loop->last ? '' : 'mb-3' }}">
                            <div class="d-flex mb-1">
                                <div class="text-truncate">{{ $service->description }}</div>
                                <div class="ms-auto ps-2 fw-medium">{{ $money($service->revenue) }}</div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar" style="width: {{ $service->share }}%" role="progressbar" aria-valuenow="{{ $service->share }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @empty
                        <div class="text-secondary">No invoices in the last 90 days.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Recent invoices + new pets --}}
    <div class="row row-deck row-cards g-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent invoices</h3>
                    <div class="card-actions">
                        <a href="{{ backpack_url('pet-shop/invoice') }}" class="btn btn-sm">View all</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Owner</th>
                                <th>Issued</th>
                                <th>Due</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentInvoices as $invoice)
                                @php
                                    $due = $invoice->due_date;
                                    $dueSoon = $due && $due->between(today(), today()->addDays(7));
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ backpack_url('pet-shop/invoice/'.$invoice->id.'/show') }}" class="fw-medium">{{ $invoice->series }} {{ $invoice->number }}</a>
                                        <div class="text-secondary small">{{ $invoice->items->count() }} {{ Str::plural('item', $invoice->items->count()) }}</div>
                                    </td>
                                    <td>{{ $invoice->owner?->name ?? '-' }}</td>
                                    <td class="text-secondary">{{ $invoice->issuance_date?->format('j M Y') }}</td>
                                    <td class="text-secondary">
                                        {{ $due?->format('j M Y') ?? '-' }}
                                        @if($dueSoon)<span class="badge bg-yellow-lt ms-1">Due soon</span>@endif
                                    </td>
                                    <td class="text-end fw-medium">{{ '$'.number_format($invoice->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New pets</h3>
                    <div class="card-actions">
                        <a href="{{ backpack_url('pet-shop/pet') }}" class="btn btn-sm">View all</a>
                    </div>
                </div>
                <div class="list-group list-group-flush">
                    @foreach($newPets as $pet)
                        <a href="{{ backpack_url('pet-shop/pet/'.$pet->id.'/show') }}" class="list-group-item list-group-item-action">
                            <div class="row align-items-center g-2">
                                <div class="col-auto">
                                    @if($pet->avatar?->url)
                                        <span class="avatar" style="background-image: url({{ asset($pet->avatar->url) }})"></span>
                                    @else
                                        <span class="avatar">{{ Str::substr($pet->nickname, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="col text-truncate">
                                    <div class="fw-medium">{{ $pet->nickname }}</div>
                                    <div class="text-secondary small text-truncate">
                                        {{ $pet->passport?->species ?? 'Unknown species' }}{{ $pet->passport?->breed ? ', '.$pet->passport->breed : '' }}
                                        @if($pet->owners->isNotEmpty()) &middot; {{ $pet->owners->first()->name }} @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
