<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Tags;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $contacts = Contacts::count();
        $tags = Tags::count();
        
        return view('dashboard')->with(compact('tags','contacts'));
    }
}
