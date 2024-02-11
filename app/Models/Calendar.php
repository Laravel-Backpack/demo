<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'calendar';

    protected $fillable = [
        'title',
        'start',
        'end',
        'background_color',
        'text_color',
    ];
}
