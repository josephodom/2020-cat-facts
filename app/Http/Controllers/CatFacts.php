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
        $limit = $request->input('fact-count');
        
        // If $limit isn't an integer, return an error
        if(!is_numeric($limit) || intval($limit) != $limit){
            $this->producePDF('ERROR: Given fact-count is not a valid integer!');
        }
        
        $limit = intval($limit);
        
        // We want to make sure $limit is between 1 and the API limit, inclusive
        $limit = max(1, $limit);
        $limit = min($this->limit, $limit);
        
        // Get the facts from the API endpoint
        // Since it's a simple GET request, we'll use file_get_contents instead of curl
        $facts = file_get_contents('https://catfact.ninja/facts?limit=' . $limit);
        
        // Attempt to decode the facts string as JSON
        $facts = json_decode($facts);
        
        // If we didn't get valid JSON, return an error
        if($facts === null){
            $this->producePDF('ERROR: There was an error processing your cat facts. Sorry :(');
        }
        
        // For now, we're just die-ing the info we have so far
        die('<pre>' . print_r([
            'limit' => $request->input('fact-count'),
            'facts' => $facts,
        ], true) . '</pre>');
    }
    
    private function producePDF($data){
        die($data);
    }
}
