<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function show()
    {
        return view('menu.place');
    }

    public function select(Request $request)
    {
        $request->validate([
            'place' => 'required'
        ]);

        session(['selected_place' => $request->place]);

        return redirect()->route('pcmap');
    }
}
