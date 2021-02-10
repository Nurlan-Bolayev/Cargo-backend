<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrustedPeople extends Model
{
    use HasFactory;
    protected $table = 'trusted_people';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
