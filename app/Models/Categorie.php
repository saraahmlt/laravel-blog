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
       'description',
       'image',
    ];

    public function posts()
    {
        return $this->BelongsToMany(Post::class, 'categorie_post', 'post_id', 'category_id')->withTimestamps();
    }
    
}
