<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'author_id',
        'title',
        'content'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
