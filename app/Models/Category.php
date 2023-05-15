<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected  $table = "categories";
    public $timestamps = true;

    // thiết lập quan hệ vớI bài đăng cơ bản
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    // lấy các danh mục con 
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    // tạo quan hệ để lấy danh mục cha theo id
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    // thiét lập mối quan hệ trung gian để lấy bài đăng từ 1 danh mục cha 
    public function posts()
    {
        return $this->hasManyThrough(Post::class, Category::class, 'parent_id', 'category_id');
    }
}
