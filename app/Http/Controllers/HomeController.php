<?php

namespace App\Http\Controllers;

use App\BarcodeScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    private $scanner;

    public function __construct(BarcodeScanner $scanner)
    {
        $this->scanner = $scanner;

        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function scan(Request $request)
    {
        $path = $request->file('image')->store(Auth::user()->id.'/images', 'public');

        $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();

        $fullPath = $storagePath . $path;

        $result = $this->scanner->scan($fullPath);

        return view('home', [
            'path' => $path,
            'barcode' => $result->toJson(),
        ]);
    }
}
