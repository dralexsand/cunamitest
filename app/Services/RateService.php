<?php

declare(strict_types=1);


namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RateService
{
    protected string $api_key;
    protected string $api_base_url;

    public function __construct()
    {
        $this->api_key = getenv('RATE_API_KEY');
        $this->api_base_url = getenv('RATE_API_BASE_URL');
    }

    public function getLatestSpecificCurrency(
        string $currencyCodes,
        string $baseCurrency = "USD"
    ) {
        $response = $this->apiLatest($baseCurrency);
        $currencyCodesArray = explode(",", trim($currencyCodes));
        $data = collect($response['data']);
        $filtered = $data->only($currencyCodesArray);
        return $filtered->all();
    }

    public function getDynamicsCurrencyRangeDates(
        string $currencyCodes,
        string $baseCurrency,
        string $dateFrom,
        string $dateTo
    ) {
        $response = $this->apiHistorical($baseCurrency, $dateFrom, $dateTo);
        $currencyCodesArray = explode(",", trim($currencyCodes));
        $data = $response['data'];

        $result = [];
        foreach ($data as $dataPerDate => $dataList) {
            $dataListCollection = collect($dataList);
            $filtered = $dataListCollection->only($currencyCodesArray);
            $result[$dataPerDate] = $filtered->all();
        }

        return $result;
    }

    public function buildStringApiLatest(string $baseCurrency = "USD")
    {
        return $this->api_base_url
            . "/latest?apikey="
            . $this->api_key
            . "&base_currency={$baseCurrency}";
    }

    public function buildStringApiHistorical(
        string $baseCurrency = "USD",
        string $dateFrom = "",
        string $dateTo = ""
    ) {
        $dateFilter = [];

        if ($dateFrom !== "") {
            $dateFilter[] = "date_from={$dateFrom}";
        }

        if ($dateTo !== "") {
            $dateFilter[] = "date_to={$dateTo}";
        }

        $api_req = $this->api_base_url
            . "/historical?apikey="
            . $this->api_key
            . "&base_currency={$baseCurrency}";

        return empty($dateFilter)
            ? $api_req
            : $api_req . "&" . implode('&', $dateFilter);
    }

    public function apiLatest(string $baseCurrency)
    {
        $url = $this->buildStringApiLatest($baseCurrency);
        return Http::get($url);
    }

    public function apiHistorical(
        string $baseCurrency,
        string $dateFrom,
        string $dateTo
    ) {
        $url = $this->buildStringApiHistorical(
            $baseCurrency,
            $dateFrom,
            $dateTo
        );

        return Http::get($url);
    }

}
