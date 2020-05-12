<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($question) {
            $question->slug = Str::slug($question->title, '-');
        });
    }

    // protected $guarded = [];
    protected $fillable = ['title', 'body', 'slug', 'category_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reply()
    {
        return $this->hasMany(Reply::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPathAttribute()
    {
        return "/question/$this->slug";
    }
}
