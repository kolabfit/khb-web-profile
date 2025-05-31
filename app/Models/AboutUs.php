<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AboutUs extends Model
{
    /** @use HasFactory<\Database\Factories\AboutUsFactory> */
    use HasFactory;

    // Karena nama tabel tidak plural:
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'text',
        'image',
        'number',
        'type',
        'slug',
    ];

    public function getImageAttribute($value)
    {
        if (request()->routeIs('filament.*')) {
            return $value;
        } else {
            return env('APP_URL') . Storage::url($value);
        }
    }
}
