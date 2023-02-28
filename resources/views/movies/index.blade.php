<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Movies</title>
	</head>
	<body>
		<div>Movies</div>

		{{-- 検索機能 --}}
		<div>
			<form action="{{ route('movies.index') }}" method="GET">
				<input type="text" name="keyword" value="{{ $keyword }}">
				<div>
					<input type="radio" name="onAir" value="">
					<label for="0">全て</label>
				</div>
				<div>
					<input type="radio" name="onAir" value="1">
					<label for="1">上映中</label>
				</div>
				<div>
					<input type="radio" name="onAir" value="0">
					<label for="0">上映予定</label>
				</div>
				<input type="submit" value="検索">
			</form>
		</div>

		<ul>
			@foreach ($movies as $movie)
			<li>タイトル: {{ $movie->title }}</li>
			<li>映画url: {{ $movie->image_url }}</li>
			<li>公開年: {{ $movie->published_year }}</li>
			<li>上映中？: {{ $movie->is_showing? '上映中' : '上映予定' }}</li>
			<li>概要: {{ $movie->description}}</li>
			@endforeach
		</ul>
	</body>
</html>