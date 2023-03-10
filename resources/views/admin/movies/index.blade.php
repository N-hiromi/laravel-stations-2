<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin/Movies</title>
</head>
<body>
    <div>admin/movies</div>
    <ul>
    @foreach ($movies as $movie)
        <li>タイトル: <a href="{{ route('admin.movies.edit',['id' =>$movie->id]) }}">{{ $movie->title }}</a></li>
        <li>映画url: {{ $movie->image_url }}</li>
        <li>公開年: {{ $movie->published_year }}</li>
        <li>上映中？: {{ $movie->is_showing? '上映中' : '上映予定' }}</li>
        <li>概要: {{ $movie->description}}</li>
        <li>ジャンルid: {{ $movie->genre_id}}</li>
        <form method="POST" action="{{route('admin.movies.destroy',['id'=>$movie->id])}}">
          @csrf
					@method('delete')
          <button type="submit">削除</button>
        </form>
    @endforeach
    </ul>
    <a href="{{ route('admin.movies.create') }}">{{ __('新規作成') }}</a>
</body>
</html>