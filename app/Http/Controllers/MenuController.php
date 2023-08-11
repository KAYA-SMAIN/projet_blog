<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller 
{
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menu.index', compact('menuItems'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $menuItem = new MenuItem();
        $menuItem->label = $request->input('label');
        $menuItem->url = $request->input('url');
        $menuItem->parent_id = $request->input('parent_id');
        $menuItem->save();

        return redirect()->route('menu.index');
    }
}