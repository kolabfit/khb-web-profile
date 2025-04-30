<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'type'
    ];
}
