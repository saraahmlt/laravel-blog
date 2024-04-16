<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'content', 
        'image',
        'user_id'
    ];
    
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Categorie::class, 'categorie_post', 'post_id', 'category_id');
    }
    
}

