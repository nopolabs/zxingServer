<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('manage');
    }

    public function createToken()
    {
        Auth::user()->clients()->where('name', 'BARCODE')->delete();

        $token = Auth::user()->createToken('BARCODE', ['scan-barcodes'])->accessToken;

        return view('manage', [
            'token' => $token,
        ]);
    }
}