<?php

namespace Tests\Config;

class PassportConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function validCreateInput($model)
    {
        $passport = parent::validCreateInput($model);
        $passport['pet'] = 1;
        return $passport;
    }

    public static function createTestEntry(string $model, array $attributes = [])
    {
        $passport = parent::createTestEntry($model, $attributes);
        $passport->pet()->associate(1);
        $passport->save();
        return $passport;
    }
}
