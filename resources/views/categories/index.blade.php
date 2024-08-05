@section('content')
    <div class="previewCategories">
        @if ($type === 'all')
            @foreach ($categories as $category)
                @include('categories.category', ['category' => $category, 'title' => null, 'tvShows' => true, 'movies' => true])
            @endforeach
        @elseif ($type === 'tvshows')
            <h1>TV Shows</h1>
            @foreach ($categories as $category)
                @include('categories.category', ['category' => $category, 'title' => null, 'tvShows' => true, 'movies' => false])
            @endforeach
        @elseif ($type === 'movies')
            <h1>Movies</h1>
            @foreach ($categories as $category)
                @include('categories.category', ['category' => $category, 'title' => null, 'tvShows' => false, 'movies' => true])
            @endforeach
        @endif
    </div>
@endsection
