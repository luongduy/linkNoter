<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = DB::table('users')->insertGetId([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $linkId = DB::table('links')->insertGetId([
        	'user_id' => $userId,
            'title' => str_random(10),
            'href' => str_random(10).'com'
        ]);
        for ($i = 0; $i < 20; $i++) {
	        DB::table('comments')->insert([
	        	'user_id' => $userId,
	        	'link_id' => $linkId,
	            'content' => str_random(100),
	            'voted' => mt_rand(10,100)
	        ]);
    	}
    }
}
