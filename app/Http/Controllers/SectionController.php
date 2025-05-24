<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Stage;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditSectionRequest;
use App\Http\Requests\StoreSectionRequest;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.

     * sections => relationship name  / dd( $stagesWithRelatedSections); =>relations
     */
    public function index()
    {
        // To Display the sections 
        $stagesWithRelatedSections=Stage::with(['sections'])->get();
        // To display all stages in select in AddForm
        $all_Stages = Stage::all();
        return view('pages.sections.sectionswithModals', compact('stagesWithRelatedSections', 'all_Stages'));
    }
    
    //! get All classrooms : 
    // Retrieve a list of classrooms associated with the specified stage
        public function getAllClassrooms($id )
    {
        // pluck('column_value', 'column_key'); => return accossiative array ..
        $listOfClassrooms= Classroom::where('stage_id',$id )->pluck('class_name','id');
        return $listOfClassrooms;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSectionRequest $request)
    {
        try {
            $validated = $request->validated(); 

            DB::beginTransaction(); // Start a transaction
            //! spatie translatable Eloquent Model

            $section =Section::create([
                'section_name' => ['en'=>$validated['Name_Section_En']  , 'ar'=> $validated['Name_Section_Ar']],
                'status'       => 1, // set the status value to 1 when the record is created ..
                'stage_id'     => $validated['stage_id'],
                'classroom_id' => $validated['classroom_id'],
            ]); 

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.created'));

            return redirect()->route('sections.index');

        } catch (Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error storing section: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSectionRequest $request)
    {
        try {
            $validated = $request->validated(); 
            $section = Section::findOrFail($request->id);

            DB::beginTransaction(); // Start a transaction

            $updateData = [
                'section_name'    => ['en' => $validated['Name_Section_En'], 'ar' => $validated['Name_Section_Ar']],
                'stage_id'        => $validated['stage_id'],
                'classroom_id'    => $validated['classroom_id'],
            ];

            $updateData['status']  = isset($request->status) ? 1 : 0;

            $section->update($updateData);

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.update'));

            return redirect()->route('sections.index');

        } catch (Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error updating section: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = Section::findOrFail($request->id)->delete();
        flash()->addSuccess(trans('messages.delete'));
        return redirect()->route('sections.index');
    }
}
