<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Requets;

class mycont 
{
    public static $data;

    public function __construct(){
        //$json = file_get_contents("https://api.exchangeratesapi.io/latest");
        $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/currencies");
        self::$data = json_decode($json, true);
        

        foreach (self::$data["results"] as $key => $value) {
            DB::table('table')->insert([$value["id"], $value["currencyName"], $value["currencySymbol"]]);
        }
        
    }

    public function get() {

        return response()->json(['data'=>self::$data]);
    }

    public function convert()
    {
        return self::$data["rates"][$_GET["currency"]];
    }
}