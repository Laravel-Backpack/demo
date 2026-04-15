{{-- Example "view" metric: a custom table rendered server-side --}}
@php
    $products = $query->clone()
        ->orderByDesc('price')
        ->limit(5)
        ->get(['name', 'price', 'status']);
@endphp

<table class="table table-sm table-striped mb-0">
    <thead>
        <tr>
            <th>Product</th>
            <th class="text-end">Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td class="text-end">${{ number_format($product->price, 2) }}</td>
                <td>
                    <span class="badge bg-{{ $product->status === 'in-stock' ? 'success' : ($product->status === 'out-of-stock' ? 'danger' : 'warning') }}">
                        {{ $product->status }}
                    </span>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="text-secondary text-center">No products found</td></tr>
        @endforelse
    </tbody>
</table>
