<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
