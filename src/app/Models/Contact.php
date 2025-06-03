<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Contact extends Model
{
    use HasFactory;
         protected $fillable = [
            'last_name',
            'first_name',
             'gender',
             'email',
             'tel',
             'address',
             'building',
             'category_id', 
             'contact',
             'detail'
             ];
// Contactモデルにcategory（）リレーションを定義
             public function category()
{
    return $this->belongsTo(Category::class);
}
// // Contactモデルにuser（）リレーションを定義（Userモデルとも繋げる）
             public function user()
{
    return $this->belongsTo(User::class);
}

}
