<?php

namespace App\Models\PetShop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'series',
        'number',
        'issuance_date',
        'due_date',
    ];

    protected $casts = [
        'id'            => 'integer',
        'owner_id'      => 'integer',
        'issuance_date' => 'date',
        'due_date'      => 'date',
    ];

    protected $appends = [
        'total',
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

    public function owner()
    {
        return $this->belongsTo(\App\Models\PetShop\Owner::class, 'owner_id');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\PetShop\InvoiceItem::class);
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

    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
