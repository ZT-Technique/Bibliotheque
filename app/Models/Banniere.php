<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banniere extends Model
{
    protected $table = 'bannieres';

    protected $fillable = [
        'title',
        'image_path',
        'link',
        'position',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function activeForPosition(string $position)
    {
        return static::where('position', $position)
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
    }
}
