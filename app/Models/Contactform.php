<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Contactform extends Model
{
    use HasFactory;
    protected $table = 'contactforms';
    protected $fillable = [
        'name', 'email','type','location','userid','date','whatsapp','email','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */

    public function user(){
        return $this->hasOne(User::class,'id','userid');
    }
    public function getCreatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
    public function getUpdatedAtAttribute($value){
        return Carbon::parse($value)->timestamp;
    }
}
