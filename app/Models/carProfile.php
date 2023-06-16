<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carProfile extends Model
{
    use HasFactory;
    public function carService()
    {
        return $this->belongsTo(carService::class, 'service_id');
    }
}
