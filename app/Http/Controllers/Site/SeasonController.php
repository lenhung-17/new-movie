<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeasonController extends Controller
{
    protected $username;

    public function __construct()
    {
        $this->username = Auth::user()->username;
    }

    public function create(Entity $entity)
    {
        $seasons = $entity->seasons; // Assuming the entity has a relationship with seasons

        if ($seasons->isEmpty()) {
            return "";
        }

        $seasonsHtml = "";
        foreach ($seasons as $season) {
            $seasonNumber = $season->season_number;

            $videosHtml = "";
            foreach ($season->videos as $video) {
                $videosHtml .= $this->createVideoSquare($video);
            }

            $seasonsHtml .= view('partials.season', compact('seasonNumber', 'videosHtml'))->render();
        }

        return $seasonsHtml;
    }

    private function createVideoSquare(Video $video)
    {
        $id = $video->id;
        $thumbnail = $video->thumbnail;
        $name = $video->title;
        $description = $video->description;
        $episodeNumber = $video->episode_number;
        $hasSeen = $video->hasSeen($this->username) ? "<i class='fas fa-check-circle seen'></i>" : "";

        return view('partials.video_square', compact('id', 'thumbnail', 'name', 'description', 'episodeNumber', 'hasSeen'))->render();
    }
}
