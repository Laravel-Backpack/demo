@php
    $users = \App\User::inRandomOrder()->take(6)->get();
    $invoices = \App\Models\PetShop\Invoice::inRandomOrder()->take(6)->get();
    $products = \App\Models\Product::inRandomOrder()->take(6)->get();
    $owners = \App\Models\PetShop\Owner::inRandomOrder()->take(6)->get();
@endphp

<div class="row">

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with hardcoded complete data --}}
                @include('crud::chips.general', [
                    'text' => 'John Doe',
                    'title' => 'Example of a chip without URL',
                    'url' => 'https://google.com',
                    'target' => '_blank',
                    'image' => asset('uploads/person1.jpg'),
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'text' => '8AH13A7',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'text' => 'john.doe@example.com',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-phone',
                            'text' => '+1 (555) 123-4567',
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

                {{-- Example of General chip for a person, with hardcoded data, missing URL --}}
                @include('crud::chips.general', [
                    'text' => 'Adam Mancinello',
                    'title' => 'Example of a chip without URL',
                    // 'url' => '#',
                    'showImage' => true,
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'text' => '8AH13A7',
                            'url' => 'mailto:adam.mancinello@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'text' => 'adam.mancinello@example.com',
                            'url' => 'mailto:adam.mancinello@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-phone',
                            'text' => '+1 (555) 123-4567',
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

                {{-- Example of General chip for a person, with hardcoded data, missing image --}}
                @include('crud::chips.general', [
                    'text' => 'John Doe',
                    'title' => 'Example of a chip without an image',
                    'url' => 'https://example.com',
                    'showImage' => false,
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'text' => '8AH13A7',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'text' => 'john.doe@example.com',
                            'url' => 'mailto:john.doe@example.com',
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-phone',
                            'text' => '+1 (555) 123-4567',
                            'url' => 'tel:+15551234567',
                            'title' => 'Click to call',
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

</div>

<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">Works well to show off people - eg. Users, Customers:</p>
    </div>
</div>

<div class="row">

    @foreach ($users as $user)

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.general', [
                    'text' => $user->name,
                    'url' => backpack_url('user/'.$user->id.'/show'),
                    'showImage' => false,
                    // 'image' => backpack_avatar_url($user), // doesn't work well with dummy data
                    'details' => [
                        [
                            'icon' => 'la la-hashtag',
                            'text' => $user->id,
                            'url' => backpack_url('user/'.$user->id.'/show'),
                            'title' => 'Click to preview',
                        ],
                        [
                            'icon' => 'la la-envelope',
                            'text' => $user->email,
                            'url' => 'mailto:'.$user->email,
                            'title' => 'Click to email',
                        ],
                        [
                            'icon' => 'la la-calendar',
                            'text' => $user->created_at->format('F j, Y'),
                            'title' => 'Created at '.$user->created_at,
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

    @endforeach
</div>

<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">In this demo, the most obvious example is pet owners:</p>
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
        <p class="mt-2 mb-2">But it works particularly well for entities where the name alone can't identify an entity, eg. Invoice:</p>
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

<div class="row">

    @foreach ($products as $product)

    <div class="col-md-4">

        <div class="card mb-2">
            <div class="card-body">

                {{-- Example of General chip for a person, with data from Eloquent model --}}
                @include('crud::chips.general', [
                    'text' => $product->name,
                    'url' => backpack_url('product/'.$product->id.'/show'),
                    // 'showImage' => false,
                    'details' => [
                        [
                            'icon' => 'la la-dollar',
                            'text' => $product->price,
                            'title' => 'Priced at $'.$product->price,
                        ],
                        [
                            'icon' => 'la la-tag',
                            'text' => $product->category->name,
                            'url' => backpack_url('category/'.$product->category->id.'/show'),
                            'title' => 'Product category: '.$product->category->name,
                        ],
                        [
                            'icon' => 'la la-tag',
                            'text' => $product->status,
                            'title' => 'Product status: '.$product->status->value,
                        ],
                        [
                            'icon' => 'la la-traffic-light',
                            'text' => $product->condition,
                            'title' => 'Production condition: '.$product->condition,
                        ]
                    ]
                ])

            </div>
        </div>

    </div>

    @endforeach
</div>

<div class="row">
    <div class="col">
        <p class="mt-2 mb-2">
            The beauty of chips is that they are simple blade files, so you can create your own chips for any entity you want.
            You can even use them in your own widgets, in your own custom views or... in your datatables! <a href="{{ backpack_url('pet-shop/invoice') }}">Check out the Invoice datatable</a> to see how we use chips in the List operation, and <a href="{{ backpack_url('pet-shop/invoice/1/show') }}">an Invoice item</a> to see how we use chips inside a Show operation (using the chip widget).
        </p>
    </div>
</div>
