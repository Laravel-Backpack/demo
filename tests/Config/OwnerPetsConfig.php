<?php

namespace Tests\Config;

class OwnerPetsConfig extends \Backpack\CRUD\app\Library\CrudTesting\TestConfigHelper
{
    /**
     * Define the route parameters for the controller.
     * These will be injected into the mocked route.
     *
     * @return array
     */
    public function getRouteParameters()
    {
        return [
            'owner' => 1, // Simulates ?owner=1 or /owner/1
        ];
    }

    public function validCreateInput($model)
    {
        $pet = parent::validCreateInput($model);
        $pet['avatar']['url'] = 'https://placekitten.com/300/300';
        $pet['owners'] = [
            [
                'owner_id' => 1,
                'role'     => 'Owner',
            ],
        ];

        return $pet;
    }

    public function validUpdateInput($model)
    {
        $pet = parent::validUpdateInput($model);
        $pet['avatar']['url'] = 'https://placekitten.com/400/400';
        $pet['owners'] = [
            [
                'owner_id' => 1,
                'role'     => 'Owner',
            ],
        ];

        return $pet;
    }

    public static function createTestEntry(string $model, array $attributes = [])
    {
        $pet = parent::createTestEntry($model, $attributes);
        // Ensure the pet is linked to owner 1
        $pet->owners()->attach(1, ['role' => 'Owner']);

        return $pet;
    }
}
