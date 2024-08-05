<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Define the table if not using Laravel's default 'categories'
     protected $table = 'categories';

    // Specify fillable fields if necessary
     protected $fillable = ['name'];
}
