<?php

namespace App\Http\Controllers\Admin;
use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;

class MovieController extends Controller
{
    
	public function index()
	{
		$movies = Movie::all();
		// return response()->json($movies);
		return view('admin.movies.index', ['movies' => $movies]);
	}

	public function create(){
		return view('admin.movies.create');
	}

	public function store(CreateMovieRequest $request){
		// 登録作業
		$result = Movie::create($request->all());
		if ($result){
			return redirect()
      ->route('admin.movies.index')
      ->withSuccess('データを登録しました。');
		}else{
			return redirect()
      ->route('admin.movies.create')
      ->withError('データの登録に失敗しました。');
		}
	}

	public function edit($id){
		$movie = Movie::find($id);
		// compactでパラメータをviewに渡す。配列で次のように渡すのと同じように解釈される['id' => $id]
		return view('admin.movies.edit', compact('movie'));
	}

	public function update(UpdateMovieRequest $request, $id){
		$movie = Movie::find($id);
		$result = $movie->update([  
			"title" => $request->title,
			"image_url" => $request->image_url,
			"published_year" => $request->published_year,
			"is_showing" => $request->is_showing,
			"description" => $request->description
	]);  
		if ($result){
			return redirect()
      ->route('admin.movies.index')
      ->withSuccess('データを更新しました。');
		}else{
			return redirect()
      ->route('admin.movies.edit')
      ->withError('データの更新に失敗しました。');
		}
	}

	public function destroy($id){
		$movie = Movie::find($id);
		if ($movie){
			$movie->delete();
			return redirect()->route('admin.movies.index');
		}else{
			// 404ページへリダイレクト
			abort(404);
		}
	}
}
