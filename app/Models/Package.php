<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function owner(){
        return $this->belongsTo(User::class,'owner_id');
    }

    public function declared(){
        return $this->hasMany(Package::class);
    }

    public function undeclared(){
         return $this->$this->hasMany(Package::class);
    }

    public function overseasAddresses(){
        return $this->belongsTo(OverseasAddress::class,'start_point_id');
    }
}
