<?php

namespace App\Models;

use Backpack\NewsCRUD\app\Models\Tag as OriginalTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends OriginalTag
{
    use HasFactory;
    use \App\Models\Traits\LogsActivity;
}
