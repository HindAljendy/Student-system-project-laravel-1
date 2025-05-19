<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreStageRequest;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();
        return view('pages.stages.stagewithModals' , compact('stages'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStageRequest $request)
    {
        try {
            $validated = $request->validated(); 

            DB::beginTransaction(); // Start a transaction
            //! spatie translatable Eloquent Model

            // way 1
            $stage =Stage::create([
                'name' => ['en'=>$validated['name_stage_en']  , 'ar'=> $validated['name_stage_ar']],
                'notes'=> ['en'=>$validated['notes_stage_en'] , 'ar'=> $validated['notes_stage_ar']],
            ]); 

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.created'));

            return redirect()->route('stages.index');

        } catch (\Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error storing stage: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }
        
        //? $e->getTraceAsString() => (debugging) to find out where the error occurred and how it was implemented within the program.

        //! spatie translatable Eloquent Model
        // way 2  public function setTranslation(string $attributeName, string $locale, string $value)
        // $post->setTranslation('name', 'en', 'Updated name in English');

        /* $translations_name=[
            'en'=> $validated['name_stage_en'],
            'ar'=> $validated['name_stage_ar'],
        ];
        $translations_notes=[
            'en'=> $validated['notes_stage_en'],
            'ar'=>$validated['notes_stage_en'] ,
        ];
        $stage->setTranslations('name' ,$translations_name);
        $stage->setTranslations('notes',$translations_notes); */
    }





    /**
     * Update the specified resource in storage.

     * <!-- The id send with request  To know the specific stage  = don't show the id in URL SO must don't send the  $stage with route :  FOR SECURITY  -->
     */
    public function update(StoreStageRequest $request )
    {
        try {
            $validated = $request->validated(); 
            $stage = Stage::findOrFail($request->id);

            DB::beginTransaction(); // Start a transaction
            //! spatie translatable Eloquent Model


            $stage->update([
                'name' => ['en'=>$validated['name_stage_en']  , 'ar'=> $validated['name_stage_ar']],
                'notes'=> ['en'=>$validated['notes_stage_en'] , 'ar'=> $validated['notes_stage_ar']],
            ]); 

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.update'));

            return redirect()->route('stages.index');

        } catch (\Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error storing stage: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request )
    {
        //!  delete Stage : Application of not being able to delete the stage if there are classrooms attached to it => Fk : stage_id , CascadeOnDelete
        /* First, make sure that there are classrooms related to the stage. 
        If there are, an error appears stating that the stage cannot be deleted. 
        If there are none, the stage is deleted immediately. */

        $class_Id= Classroom::where('stage_id', $request->id)->pluck('stage_id');
        
        if($class_Id->count()  == 0){
            $stage = Stage::findOrFail($request->id)->delete();
            flash()->addSuccess(trans('messages.delete'));
            return redirect()->route('stages.index'); 
        }
        else{
            flash()->addError(trans('messages.error_deleteStage'));            
            return redirect()->route('stages.index');
        }
        


    }
}
