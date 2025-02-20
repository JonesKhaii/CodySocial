<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;
    protected $table = "post_comments";

    protected $fillable = ['user_id', 'post_id', 'comment', 'status', 'parent_id', 'replied_comment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->where('status', 'active');
    }
}
