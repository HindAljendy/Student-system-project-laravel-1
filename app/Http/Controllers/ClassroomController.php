<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditClassroomRequest;
use App\Http\Requests\StoreClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();
        $classrooms = Classroom::all();
        return view('pages.classrooms.classroomswithModals' , compact('stages', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        $List_classes = $request->List_classes;
        try {
            $validated = $request->validated(); 

            DB::beginTransaction(); // Start a transaction
            //! spatie translatable Eloquent Model

            foreach ($List_classes as $List_class) {
                $classroom =Classroom::create([
                'class_name' => ['en'=> $List_class['name_class_en']  , 'ar'=> $List_class['name_class_ar'] ],
                'stage_id'   =>  $List_class['stage_id']  ,
            ]); 
            }

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.created'));

            return redirect()->route('classrooms.index');

        } catch (\Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error storing classroom: ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }
    } 


    /**
     * Update the specified resource in storage.
     */
    public function update(EditClassroomRequest $request)
    {
        try {
            $validated = $request->validated(); 
            $classroom = Classroom::findOrFail($request->id);

            DB::beginTransaction(); // Start a transaction
            //! spatie translatable Eloquent Model

            $classroom->update([
            'class_name'  => ['en'=>$validated['name_class_en']  , 'ar'=> $validated['name_class_ar']] ,
            'stage_id'    => $validated['stage_id'],
        ]);

            DB::commit(); // Commit the transaction if save is successful
            flash()->addSuccess(trans('messages.update'));

            return redirect()->route('classrooms.index');

        } catch (\Exception  $e) {

            DB::rollBack(); // Roll back the transaction if save fails
            flash()->addError(trans('messages.error' . ' : ' . $e->getMessage()));
            \Log::error('Error updating classroom : ' . $e->getMessage() . ' - ' . $e->getTraceAsString());
            
            return redirect()->back()->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $classroom = Classroom::findOrFail($request->id)->delete();
        flash()->addSuccess(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }

    /* delete  all checked classrooms */
    public function deleteAll(Request $request){
        // because the value of input  "delete_all_id" in modal dispalay type string => "delete_all_id": "on,2,4",
        // must transform to array By use method explode => QUERY :whereIn
        
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->delete();
        flash()->addSuccess(trans('messages.delete'));
        return redirect()->route('classrooms.index');

    }

    /* fillter classrooms is designed to retrieve all stages and filter classrooms based on the provided stage_id from the request. It then passes these data to a view */
    public function fillter_classrooms(Request $request){
        $request->validate([
        'stage_id' => 'required|exists:stages,id',
        ]);

        $stages=Stage::all();

        // Get classrooms filtered by the selected stage_id
        $search=Classroom::select('*')->where('stage_id', $request -> stage_id)->get();

        // Return the view with stages and filtered classrooms
        return view('pages.classrooms.classroomswithModals', compact('stages'))->with('details', $search);
    }


    
}
