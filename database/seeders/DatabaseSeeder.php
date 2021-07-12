<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(OrderCategorySeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(MenuTypeSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(SetupSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
