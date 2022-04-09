<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends Controller
{
  public function index()
  {
    $index = File::all();
    dd($index);
  }
  public function store(Request $request)
  {
    // dd($request);
    $request->validate([
      'file' => 'required|mimes:pdf'
    ]);

    $fileModel = new File;
    if ($request->file()) {
      $fileName = $request->file->getClientOriginalName();
      $filePath = Storage::putFile('uploads', $request->file('file'));
      $fileModel->name = $fileName;
      $fileModel->file_path = $filePath;
      $fileModel->save();
      return back();
    }
  }
}
