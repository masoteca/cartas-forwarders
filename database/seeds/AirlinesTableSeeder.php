<?php

use Illuminate\Database\Seeder;

class AirlinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $airlines = array(
            array('id' => '1','name' => 'LATAM','prefix' => '045','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'AEROMEXICO','prefix' => '139','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'AIR CANADA','prefix' => '014','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','name' => 'AIR FRANCE','prefix' => '057','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => 'ALITALIA','prefix' => '055','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','name' => 'ASIANA','prefix' => '988','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','name' => 'ATLAS','prefix' => '369','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','name' => 'AVIANCA','prefix' => '729','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','name' => 'DELTA','prefix' => '006','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','name' => 'BRINGER','prefix' => '417','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','name' => 'BRITISH','prefix' => '125','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','name' => 'CATHAY','prefix' => '160','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','name' => 'COPA AIR','prefix' => '230','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','name' => 'EMIRATES','prefix' => '176','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','name' => 'GOL AIRLINE','prefix' => '127','created_at' => NULL,'updated_at' => NULL),
            array('id' => '16','name' => 'IBERIA','prefix' => '075','created_at' => NULL,'updated_at' => NULL),
            array('id' => '17','name' => 'KLM','prefix' => '074','created_at' => NULL,'updated_at' => NULL),
            array('id' => '18','name' => 'KOREAN','prefix' => '180','created_at' => NULL,'updated_at' => NULL),
            array('id' => '19','name' => 'LQ','prefix' => '016','created_at' => NULL,'updated_at' => NULL),
            array('id' => '20','name' => 'LUFTHANSA','prefix' => '020','created_at' => NULL,'updated_at' => NULL),
            array('id' => '21','name' => 'MERCURY','prefix' => '805','created_at' => NULL,'updated_at' => NULL),
            array('id' => '22','name' => 'QANTAS','prefix' => '081','created_at' => NULL,'updated_at' => NULL),
            array('id' => '23','name' => 'QATAR','prefix' => '157','created_at' => NULL,'updated_at' => NULL),
            array('id' => '24','name' => 'UNITED','prefix' => '016','created_at' => NULL,'updated_at' => NULL)
        );


        foreach ($airlines as $airline) {
            \App\Models\Airline::firstOrCreate($airline);
        }
    }
}
