<?php

use Illuminate\Database\Seeder;

class NotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $id = DB::table('categories')->insertGetId([
            'user_id' => 1,
            'name' => 'Unnamed',
        ]);

        for ($j = 0; $j < 12; $j++) {
            DB::table('notes')->insert([
                'category_id' => $id,
                'title' => $faker->title,
                'content' => $faker->text(),
            ]);
        }

    }}
