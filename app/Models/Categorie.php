<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $fillable = [
       'categorie',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'categorie_post');
    }
    
}
