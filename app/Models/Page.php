<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Backpack\PageManager\app\Models\Page as OriginalPage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends OriginalPage
{
    use HasFactory;
    use LogsActivity;
}
