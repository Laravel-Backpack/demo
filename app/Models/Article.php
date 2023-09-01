<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Backpack\NewsCRUD\app\Models\Article as OriginalArticle;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends OriginalArticle
{
    use HasFactory;
    use LogsActivity;
}
