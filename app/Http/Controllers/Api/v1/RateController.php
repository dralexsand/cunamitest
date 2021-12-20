<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\RateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RateController extends Controller
{
    protected RateService $service;

    public function __construct()
    {
        $this->service = new RateService;
    }

    public function apiLatestSpecificCurrency(Request $request)
    {
        return $this->service->getLatestSpecificCurrency(
            $request->input('currency'),
            $request->input('base_currency', 'USD'),
        );
    }

    public function apiDynamicsCurrencyRangeDates(Request $request)
    {
        return $this->service->getDynamicsCurrencyRangeDates(
            $request->input('currency'),
            $request->input('base_currency', 'USD'),
            $request->input('date_from', ''),
            $request->input('date_to', ''),
        );
    }


}
