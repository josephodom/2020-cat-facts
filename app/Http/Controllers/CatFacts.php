<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatFacts extends Controller
{
    /**
     * The limit set by the cat facts API. Placing this here so frontend & backend can have it
     *
     * @var integer
     */
    private $limit = 1000;
    
    /**
     * Simple HTML page that holds the form
     *
     * @return string
     */
    public function form() : string {
        return view('catfacts.form', [
            'limit' => $this->limit,
        ]);
    }
    
    /**
     * Route that grabs the cat facts & compiles them into a PDF
     *
     * @param Request $request
     * @return string
     */
    public function pdf(Request $request) : string {
        die('<pre>' . print_r($request->input('fact-count'), true) . '</pre>');
    }
}
