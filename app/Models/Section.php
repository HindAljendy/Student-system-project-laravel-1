<?php

namespace App\Models;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory ,  HasTranslations; 

    protected $fillable = ['section_name','status', 'stage_id', 'classroom_id'];
    public $translatable = ['section_name'];

   //! one to many Relationship between stages, sections
    public function stage(){
        return $this->belongsTo(Stage::class);
    }

    //! one to many Relationship between classrooms, sections
    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }

}
