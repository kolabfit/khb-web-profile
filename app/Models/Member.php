<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
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
