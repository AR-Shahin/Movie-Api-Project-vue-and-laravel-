<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Movie;

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
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password')
        ]);
        $this->call([
            CategorySeeder::class
        ]);
        // \App\Models\Admin::factory(10)->create();
        Movie::factory(15)->create();
    }
}
