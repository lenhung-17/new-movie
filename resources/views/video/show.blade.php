@section('content')
    <div class="watchContainer">

        <div class="videoControls watchNav">
            <button onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
            <h1>{{ $video->title }}</h1>
        </div>

        <div class="videoControls upNext" style="display:none;">
            <button onclick="restartVideo();"><i class="fas fa-redo"></i></button>

            <div class="upNextContainer">
                <h2>Up next:</h2>
                <h3>{{ $upNextVideo->title }}</h3>
                <h3>{{ $upNextVideo->getSeasonAndEpisode() }}</h3>

                <button class="playNext" onclick="watchVideo({{ $upNextVideo->id }})">
                    <i class="fas fa-play"></i> Play
                </button>
            </div>
        </div>

        <video controls autoplay onended="showUpNext()">
            <source src="{{ $video->file_path }}" type="video/mp4">
        </video>
    </div>
@endsection

@push('scripts')
    <script>
        initVideo("{{ $video->id }}", "{{ auth()->user()->username }}");
    </script>
@endpush
