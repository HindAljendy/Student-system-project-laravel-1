<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodGroup extends Model
{
    use HasFactory;

    protected $fillable = ['group_name'];

    //!  one to many Relationship between my__parents , blood_groups :
    // علاقة الأب بزمرة الدم
    public function fathers(){
        return $this->hasMany(My_Parent::class , 'Blood_Type_Father_id' , 'id');
    }

    // علاقة الام بزمرة الدم
    public function mothers(){
        return $this->hasMany(My_Parent::class , 'Blood_Type_Mother_id' , 'id');
    }
}
