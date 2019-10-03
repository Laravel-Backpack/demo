<?php 

namespace App\Library;

class Elfinder{
    public static function checkAccess($attr, $path, $data, $volume) {
    	switch ($attr) {
    		case 'read':
    			return true;
    			break;

    		case 'write':
    			return false;
    			break;
    		
    		default:
    			return false;
    			break;
    	}
    }
}
