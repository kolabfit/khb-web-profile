<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    protected $fillable = [
        'name',
        'position',
        'company',
        'testimonial',
        'photo',
    ];

    public function getPhotoAttribute($value)
    {
        if (request()->routeIs('filament.*')) {
            return $value;
        } else {
            return env('APP_URL') . Storage::url($value);
        }
    }
}
