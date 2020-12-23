<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPost extends Model
{
    use HasFactory;
    protected $table = 'tags_posts';
    protected $guarded = ['id_post,id_tag'];
    protected $primaryKey = ['id_post', 'id_tag'];
    public $incrementing = false;
}
