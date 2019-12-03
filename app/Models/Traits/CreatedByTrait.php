<?php

namespace App\Models\Traits;

trait CreatedByTrait
{
    /**
     * Stores the user id at each create & update.
     */
    public function save(array $options = [])
    {
        $user = backpack_auth()->check() ? backpack_auth()->user() : (\Auth::check() ? \Auth::user() : false);

        if ($user) {
            $this->created_by = $this->created_by ?? $user->id;
            $this->updated_by = $user->id;
        }

        parent::save();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo('App\User', 'updated_by');
    }
}
