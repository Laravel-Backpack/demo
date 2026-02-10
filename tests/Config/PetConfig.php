<?php

namespace Tests\Config;

class PetConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function validCreateInput($model)
    {
        $pet = parent::validCreateInput($model);
        $pet['avatar']['url'] = 'https://placekitten.com/300/300';
        return $pet;
    }

    public function validUpdateInput($model)
    {
        $pet = parent::validUpdateInput($model);
        $pet['avatar']['url'] = 'https://placekitten.com/400/400';
        return $pet;
    }

    public static function createTestEntry(string $model, array $attributes = [])
    {
        $pet = parent::createTestEntry($model, $attributes);
        $pet->avatar()->create([
            'url' => 'https://placekitten.com/350/350',
        ]);
        return $pet;
    }
}
