<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $currency = $request->input('currency');

        if (in_array($currency, ['USD', 'CAD'])) {
            // Store currency in session
            Session::put('currency', $currency);

            return response()->json([
                'success' => true,
                'currency' => $currency,
            ]);
        }

        return response()->json([
            'success' => false,
            'error' => 'Invalid currency',
        ], 400);
    }
}
