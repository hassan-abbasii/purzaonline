<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slot extends Model
{
    use HasFactory;
     public function shopMechanic()
    {
        return $this->belongsTo(shopMechanic::class, 'mechanic_id');
    }
}
