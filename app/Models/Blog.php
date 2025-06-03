<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'blog_category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageAttribute($value)
    {
        if (request()->routeIs('filament.*')) {
            return $value;
        } else {
            return env('APP_URL') . Storage::url($value);
        }
    }
}