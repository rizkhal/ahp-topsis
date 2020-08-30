<?php

use Illuminate\Database\Seeder;

class AlternativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int) $this->command->ask("How many alternatives do you need ?", 10);

        $this->command->info("Generate {$count} alternatives...");

        $alternatives = factory(App\Models\Alternative::class, $count)->create();

        $this->command->info("Alternatives successfully generated...");
    }
}
