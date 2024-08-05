<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showAllCategories()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories, 'type' => 'all']);
    }

    public function showTVShowCategories()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories, 'type' => 'tvshows']);
    }

    public function showMovieCategories()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories, 'type' => 'movies']);
    }

    public function showCategory($categoryId, $title = null)
    {
        $category = Category::findOrFail($categoryId);
        $title = $title ?? $category->name;
        return view('categories.show', ['category' => $category, 'title' => $title]);
    }


}
