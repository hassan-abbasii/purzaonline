<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;
     public function service()
    {
        return $this->belongsTo(carService::class, 'service_id');
    }
    public function sarvice()
{
    return $this->belongsTo(service::class,'service_id');
}
public function slot()
{
    return $this->belongsTo(slot::class,'slot_id');
}
public function shop()
{
    return $this->belongsTo(shop::class,'shop_id');
}

 public function car()
{
    return $this->belongsTo(CarCc::class,'cc_id');
}
public function users(){
	return $this->belongsTo(users::class,'user_id');
}
}
