<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productos = array(
            array('name' => 'Manzana'),
            array('name' => 'Pera'),
            array('name' => 'Piña'),
            array('name' => 'XXXX'),
        );

        foreach ($productos as $producto) {
            \App\Models\Product::firstOrCreate($producto);
        }
    }
}
