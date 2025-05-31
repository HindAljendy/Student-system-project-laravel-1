<?php

namespace App\Models;

use App\Models\Religion;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Religion extends Model
{
    use HasFactory  ,  HasTranslations; 

    protected $fillable = ['religion_name'];

    public $translatable = ['religion_name'];

    //!  one to many Relationship between my__parents , religions :
    // علاقة الأب بالديانة
    public function fathers(){
        return $this->hasMany(My_Parent::class , 'Religion_Father_id' , 'id');
    }

    // علاقة الام بالديانة
    public function mothers(){
        return $this->hasMany(My_Parent::class , 'Religion_Mother_id' , 'id');
    }

}
