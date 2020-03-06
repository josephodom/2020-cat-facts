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
     * Route that intends to grab the cat facts & compiles them into a PDF
     * Unhappy conditions still output a PDF, just not one with the data you're after
     *
     * @param Request $request
     * @return void
     */
    public function pdf(Request $request) : void {
        $limit = $request->input('fact-count');
        
        // If $limit isn't an integer, return an error
        if(!is_numeric($limit) || intval($limit) != $limit){
            // Still outputs a PDF, just one explaining that there was an error
            $this->producePDF('Error', 'Given fact-count is not a valid integer!');
        }
        
        $limit = intval($limit);
        
        // We want to make sure $limit is between 1 and the API limit, inclusive
        $limit = max(1, $limit);
        $limit = min($this->limit, $limit);
        
        // Get the facts from the API endpoint
        // Since it's a simple GET request, we'll use file_get_contents instead of curl
        $factsJSONString = file_get_contents('https://catfact.ninja/facts?limit=' . $limit);
        
        // Attempt to decode the facts string as JSON
        $factsJSON = json_decode($factsJSONString);
        
        // If we didn't get valid JSON, return an error
        if($factsJSON === null || empty($factsJSON->data)){
            // Still outputs a PDF, just one explaining that there was an error
            $this->producePDF('Error', 'There was an error processing your cat facts. Sorry :(');
        }
        
        // For storing the facts closer to human readability
        // We'll have one fact per index, then implode the facts
        $facts = [];
        
        // Cycle through the facts JSON
        foreach($factsJSON->data as $key => $fact){
            // Add the fact number to the beginning of the fact
            $facts[] = (++$key) . ') ' . $fact->fact;
        }
        
        // Output the facts in a PDF
        $this->producePDF(
            // Title; i.e. if you ask for 5 cat facts, this will say "5 Cat Facts!"
            $limit . ' Cat Facts!',
            // Space the facts out a little
            implode("\n\n", $facts),
            // Save successful PDFs with this filename
            $limit . '_' . time() . '_' . mt_rand(111, 999)
        );
    }
    
    /**
     * Outputs a PDF with the given title & body. Exits. Saves the PDF, if you explicitly give it a filename.
     *
     * @param string $title
     * @param string $data
     * @param string $filename
     * @return void
     */
    private function producePDF(string $title, string $data, string $filename = null) : void {
        // Pull in the PDF library
        require_once base_path('vendor/fpdf/fpdf.php');
        
        // Sanitize strings for PDFs
        $title = iconv('UTF-8', 'windows-1252', $title);
        $data = iconv('UTF-8', 'windows-1252', $data);
        
        // Create the PDF object
        $pdf = new \FPDF();
        
        // Create a PDF page
        $pdf->AddPage();
        
        // Write our title in large print
        $pdf->SetFont('Arial', '', 24);
        $pdf->MultiCell(0, 18, $title, 24);
        
        // Now write our facts in medium print
        $pdf->SetFont('Arial', '', 14);
        $pdf->MultiCell(0, 7, $data);
        
        if($filename !== NULL){
            ob_start();
        }
        
        // Output the PDF
        $pdf->Output();
        
        if($filename !== NULL){
            $output = ob_get_clean();
            
            echo $output;
            
            file_put_contents(base_path('public/pdf/' . $filename . '.pdf'), $output);
        }
        
        // Die, just in case. Nothing else should happen from here on out
        die();
    }
    
    public function past() : string {
        return 'nothing yet';
    }
}
