<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gradebook;

class GradebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gradebook::factory(10)->create();
    }
}
