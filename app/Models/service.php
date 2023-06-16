<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
     public function shopMechanic()
    {
        return $this->belongsTo(shopMechanic::class, 'mechanic_id');
    }
    
     public function CarCc()
    {
        return $this->belongsTo(CarCc::class, 'cc_id');
    }
    public function mechanicService()
    {
        return $this->belongsTo(mechanicService::class, 'service_id');
    }
}
