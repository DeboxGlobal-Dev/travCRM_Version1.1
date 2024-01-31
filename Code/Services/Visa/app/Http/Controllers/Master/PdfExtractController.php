<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use PDF;
// use Illuminate\Support\Facades\DB;
 use Illuminate\Support\Facades\Storage;
//use Illuminate\Support\Facades\Validator;
//use App\Models\Master\PdfExtract;

class PdfExtractController extends Controller
{

    public function extractPDF(){

        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile(public_path('NeelakshiBaghel.pdf'));

        $text = $pdf->getText();
        echo $text;
        dd($text);
    }

    public function ReadPdf(){
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile(public_path('NeelakshiBaghel.pdf'));
        $text = $pdf->getText();
        $data = [
            'title' => 'Sample PDF',
            'content'=>$text
        ];
        $pdf = PDF::loadView('welcome', $data);
        return $pdf->stream('sample.pdf');
    }
}
