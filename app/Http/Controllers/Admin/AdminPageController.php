<?php

namespace App\Http\Controllers\Admin;

class AdminPageController
{
    /**
     * Show the new in v7 page.
     *
     * @return \Illuminate\View\View
     */
    public function newInV7()
    {
        return view('admin.new-in-v7', [
            'title' => 'New in v7',
            'description' => 'Discover the new features and improvements in Backpack v7.',
        ]);
    }
}
