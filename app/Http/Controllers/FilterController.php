<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function filterData()
    {
        $client = new Client();
        $response = $client->get('https://gist.githubusercontent.com/Loetfi/fe38a350deeebeb6a92526f6762bd719/raw/9899cf13cc58adac0a65de91642f87c63979960d/filter-data.json');
        $respBody = json_decode($response->getBody()->getContents());
        $bills = $respBody->data->response->billdetails;
        $denoms = array_column($bills, 'body');

        $denomFiltered = [];
        foreach ($denoms as $denom) {
            $arrDenom = explode(':', $denom[0]);
            $denom = (int)trim(end($arrDenom));
            if ($denom >= 100000) {
                $denomFiltered[] = $denom;
            }
        }

        echo "<pre>";
        print_r($denomFiltered);
        echo "</pre>";
    }
}
