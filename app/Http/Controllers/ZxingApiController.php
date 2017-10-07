<?php

namespace App\Http\Controllers;


use App\BarcodeScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZxingApiController extends Controller
{
    private $scanner;

    public function __construct(BarcodeScanner $scanner)
    {
        $this->scanner = $scanner;
    }

   public function scan(Request $request)
   {
       if ($request->exists('isbnImage')) {
           $path = $request->file('isbnImage')->store('scan');
       } else {
           $path = 'scan/' . uniqid();
           $contents = $request->exists('isbnUrl')
               ? file_get_contents($request->get('isbnUrl'))
               : $request->getContent(true);
           Storage::put($path, $contents);
       }

        $storagePath = Storage::disk()->getDriver()->getAdapter()->getPathPrefix();
        $fullPath = $storagePath.$path;

        $result = $this->scanner->scan($fullPath);

        Storage::disk('public')->delete($path);

        return response()->json($result->toArray());
    }
}
