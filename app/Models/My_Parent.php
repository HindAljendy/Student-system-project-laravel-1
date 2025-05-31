<?php

namespace App\Models;

use App\Models\Religion;
use App\Models\BloodGroup;
use App\Models\Nationality;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class My_Parent extends Model
{
    use HasFactory  ,  HasTranslations; 

    protected $fillable = ['Email','Password', 
    'Name_Father', 'National_ID_Father ', 'Passport_ID_Father' , 'Phone_Father', 'Job_Father' , 'Nationality_Father_id', 'Blood_Type_Father_id' ,'Religion_Father_id' , 'Address_Father',

    'Name_Mother' , 'National_ID_Mother', 'Passport_ID_Mother', 'Phone_Mother' , 'Job_Mother' , 'Nationality_Mother_id', 'Blood_Type_Mother_id' , 'Religion_Mother_id', 'Address_Mother'
    ];

    public $translatable = ['Name_Father' , 'Job_Father' ];

    //!  one to many Relationship between my__parents , nationalities :
    public function fatherNationality(){
        return $this->belongsTo(Nationality::class , 'National_ID_Father');
    }
    public function motherNationality(){
        return $this->belongsTo(Nationality::class , 'National_ID_Mother');
    }
    
    //!  one to many Relationship between my__parents , religions :
    public function fatherReligion()
    {
        return $this->belongsTo(Religion::class, 'Religion_Father_id');
    }
    public function motherReligion()
    {
        return $this->belongsTo(Religion::class, 'Religion_Mother_id');
    }

    //!  one to many Relationship between my__parents , blood_groups :
    public function fatherBloodType()
    {
        return $this->belongsTo(BloodGroup::class, 'Blood_Type_Father_id');
    }
    public function motherBloodType()
    {
        return $this->belongsTo(BloodGroup::class, 'Blood_Type_Mother_id');
    }
}
