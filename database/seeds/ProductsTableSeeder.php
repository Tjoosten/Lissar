<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * TODO: Implement docblock
 */
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete(); // Truncate the database table.

        // Seed the database table with factories. 
        factory(App\Product::class)->create(['type' => 'Eten']);
    }
}
