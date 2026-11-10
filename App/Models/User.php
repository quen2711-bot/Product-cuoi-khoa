<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'email', 'password', 'is_admin'];
    protected $hidden = ['password', 'remember_token'];

    public function posts() { return $this->hasMany(Post::class); }
    public function comments() { return $this->hasMany(Comment::class); }
}