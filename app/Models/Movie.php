<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    // use HasFactory;
    protected $table = 'movies'; //使うテーブル名の指定
    protected $fillable = ['title', 'image_url', 'published_year', 'is_showing', 'description', 'genre_id']; // 追加を許可するカラムの指定
    public function genre(){
        return $this->belongsTo(Genre::class);
    }
}
