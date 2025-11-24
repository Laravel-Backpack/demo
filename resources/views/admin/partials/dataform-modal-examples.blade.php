<div class="row">
    <div class="col-md-12">
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">
                    Quickly Add/Edit Invoices

                    <span class="card-subtitle">Showing latest invoices in a custom table, with buttons to create or edit an invoice in a modal form.</span>
            </div>
            <div class="card-body">

                @php
                    $newestInvoices = \App\Models\Petshop\Invoice::orderBy('updated_at')->take(5)->get();
                @endphp

                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="w-1">Actions</th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($newestInvoices as $invoice)
                            <tr>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_invoice_{{ $invoice->id }}" bp-button="create">Edit</a>

                                    <x-bp-dataform-modal
                                        formId="edit_invoice_{{ $invoice->id }}"
                                        :controller="\App\Http\Controllers\Admin\PetShop\InvoiceCrudController::class"
                                        formOperation="updateInModal"
                                        :entry="\App\Models\PetShop\Invoice::find($invoice->id)"
                                    />

                                </td>
                                <td>
                                    <a href="{{ url('admin/pet-shop/invoice/'.$invoice->id.'/show') }}">
                                    {{ $invoice->series.' '.$invoice->number }}
                                    </a>
                                </td>
                                <td>{{ $invoice->owner->name }}</td>
                                <td>${{ number_format($invoice->total, 0) }}</td>
                                <td class="text-secondary">{{ $invoice->created_at->diffForHumans() }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <p class="mt-3">
                    Didn't find what you're looking for?

                    <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#create_invoice">
                        <span>Create a new invoice</span>
                    </a>
                </p>

                <x-bp-dataform-modal
                    formId="create_invoice"
                    :controller='\App\Http\Controllers\Admin\PetShop\InvoiceCrudController::class'
                    :formInsideCard="false"
                />

            </div>
        </div>
    </div>
</div>
