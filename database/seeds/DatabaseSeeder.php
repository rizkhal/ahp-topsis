<?php

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
        $this->call(UserTableSeeder::class);
        $users = factory(\App\Models\Alternative::class, 20)->create();
        $users = factory(\App\Models\Criteria::class, 20)->create();
    }
}
