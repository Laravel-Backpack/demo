<?php

namespace Tests\Config;

class UserConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    public function validCreateInput($model)
    {
        $user = parent::validCreateInput($model);
        return array_merge($user, ['password_confirmation' => $user['password']]);
    }

    public function validUpdateInput($model)
    {
        $user = parent::validUpdateInput($model);
        return array_merge($user, ['password_confirmation' => $user['password']]);
    }
    
    public static function getDatabaseAssertInput(string $model, array $input = []): array
    {
        $database = parent::getDatabaseAssertInput($model, $input);

        unset($database['password']);
        unset($database['password_confirmation']);

        return $database;
    }
}
