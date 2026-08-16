<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function getData()
    {
        $client = new Client();
        $response = $client->get('http://universities.hipolabs.com/search?country=United+States');
        $data = json_decode($response->getBody(), true);

        return view('api.data', ['data' => $data], compact('data'));
        
    }
}

