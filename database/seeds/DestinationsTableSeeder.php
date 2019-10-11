<?php

use Illuminate\Database\Seeder;

class DestinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinos = array(
            array('country' => 'Mexico', 'code' => 'MX'),
            array('country' => 'Brazil', 'code' => 'BR'),
            array('country' => 'Chile', 'code' => 'CL'),
            array('country' => 'Colombia', 'code' => 'COL'),
        );

        foreach ($destinos as $destino) {
            \App\Models\Destination::firstOrCreate($destino);
        }
    }
}
