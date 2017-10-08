<?php

namespace App\Http\Controllers;


use App\BarcodeScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZxingController extends Controller
{
    private $scanner;

    public function __construct(BarcodeScanner $scanner)
    {
        $this->scanner = $scanner;
    }

    public function index(Request $request)
    {
        return view('index');
    }

    public function scan(Request $request)
    {
        $path = $request->file('image')->store('images', 'public');

        $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();

        $fullPath = $storagePath . $path;

        $result = $this->scanner->scan($fullPath);

        return view('index', ['path' => $path, 'isbn' => $result->toJson()]);
    }
}
