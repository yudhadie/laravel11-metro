<?php

namespace App\Http\Controllers\FE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FEWebsiteController extends Controller
{
    public function home()
    {
        return view('fe.welcome',[
            'title' => 'home',
        ]);
    }

    public function profile()
    {
        return view('fe.profile',[
            'title' => 'Profile',
        ]);
    }
}
