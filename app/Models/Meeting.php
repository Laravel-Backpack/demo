<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'email',
        'number',
        'start',
        'end',
        'background_color',
        'text_color',
    ];
}
