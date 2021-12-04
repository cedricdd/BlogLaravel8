<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::withoutEvents(function () {
            User::factory()->admin()->create() ;
            User::factory()->count(2)->create([
                'role' => 'redac'
            ]);
            User::factory()->count(10)->create([
                'role' => 'user'
            ]);
        });
    }
}
