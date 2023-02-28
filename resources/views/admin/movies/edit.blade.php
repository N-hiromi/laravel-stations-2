<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin/Movies/id/edit</title>
</head>
<body>
	<div>admin/movies/{id}/edit</div>
	<h1>更新</h1>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<form method="PATCH" action="{{ route('admin.movies.update',['id' =>$movie->id]) }}">
		@csrf

		<div>
			<label for="form-title">映画タイトル</label>
			<input type="text" name="title" id="form-title" value="{{ $movie->title }}" required>
		</div>

		<div>
			<label for="form-image">画像url</label>
			<input type="text" name="image_url" id="form-image" value="{{ $movie->image_url }}" required>
		</div>

		<div>
			<label for="form-published-year">公開年</label>
			<input type="text" name="published_year" id="form-published-year" value="{{ $movie->published_year }}" required>
		</div>

		<div>
			<label for="form-is-showing">公開中かどうか</label>
			<input type="hidden" name="is_showing" value="0">
			<input type="checkbox" name="is_showing" id="form-is-showing" value="1"
			@if ($movie->is_showing == 1) checked @endif />
			{{ $movie->is_showing? "上映中": "上映予定"}}
		</div>

		<div>
			<label for="form-description">概要</label>
			{{-- textareaはvalue対応していない。初期値はタグの間に書く --}}
			<textarea name="description" required>{{ $movie->description }}</textarea>
		</div>

		<button type="submit">登録</button>
	</form>
	<a href="{{ route('admin.movies.index') }}">{{ __('一覧へ戻る') }}</a>
</body>
</html>