<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\PageManager\app\Models\Page as OriginalPage;

class Page extends OriginalPage
{
    use HasFactory;
    use LogsActivity;
}
