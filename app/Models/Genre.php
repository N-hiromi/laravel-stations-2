<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    // use HasFactory;
    protected $table = 'genres'; //使うテーブル名の指定
    protected $fillable = ['name']; // 追加を許可するカラムの指定
    public function movies(){
        return $this->hasMany(Movie::class);
    }
}
