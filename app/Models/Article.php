<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\NewsCRUD\app\Models\Article as OriginalArticle;

class Article extends OriginalArticle
{
    use HasFactory;
    use LogsActivity;
}
