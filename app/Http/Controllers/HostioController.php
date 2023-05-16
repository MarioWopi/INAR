<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HostioController extends Controller
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
                "Authorization" => "Bearer " . env("API_KEY_HOSTIO")
            ]

        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }

    public function getAll()
    {
        $domain = request()->query("domain");
        $limit = request()->query("limit");
        $page = request()->query("page");

        $client = new Client();
        $response = $client->request("GET", "https://host.io/api/full/$domain", [
            "query" => [
                "limit" => $limit,
                "page" => $page
            ],
            "headers" => [
                'accept' => 'application/json',
                "Authorization" => "Bearer " . env("API_KEY_HOSTIO")
            ]

        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }

    public function getByField()
    {
        $page = request()->query("page");
        $field = request()->query("field");
        $value = request()->query("value");
        $limit = request()->query("limit");

        $client = new Client();
        $response = $client->request("GET", "https://host.io/api/domains/$field/$value", [
            "query" => [
                "page" => $page,
                "limit" => $limit
            ],
            "headers" => [
                'accept' => 'application/json',
                "Authorization" => "Bearer " . env("API_KEY_HOSTIO")
            ]
        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }
    
}
