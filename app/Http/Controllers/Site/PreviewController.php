<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreviewController extends Controller
{
    protected $username;

    public function __construct()
    {
        $this->username = Auth::user()->username;
    }

    public function createCategoryPreviewVideo($categoryId)
    {
        $entity = Entity::where('category_id', $categoryId)->inRandomOrder()->first();

        if (!$entity) {
            return "No TV shows to display";
        }

        return $this->createPreviewVideo($entity);
    }

    public function createTVShowPreviewVideo()
    {
        $entity = Entity::whereHas('videos', function ($query) {
            $query->where('is_movie', 0);
        })->inRandomOrder()->first();

        if (!$entity) {
            return "No TV shows to display";
        }

        return $this->createPreviewVideo($entity);
    }

    public function createMoviesPreviewVideo()
    {
        $entity = Entity::whereHas('videos', function ($query) {
            $query->where('is_movie', 1);
        })->inRandomOrder()->first();

        if (!$entity) {
            return "No movies to display";
        }

        return $this->createPreviewVideo($entity);
    }

    public function createPreviewVideo($entity)
    {
        if (!$entity) {
            $entity = $this->getRandomEntity();
        }

        $video = $entity->videos()->first(); // Get the first video related to the entity

        if (!$video) {
            return "No video found for this entity";
        }

        $inProgress = $video->isInProgress($this->username);
        $playButtonText = $inProgress ? "Continue watching" : "Play";

        $seasonEpisode = $video->isMovie() ? "" : "Season {$video->season}, Episode {$video->episode}";

        return view('partials.preview.blade.php', compact('entity', 'video', 'playButtonText', 'seasonEpisode'))->render();
    }

    public function createEntityPreviewSquare($entity)
    {
        return view('partials.entity_preview_square', compact('entity'))->render();
    }

    private function getRandomEntity()
    {
        return Entity::inRandomOrder()->first();
    }
}
