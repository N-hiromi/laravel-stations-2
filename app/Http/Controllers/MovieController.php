<?php

namespace App\Http\Controllers;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller{
	public function sample(){
		return view('practice');
	}

	public function index(Request $request)
	{
		$keyword = $request->input('keyword');
		$onAir = $request->input('onAir');
		$query = Movie::query();

		if(!empty($keyword)){
			if(!empty($keyword)){
				$query->where('title', 'LIKE', "%{$keyword}")
				->orwhere('description', 'LIKE', "%{$keyword}");
			}
		}
		if(!empty($onAir)){
			$query->where('is_showing', $onAir);
			// if($onAir = 0){
			// 	$query->where('is_showing', 0);
			// }else{
			// 	$query->where('is_showing', 1);
			// }
		}
		$movies = $query->get();
		return view('movies.index', compact('movies', 'keyword', 'onAir'));
	}
}