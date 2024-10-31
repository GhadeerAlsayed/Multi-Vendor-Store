<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $title = 'store';
        return view('dashboard.index',[
            'title' => $title,
            'name' => 'ghaderr'
        ]);
    }
}
