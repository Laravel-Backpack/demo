<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\NewsCRUD\app\Models\Category as OriginalCategory;

class Category extends OriginalCategory
{
    use HasFactory;
    use LogsActivity;
}
