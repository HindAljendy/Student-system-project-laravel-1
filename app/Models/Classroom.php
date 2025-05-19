<?php

namespace App\Models;

use App\Models\Stage;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory  ,  HasTranslations; 

    protected $fillable = ['class_name', 'stage_id', ];

    public $translatable = ['class_name'];

    //! one to many Relationship between stages, classrooms
    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    //! one to many Relationship between sections, classrooms
    public function sections(){
        return $this->hasMany(Section::class, 'classroom_id', 'id');
    }
}
