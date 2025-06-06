<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CryptoController extends Controller
{
    public function callback(Request $request)
    {
        Log::info("Crypto Donation Completed: ", [$request->all()]);
        return response()->json($request->all());
    }
}
