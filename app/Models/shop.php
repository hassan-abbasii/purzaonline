<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
    use HasFactory;
       public function users()
{
    return $this->belongsTo(users::class, 'user_id');
}
}
