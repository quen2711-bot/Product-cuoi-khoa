<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = ['title', 'slug', 'content', 'image', 'status', 'scheduled_at', 'category_id'];
    protected $dates = ['scheduled_at', 'deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function tags() { return $this->belongsToMany(Tag::class); }
    public function comments() { return $this->hasMany(Comment::class); }
    public function scopePublished($q) { return $q->where('status', 'published'); }
}