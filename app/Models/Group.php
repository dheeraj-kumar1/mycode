<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['group_name','status'];
     public function scopeActive($query){

     }
       public function groups(){
        return $this->hasMany(groups::class);
    }
}
