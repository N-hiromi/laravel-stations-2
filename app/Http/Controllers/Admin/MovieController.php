<?php

namespace App\Http\Controllers\Admin;
use App\Models\Movie;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    
	public function index()
	{
		$movies = Movie::all();
		// return response()->json($movies);
		return view('admin.movies.index', ['movies' => $movies]);
	}

	public function create(){
		// return view('admin.movies.create');
		// テスト用
		$genres = Genre::all();
		return view('admin.movies.create', ['genres' => $genres]);
	}

	public function store(CreateMovieRequest $request){
		DB::beginTransaction();
		try{
			$genre_name = $request->genre;
			if ($genre_name){
				// 入力されたgenre(genre.name)がgenreテーブルにあるか？
				$is_genre_name_record = Genre::where('name', $genre_name)->first();

				// 無ければgenreテーブルへgenreを登録
				if(!$is_genre_name_record){
					$result = Genre::create([
						"name" => $genre_name
					]);
					if ($result){
						$genre_id = $result->id;
					}else {
						return redirect()
						->route('admin.movies.create')
						->withError('ジャンルテーブルへの登録が失敗しました。');
					}
				}else{
					// genre.nameがgenreテーブルに見つかった場合、そのidを返す
					$genre_id = $is_genre_name_record->id;
				}
			}
			// 得られたgenre_idをmoviesテーブルへ登録。他のカラムも全て登録
			$result = Movie::create([
				"title" => $request->title,
				"image_url" => $request->image_url,
				"published_year" => $request->published_year,
				"is_showing" => $request->is_showing,
				"description" => $request->description,
				"genre_id" => $genre_id
			]);
			DB::commit();
			return redirect()
				->route('admin.movies.index')
				->withSuccess('データを登録しました。');
		} catch(\Throwable $e){
			report($e);
			abort(500);
		}
	}

	public function edit($id){
		$movie = Movie::find($id);
		// compactでパラメータをviewに渡す。配列で次のように渡すのと同じように解釈される['id' => $id]
		return view('admin.movies.edit', compact('movie'));
	}

	public function update(UpdateMovieRequest $request, $id){
		DB::beginTransaction();
		try{
			$genre_name = $request->genre;
			if ($genre_name){
				// 入力されたgenre(genre.name)がgenreテーブルにあるか？
				$is_genre_name_record = Genre::where('name', $genre_name)->first();

				// 無ければgenreテーブルへgenreを登録
				if(!$is_genre_name_record){
					$result = Genre::create([
						"name" => $genre_name
					]);
					if ($result){
						$genre_id = $result->id;
					}else {
						// return redirect()
						// ->route('admin.movies.create')
						// ->withError('ジャンルテーブルへの登録が失敗しました。');
						// abort(500);
					}
				}else{
					// genre.nameがgenreテーブルに見つかった場合、そのidを返す
					$genre_id = $is_genre_name_record->id;
				}
			}
			$movie = Movie::find($id);
			// 得られたgenre_idをmoviesテーブルへ登録。他のカラムも全て登録
			$result = $movie->update([  
				"title" => $request->title,
				"image_url" => $request->image_url,
				"published_year" => $request->published_year,
				"is_showing" => $request->is_showing,
				"description" => $request->description,
				"genre_id" => $genre_id
		]);
			DB::commit();
			return redirect()
				->route('admin.movies.index')
				->withSuccess('データを更新しました。');
			// dd($result);
		} catch(\Throwable $e){
			report($e);
			abort(500);
			// dd($e);
			// DB::rollback();
			// return redirect()
			// 	->route('admin.movies.edit')
			// 	->withError('データの更新に失敗しました。');
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
