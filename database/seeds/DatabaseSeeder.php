<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        
        $this->command->info('Seeding other tables.');
        echo "\n"; // Breakline

        $this->call(PriorityTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
