<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClashRoyaleController extends Controller
{

    /*
    * http://127.0.0.1:8000/getPlayerByUserTag?userTag=RU0QG2J
    */
    public function getPlayerByUserTag(Request $request)
    {

        $token = $request->bearerToken();

        if ($token) {
            $userTag = request()->query("userTag");

            $client = new Client();
            $response = $client->request("GET", "https://api.clashroyale.com/v1/players/%23" . $userTag, [
                "headers" => [
                    'accept' => 'application/json',
                    "Authorization" => "Bearer " . env("API_KEY_CLASHROYALE")
                ]

            ]);

            $result = json_decode($response->getBody());

            return $result;
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }

    /*
    * http://127.0.0.1:8000/getClans?name=API&location=57000000&minMembers=20&maxMembers=30&limit=3
    */
    public function getClans(Request $request)
    {

        $token = $request->bearerToken();

        if ($token) {
            $name = request()->query("name");
            $locationId = request()->query("locationId");
            $minMembers = request()->query("minMembers");
            $maxMembers = request()->query("maxMembers");
            $limit = request()->query("limit");

            $client = new Client();
            $response = $client->request("GET", "https://api.clashroyale.com/v1/clans", [
                "query" => [
                    'name' => $name,
                    'locationId' => $locationId,
                    'minMembers' => $minMembers,
                    'maxMembers' => $maxMembers,
                    'limit' => $limit
                ],
                "headers" => [
                    'accept' => 'application/json',
                    "Authorization" => "Bearer " . env("API_KEY_CLASHROYALE")
                ]
            ]);

            $result = json_decode($response->getBody());

            return $result;
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }

    /*
    * http://127.0.0.1:8000/getLocations?limit=2
    */
    public function getLocations(Request $request)
    {

        $token = $request->bearerToken();

        if ($token) {
            $limit = request()->query("limit");

            $client = new Client();
            $response = $client->request("GET", "https://api.clashroyale.com/v1/locations", [
                "query" => [
                    'limit' => $limit
                ],
                "headers" => [
                    'accept' => 'application/json',
                    "Authorization" => "Bearer " . env("API_KEY_CLASHROYALE")
                ]

            ]);

            $result = json_decode($response->getBody());
            return $result;
        } else {
            return response()->json(['mensaje' => 'Error: Token introducido no válido'], 403);
        }
    }
}
