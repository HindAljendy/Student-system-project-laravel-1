<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->integer('status');  // active , Inactive 

            //! every section belongsTo "stage , classroom"
            /* Fk : Relation one to many with stages */
            $table->foreignId('stage_id')->constrained('stages')->cascadeOnDelete();

            /* Fk : Relation one to many with classrooms */
            $table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
