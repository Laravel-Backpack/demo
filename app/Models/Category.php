<?php

namespace App\Models;

use Backpack\NewsCRUD\app\Models\Category as OriginalCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends OriginalCategory
{
    use HasFactory;
    use \Backpack\ActivityLog\Traits\LogsActivity;
}
