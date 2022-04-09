<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Inertia\Inertia;

class FileController extends Controller
{
  public function index()
  {
    // $test = File::first();
    // dd($test, Storage::url($test->name));
    return Inertia::render('FileStorage', [
      'files' => File::all()->map(
        function ($file) {
          $link = explode("/", $file->file_path)[1];
          return [
            'id' => $file->id,
            'name' => $file->name,
            'file_path' => $file->file_path,
            'created_at' => $file->created_at,
            'link' => 'view/' . $link,
          ];
        }
      )
    ]);
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
      $filePath = Storage::putFile('public', $request->file('file'));
      $fileModel->name = $fileName;
      $fileModel->file_path = $filePath;
      $fileModel->save();
      return back();
    }
  }
}
