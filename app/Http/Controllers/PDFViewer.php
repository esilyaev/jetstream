<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PDFViewer extends Controller
{
    //
    public function view($filename)
    {
        // dd($filename);
        return Inertia::render('PDFViewer', [
            'filename' => $filename
        ]);
    }
}
