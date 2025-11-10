<?php

use Illuminate\Database\Seeder;
use App\Region;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            'Alto tietê',
            'Interior',
            'ES',
            'SP Interior',
            'SP',
            'SP2',
            'MG',
            'Nacional',
            'SP CAV',
            'RJ',
            'SP2',
            'SP1',
            'NE1',
            'NE2',
            'SUL',
            'Norte',
        ];

        foreach ($regions as $region) {
            $region = Region::create([
                "name" => $region
            ]);
        }
    }
}
