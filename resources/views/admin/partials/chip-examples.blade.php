@php
    $user = \App\User::inRandomOrder()->first();
    $invoices = \App\Models\PetShop\Invoice::inRandomOrder()->take(3)->get();
    $products = \App\Models\Product::inRandomOrder()->take(3)->get();
    $owners = \App\Models\PetShop\Owner::inRandomOrder()->take(3)->get();
@endphp

<div class="row">

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with hardcoded complete data --}}
                @include('crud::chips.general', [
                    'heading' => [
                        'content' => 'John Doe',
                        'href' => 'https://google.com',
                        'target' => '_blank',
                        'title' => 'Example of a chip without URL',
                    ],
                    'image' => [
                        'content' => asset('uploads/person1.jpg'),
                        'element' => 'a',
                        'href' => 'https://chatgpt.com',
                        'target' => '_blank',
                        'title' => 'Image can have its own URL, but why?! Falls back to the one in the heading',
                    ],
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'content' => '8AH13A7',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'content' => 'john.doe@example.com',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-phone',
                            'content' => '+1 (555) 123-4567',
                            'url' => 'tel:+15551234567',
                            'title' => 'Click to call',
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with hardcoded data, missing URL and image --}}
                @include('crud::chips.general', [
                    'heading' => [
                        'content' => 'Adam Mancinello',
                        'title' => 'Example of a chip without URL or image',
                        'element' => 'span', // can be a span, a div, or an anchor
                    ],
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'content' => '8AH13A7',
                            'url' => 'mailto:adam.mancinello@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'content' => 'adam.mancinello@example.com',
                            'url' => 'mailto:adam.mancinello@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-phone',
                            'content' => '+1 (555) 123-4567',
                            'url' => 'tel:+15551234567',
                            'title' => 'Click to call',
                        ]
                    ]
                ])

            </div>
        </div>

    </div>


    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.general', [
                    'heading' => [
                        'content' => $user->name,
                        'href' => backpack_url('user/'.$user->id.'/show'),
                        'title' => 'Click to preview',
                    ],
                    'image' => [
                        'content' => backpack_avatar_url($user), // doesn't work well with dummy data
                        'element' => 'a',
                        'href' => backpack_url('user/'.$user->id.'/show'),
                        'title' => 'Because of dummy data, this image is not available, but it would show a profile image',
                    ],
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'content' => $user->id,
                            'url' => backpack_url('user/'.$user->id.'/show'),
                            'title' => 'Click to preview',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'content' => $user->email,
                            'url' => 'mailto:'.$user->email,
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-calendar',
                            'content' => $user->created_at->format('F j, Y'),
                            'title' => 'Created at '.$user->created_at,
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">Works well for people - in this demo, the most obvious example is pet owners:</p>
    </div>
</div>

<div class="row">

    @foreach ($owners as $owner)

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.owner', ['entry' => $owner])

            </div>
        </div>

    </div>

    @endforeach
</div>

<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">But it's particularly useful for entities where the name alone can't identify an entity, eg. Invoice:</p>
    </div>
</div>


<div class="row">

    @foreach ($invoices as $invoice)

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.invoice', ['entry' => $invoice])

            </div>
        </div>

    </div>

    @endforeach
</div>


<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">Or entities that can sometimes have duplicated names, like Products:</p>
    </div>
</div>

<div class="row mb-4">

    @foreach ($products as $product)

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.general', [
                    'heading' => [
                        'content' => $product->name,
                        'href' => backpack_url('product/'.$product->id.'/show'),
                        'title' => 'Click to preview',
                    ],
                    'details' => [
                        [
                            'icon' => 'la la-dollar',
                            'content' => $product->price,
                            'title' => 'Priced at $'.$product->price,
                        ],
                        [
                            'icon' => 'la la-tag',
                            'content' => $product->category->name,
                            'url' => backpack_url('category/'.$product->category->id.'/show'),
                            'title' => 'Product category: '.$product->category->name,
                        ],
                        [
                            'icon' => 'la la-tag',
                            'content' => $product->status,
                            'title' => 'Product status: '.$product->status->value,
                        ],
                        [
                            'icon' => 'la la-traffic-light',
                            'content' => $product->condition,
                            'title' => 'Production condition: '.$product->condition,
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

    @endforeach
</div>
