<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'content',
        'image_url',
        'keywords',
        'order',
    ];
    protected $casts = [
        'keywords' => 'array',
    ];


}
