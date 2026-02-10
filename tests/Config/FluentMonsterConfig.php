<?php

namespace Tests\Config;

class FluentMonsterConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function validCreateInput($model)
    {
        return parent::validCreateInput($model);
    }

    public function validUpdateInput($model)
    {
        return parent::validUpdateInput($model);
    }

    public static function createTestEntry(string $model, array $attributes = [])
    {
        return parent::createTestEntry($model, $attributes);
    }
}
