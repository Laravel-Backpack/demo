<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Address extends Model
{
    use CrudTrait;
    use LogsActivity;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'addresses';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['monster_id', 'street', 'country_id'];

    public function monster()
    {
        return $this->belongsTo(\App\Models\Monster::class, 'monster_id');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }
}
