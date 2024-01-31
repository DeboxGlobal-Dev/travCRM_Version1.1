<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfExtractController extends Controller
{
    public function extractPDF(){

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile(public_path('NeelakshiBaghel.pdf'));

        $text = $pdf->getText();
        echo $text;
        dd($text);
    }
}
