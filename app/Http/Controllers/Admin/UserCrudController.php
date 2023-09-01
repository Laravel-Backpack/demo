<?php

namespace App\Http\Controllers\Admin;

use Backpack\ActivityLog\Models\ActivityLog;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as OriginalUserCrudController;

class UserCrudController extends OriginalUserCrudController
{
    use \Backpack\ActivityLog\Http\Controllers\Operations\ModelActivityOperation;
    use \Backpack\ActivityLog\Http\Controllers\Operations\EntryActivityOperation;

    public function setupListOperation()
    {
        CRUD::set('activity-log.options', ActivityLog::CAUSER);

        parent::setupListOperation();
    }
}
