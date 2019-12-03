<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\InheritsRelationsFromParentModel;

class Creator extends BackpackUser
{
    use InheritsRelationsFromParentModel;
    use CrudTrait;

    protected $table = 'users';

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
   
    public function snippets()
    {
        return $this->hasMany('App\Models\Snippet', 'created_by');
    }
}
