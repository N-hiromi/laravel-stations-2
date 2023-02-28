<?php

namespace Database\Seeders;
use DB; // これがないとエラーになる。注意
use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('movies')->insert(
			[
				[
					'title'=>'すごい映画',
					'image_url'=>'https://picsum.photos/100',
					'published_year'=>'2021',
					'is_showing'=>0,
					'description'=>'なんかすごくてすごい映画'
				]
			]
		);
	}
}
