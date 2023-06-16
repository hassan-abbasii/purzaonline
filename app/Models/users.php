<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    public function getAll(){
    	return users::all();
    }

    public function user()
    {
        return $this->belongsTo(users::class);
    }
}
