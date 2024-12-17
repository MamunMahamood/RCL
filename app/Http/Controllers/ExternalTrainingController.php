<?php

namespace App\Http\Controllers;

use App\Models\ExternalTraining;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExternalTrainingController extends Controller
{
    public function external_training_store(){
        $volunteer = Volunteer::where('user_id', Auth::user()->id)->first();
        if(!empty(request())){
            ExternalTraining::create([
                'volunteer_id'=>Auth::user()->id,
                'training_name'=>request()->training_name,
                'duration'=>request()->duration,
                'attend_date'=>request()->attend_date,
                'organization_name'=>request()->organization_name,
            ]);

           

            
        }
        $external_trainings = ExternalTraining::where('volunteer_id', $volunteer->id)->get();

        
        return response()->json(['status'=>true, 'message' => 'External Training is Saved', 'external_trainings'=>$external_trainings,]);
    }
}
