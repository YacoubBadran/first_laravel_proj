<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CurrenciesSeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = file_get_contents("https://free.currencyconverterapi.com/api/v6/currencies");
        $data = json_decode($json, true);
        

        foreach ($data["results"] as $key => $value) {

            \App\Currency::updateOrCreate(
                [
                    'code' => array_get($value, "id", 'DEFAULT'),
                    'name' => array_get($value, "currencyName", 'DEFAULT'),
                     'symbol' => array_get($value, "currencySymbol", 'DEFAULT'),
                ]);


        }
    }
}
