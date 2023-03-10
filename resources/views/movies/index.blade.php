<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Movies</title>
		<!-- CSS only -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</head>
	<body>
		<div>Movies</div>
		{{-- 検索機能 --}}
		<div>
			<form action="{{ route('movies.index') }}" method="GET">
				<input type="text" name="keyword" value="{{ $keyword }}">
				<div>
					<input type="radio" name="is_showing" value="2"
					@if ($is_showing == "2") checked @endif/>
					<label>全て</label>
				</div>
				<div>
					<input type="radio" name="is_showing" value="1"
					@if ($is_showing == "1") checked @endif/>
					<label for="1">上映中</label>
				</div>
				<div>
					<input type="radio" name="is_showing" value="0"
					@if ($is_showing == "0") checked @endif/>
					<label for="0">上映予定</label>
				</div>
				<input type="submit" value="検索">
			</form>
		</div>

		<nav aria-label="Page navigation example">
			{{ $movies->appends(request()->query())->links() }}
		</nav>

		<ul>
			@foreach ($movies as $movie)
			<li>タイトル: {{ $movie->title }}</li>
			<li>映画url: {{ $movie->image_url }}</li>
			<li>公開年: {{ $movie->published_year }}</li>
			<li>上映中？: {{ $movie->is_showing? '上映中' : '上映予定' }}</li>
			<li>概要: {{ $movie->description}}</li>
			<li>ジャンルid: {{ $movie->genre_id}}</li>
			@endforeach
		</ul>
	</body>
</html>