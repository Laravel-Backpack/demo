@include('crud::chips.general', [
    'text' => 'Invoice '.$entry->series.' '.$entry->number.' - '.$entry->owner->name,
    'url' => backpack_url('pet-shop/invoice/'.$entry->id.'/show'),
    // 'showImage' => false,
    'details' => [
        [
            'icon' => 'la la-dollar',
            'text' => $entry->total,
            'title' => 'Total invoice amount $'.$entry->total,
        ],
        [
            'icon' => 'la la-tags',
            'text' => $entry->items->count().' items',
        ],
        [
            'icon' => 'la la-calendar',
            'text' => $entry->issuance_date->format('F j, Y'),
            'title' => 'Issuance date: '.$entry->issuance_date,
        ]
    ]
])
