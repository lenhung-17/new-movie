<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VideoController extends Controller
{
    public function getUpNext(Video $currentVideo)
    {
        $entityId = $currentVideo->entity_id;
        $season = $currentVideo->season;
        $episode = $currentVideo->episode;
        $videoId = $currentVideo->id;

        // Try to find the next video in the same season
        $video = Video::where('entity_id', $entityId)
            ->where('id', '!=', $videoId)
            ->where(function ($query) use ($season, $episode) {
                $query->where(function ($query) use ($season, $episode) {
                    $query->where('season', $season)
                        ->where('episode', '>', $episode);
                })
                    ->orWhere('season', '>', $season);
            })
            ->orderBy('season')
            ->orderBy('episode')
            ->first();

        // If no next video is found, get the most viewed video of all
        if (!$video) {
            $video = Video::where('id', '!=', $videoId)
                ->where(function ($query) {
                    $query->where('season', '<=', 1)
                        ->where('episode', '<=', 1);
                })
                ->orderBy('views', 'desc')
                ->first();
        }

        return $video;
    }

    public function getEntityVideoForUser($entityId)
    {
        // Try to find the most recently watched video
        $videoId = DB::table('videos_progress')
            ->join('videos', 'videos_progress.video_id', '=', 'videos.id')
            ->where('videos.entity_id', $entityId)
            ->orderBy('videos_progress.date_modified', 'desc')
            ->value('videos_progress.video_id');

        // If no video is found, get the first video in the entity
        if (!$videoId) {
            $videoId = Video::where('entity_id', $entityId)
                ->orderBy('season')
                ->orderBy('episode')
                ->value('id');
        }

        return $videoId;
    }

    public function show($id)
    {
        $currentVideo = Video::findOrFail($id);
        $upNextVideo = $this->getUpNext($currentVideo);
        // Use $upNextVideo as needed

        // Example for getting video for a user
//        $entityId = $currentVideo->entity_id;
//        $userVideoId = $this->getEntityVideoForUser($entityId);
        // Use $userVideoId as needed
        return view('video.show', compact('currentVideo', 'upNextVideo'));
    }
}
