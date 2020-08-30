<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many students do you need ?", 10);

        $this->command->info("Generate {$count} students...");

        $students = factory(App\Models\Student::class, $count)->create();

        $this->command->info("Students successfully generated...");
    }
}
