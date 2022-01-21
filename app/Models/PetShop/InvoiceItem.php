<?php

namespace App\Models\PetShop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'order',
        'description',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'id'         => 'integer',
        'invoice_id' => 'integer',
        'quantity'   => 'float',
        'unit_price' => 'float',
    ];

    protected $appends = [
        'subtotal',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function invoice()
    {
        return $this->belongsTo(\App\Models\PetShop\Invoice::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
