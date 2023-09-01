<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function monsters()
    {
        return $this->hasMany(\App\Models\Monster::class);
    }

    public function heroes()
    {
        return $this->belongsToMany(\App\Models\Hero::class, 'monsters')
                    ->withPivot(array_filter((new \App\Models\Monster())->getFillable(), function ($item) {
                        // fields that are on fillable but are not part of model table
                        $columnsToRemove = ['fake-text', 'fake-switch', 'fake-select', 'fake-checkbox', 'editable_checkbox'];

                        return !in_array($item, $columnsToRemove);
                    }));
    }
}
