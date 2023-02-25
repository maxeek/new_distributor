<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends BaseModel
{
    const DELIVERED = 1;
    const PENDING = 2;
    const CANCELED = 3;

    protected $fillable = ['name'];
}
