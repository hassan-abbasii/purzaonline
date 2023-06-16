<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopMechanic extends Model
{
    use HasFactory;
    public function mechanic()
{
    return $this->belongsTo(mechanic::class, 'mechanic_id');
}
}
