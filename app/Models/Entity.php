<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entities';
    protected $fillable = ['name', 'thumbnail', 'preview.blade.php', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSeasons()
    {
        return Video::where('entity_id', $this->id)
            ->where('is_movie', 0)
            ->orderBy('season')
            ->orderBy('episode')
            ->get()
            ->groupBy('season')
            ->map(function ($videos, $seasonNumber) {
                return new Season($seasonNumber, $videos);
            })
            ->values();
    }
}
