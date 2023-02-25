<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant',
        'qty',
        'up',
        'amount'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
