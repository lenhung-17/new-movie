<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $fillable = ['title', 'description', 'file_path',
        'is_movie', 'release_date', 'views', 'duration', 'season', 'episode', 'entity_id'];

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getSeasonAndEpisode()
    {
        if ($this->isMovie()) {
            return null;
        }

        return "Season {$this->season}, Episode {$this->episode}";
    }

    public function isMovie()
    {
        return $this->isMovie == 1;
    }

    public function isInProgress($username)
    {
        return VideoProgress::where('video_id', $this->id)
            ->where('username', $username)
            ->exists();
    }

    public function hasSeen($username)
    {
        return VideoProgress::where('video_id', $this->id)
            ->where('username', $username)
            ->where('finished', 1)
            ->exists();
    }
}
