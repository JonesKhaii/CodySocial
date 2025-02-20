<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

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
