<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'author_id'
    ];
    
    protected $appends = ['like_counts'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tag');
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikeCountsAttribute(){
        return $this->likes()->count();
    }
}
