<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

/**
 * TODO: Implement docblock
 */
class PriorityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->delete();

        factory(App\Priority::class)->create(['name' => trans('seeders.priority-name-1'), 'description' => trans('seeders.priority-description-1'), 'color_code' => '#000']);
        factory(App\Priority::class)->create(['name' => trans('seeders.priority-name-2'), 'description' => trans('seeders.priority-description-2'), 'color_code' => '#000']);
        // Hoog
        // Kritiek
    }
}
