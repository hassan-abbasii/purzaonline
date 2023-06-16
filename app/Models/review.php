<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;
     public function shop()
    {
        return $this->belongsTo(shop::class, 'shop_id');
    }
    public function users()
    {
        return $this->belongsTo(users::class, 'user_id');
    }
}
