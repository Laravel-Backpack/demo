<?php

namespace Tests\Config;

class MonsterConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function validCreateInput($model)
    {
        return array_merge(parent::validCreateInput($model), ['icondummy' => 1]);
    }

    public function validUpdateInput($model)
    {
        return array_merge(parent::validCreateInput($model), ['icondummy' => 1]);
    }

    public static function createTestEntry(string $model, array $attributes = [])
    {
        return parent::createTestEntry($model, $attributes);
    }

    public static function getDatabaseAssertInput(string $model, array $input = []): array
    {
        $input = parent::getDatabaseAssertInput($model, $input);
        $input['belongs_to_non_nullable'] = 1;

        return $input;
    }
}
