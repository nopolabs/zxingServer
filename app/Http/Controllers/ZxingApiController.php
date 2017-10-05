<?php

namespace App\Http\Controllers;


use App\IsbnScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZxingApiController extends Controller
{
    private $scanner;

    public function __construct(IsbnScanner $scanner)
    {
        $this->scanner = $scanner;
    }

   public function scan(Request $request)
    {
        $path = request()->file('isbnImage')->store('isbnImages', 'public');

        $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();

        $fullPath = $storagePath . $path;

        $result = $this->scanner->scan($fullPath);

        return response()->json($result->toArray());
    }
}
