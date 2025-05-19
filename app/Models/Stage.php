<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stage extends Model
{
    use HasFactory ,  HasTranslations; 

    public $translatable = ['name', 'notes'];

    protected $fillable = ['name','notes'];

    //! one to many Relationship between stages, classrooms
    public function classrooms(){
        return $this->hasMany(Classroom::class , 'stage_id', 'id');
    }

    //! one to many Relationship between stages, sections
    public function sections(){
        return $this->hasMany(Section::class , 'stage_id', 'id');
    }


}
