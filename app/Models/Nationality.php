<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    use HasFactory  ,  HasTranslations; 

    protected $fillable = ['nationality_name'];

    public $translatable = ['nationality_name'];

    //!  one to many Relationship between my__parents , nationalities :
    // علاقة الأب بالجنسية
    public function fathers(){
        return $this->hasMany(My_Parent::class , 'Nationality_Father_id' , 'id');
    }

    // علاقة الام بالجنسية
    public function mothers(){
        return $this->hasMany(My_Parent::class , 'Nationality_Mother_id' , 'id');
    }
 

}
