{{-- @dump($entry) --}}

@php
    $last_purchase = $entry->invoices()->orderBy('issuance_date', 'DESC')->first()->issuance_date;
@endphp

@include('crud::chips.general', [
    'text' => $entry->name,
    'url' => backpack_url('pet-shop/owner/'.$entry->id.'/show'),
    'image' => asset($entry->avatar->url),
    // 'showImage' => false,
    'details' => [
        [
            'icon' => 'la la-dog',
            'text' => $entry->pets->count().' pets',
            'title' => 'Number of pets: '.$entry->pets->count(),
        ],
        [
            'icon' => 'la la-shopping-cart',
            'text' => $entry->invoices->count(). ' purchases',
            'title' => 'Number of purchases: '.$entry->invoices->count(),
        ],
        [
            'icon' => 'la la-calendar',
            'text' => $last_purchase->format('F j, Y'),
            'title' => 'Last purchase: '.$last_purchase,
        ]
    ]
])
