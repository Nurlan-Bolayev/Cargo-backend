<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\OverseasAddress;
use App\Models\Package;
use App\Models\User;
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
        $admin = Admin::query()->create([
           'email' => 'admin@admin.com',
            'name' => 'Admin',
            'password' => \Hash::make('admin123')
        ]);


        $user = User::factory()->create([
            'email' => 'nurlan@gmail.com',
            'name' => 'nurlan',
            'password' => \Hash::make('nurlan123')
        ]);

        $turkey = OverseasAddress::factory()->create([
            'country' => 'Turkey'
        ]);

        $usa = OverseasAddress::factory()->create([
            'country' => 'USA'
        ]);

        Package::factory()->count(5)->create([
            'start_point_id' => $turkey,
        ]);

        Package::factory()->count(5)->create([
            'start_point_id' => $usa,
        ]);
    }
}
