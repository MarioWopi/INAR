<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HostioController extends Controller
{
    /*
    * ENDPOINT (QUERYPARAMS -> IP | limit (1 o 5) | page | token )
    * http://127.0.0.1:8000/getDomainsByIp?ip=8.8.8.8&limit=10&page=2
    */
    public function getDomainsByIp(Request $request)
    {

        $token = $request->bearerToken();

        if ($token) {
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

            $result = json_decode($response->getBody());

            return $result;
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }

    /*
    * ENDPOINT
    * http://127.0.0.1:8000/getAll?domain=google.com
    */
    public function getAll(Request $request)
    {

        $token = $request->bearerToken();

        if ($token) {
            $domain = request()->query("domain");

            $client = new Client();
            $response = $client->request("GET", "https://host.io/api/full/$domain", [
                "headers" => [
                    'accept' => 'application/json',
                    "Authorization" => "Bearer " . env("API_KEY_HOSTIO")
                ]

            ]);

            $result = json_decode($response->getBody());

            return $result;
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }


    /*
    * ENDPOINT ( QUERYPARAMS -> field (en la lista del readme) | value | limit ( 1 o 5) | page)
    * http://127.0.0.1:8000/getByField?field=email&value=google@gmail.com?page=1&limit=5
    */
    public function getByField(Request $request)
    {


        $token = $request->bearerToken();

        if ($token) {

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
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }
}
