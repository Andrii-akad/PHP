<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $guarded = ['id'];

    public function Category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'id_category');
    }

    public function User()
    {
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }

    public function Tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'tags_posts', 'id_post', 'id_tag');
    }
}
