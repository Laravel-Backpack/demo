<?php

namespace Tests\Config;

class OwnerConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function getRouteParameters()
    {
        return [
            'id' => 1,
        ];
    }

    public function validCreateInput($model)
    {
        $owner = parent::validCreateInput($model);
        $owner['avatar']['url'] = 'https://placekitten.com/300/300';

        return $owner;
    }
}
