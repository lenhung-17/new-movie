<div class="previewContainer">
    <img src="{{ $entity->thumbnail }}" class="previewImage" hidden>
    <video autoplay muted class="previewVideo" onended="previewEnded()">
        <source src="{{ $video->file_path }}" type="video/mp4">
    </video>
    <div class="previewOverlay">
        <div class="mainDetails">
            <h3>{{ $entity->name }}</h3>
            @if(!$video->isMovie())
                <h4>{{ $seasonEpisode }}</h4>
            @endif
            <div class="buttons">
                <button onclick="watchVideo({{ $video->id }})"><i class="fas fa-play"></i> {{ $playButtonText }}</button>
                <button onclick="volumeToggle(this)"><i class="fas fa-volume-mute"></i></button>
            </div>
        </div>
    </div>
</div>
