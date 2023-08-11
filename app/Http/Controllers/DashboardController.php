<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index() {
        $posts=auth()->user()->posts; 
        return view("dashboard", compact("posts"));
    }
}
