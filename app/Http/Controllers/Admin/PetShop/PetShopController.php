<?php

namespace App\Http\Controllers\Admin\PetShop;

use App\Http\Controllers\Controller;

class PetShopController extends Controller
{
    public function about()
    {
        return view('admin.petshop_about');
    }
}
