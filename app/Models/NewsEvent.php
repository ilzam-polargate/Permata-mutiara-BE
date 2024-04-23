<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsEvent extends Model
{
    protected $table = 'news_events';

    protected $fillable = [
        'article_category_id',
        'article_title',
        'article_description',
        'article_date',
        'article_image',
        'article_caption',
        'meta_keyword',
        'meta_description',
    ];

    public function articleCategory()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }
}
