<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    /** @use HasFactory<\Database\Factories\OrganizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
    ];

    public function getLogoAttribute($value)
    {
        if (request()->routeIs('filament.*')) {
            return $value;
        } else {
            return env('APP_URL') . Storage::url($value);
        }
    }
}
