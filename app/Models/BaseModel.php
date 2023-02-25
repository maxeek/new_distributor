<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function index($fields)
    {
        return get_called_class()::select($fields)->get();
    }
}
