<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Religion;
use App\Models\BloodGroup;
use App\Models\Nationality;

class AddParent extends Component
{
    public $successMessage = '';

    public $currentStep = 1;

    // properties :
    public $Email , $Password ,
    
    // father inputs 
    $Name_Father_ar , $Name_Father_en , $Job_Father_ar , $Job_Father_en , $National_ID_Father , $Passport_ID_Father , 
    $Phone_Father , $Nationality_Father_id , $Blood_Type_Father_id , $Religion_Father_id , $Address_Father ,

    // mother inputs 
    $Name_Mother_ar , $Name_Mother_en , $Job_Mother_ar , $Job_Mother_en , $National_ID_Mother , 
    $Passport_ID_Mother , $Phone_Mother,
    $Nationality_Mother_id , $Blood_Type_Mother_id , $Religion_Mother_id ,$Address_Mother ;


    public function render()
    {
        return view('livewire.add-parent' ,[
            'Nationalities' => Nationality::all() ,
            'Blood_Types' => BloodGroup::all() ,
            'Religions' => Religion::all() ,
        ]);
    }

    //method : firstStepSubmit
    public function firstStepSubmit(){
        $this->currentStep = 2;   
    }
    //method : secondStepSubmit
    public function secondStepSubmit(){
        $this->currentStep = 3;
    }
    //method : back
    public function back($step){
        $this->currentStep = $step;
    }

    //method : submitForm
    public function submitForm(){
        $this->successMessage = 'save successfully.';

    }
    


}
