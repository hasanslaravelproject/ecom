<?php

namespace Database\Seeders;

use App\Models\Setup;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setup::factory()
            ->count(5)
            ->create();
    }
}
