<?php

namespace Database\Seeders;

use App\Models\Practice;
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
		$this->call([
		    SheetTableSeeder::class,
				MoviesTableSeeder::class,
		]);
		Practice::factory(10)->create();
	}
}
