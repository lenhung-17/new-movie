<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    private $seasonNumber;
    private $videos;

    public function __construct($seasonNumber, $videos)
    {
        $this->seasonNumber = $seasonNumber;
        $this->videos = $videos;
    }

    public function getSeasonNumber()
    {
        return $this->seasonNumber;
    }

    public function getVideos()
    {
        return $this->videos;
    }
}
