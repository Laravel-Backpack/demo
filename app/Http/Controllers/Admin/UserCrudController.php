<?php

namespace App\Http\Controllers\Admin;

use Backpack\ActivityLog\Http\Controllers\Operations\ShowCauserEntryActivityLogsOperation;
use Backpack\ActivityLog\Http\Controllers\Operations\ShowCauserModelActivityLogsOperation;
use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as OriginalUserCrudController;

class UserCrudController extends OriginalUserCrudController
{
    use ShowCauserModelActivityLogsOperation;
    use ShowCauserEntryActivityLogsOperation;
}
