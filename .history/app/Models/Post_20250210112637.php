<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Post extends Model
{
    protected $fillable = [
        'title',
        'tags',
        'summary',
        'slug',
        'description',
        'photo',
        'quote',
        'post_cat_id',
        'post_tag_id',
        'added_by',
        'status'
    ];

    // Quan hệ với danh mục bài viết
    public function category()
    {
        return $this->belongsTo('App\Models\PostCategory', 'post_cat_id', 'id');
    }

    // Quan hệ với tag qua bảng trung gian post_tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    // Quan hệ với tác giả
    public function author_info()
    {
        return $this->belongsTo('App\Models\User', 'added_by', 'id');
    }

    // Lấy tất cả bài viết kèm category, author, tags
    public static function getAllPost()
    {
        return Post::with(['category', 'author_info', 'tags'])->orderBy('id', 'DESC')->paginate(10);
    }

    // Lấy bài viết theo slug
    public static function getPostBySlug($slug)
    {
        return Post::with(['tags', 'author_info', 'category'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->first();
    }

    // Quan hệ với comment
    public function comments()
    {
        return $this->hasMany(PostComment::class)
            ->whereNull('parent_id')
            ->where('status', 'active')
            ->with('user_info')
            ->orderBy('id', 'DESC');
    }

    // Lấy tất cả bình luận của bài viết
    public function allComments()
    {
        return $this->hasMany(PostComment::class)->where('status', 'active');
    }

    // Lấy bài viết theo tag
    public static function getBlogByTag($slug)
    {
        return Post::where('tags', $slug)->paginate(8);
    }

    // Đếm số bài viết active
    public static function countActivePost()
    {
        return Post::where('status', 'active')->count() ?? 0;
    }
}
