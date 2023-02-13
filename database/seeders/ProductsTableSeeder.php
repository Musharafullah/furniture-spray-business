<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new Product();
        $product->code = '4CLT';
        $product->product_name = '4mm Clr Toughened';
        $product->cost_from_supplier = 27.16;
        $product->sale_net_sqm = 57.04;
        $product->cut_out = 25.00;
        $product->notch = 20.00;
        $product->hole = 5.00;
        $product->painted = 85.00;
        $product->sparkle_finish = 40.00;
        $product->metallic_finish = 35.00;
        $product->printed = 150.00;
        $product->cnc = 75.00;
        $product->standblasted = 45.00;
        $product->ritec = 25.00;
        $product->type = 'full_featured';
        $product->save();

        $product = new Product();
        $product->code = '6CLT';
        $product->product_name = '6mm Clr Toughened';
        $product->cost_from_supplier = 29.45;
        $product->sale_net_sqm = 61.85;
        $product->cut_out = 25.00;
        $product->notch = 20.00;
        $product->hole = 5.00;
        $product->painted = 85.00;
        $product->sparkle_finish = 40.00;
        $product->metallic_finish = 35.00;
        $product->printed = 150.00;
        $product->cnc = 75.00;
        $product->standblasted = 45.00;
        $product->ritec = 25.00;
        $product->type = 'full_featured';
        $product->save();

        $product = new Product();
        $product->code = 'Pyro630';
        $product->product_name = 'Pyrotech 630 6mm';
        $product->cost_from_supplier = 90.00;
        $product->sale_net_sqm = 189.00;
        $product->type = 'non_featured';
        $product->save();
    }
}
