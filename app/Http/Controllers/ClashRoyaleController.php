<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClashRoyaleController extends Controller
{


    public function getPlayer()
    {
        $ip = request()->query("ip");
        $limit = request()->query("limit");
        $page = request()->query("page");


        $client = new Client();
        $response = $client->request("GET", "https://api.clashroyale.com/v1/players/#RU0QG2J", [
            "query" => [
                "limit" => $limit,
                "page" => $page
            ],
            "headers" => [
                'accept' => 'application/json',
                "Authorization" => "Bearer " . env("API_KEY_CLASHROYALE")
            ]

        ]);

        //json_decode($response->getBody()->getContents());
        $result = json_decode($response->getBody());

        return $result;
    }
}
