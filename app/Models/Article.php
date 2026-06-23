<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'authors',
        'author_image',
        'author_level',
        'author_country',
        'year',
        'publication_date',
        'theme_id',
        'abstract',
        'keywords',
        'pdf_path',
        'cover_image',
        'downloads_count',
        'is_visible',
    ];

    protected $casts = [
        'publication_date' => 'date',
    ];

    /**
     * Get the theme that owns the article.
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function favorites()
    {
        return $this->hasMany(UserFavorite::class);
    }


}
