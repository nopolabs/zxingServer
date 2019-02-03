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
       if ($request->exists('image')) {
           $path = $request->file('image')->store('temp');
       } else {
           $path = 'temp/' . uniqid('ZxingApiController_', true);
           $contents = $request->exists('url')
               ? file_get_contents($request->get('url'))
               : $request->getContent(true);
           Storage::disk()->put($path, $contents);
       }

        $storagePath = Storage::disk()->getDriver()->getAdapter()->getPathPrefix();
        $fullPath = $storagePath.$path;

        $result = $this->scanner->scan($fullPath);

        Storage::disk()->delete($path);

        return response()->json($result->toArray());
    }
}
