<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin/Movies/create</title>
</head>
<body>
	<div>admin/movies/create</div>
	<h1>新規作成</h1>

	@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
	@endif

	<form method="POST" action="{{ route('admin.movies.store') }}">
		@csrf

		<div>
			<label for="form-title">映画タイトル</label>
			<input type="text" name="title" id="form-title" required>
		</div>

		<div>
			<label for="form-image">画像url</label>
			<input type="text" name="image_url" id="form-image" required>
		</div>

		<div>
			<label for="form-published-year">公開年</label>
			<input type="text" name="published_year" id="form-published-year" required>
		</div>

		<div>
			<label for="form-is-showing">公開中かどうか</label>
			<input type="hidden" name="is_showing" value="0">
			<input type="checkbox" name="is_showing" id="form-is-showing" value="1">
		</div>

		<div>
			<label for="form-description">概要</label>
			<textarea name="description" required></textarea>
		</div>

		<button type="submit">登録</button>
	</form>
	<a href="{{ route('admin.movies.index') }}">{{ __('一覧へ戻る') }}</a>
</body>
</html>