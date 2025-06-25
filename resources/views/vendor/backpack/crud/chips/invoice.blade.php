@include('crud::chips.general', [
    'heading' => [
        'content' => 'Invoice '.$entry->series.' '.$entry->number.' - '.$entry->owner->name,
        'href' => backpack_url('pet-shop/invoice/'.$entry->id.'/show'),
    ],
    'details' => [
        [
            'icon' => 'la la-dollar',
            'content' => $entry->total,
            'title' => 'Total invoice amount $'.$entry->total,
        ],
        [
            'icon' => 'la la-tags',
            'content' => $entry->items->count().' items',
        ],
        [
            'icon' => 'la la-calendar',
            'content' => $entry->issuance_date->format('F j, Y'),
            'title' => 'Issuance date: '.$entry->issuance_date,
        ]
    ]
])
