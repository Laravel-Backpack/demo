<?php

namespace App\Library;

class Elfinder
{
    public static function checkAccess($attr, $path, $data, $volume)
    {
        // on production / staging environments disable writing
        // since it could be a security vulnerability
        switch ($attr) {
            case 'read':
                return true;
                break;

            case 'write':
                return (app('env') == 'local') ? true : false;
                break;

            default:
                return false;
                break;
        }
    }
}
