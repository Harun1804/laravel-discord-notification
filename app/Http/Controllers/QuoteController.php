<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        if($request->quote != null){
            $data = [
                'quote' => $request->quote,
                'by'    => $request->by
            ];

            return view('quote.index', compact('data'));
        }

        return redirect()->route('quote.create');
    }

    public function create()
    {
        return view('quote.form');
    }
}
