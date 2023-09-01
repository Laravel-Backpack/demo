<?php

namespace App\Models;

use App\Models\Traits\LogsActivity;
use Backpack\MenuCRUD\app\Models\MenuItem as OriginalMenuItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends OriginalMenuItem
{
    use HasFactory;
    use LogsActivity;

    public static $pageLink = 'page_link';
    public static $externalLink = 'external_link';
    public static $internalLink = 'internal_link';
}
