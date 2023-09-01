<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Backpack\NewsCRUD\app\Models\Tag as OriginalTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends OriginalTag
{
    use HasFactory;
    use LogsActivity;
}
