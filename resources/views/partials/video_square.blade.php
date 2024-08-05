<a href="{{ url('watch', ['id' => $id]) }}">
    <div class="episodeContainer">
        <div class="contents">
            <img src="{{ $thumbnail }}">

            <div class="videoInfo">
                <h4>{{ $episodeNumber }}. {{ $name }}</h4>
                <span>{{ $description }}</span>
            </div>

            {!! $hasSeen !!}
        </div>
    </div>
</a>
