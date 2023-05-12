<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CoinRankingController extends Controller
{
    /*
    * ENDPOINT (QUERYPARAMS -> IP | limit (1 o 5) | page )
    * http://127.0.0.1:8000/getDomainsByIp?ip=8.8.8.8&limit=10&page=2
    */

    //https://host.io/api/full/stucom.com?&token=8cd72f876a8c4f

    public function getDomainsByIp()
    {
        $ip = request()->query("ip");
        $limit = request()->query("limit");
        $page = request()->query("page");


        $client = new Client();
        $response = $client->request("GET", "https://host.io/api/domains/ip/$ip", [
            "query" => [
                "limit" => $limit,
                "page" => $page
            ],
            "headers" => [
                'accept' => 'application/json',
                "Authorization" => "Bearer " . env("API_KEY_COINRANKING")
            ]

        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }

    public function getAllByDomain()
    {
        $ip = request()->query("ip");
        $limit = request()->query("limit");
        $page = request()->query("page");


        $client = new Client();
        $response = $client->request("GET", "https://host.io/api/domains/ip/$ip", [
            "query" => [
                "limit" => $limit,
                "page" => $page
            ],
            "headers" => [
                'accept' => 'application/json',
                "Authorization" => "Bearer " . env("API_KEY_COINRANKING")
            ]

        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }

}
