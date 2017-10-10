<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->has('createToken') && $request->get('createToken') === 'true') {
            return view('manage', [
                'token' => $this->createToken(),
            ]);
        }

        return view('manage');
    }

    private function createToken()
    {
        $user = Auth::user();

        $user->clients()->where('name', 'BARCODE')->delete();

        return $user->createToken('BARCODE', ['scan-barcodes'])->accessToken;
    }
}