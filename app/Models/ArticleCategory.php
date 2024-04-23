<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $table = 'article_categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'article_category_name',
    ];

    // Tambahkan relasi jika diperlukan
}
