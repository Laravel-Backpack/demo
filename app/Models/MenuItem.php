<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backpack\MenuCRUD\app\Models\MenuItem as OriginalMenuItem;

class MenuItem extends OriginalMenuItem
{
    use HasFactory;
    use LogsActivity;

    public static $pageLink = 'page_link';
    public static $externalLink = 'external_link';
    public static $internalLink = 'internal_link';
}
