<?php

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($j = 0; $j < 5; $j++) {
            DB::table('notifications')->insert([
                'user_id' => $faker->randomElement([1,2]),
                'title' => $faker->title,
                'desc' => $faker->text,
                'type' => 'links',
                'entity_id' => $faker->randomElement([1,2,3]),
            ]);
        }
    }
}
