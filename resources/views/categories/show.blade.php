@section('content')
    <div class="previewCategories noScroll">
        @include('categories._category', ['category' => $category, 'title' => $title, 'tvShows' => true, 'movies' => true])
    </div>
@endsection
