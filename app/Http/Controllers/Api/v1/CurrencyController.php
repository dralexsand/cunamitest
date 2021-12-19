<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        return response()->json([
            'id' => 1,
            'name' => 'USD',
            'value' => 1,
        ]);
    }
}
