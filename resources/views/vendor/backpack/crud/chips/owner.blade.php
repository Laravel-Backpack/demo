@php
    $last_purchase = $entry->invoices()->orderBy('issuance_date', 'DESC')->first()->issuance_date;
@endphp

@include('crud::chips.general', [
    'heading' => [
        'content' => $entry->name,
        'href' => backpack_url('pet-shop/owner/'.$entry->id.'/show'),
    ],
    'image' => [
        'content' => asset($entry->avatar->url),
    ],
    'details' => [
        [
            'icon' => 'la la-dog',
            'content' => $entry->pets->count().' pets',
            'title' => 'Number of pets: '.$entry->pets->count(),
        ],
        [
            'icon' => 'la la-shopping-cart',
            'content' => $entry->invoices->count(). ' purchases',
            'title' => 'Number of purchases: '.$entry->invoices->count(),
        ],
        [
            'icon' => 'la la-calendar',
            'content' => $last_purchase->format('F j, Y'),
            'title' => 'Last purchase: '.$last_purchase,
        ]
    ]
])
