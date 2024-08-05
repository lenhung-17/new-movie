<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    public static function getEntities(Request $request)
    {
        $categoryId = $request->get('category_id');
        $query = Entity::query();

        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }

    public static function getTVShowEntities(Request $request)
    {
        $categoryId = $request->get('category_id');

        $query = Entity::select('entities.*')
            ->join('videos', 'entities.id', '=', 'videos.entity_id')
            ->where('videos.is_movie', 0);

        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }

    public static function getMoviesEntities(Request $request)
    {
        $categoryId = $request->get('category_id');

        $query = Entity::select('entities.*')
            ->join('videos', 'entities.id', '=', 'videos.entity_id')
            ->where('videos.is_movie', 1);

        if ($categoryId !== null) {
            $query->where('category_id', $categoryId);
        }

        return $query->get();
    }

    public static function getSearchEntities($term)
    {
        return Entity::where('name', 'like', '%' . $term . '%')->get();
    }

    public function entities(Request $request, $tvShows, $movies)
    {
        if ($tvShows && $movies) {
            $entities =  $this->getEntities($request);
        } elseif ($tvShows) {
            $entities = $this->getTVShowEntities($request);
        } else {
            $entities = $this->getMoviesEntities($request);
        }
        return view('categories.category', compact('entities'));
    }
}
