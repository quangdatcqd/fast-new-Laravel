<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = "tags";
    public $timestamps = false;
    protected $createdAt = 'created_at';
    protected $updatedAt = 'updated_at';

    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
